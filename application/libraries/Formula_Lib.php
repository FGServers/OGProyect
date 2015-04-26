<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo formula_lib.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class Formula_Lib extends oGPCore
{
	/**
	 * __construct()
	 */
	public function __construct ()
	{
		parent::__construct();
	}

	/**
	 * method phalanx_range
	 * param $phalanx_level
	 * return the plalanx range
	 */
	public function phalanx_range ( $phalanx_level )
	{
		$range = 0;

		if ( $phalanx_level > 1 )
		{
			$range = pow ( $phalanx_level , 2 ) - 1;
		}
		elseif ( $phalanx_level == 1 )
		{
			$range = 1;
		}

		return $range;
	}

	/**
	 * method missile_range
	 * param $impulse_drive_level
	 * return the missile range
	 */
	public function missile_range ( $impulse_drive_level )
	{
		if ( $impulse_drive_level > 0 )
		{
			return ( $impulse_drive_level * 5 ) - 1;
		}

		return 0;
	}
}
/* end of Formula_Lib.php */