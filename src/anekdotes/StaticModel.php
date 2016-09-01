<?php

namespace Anekdotes\Database;

use ArrayAccess;
use Str;

/**
 * Abstract class used to create static Model classes. These classes have their data initiated in themselves. Allows Model operations to be used to a certain extent.
 */
class StaticModel implements ArrayAccess
{
    /**
   * Contains the static base data of the model, as defined in the model's file.
   *
   * @var mixed[]  model's base data
   */
  public static $data = [];

  /**
   * Contains the current locale or it'll select french by default.
   *
   * @var string The current locale
   */
  public $locale = 'fr';

  /**
   * Contains the data of the current object in the model.
   *
   * @var mixed[] The object's data
   */
  public $instaceData = [];

  /**
   * Initiates a new object that is part of the model, with the provided data.
   *
   * @param mixed[] $instaceData The objects's data
   */
  public function __construct($instaceData)
  {
      $this->instaceData = $instaceData;
  }

  /**
   * Obtain an instance of the model object at the requested id.
   *
   * @param  int         $id The id of the requested object
   *
   * @return StaticModel     The instance of the model object
   */
  public static function find($id)
  {
      $obj = static::where('id', '=', $id);

      return isset($obj[0]) ? $obj[0] : null;
  }

  /**
   * Obtain all objects in the static model that fit the requested conditions.
   *
   * @todo Implement the operator
   *
   * @param  string        $colomn   The column that is evaluated in the where
   * @param  string        $operator should be able to have a different operation based on the operator
   * @param  string        $search   The value searched in the column
   *
   * @return StaticModel[]           An array with all the model results
   */
  public static function where($colomn, $operator, $search)
  {
      $results = [];
      foreach (static::$data as $value) {
          $columns = explode('.', $colomn);
          $temp = null;
          foreach ($columns as $index => $column) {
              if ($index == 0) {
                  if (isset($value[$column])) {
                      $temp = $value[$column];
                  }
              } else {
                  if (isset($temp[$column])) {
                      $temp = $temp[$column];
                  }
              }
          }

          //check operator
          if ($operator == '=' && $temp == $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '==' && $temp == $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '>' && $temp > $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '<' && $temp < $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '<>' && $temp <> $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '!=' && $temp != $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '===' && $temp === $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '>=' && $temp >= $search) {
              $results[] = new static($value);
          }
          elseif ($operator == '<=' && $temp <= $search) {
              $results[] = new static($value);
          }
      }

      return $results;
  }

  /**
   * Obtain all objects in the static model that are in the column's array.
   *
   * @param  string        $column   The column that is evaluated in the where
   * @param  string        $search   The value searched in the column array
   *
   * @return StaticModel[]           An array with all the model results
   */
  public static function whereIn($column, $search)
  {
      $results = [];
      foreach (static::$data as $value) {
          if (in_array($value[$column], $search)) {
              $results[] = new static($value);
          }
      }

      return $results;
  }

  /**
   * Returns an array with all the items in the model.
   *
   * @return StaticModel[] Array with all the items
   */
  public static function all()
  {
      $results = [];
      foreach (static::$data as $value) {
          $results[] = new static($value);
      }

      return $results;
  }

  /**
   * Get an attribute of an item in the model instance.
   *
   * @param  string $key The name of the requested attribute
   *
   * @return string      The value of the requested attribute
   */
  public function getAttribute($key)
  {
      if (array_key_exists($key, $this->instaceData)) {
          return $this->instaceData[$key];
      } elseif (array_key_exists($this->locale, $this->instaceData) &&
      array_key_exists($key, $this->instaceData[$this->locale])) {
          return $this->instaceData[$this->locale][$key];
      } else {
          return;
      }
  }

  /**
   * Sets an attribute of an item in the model instance.
   *
   * @param string $key   The name of the attribute to modify
   * @param string $value The value to associate to the attribute
   */
  public function setAttribute($key, $value)
  {
      if (is_null($key)) {
          $this->instaceData[] = $value;
      } else {
          $this->instaceData[$key] = $value;
      }
  }

  /**
   * Encodes the model instance to JSON.
   *
   * @return string Encoded JSON String of the instance
   */
  public function toJson()
  {
      return json_encode($this->instaceData);
  }

  /**
   * Encodes all of the model to JSON.
   *
   * @return string Encoded JSON String of the StaticModel Array
   */
  public static function allJson()
  {
      return json_encode(static::$data);
  }

  /**
   * Obtain the attribute at the set key of the instance.
   *
   * @param  string $key The name of the requested attribute
   *
   * @return string      The value of the requested attribute
   */
  public function __get($key)
  {
      return $this->getAttribute($key);
  }

  /**
   * Sets an attribute of an item in the model instance.
   *
   * @param string $key   The name of the attribute to modify
   * @param string $value The value to associate to the attribute
   */
  public function __set($key, $value)
  {
      $this->setAttribute($key, $value);
  }

  /**
   * Sets the attribute at the provided offset.
   *
   * @todo Test if it works. Probably is an error of undefined key
   *
   * @param int    $offset   Attribute to set the offset at
   * @param string $value    Value to set at that offset
   */
  public function offsetSet($offset, $value)
  {
      $this->setAttribute($key, $value);
  }

  /**
   * Check if there's an object at that offset.
   *
   * @param  int      $offset Offset to verify
   *
   * @return bool          if there's either a value or a translated value at that offset
   */
  public function offsetExists($offset)
  {
      return isset($this->instaceData[$offset]) || isset($this->instaceData[$this->locale][$offset]);
  }

  /**
   * Unset the value at the provided offset.
   *
   * @param  int   $offset Offset to unset the value at
   */
  public function offsetUnset($offset)
  {
      unset($this->instaceData[$offset]);
  }

  /**
   * Get the attribute at the requested offset.
   *
   * @param  string  $offset  The offset where the attribute is requested
   *
   * @return mixed            The requested attribute
   */
  public function offsetGet($offset)
  {
      return $this->getAttribute($offset);
  }
}
