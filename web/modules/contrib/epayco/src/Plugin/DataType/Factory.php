<?php

namespace Drupal\epayco\Plugin\DataType;

use Drupal\Core\TypedData\TypedData;
use Epayco\Epayco;

/**
 * Provides a data type wrapping \Epayco\Epayco.
 *
 * @DataType(
 *   id = "epayco_factory",
 *   label = @Translation("ePayco factory"),
 *   description = @Translation("An ePayco client to handle requests."),
 * )
 */
class Factory extends TypedData {

  /**
   * The ePayco factory.
   *
   * @var \Epayco\Epayco
   */
  protected $value;

  /**
   * {@inheritdoc}
   */
  public function setValue($value, $notify = TRUE) {
    if ($value && !$value instanceof Epayco) {
      throw new \InvalidArgumentException('Invalid ePayco factory.');
    }
    parent::setValue($value, $notify);
  }

}
