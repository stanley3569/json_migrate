<?php

namespace Drupal\json_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Drupal\migrate\Row;

/**
 * Source plugin to import data from JSON files.
 *
 * @MigrateSource(
 *   id = "json_page"
 * )
 */
class JsonPage extends SourcePluginBase {

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $title = $row->getSourceProperty('title');

    if (strlen($title) > 255) {
      $row->setSourceProperty('title', substr($title, 0, 255));
    }
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'json_filename' => [
        'type' => 'string'
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return [
      'title' => $this->t('city'),
      'id' => $this->t('_id'),
      'longitude' => $this->t('longitude'),
      'latitude' => $this->t('latitude'),
      'pop' => $this->t('pop'),
      'state' => $this->t('state'),
      'json_filename' => $this->t("Source JSON filename"),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return "json data";
  }

  /**
   * Initializes the iterator with the source data.
   *
   * @return \Iterator
   *   An iterator containing the data for this source.
   */
  protected function initializeIterator() {
    $path = dirname(DRUPAL_ROOT) . "/data/cities.json";
    $filename = $path;
    $rows = [];

    $row = json_decode(file_get_contents($filename), TRUE);
    $row['json_filename'] = $filename;

    return new \ArrayIterator($row);
  }

}
