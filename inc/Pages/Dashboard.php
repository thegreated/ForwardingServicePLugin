<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_mngr;

	public $pages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Forwarding Service', 
				'menu_title' => 'Forwarding Services', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSettings()
	{

		$args = array(
			array(
				'option_group' => 'forwarding_service_error_handler',
				'option_name' => 'alecaddd_plugin',
				'callback' => array( $this->callbacks_mngr, 'errorHandler' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(

			array(
				'id' => 'forwarding_service_error_index',
				'title' => 'Error Handler',
				'callback' => array( $this->callbacks_mngr, 'errorHandlerManager' ),
				'page' => 'alecaddd_plugin'
			)
	
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array();
	
		foreach ( $this->errors as $key => $value ) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_mngr, 'textField' ),
				'page' => 'alecaddd_plugin',
				'section' => 'forwarding_service_error_index',
				'args' => array(
					'option_name' => 'alecaddd_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}

		
		$this->settings->setFields( $args );
	}
}