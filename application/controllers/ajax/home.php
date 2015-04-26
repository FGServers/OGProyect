<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo home.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class Home extends OGPCore
{
	private $_lang;

	/**
	 * __construct()
	 */
	function __construct()
	{
		parent::__construct();

		$this->_lang = parent::$lang;

		$this->build_page();
	}

	/**
	 * method __destruct
	 * param
	 * return close db connection
	 */
	function __destruct()
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
		parent::$page->display ( parent::$page->parse_template ( parent::$page->get_template ( 'ajax/home_view' ) , $this->_lang ) , FALSE , '' , FALSE );
	}
}
/* end of home.php */