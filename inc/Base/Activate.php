<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Base;

use Inc\System\Database;
use Inc\System\Model\User;

class Activate
{



	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'alecaddd_plugin' ) ) {
			update_option( 'alecaddd_plugin', $default );
		}

		if ( ! get_option( 'alecaddd_plugin_cpt' ) ) {
			update_option( 'alecaddd_plugin_cpt', $default );
		}

		if ( ! get_option( 'alecaddd_plugin_tax' ) ) {
			update_option( 'alecaddd_plugin_tax', $default );
		}

		Database::activate();
		//Database::jal_install_data();
		

	}

	
}