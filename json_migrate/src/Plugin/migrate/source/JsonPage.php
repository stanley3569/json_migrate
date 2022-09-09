<?php 
namespace Drupal\json_migrate\Plugin\migrate\source; 
use Drupal\migrate\Plugin\migrate\source\SourcePluginBase; 
use Drupal\migrate\Row; 
 
/** 
* Source plugin to import data from JSON files 
* @MigrateSource( 
*   id = "json_page" 
* ) 
*/ 
class JsonPage extends SourcePluginBase { 
 
  public function prepareRow(Row $row) { 
    $title = $row->getSourceProperty('title');  
    // make sure the title isn't too long for Drupal 
    if (strlen($title) > 255) { 
      $row->setSourceProperty('title', substr($title,0,255)); 
    }  
    return parent::prepareRow($row); 
  } 
 
  public function getIds() { 
    $ids = [ 
      'json_filename' => [ 
        'type' => 'string' 
      ] 
    ]; 
    return $ids; 
  } 
 
  public function fields() { 
    return array( 
      'url' => $this->t('URL'), 
      'title' => $this->t('Title'), 
      'body' => $this->t('Body'), 
      'date' => $this->t('Date Published'), 
      'json_filename' => $this-t{"Source JSON filename") 
    ); 
  } 
 
  public function __toString() { 
    return "json data"; 
  } 
 
  /** 
   * Initializes the iterator with the source data. 
   * @return \Iterator 
   *   An iterator containing the data for this source. 
   */ 
  protected function initializeIterator() { 
 
    // loop through the source files and find anything with a .json extension 
    $path = dirname(DRUPAL_ROOT) . "/source-data/cities.json"; 
    $filenames = glob($path); 
    $rows = []; 
    foreach ($filenames as $filename) { 
      // using second argument of TRUE here because migrate needs the data to be 
      // associative arrays and not stdClass objects. 
      $row = json_decode(file_get_contents($filename), true); // sets the title, body, etc. 
      $row['json_filename'] = $filename;
 
    } 
 
    // Migrate needs an Iterator class, not just an array
    return new \ArrayIterator($rows); 
  } 
} 