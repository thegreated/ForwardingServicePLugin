<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;
//test
use Inc\System\Model\User;
use Inc\System\Model\Token;

use Inc\Base\BaseController;


use Inc\System\Database;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/cpt.php" );
	}

	public function memberMngr()
	{
	
	//	$args['id'] = (int)"4";
		//$args['firstname'] = "KARDO";
	//	$args['lastname'] = "DALISAY";
		 $args['email'] = "edwardarilla2@gmail.com";
		$args['password'] = "passwword";
		//$args['contact'] =  (int)"09126996536";
	
		 $user = new User($args);
		//print_r($user->email);
		 var_dump($user->login());
		// echo $user->register();
	//	var_dump($user);
	//	var_dump( $user->resetPassword(1));
		//
		//echo Database::activate();
		// $args['user_id'] = (int)6;
		// $args['active'] = (int)"1";
		// $args['setting'] = (int)"1";
		// $token = new Token($args);
		// $token = $token->generateToken();
		// var_dump($token);
	}

	// public function adminTaxonomy()
	// {
	// 	return require_once( "$this->plugin_path/templates/taxonomy.php" );
	// }

	// public function adminWidget()
	// {
	// 	return require_once( "$this->plugin_path/templates/widget.php" );
	// }

	// public function adminGallery()
	// {
	// 	echo "<h1>Gallery Manager</h1>";
	// }

	// public function adminTestimonial()
	// {
	// 	echo "<h1>Testimonial Manager</h1>";
	// }

	// public function adminTemplates()
	// {
	// 	echo "<h1>Templates Manager</h1>";
	// }

	// public function adminAuth()
	// {
	// 	echo "<h1>Templates Manager</h1>";
	// }

	// public function adminMembership()
	// {
	// 	echo "<h1>Membership Manager</h1>";
	// }

	// public function adminChat()
	// {
	// 	echo "<h1>Chat Manager</h1>";
	// }
}