<?php

namespace Drupal\Tests\reference_table_formatter\Kernel;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Render\RenderContext;
use Drupal\entity_test\Entity\EntityTest;
use Drupal\entity_test\Entity\EntityTestBundle;
use Drupal\entity_test\Entity\EntityTestNoLabel;
use Drupal\entity_test\Entity\EntityTestWithBundle;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\language\LanguageNegotiatorInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\reference_table_formatter\Plugin\Field\FieldFormatter\EntityReferenceTableFormatter;

/**
 * @coversDefaultClass \Drupal\reference_table_formatter\Plugin\Field\FieldFormatter\EntityReferenceTableFormatter
 * @group reference_table_formatter
 */
class EntityReferenceTest extends EntityKernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['field', 'reference_table_formatter'];

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->drupalSetCurrentUser($this->drupalCreateUser([], NULL, TRUE));

    $this->renderer = $this->container->get('renderer');
  }

  /**
   * Tests with generic entity referencing.
   */
  public function testGenericEntityFormatting() {
    $this->installEntitySchema('entity_test_with_bundle');
    EntityTestBundle::create(['id' => 'test_bundle'])->save();
    $this->setUpChildFields('entity_test_with_bundle', 'test_bundle');

    $child_0 = EntityTestWithBundle::create([
      'type' => 'test_bundle',
      'name' => $this->randomMachineName(),
      'field_string' => 'Foo',
    ]);
    $child_0->save();

    $child_1 = EntityTestWithBundle::create([
      'type' => 'test_bundle',
      'name' => $this->randomMachineName(),
    ]);
    $child_1->save();

    // Setup reference field to be used on the parent entity.
    $field_storage = FieldStorageConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_reference',
      'type' => 'entity_reference',
      'cardinality' => -1,
      'settings' => ['target_type' => 'entity_test_with_bundle'],
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => 'entity_test',
      'label' => 'References',
      'settings' => [
        'handler' => 'default:entity_test_with_bundle',
        'handler_settings' => [
          'target_bundles' => ['test_bundle' => 'test_bundle'],
        ],
      ],
    ]);
    $field->save();

    $parent = EntityTest::create([
      'field_reference' => [
        ['target_id' => $child_0->id()],
        ['target_id' => $child_1->id()],
      ],
    ]);

    $build = $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_reference->view([
        'type' => 'entity_reference_table',
        'settings' => ['show_entity_label' => TRUE],
      ]);
    });
    $this->setRawContent($this->renderer->renderPlain($build));

    $this->assertText($child_0->label());
    $this->assertText('Foo');
    $this->assertText($child_1->label());

    // Test no error raised with deleted referenced entity.
    $child_1->delete();
    $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_reference->view([
        'type' => 'entity_reference_table',
        'settings' => ['show_entity_label' => TRUE],
      ]);
    });

    $this->installModule('language');
    $lang = ConfigurableLanguage::createFromLangcode('ja');
    $lang->save();
    $negotiator = $this->createMock(LanguageNegotiatorInterface::class);
    $negotiator->method('initializeType')->willReturn([$lang]);
    $this->container->get('language_manager')->setNegotiator($negotiator);

    $child_0 = EntityTestWithBundle::load($child_0->id());
    $child_0->addTranslation('ja', ['field_string' => '大丈夫']);
    $child_0->save();
    $parent = EntityTest::create(['field_reference' => ['target_id' => $child_0->id()]]);
    $build = $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_reference->view(['type' => 'entity_reference_table']);
    });
    $this->setRawContent($this->renderer->renderPlain($build));
    $this->assertText('大丈夫', 'Referenced entities rendered in correct language.');

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Using non-default reference handler with reference_table_formatter has not yet been implemented.');

    // Install views so we can test using an entity reference selection plugin
    // other than default.
    $this->installModule('views');
    $field
      ->setSettings(['handler' => 'views', 'handler_settings' => []])
      ->save();

    // Re-create parent entity to reload latest FieldConfig instance.
    $parent = EntityTest::create([
      'field_reference' => [
        ['target_id' => $child_0->id()],
      ],
    ]);

    $build = $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_reference->view(['type' => 'entity_reference_table']);
    });
  }

  /**
   * Tests formatting with various default selection plugin handler settings.
   */
  public function testDefaultSelectionTargetBundles() {
    $this->installEntitySchema('entity_test_with_bundle');
    EntityTestBundle::create(['id' => 'test_bundle'])->save();
    $this->setUpChildFields('entity_test_with_bundle', 'test_bundle');

    $child = EntityTestWithBundle::create([
      'type' => 'test_bundle',
      'name' => $this->randomMachineName(),
      'field_string' => 'Foo',
    ]);
    $child->save();

    $field_storage = FieldStorageConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_missing_bundles',
      'type' => 'entity_reference',
      'cardinality' => -1,
      'settings' => ['target_type' => 'entity_test_with_bundle'],
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => 'entity_test',
      'label' => 'References Missing Bundles',
      'settings' => [
        'handler' => 'default:entity_test_with_bundle',
        'handler_settings' => ['target_bundles' => []],
      ],
    ]);
    $field->save();

    $parent = EntityTest::create([
      'field_missing_bundles' => [['target_id' => $child->id()]],
    ]);

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Cannot render reference table for References Missing Bundles: target_bundles setting on the field should not be empty.');

    $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_missing_bundles->view(['type' => 'entity_reference_table']);
    });

    $field_storage = FieldStorageConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_no_bundle',
      'type' => 'entity_reference',
      'cardinality' => -1,
      'settings' => ['target_type' => 'entity_test'],
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => 'entity_test',
      'label' => 'References No Bundles',
      'settings' => [
        'handler' => 'default:entity_test',
        'handler_settings' => ['target_bundles' => []],
      ],
    ]);
    $field->save();

    $child = EntityTest::create(['field_string' => 'Foo']);
    $child->save();

    $parent = EntityTest::create([
      'field_no_bundle' => [['target_id' => $child->id()]],
    ]);

    $build = $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_no_bundle->view(['type' => 'entity_reference_table']);
    });
    $this->setRawContent($this->renderer->renderPlain($build));
    $this->assertText('Foo', 'Formatter should work for entities with no bundles.');
  }

  /**
   * Tests formatting for referenced entities that have no label.
   */
  public function testNoLabel() {
    $this->installEntitySchema('entity_test_no_label');
    $field = $this->setUpChildFields('entity_test_no_label', 'entity_test_no_label');

    $child_0 = EntityTestNoLabel::create([
      'name' => $this->randomMachineName(),
      'field_string' => 'Foo',
    ]);
    $child_0->save();

    $child_1 = EntityTestNoLabel::create([
      'name' => $this->randomMachineName(),
      'field_string' => 'Bar',
    ]);
    $child_1->save();

    // Setup reference field to be used on the parent entity.
    $field_storage = FieldStorageConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_reference',
      'type' => 'entity_reference',
      'cardinality' => -1,
      'settings' => ['target_type' => 'entity_test_no_label'],
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => 'entity_test',
      'label' => 'References',
      'settings' => [
        'handler' => 'default:entity_test_no_label',
        'handler_settings' => [
          'target_bundles' => ['entity_test_no_label' => 'entity_test_no_label'],
        ],
      ],
    ]);
    $field->save();

    $parent = EntityTest::create([
      'field_reference' => [
        ['target_id' => $child_0->id()],
        ['target_id' => $child_1->id()],
      ],
    ]);

    $build = $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_reference->view([
        'type' => 'entity_reference_table',
        'settings' => ['show_entity_label' => TRUE],
      ]);
    });
    $this->setRawContent($this->renderer->renderPlain($build));

    $this->assertText('Foo');
    $this->assertText('Bar');

    $elements = $this->cssSelect('th');
    $this->assertCount(1, $elements, 'Only fields shown event with show_entity_label set to TRUE when entities have no label key.');
  }

  /**
   * Tests compatibility with entity reference revisions field type.
   *
   * @requires module entity_reference_revisions
   * @requires module paragraphs
   */
  public function testEntityReferenceRevisions() {
    $this->installModule('entity_reference_revisions');
    $this->installModule('file');
    $this->installModule('paragraphs');
    $this->installEntitySchema('paragraph');

    ParagraphsType::create(['id' => 'test_bundle'])->save();
    $this->setUpChildFields('paragraph', 'test_bundle');

    $paragraph_0 = Paragraph::create([
      'type' => 'test_bundle',
      'field_string' => 'Foo',
    ]);
    $paragraph_0->save();

    $paragraph_1 = Paragraph::create([
      'type' => 'test_bundle',
      'field_string' => 'Bar',
    ]);
    $paragraph_1->save();

    // Setup reference field to be used on the parent entity.
    $field_storage = FieldStorageConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_reference',
      'type' => 'entity_reference_revisions',
      'cardinality' => -1,
      'settings' => ['target_type' => 'paragraph'],
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => 'entity_test',
      'label' => 'References',
      'settings' => [
        'handler' => 'default:paragraph',
        'handler_settings' => [
          'target_bundles' => ['test_bundle' => 'test_bundle'],
        ],
      ],
    ]);
    $field->save();

    $parent = EntityTest::create([
      'field_reference' => [
        [
          'target_id' => $paragraph_0->id(),
          'target_revision_id' => $paragraph_0->getRevisionId(),
        ],
        [
          'target_id' => $paragraph_1->id(),
          'target_revision_id' => $paragraph_1->getRevisionId(),
        ],
      ],
    ]);

    $build = $this->renderer->executeInRenderContext(new RenderContext(), function () use ($parent) {
      return $parent->field_reference->view(['type' => 'entity_reference_table']);
    });
    $this->setRawContent($this->renderer->renderPlain($build));

    $this->assertText('Foo');
    $this->assertText('Bar');
  }

  /**
   * Sets up child fields.
   *
   * @param string $entity_type
   *   The entity type of referenced child entities.
   * @param string $bundle
   *   The bundle for referenced child entities.
   */
  protected function setUpChildFields($entity_type, $bundle) {
    // Setup a generic field to be used on referenced entities.
    $field_storage = FieldStorageConfig::create([
      'entity_type' => $entity_type,
      'field_name' => 'field_string',
      'type' => 'string',
    ]);
    $field_storage->save();

    FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => $bundle,
      'label' => 'String Field',
    ])->save();

    $this->container
      ->get('entity_display.repository')
      ->getViewDisplay($entity_type, $bundle)
      ->setComponent('field_string')
      ->save();
  }

  /**
   * @covers ::settingsSummary
   */
  public function testSettingsSummary() {
    $formatter = new EntityReferenceTableFormatter(
      'test',
      [],
      $this->createMock(FieldDefinitionInterface::class),
      [],
      '',
      '_custom',
      [],
      $this->container->get('reference_table_formatter.renderer'),
      $this->container->get('entity_type.manager'),
      $this->container->get('entity_display.repository')
    );

    $summary = $formatter->settingsSummary();
    $this->assertCount(1, $summary);
    $this->assertEquals(
      t('Showing a table of rendered @mode entity fields', ['@mode' => 'Default']),
      $summary[0],
      'Formatter settings summary with default values.'
    );

    $formatter->setSetting('view_mode', 'does_not_exist');
    $this->assertEquals(
      t('Showing a table of rendered @mode entity fields', ['@mode' => 'does_not_exist']),
      $formatter->settingsSummary()[0],
      'View mode setting that does not exist is printed verbatim.'
    );

    $empty = $this->randomMachineName();
    $formatter->setSettings([
      'view_mode' => 'default',
      'show_entity_label' => TRUE,
      'empty_cell_value' => $empty,
      'hide_header' => TRUE,
    ]);

    $summary = $formatter->settingsSummary();
    $this->assertCount(4, $summary);
    $this->assertEquals(t('Entity label displayed'), $summary[1], 'Show entity label message.');
    $this->assertEquals(t('Table header hidden'), $summary[2], 'Table header setting message.');
    $this->assertEquals(t('Empty cell value: @value', ['@value' => $empty]), $summary[3], 'Empty cell value message.');
  }

}
