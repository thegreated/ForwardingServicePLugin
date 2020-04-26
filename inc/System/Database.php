<?php 
/**
 * @package  Forwarding Service
 */
namespace Inc\System;


class Database 
{

    public function activate() {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        global $wpdb;
        $table = $wpdb->prefix . 'fs_user';
        $charset = $wpdb->get_charset_collate();
        $charset_collate = $wpdb->get_charset_collate();
        $sql2 = "CREATE TABLE $table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        firstname varchar(150) NOT NULL,
        lastname varchar(150) NOT NULL,
        email varchar(50) ,
        password varchar(150),
        contact int(25),
        birthday date,
        UNIQUE (email),
        PRIMARY KEY  (id)
        )"; //$charset_collate;";

        dbDelta( $sql2 );

        $table = $wpdb->prefix . 'fs_token';
        $sql .= "CREATE TABLE $table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        codeData varchar(150) NOT NULL,
        active varchar(150),
        setting int(5), 
        created_at DATETIME NOT NULL
                DEFAULT CURRENT_TIMESTAMP, 
        -- updated_at DATETIME NOT NULL
        --         DEFAULT CURRENT_TIMESTAMP, 
        PRIMARY KEY  (id),
        FOREIGN KEY (user_id) REFERENCES " .$wpdb->prefix . "fs_user(id)
        )"; //$charset_collate;";
        
       // return $sql;
        dbDelta( $sql );



        add_option( 'jal_db_version', $jal_db_version );
    }   

    public function remove() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fs_user';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
        $table_name = $wpdb->prefix . 'fs_token';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    //delete_option("jal_db_version");
    } 


    function jal_install_data() {
        global $wpdb;
        
        $welcome_name = 'Mr. WordPress';
        $welcome_text = 'Congratulations, you just completed the installation!';
        
        $table_name = $wpdb->prefix . 'md_things';
        
        $wpdb->insert( 
            $table_name, 
            array( 
                'time' => current_time( 'mysql' ), 
                'name' => $welcome_name, 
                'text' => $welcome_text, 
            ) 
        );
    }

}