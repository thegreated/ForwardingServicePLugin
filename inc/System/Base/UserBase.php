<?php
/**
 * @package  Forwarding Service
 */
namespace Inc\System\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class UserBase extends BaseController
{
	public $callbacks;

	public $subpages = array();

	public function register()
	{
	//	if ( ! $this->activated( 'chat_manager' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->settings->addSubPages( $this->subpages )->register();
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'alecaddd_plugin', 
				'page_title' => 'Member Manager', 
				'menu_title' => 'Member Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'ed_members', 
				'callback' => array( $this->callbacks, 'memberMngr' )
			)
		);
	}
}