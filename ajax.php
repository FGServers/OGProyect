<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo ajax.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

define ( 'INSIDE'  	, TRUE );
define ( 'IN_LOGIN'	, TRUE );
define ( 'OGP_ROOT'	, './' );

$InLogin	= TRUE;

include ( OGP_ROOT . 'application/core/common.php' );

switch ( ( isset ( $_GET['content'] ) ? $_GET['content'] : '' ) )
{
	// information ajax request
	case 'info':

		include ( OGP_ROOT . AJAX_PATH. 'info.php' );
		new Info();

	break;

	// media ajax request
	case 'media':

		include ( OGP_ROOT . AJAX_PATH. 'media.php' );
		new Media();

	break;

	// home ajax request
	case '':
	case 'home':
	default:

		include ( OGP_ROOT . AJAX_PATH. 'home.php' );
		new Home();

	break;
}
/* end of ajax.php */