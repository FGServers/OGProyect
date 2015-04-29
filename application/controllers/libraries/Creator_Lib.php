<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo creator_lib.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class Creator_Lib extends OGPCore
{
	private $_lang;

	/**
	 * __construct()
	 */
	public function __construct ()
	{
		parent::__construct();

		$this->_lang	= parent::$lang;
	}

	/**
	 * method return_size
	 * param $position
	 * param $home_world
	 * return a radomized size for the planet
	 */
	private function return_size ( $position , $home_world = FALSE )
	{
		if ( ! $home_world )
		{
			// THIS DIAMETERS ARE CALCULATED TO RETURN THE CORRECT AMOUNT OF FIELDS, IT SHOULD WORK AS OGAME.
			$min 			= array (  9747 ,  9849 ,  9900 , 11091 , 12166 , 12166 , 11875 , 12962 , 12689 , 12410 , 12084 , 11662 , 10441 , 9000 , 8063 );
			$max 			= array ( 10393 , 10489 , 11705 , 14248 , 14595 , 15067 , 15395 , 15685 , 15428 , 14934 , 14283 , 13077 , 11000 , 9644 , 8603 );

			$diameter		= mt_rand ( $min[$position - 1] , $max[$position - 1] );
			$diameter	   *= PLANETSIZE_MULTIPLER;

			$fields 		= (int)pow ( ( $diameter / 1000 ) , 2 );
		}
		else
		{
			$diameter	= '12800';
			$fields 	= Functions_Lib::read_config ( 'initial_fields' );
		}

		$return['diameter'] 	= $diameter;
		$return['field_max'] 	= $fields;

		return $return;
	}

	/**
	 * method create_planet
	 * param $Galaxy
	 * param $System
	 * param $Position
	 * param $PlanetOwnerID
	 * param $PlanetName
	 * param $HomeWorld
	 * return creates a planet into the data base.
	 */
	public function create_planet ( $galaxy , $system , $position , $planet_owner_id , $planet_name = '' , $home_world = FALSE )
	{
		$planet_exist	= parent::$db->query_fetch ( "SELECT `id`
						   								FROM " . PLANETS . "
						   								WHERE `galaxy` = '" . $galaxy . "' AND
						   										`system` = '" . $system . "' AND
						   										`planet` = '" . $position . "';" );


		if ( ! $planet_exist )
		{
			$planet 						= $this->return_size ( $position , $home_world );
			$planet['diameter'] 			= ($planet['field_max'] ^ (14 / 1.5)) * 75;
			$planet['metal']	 			= BUILD_METAL;
			$planet['crystal'] 				= BUILD_CRISTAL;
			$planet['deuterium'] 			= BUILD_DEUTERIUM;
			$planet['metal_perhour'] 		= Functions_Lib::read_config ( 'metal_basic_income' );
			$planet['crystal_perhour'] 		= Functions_Lib::read_config ( 'crystal_basic_income' );
			$planet['deuterium_perhour'] 	= Functions_Lib::read_config ( 'deuterium_basic_income' );
			$planet['galaxy'] 				= $galaxy;
			$planet['system'] 				= $system;
			$planet['planet'] 				= $position;

			if ( $position == 1 || $position == 3 )
			{
				$PlanetType 		= array('desert');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(0,100);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}
			elseif ( $position == 2 || $position == 5 ) 
			{
				$PlanetType 		= array('dry');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-25,75);
				$planet['temp_max'] = $planet['temp_min'] + 40;

			}
			elseif ( $position == 4 || $position == 7 )
			{
				$PlanetType 		= array('normal');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-50,50);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}
			elseif ( $position == 6 || $position == 9 )
			{
				$PlanetType 		= array('jungle');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-25,75);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}
			elseif ( $position == 8 || $position == 11 )
			{
				$PlanetType 		= array('water');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-75,25);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}
			elseif ( $position == 10 || $position == 13)
			{
				$PlanetType 		= array('ice');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-100,10);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}
			elseif ( $position == 12 || $position == 14)
			{
				$PlanetType 		= array('gas');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-75,25);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}
			else
			{
				$PlanetType 		= array('desert','dry','normal','jungle','water','ice','gas');
				$PlanetDesign 		= array('_01','_02','_03','_04','_05','_06','_07','_08','_09','_10');
				$planet['temp_min'] = mt_rand(-120,10);
				$planet['temp_max'] = $planet['temp_min'] + 40;
			}

			$planet['image'] 			= $PlanetType[mt_rand(0,count($PlanetType) - 1)];
			$planet['image'] 		   .= $PlanetDesign[mt_rand(0,count($PlanetDesign) - 1)];
			$planet['planet_type'] 		= 1;
			$planet['id_owner'] 		= $planet_owner_id;
			$planet['last_update'] 		= time();
			$planet['name'] 			= ($planet_name == '') ? $this->_lang['ge_colony'] : $planet_name;

			parent::$db->query ( "INSERT INTO " . PLANETS . " SET
									" . ( ( $home_world == FALSE ) ? "`name` = '{$this->_lang['ge_colony']}'," : '' ) ."
									`id_owner` = '" . $planet['id_owner'] . "',
									`galaxy` = '" . $planet['galaxy'] . "',
									`system` = '" . $planet['system'] . "',
									`planet` = '" . $planet['planet'] . "',
									`last_update` = '" . $planet['last_update'] . "',
									`planet_type` = '" . $planet['planet_type'] . "',
									`image` = '" . $planet['image'] . "',
									`diameter` = '" . $planet['diameter'] . "',
									`field_max` = '" . $planet['field_max'] . "',
									`temp_min` = '" . $planet['temp_min'] . "',
									`temp_max` = '" . $planet['temp_max'] . "',
									`metal` = '" . $planet['metal'] . "',
									`metal_perhour` = '" . $planet['metal_perhour'] . "',
									`crystal` = '" . $planet['crystal'] . "',
									`crystal_perhour` = '" . $planet['crystal_perhour'] . "',
									`deuterium` = '" . $planet['deuterium'] . "',
									`deuterium_perhour` = '" . $planet['deuterium_perhour'] . "';" );

			$last_id	= parent::$db->insert_id();

			parent::$db->query ( "INSERT INTO " . BUILDINGS . " SET
									`building_planet_id` = '" . $last_id . "';" );

			parent::$db->query ( "INSERT INTO " . DEFENSES . " SET
									`defense_planet_id` = '" . $last_id . "';" );

			parent::$db->query ( "INSERT INTO " . SHIPS . " SET
									`ship_planet_id` = '" . $last_id . "';" );

			$RetValue = TRUE;
		}
		else
		{
			$RetValue = FALSE;
		}

		return $RetValue;
	}

	/**
	 * method create_moon
	 * param $galaxy
	 * param $system
	 * param $Planet
	 * param $Owner
	 * param $MoonID
	 * param $MoonName
	 * param $Chance
	 * return creates a moon into the data base.
	 */
	public function create_moon ( $galaxy, $system, $planet, $owner, $moon_name, $chance )
	{
		$planet_name            = "";

		$MoonPlanet = parent::$db->query_fetch ( "SELECT pm2.`id`,
														pm2.`name`,
														pm2.`temp_max`,
														pm2.`temp_min`,
														(SELECT pm.`id` AS `id_moon`
															FROM " . PLANETS . " AS pm
															WHERE pm.`galaxy` = '". $galaxy ."' AND
																	pm.`system` = '". $system ."' AND
																	pm.`planet` = '". $planet ."' AND
																	pm.`planet_type` = 3) AS `id_moon`
													FROM " . PLANETS . " AS pm2
													WHERE pm2.`galaxy` = '". $galaxy ."' AND
															pm2.`system` = '". $system ."' AND
															pm2.`planet` = '". $planet ."';" );

		if ( $MoonPlanet['id_luna'] == '' )
		{
			if ( $MoonPlanet['id'] != 0 )
			{
				$SizeMin                = 2000 + ( $chance * 100 );

				$SizeMax                = 6000 + ( $chance * 200 );

				$planet_name             = $MoonPlanet['name'];

				$maxtemp                = $MoonPlanet['temp_max'] - mt_rand(10, 45);
				$mintemp                = $MoonPlanet['temp_min'] - mt_rand(10, 45);
				$size                   = mt_rand ($SizeMin, $SizeMax);

				parent::$db->query ( "INSERT INTO " . PLANETS . " SET
										`name` = '". ( ($moon_name == '') ? $this->_lang['fcm_moon'] : $moon_name ) ."',
										`id_owner` = '". $owner ."',
										`galaxy` = '". $galaxy ."',
										`system` = '". $system ."',
										`planet` = '". $planet ."',
										`last_update` = '". time() ."',
										`planet_type` = '3',
										`image` = 'mond',
										`diameter` = '". $size ."',
										`field_max` = '1',
										`temp_min` = '". $mintemp ."',
										`temp_max` = '". $maxtemp ."';" );

				$last_id	= parent::$db->insert_id();

				parent::$db->query ( "INSERT INTO " . BUILDINGS . " SET
										`building_planet_id` = '" . $last_id . "';" );

				parent::$db->query ( "INSERT INTO " . DEFENSES . " SET
										`defense_planet_id` = '" . $last_id . "';" );

				parent::$db->query ( "INSERT INTO " . SHIPS . " SET
										`ship_planet_id` = '" . $last_id . "';" );
			}
		}

		return $planet_name;
	}
}
/* end of Creator_Lib.php */