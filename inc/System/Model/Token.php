<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\System\Model;

use Inc\System\Model\DatabaseObject;



class Token extends DatabaseObject
{

    static $wpdb;
    static public $table_name;
    static protected $db_columns = ['id', 'user_id', 'codeData', 'active', 'setting'];

    public  $id;
    public  $user_id;
    public  $codeData;
    public  $active;
    public  $setting;
    public  $created_at;
    public  $updated_at;
    
    //email handler
    public const Setting = [
        1 => 'Reset Password',
        2 => 'Reset Email',
        3 => 'Edit Profile',
        4 => 'Update Cart',
        5 => 'Send Cart',
        6 => 'Receive Cart',
      ];
    
    public function __construct($args=[])
    {
        global $wpdb;
        static::$wpdb = $wpdb;
        static::$table_name = $wpdb->prefix . 'fs_token';
        $this->user_id = sanitize_text_field($args['user_id']) ?? '';
        $this->codeData = sanitize_text_field($args['codeData']) ?? '';
        $this->active = sanitize_text_field($args['active']) ?? '';
        $this->setting = sanitize_text_field($args['setting']) ?? '';
        // $this->create = sanitize_text_field($args['create']) ?? '';
        // $this->updated = sanitize_text_field($args['updated']) ?? '';

    }

    public function generateToken()
    {
        $this->codeData =  md5(time());
        //return $this;
        parent::insert();
         //email

    }


}