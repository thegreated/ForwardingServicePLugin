<?php
/**
 * @package  Forwarding Service
 */
namespace Inc\System\Model;

use Inc\System\Model\DatabaseObject;
use Inc\System\Model\Token;


class User extends DatabaseObject
{

    static $wpdb;
    static public $table_name;
    static protected $db_columns = ['id', 'firstname', 'lastname', 'email', 'password', 'contact', 'birthday'];

    public $id;
    public  $firstname;
    public  $lastname;
    public  $email;
    public  $password;
    protected $hashed_password;
    public  $contact;
    public  $birthday;
    
    

    
    public function __construct($args=[])
    {
        global $wpdb;
        static::$wpdb = $wpdb;
        static::$table_name = $wpdb->prefix . 'fs_user';
        $this->firstname = sanitize_text_field($args['firstname']) ?? '';
        $this->lastname = sanitize_text_field($args['lastname']) ?? '';
        $this->email = sanitize_text_field($args['email']) ?? '';
        $this->password = sanitize_text_field($args['password']) ?? '';
        $this->contact = sanitize_text_field($args['contact']) ?? '';
        $this->birthday = sanitize_text_field($args['birthday']) ?? '';
    }

    //acount modification
    public function login()
    {
        
        $result = $this->checkEmail();
        $this->hashed_password = $result[0]->password ;
        if( $result && $this->checkPassword($result[0]->id ))
        {
       //     success;
           return $result;
        }

        //invalid username and password;
    
    
    }

    public function register()
    {
        $this->password = wp_hash_password($this->password);
        return parent::insert();
    }

    public function disable()
    {

    }

    public function banned()
    {

    }

    public function editDetails()
    {
        
        return parent::update($this->$id);

    }


    //recover account

    public function resetPassword($id)
    {
         static::$wpdb->update( static::$table_name  ,array('password'=> $this->hashPassword()), array('id' => $id));
         $setting = '1';
         $token = $this->generateToken($id,$setting);

        
    }

    public function resetEmail($id)
    {
        $this->id = $id;
        static::$wpdb->update( static::$table_name  ,array('email'=> $this->email), array('id' => $id));
        $setting = '2';
        $args = $this->generateToken($id,$setting);
        $token = new Token($args);

        
        $token = $token->generateToken();
        return $token;
    }

    //validation

    public function checkEmail()
    {
        $result = static::$wpdb->get_results ( "SELECT * FROM ".static::$table_name ." WHERE email='".$this->email."'");
        if($result)
        {
         return $result;
          
        }
        return false;
    }

    public function checkPassword($id)
    {
        if(wp_check_password($this->password , $this->hashed_password,$id)) {
            return true;
         } else {
            return false; 
        }
    }

    public function duplicateContact()
    {

    }


    private function  verify_password() 
    {
     
        if(wp_check_password($this->hashed_password , $this->password)) {
           return true;
        } else {
           return false;
        }
    }

    private function hashPassword()
    {
        return $this->hashed_password =  wp_hash_password($this->password);
    }
    
    public function generateToken($id,$setting)
    {
        $args['user_id'] = (int)$id;
		$args['active'] = (int)"1";
		$args['setting'] = (int)$setting;
		return $args;
    }
}
