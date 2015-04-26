<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo index.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

define ( 'INSIDE'		, TRUE );
define ( 'IN_INSTALL'	, TRUE );
define ( 'OGP_ROOT'		, './../' );

require ( OGP_ROOT . 'application/core/common.php' );

switch ( ( isset ( $_GET['page'] ) ? $_GET['page'] : '' ) )
{
	case 'update':

		include_once ( OGP_ROOT . INSTALL_PATH . 'update.php' );
		new Update();

	break;

	case 'migrate':

		include_once ( OGP_ROOT . INSTALL_PATH . 'migration.php' );
		new Migration();

	break;

	case '':
	case 'install':
	default:

		include_once ( OGP_ROOT . INSTALL_PATH . 'installation.php' );
		new Installation();

	break;
}
/* end of index.php */