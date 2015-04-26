<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo encrypter.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class Encrypter extends OGPCore
{
	private $_lang;
	private $_current_user;

	/**
	 * __construct()
	 */
	public function __construct()
	{
		parent::__construct();

		// check if session is active
		parent::$users->check_session();

		$this->_lang			= parent::$lang;
		$this->_current_user	= parent::$users->get_user_data();

		// Check if the user is allowed to access
		if ( Administration_Lib::have_access ( $this->_current_user['user_authlevel'] ) && Administration_Lib::authorization ( $this->_current_user['user_authlevel'] , 'use_tools' ) == 1 )
		{
			$this->build_page();
		}
		else
		{
			die ( Functions_Lib::message ( $this->_lang['ge_no_permissions'] ) );
		}
	}

	/**
	 * method __destruct
	 * param
	 * return close db connection
	 */
	public function __destruct ()
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
		$parse				= $this->_lang;
		$parse['uncrypted']	= '';
		$parse['encrypted']	= sha1 ( '' );

		if ( isset ( $_POST['uncrypted'] ) && $_POST['uncrypted'] != '' )
		{
			$parse['uncrypted']	= $_POST['uncrypted'];
			$parse['encrypted']	= sha1 ( $_POST['encrypted'] );
		}

		parent::$page->display ( parent::$page->parse_template ( parent::$page->get_template ( 'adm/encrypter_view' ) , $parse ) );
	}
}
/* end of encrypter.php */