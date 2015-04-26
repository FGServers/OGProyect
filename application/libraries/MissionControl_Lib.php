<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo missionControl_lib.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) die ( header ( 'location:../../' ) );

include_once ( OGP_ROOT . 'application/libraries/missions/missions.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/acs.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/attack.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/colonize.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/deploy.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/destroy.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/expedition.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/missile.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/recycle.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/spy.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/stay.php' );
include_once ( OGP_ROOT . 'application/libraries/missions/transport.php' );

class MissionControl_Lib extends OGPCore
{
	/**
	 * __construct()
	 */
	public function __construct ( &$planet )
	{
		parent::__construct();

		parent::$db->query ( "LOCK TABLE " . ACS_FLEETS . " WRITE,
											" . REPORTS . " WRITE,
											" . MESSAGES . " WRITE,
											" . FLEETS . " WRITE,
											" . FLEETS . " AS f WRITE,
											" . FLEETS . " AS f1 WRITE,
											" . FLEETS . " AS f2 WRITE,
											" . PLANETS . " WRITE,
											" . PLANETS . " AS pc1 WRITE,
											" . PLANETS . " AS pc2 WRITE,
											" . PLANETS . " AS p WRITE,
											" . PLANETS . " AS pm WRITE,
											" . PLANETS . " AS pm2 WRITE,
											" . PREMIUM . " WRITE,
											" . PREMIUM . " AS pr WRITE,
											" . SETTINGS . " WRITE,
											" . SHIPS . " WRITE,
											" . SHIPS . " AS s WRITE,
											" . BUILDINGS . " WRITE,
											" . BUILDINGS . " AS b WRITE,
											" . DEFENSES . " WRITE,
											" . DEFENSES . " AS d WRITE,
											" . RESEARCH . " WRITE,
											" . RESEARCH . " AS r WRITE,
											" . USERS_STATISTICS . " WRITE,
											" . USERS_STATISTICS . " AS us WRITE,
											" . USERS . " WRITE,
											" . USERS . " AS u WRITE" );

		$all_fleets	= parent::$db->query ( "SELECT *
												FROM " . FLEETS . "
												WHERE (
														(
															`fleet_start_galaxy` = " . $planet['galaxy'] . " AND
															`fleet_start_system` = " . $planet['system'] . " AND
															`fleet_start_planet` = " . $planet['planet'] . " AND
															`fleet_start_type` = " . $planet['planet_type'] . "
														)
														OR
														(
															`fleet_end_galaxy` = " . $planet['galaxy'] . " AND
															`fleet_end_system` = " . $planet['system'] . " AND
															`fleet_end_planet` = " . $planet['planet'] . "
														)

														AND
															`fleet_end_type`= " . $planet['planet_type'] . "
													  )

													  AND

													  (
													  	`fleet_start_time` < '" . time() . "' OR
													  		`fleet_end_time` < '" . time() . "' );" );


		// missions list
		$missions	= array	(
								1	=> 'Attack',
								2	=> 'Acs',
								3	=> 'Transport',
								4	=> 'Deploy',
								5	=> 'Stay',
								6	=> 'Spy',
								7	=> 'Colonize',
								8	=> 'Recycle',
								9	=> 'Destroy',
								10	=> 'Missile',
								15	=> 'Expedition',
							);

		// Process missions
		while ( $fleet = parent::$db->fetch_array ( $all_fleets ) )
		{
			$class_name		= $missions[$fleet['fleet_mission']];
			$mission_name	= strtolower ( $class_name ) . '_mission';

			$mission	= new $class_name;
			$mission->$mission_name ( $fleet );
		}

		parent::$db->query ( "UNLOCK TABLES" );
	}
}
/* end of MissionControl_Lib.php */