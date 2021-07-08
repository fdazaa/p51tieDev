<?php

namespace Drupal\reference_table_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\reference_table_formatter\EntityToTableRendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * A field formatter to display a table.
 *
 * @FieldFormatter(
 *   id = "entity_reference_table",
 *   label = @Translation("Table of Fields"),
 *   field_types = {
 *     "entity_reference",
 *     "entity_reference_revisions"
 *   }
 * )
 */
class EntityReferenceTableFormatter extends EntityReferenceFormatterBase {

  /**
   * Entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Entity display repository.
   *
   * @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface
   */
  protected $entityDisplayRepository;

  /**
   * Entity to table renderer.
   *
   * @var \Drupal\reference_table_formatter\EntityToTableRenderer
   */
  protected $tableRenderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('reference_table_formatter.renderer'),
      $container->get('entity_type.manager'),
      $container->get('entity_display.repository')
    );
  }

  /**
   * Constructs a new ReferenceTableFormatter.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Third party settings.
   * @param \Drupal\reference_table_formatter\EntityToTableRendererInterface $reference_renderer
   *   The entity-to-table renderer.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The Entity type manager.
   * @param \Drupal\Core\Entity\EntityDisplayRepositoryInterface $entity_display_repository
   *   The entity display repository.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, EntityToTableRendererInterface $reference_renderer, EntityTypeManagerInterface $entity_type_manager, EntityDisplayRepositoryInterface $entity_display_repository) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->referenceRenderer = $reference_renderer;
    $this->entityTypeManager = $entity_type_manager;
    $this->entityDisplayRepository = $entity_display_repository;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'view_mode' => 'default',
      'show_entity_label' => FALSE,
      'empty_cell_value' => '',
      'hide_header' => FALSE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['view_mode'] = [
      '#title' => $this->t('View Mode'),
      '#description' => $this->t('Select the view mode which will control which fields are shown and the display settings of those fields.'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('view_mode'),
      '#options' => $this->getConfigurableViewModes(),
    ];

    $form['show_entity_label'] = [
      '#title' => $this->t('Display Entity Label'),
      '#description' => $this->t('Whether the label of the target entity be displayed in the table.'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('show_entity_label'),
    ];

    $form['hide_header'] = [
      '#title' => $this->t('Hide Table Header'),
      '#description' => $this->t('Whether the table header be displayed.'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('hide_header'),
    ];

    $form['empty_cell_value'] = [
      '#title' => $this->t('Empty Cell Value'),
      '#description' => $this->t('The string which should be displayed in empty cells.'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('empty_cell_value'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $settings = $this->getSettings();

    $view_modes = $this->getConfigurableViewModes();
    $view_mode = $settings['view_mode'];
    $arguments = ['@mode' => isset($view_modes[$view_mode]) ? $view_modes[$view_mode] : $view_mode];
    $summary[] = $this->t('Showing a table of rendered @mode entity fields', $arguments);

    if ($settings['show_entity_label']) {
      $summary[] = $this->t('Entity label displayed');
    }

    if ($settings['hide_header']) {
      $summary[] = $this->t('Table header hidden');
    }

    if ($settings['empty_cell_value']) {
      $summary[] = $this->t('Empty cell value: @value', ['@value' => $settings['empty_cell_value']]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    if ($entities = $this->getEntitiesToView($items, $langcode)) {
      // Return an array so that field labels still work.
      return [
        $this->referenceRenderer->getTable(
          $this->getFieldSetting('target_type'),
          $this->getTargetBundleId(),
          $entities,
          $this->getSettings()
        ),
      ];
    }
    return [];
  }

  /**
   * Get the view modes which can be selected for this field formatter.
   *
   * @return string[]
   *   Array of view mode options; translated labels keyed by ID.
   */
  protected function getConfigurableViewModes() {
    return $this->entityDisplayRepository->getViewModeOptions($this->getFieldSetting('target_type'));
  }

  /**
   * Get the target bundle from a reference field.
   *
   * @return string
   *   The bundle that is the target of the field.
   *
   * @throws \Exception
   */
  protected function getTargetBundleId() {
    $settings = $this->getFieldSettings();

    if (strpos($settings['handler'], 'default') === 0) {
      $target_entity_type = $this->entityTypeManager->getDefinition($settings['target_type']);

      if (!$target_entity_type->hasKey('bundle')) {
        $target_bundle = $settings['target_type'];
      }
      elseif (!empty($settings['handler_settings']['target_bundles'])) {
        // Default to the first bundle, currently only supporting a single
        // bundle.
        $target_bundle = array_values($settings['handler_settings']['target_bundles']);
        $target_bundle = array_shift($target_bundle);
      }
      else {
        throw new \Exception('Cannot render reference table for ' . $this->fieldDefinition->getLabel() . ': target_bundles setting on the field should not be empty.');
      }
    }
    else {
      // Since we are only supporting rendering a single bundle, we wont know
      // what bundle we are rendering if users aren't using the default
      // selection, which is a simple configuration form.
      throw new \Exception('Using non-default reference handler with reference_table_formatter has not yet been implemented.');
    }

    return $target_bundle;
  }

}
