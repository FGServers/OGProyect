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

define ( 'INSIDE'  	, TRUE );
define ( 'IN_LOGIN'	, TRUE );
define ( 'OGP_ROOT'	, './' );

$InLogin	= TRUE;

include ( OGP_ROOT . 'application/core/common.php' );

switch ( ( isset ( $_GET['page'] ) ? $_GET['page'] : '' ) )
{
	// REGISTER PAGE
	case 'reg':

		include ( OGP_ROOT . HOME_PATH . 'register.php' );
		new Register();

	break;

	// RECOVER PASSWORD PAGE
	case 'recoverpassword':

		include ( OGP_ROOT . HOME_PATH . 'recoverpassword.php' );
		new Recoverpassword();

	break;

	// HOME - INDEX - DEFAULT - START PAGE
	case '':
	default:

		include ( OGP_ROOT . HOME_PATH . 'home.php' );
		new Home();

	break;
}
/* end of index.php */