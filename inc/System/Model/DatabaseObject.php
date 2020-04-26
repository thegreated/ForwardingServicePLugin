<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\System\Model;


class DatabaseObject 
{
    static $wpdb;
    static protected $table_name = '';
    static protected $columns = [];
    public $errors = [];


    public function select()
    {
      $result =static::$wpdb->get_results ( "SELECT * FROM ".static::$table_name  );
      return $result;
    }

    public function insert()
    {
        static::$wpdb->insert( static::$table_name , $this->attributes() );
    }

    public function update($id)
    {
        static::$wpdb->update( static::$table_name , $this->attributes(), array('id' => $id));
 
    }

    public function delete($id)
    {
      static::$wpdb->delete( static::$table_name, array( 'id' => $id ) );
    }

    public function attributes() 
    {
        $attributes = [];
        foreach(static::$db_columns as $column) {
          if($column == 'id') { continue; }
          $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function seperate(){

      $attributes = $this->attributes();
      $attribute_pairs = [];

      foreach($attributes as $key => $value) 
      {
        $attribute_pairs[] = "{$key}='{$value}'";
      }

    }
    

    



}
