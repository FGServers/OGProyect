<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo game.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }
/**
 * MODES
 * before_loads
 * before_page
 * new_page
 */
// INSERT HOOKS AFTER THIS LINE
$hook['before_page'] = array(
                                'class'    => 'MyClass',
                                'function' => 'MyMethod',
                                'filename' => 'MyClass.php',
                                'filepath' => 'hooks',
                                'params'   => array('beer', 'wine', 'snacks')
                                );


// INSERT HOOKS BEFORE THIS LINE
/* end of hooks.php */