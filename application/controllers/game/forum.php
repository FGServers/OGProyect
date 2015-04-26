<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo forum.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class Forum extends OGPCore
{
	const MODULE_ID	= 14;

	/**
	 * __construct()
	 */
	public function __construct ()
	{
		parent::__construct();

		// check if session is active
		parent::$users->check_session();

		// Check module access
		Functions_Lib::module_message ( Functions_Lib::is_module_accesible ( self::MODULE_ID ) );

		$this->build_page();
	}

	/**
	 * method __destruct
	 * param
	 * return close db connection
	 */
	public function __destruct()
	{
		parent::$db->close_connection();
	}

	/**
	 * method build_page
	 * param
	 * return main method, loads everything
	 */
	private function build_page()
	{
		Functions_Lib::redirect ( Functions_Lib::read_config ( 'forum_url' ) );
	}
}
/* end of forum.php */