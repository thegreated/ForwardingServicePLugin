<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Base;


use Inc\System\Database;

class Deactivate
{

	
	public static  function deactivate() {
		flush_rewrite_rules();
		Database::remove();
	}


	
}