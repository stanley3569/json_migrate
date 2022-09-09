<?php

namespace Drupal\json_migrate;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a json migrate entity type.
 */
interface JsonMigrateInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the json migrate title.
   *
   * @return string
   *   Title of the json migrate.
   */
  public function getTitle();

  /**
   * Sets the json migrate title.
   *
   * @param string $title
   *   The json migrate title.
   *
   * @return \Drupal\json_migrate\JsonMigrateInterface
   *   The called json migrate entity.
   */
  public function setTitle($title);

  /**
   * Gets the json migrate creation timestamp.
   *
   * @return int
   *   Creation timestamp of the json migrate.
   */
  public function getCreatedTime();

  /**
   * Sets the json migrate creation timestamp.
   *
   * @param int $timestamp
   *   The json migrate creation timestamp.
   *
   * @return \Drupal\json_migrate\JsonMigrateInterface
   *   The called json migrate entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the json migrate status.
   *
   * @return bool
   *   TRUE if the json migrate is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the json migrate status.
   *
   * @param bool $status
   *   TRUE to enable this json migrate, FALSE to disable.
   *
   * @return \Drupal\json_migrate\JsonMigrateInterface
   *   The called json migrate entity.
   */
  public function setStatus($status);

}
