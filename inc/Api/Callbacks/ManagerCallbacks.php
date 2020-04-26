<?php 
/**
 * @package  Forwarding Service
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function sanitizer( $input )
	{
		
	}
	
	public function errorHandler($input)
	{

		
		$output = array();

		foreach ( $this->errors as $key => $value ) {
			$output[$key] = $input[$key];
		}

		return $output;

		
	}

	public function errorHandlerManager()
	{
		echo 'Manage Error messange on each the pages.';
	}

	public function adminSectionManager()
	{
		echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
	}

	public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = get_option( $option_name );
		$value = $value[$name];
		echo '<input type="text" class="" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" required>';
	}
}