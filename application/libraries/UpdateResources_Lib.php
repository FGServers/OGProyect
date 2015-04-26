<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo updateresources_lib.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class UpdateResources_Lib extends OGPCore
{
	public static function update_resource ( &$CurrentUser, &$CurrentPlanet, $UpdateTime, $Simul = FALSE )
	{
		$resource	= parent::$objects->get_objects();
		$ProdGrid	= parent::$objects->get_production();
		$reslist	= parent::$objects->get_objects_list();

		$game_resource_multiplier		=	Functions_Lib::read_config ( 'resource_multiplier' );
		$game_metal_basic_income		=	Functions_Lib::read_config ( 'metal_basic_income' );
		$game_crystal_basic_income		=	Functions_Lib::read_config ( 'crystal_basic_income' );
		$game_deuterium_basic_income	=	Functions_Lib::read_config ( 'deuterium_basic_income' );

		$CurrentPlanet['metal_max']		=	Production_Lib::max_storable ( $CurrentPlanet[$resource[22]]);
		$CurrentPlanet['crystal_max']	=	Production_Lib::max_storable ( $CurrentPlanet[$resource[23]]);
		$CurrentPlanet['deuterium_max']	=	Production_Lib::max_storable ( $CurrentPlanet[$resource[24]]);

		$MaxMetalStorage                = $CurrentPlanet['metal_max'];
		$MaxCristalStorage              = $CurrentPlanet['crystal_max'];
		$MaxDeuteriumStorage            = $CurrentPlanet['deuterium_max'];

		$Caps           			= array();
		$BuildTemp      			= $CurrentPlanet['temp_max'];
		$sub_query					= '';
		$parse['production_level'] 	= 100;
		$post_porcent 				= Production_Lib::max_production ( $CurrentPlanet['energy_max'] , $CurrentPlanet['energy_used'] );
		$Caps['metal_perhour']		= 0;
		$Caps['crystal_perhour']	= 0;
		$Caps['deuterium_perhour']	= 0;
		$Caps['energy_max']			= 0;
		$Caps['energy_used']		= 0;

		foreach ( $ProdGrid as $ProdID => $formula )
		{
			$BuildLevelFactor			= $CurrentPlanet[ $resource[$ProdID] ."_porcent" ];
			$BuildLevel					= $CurrentPlanet[ $resource[$ProdID] ];
			$BuildEnergy                = $CurrentUser["research_energy_technology"];

			// BOOST
			$geologe_boost				= 1 + ( 1 * ( Officiers_Lib::is_officier_active ( $CurrentUser['premium_officier_geologist'] ) ? GEOLOGUE : 0 ) );
			$engineer_boost				= 1 + ( 1 * ( Officiers_Lib::is_officier_active ( $CurrentUser['premium_officier_engineer'] ) ? ENGINEER_ENERGY : 0 ) );

			// PRODUCTION FORMULAS
			$metal_prod					= eval ( $ProdGrid[$ProdID]['formule']['metal'] );
			$crystal_prod				= eval ( $ProdGrid[$ProdID]['formule']['crystal'] );
			$deuterium_prod				= eval ( $ProdGrid[$ProdID]['formule']['deuterium'] );
			$energy_prod				= eval ( $ProdGrid[$ProdID]['formule']['energy'] );

			// PRODUCTION
			$Caps['metal_perhour']		+= Production_Lib::current_production ( Production_Lib::production_amount ( $metal_prod , $geologe_boost ) , $post_porcent);
			$Caps['crystal_perhour']	+= Production_Lib::current_production ( Production_Lib::production_amount ( $crystal_prod , $geologe_boost ) , $post_porcent);
			$Caps['deuterium_perhour']	+= Production_Lib::current_production ( Production_Lib::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);

			if( $ProdID >= 4 )
			{
				if ( $ProdID == 12 && $CurrentPlanet['deuterium'] == 0 )
				{
					continue;
				}

				$Caps['energy_max']		+=  Production_Lib::production_amount ( $energy_prod , $engineer_boost , TRUE );
			}
			else
			{
				$Caps['energy_used']	+= Production_Lib::production_amount ( $energy_prod , 1 , TRUE );
			}
		}

		if ($CurrentPlanet['planet_type'] == 3)
		{
			$game_metal_basic_income     		= 0;
			$game_crystal_basic_income   		= 0;
			$game_deuterium_basic_income 		= 0;
			$CurrentPlanet['metal_perhour']     = 0;
			$CurrentPlanet['crystal_perhour']   = 0;
			$CurrentPlanet['deuterium_perhour']	= 0;
			$CurrentPlanet['energy_used']       = 0;
			$CurrentPlanet['energy_max']        = 0;
		}
		else
		{
			$CurrentPlanet['metal_perhour']     = $Caps['metal_perhour'];
			$CurrentPlanet['crystal_perhour']   = $Caps['crystal_perhour'];
			$CurrentPlanet['deuterium_perhour']	= $Caps['deuterium_perhour'];
			$CurrentPlanet['energy_used']       = $Caps['energy_used'];
			$CurrentPlanet['energy_max']        = $Caps['energy_max'];
		}

		$ProductionTime               = ($UpdateTime - $CurrentPlanet['last_update']);
		$CurrentPlanet['last_update'] = $UpdateTime;

		if ($CurrentPlanet['energy_max'] == 0)
		{
			$CurrentPlanet['metal_perhour']     = $game_metal_basic_income;
			$CurrentPlanet['crystal_perhour']   = $game_crystal_basic_income;
			$CurrentPlanet['deuterium_perhour'] = $game_deuterium_basic_income;
			$production_level            = 100;
		}
		elseif ($CurrentPlanet["energy_max"] >= $CurrentPlanet["energy_used"])
		{
			$production_level = 100;
		}
		else
		{
			$production_level = floor(($CurrentPlanet['energy_max'] / $CurrentPlanet['energy_used']) * 100);
		}
		if($production_level > 100)
		{
			$production_level = 100;
		}
		elseif ($production_level < 0)
		{
			$production_level = 0;
		}

		if ( $CurrentPlanet['metal'] <= $MaxMetalStorage )
		{
			$MetalProduction = (($ProductionTime * ($CurrentPlanet['metal_perhour'] / 3600))) * (0.01 * $production_level);
			$MetalBaseProduc = (($ProductionTime * ($game_metal_basic_income / 3600 )));
			$MetalTheorical  = $CurrentPlanet['metal'] + $MetalProduction  +  $MetalBaseProduc;
			if ( $MetalTheorical <= $MaxMetalStorage )
			{
				$CurrentPlanet['metal']  = $MetalTheorical;
			}
			else
			{
				$CurrentPlanet['metal']  = $MaxMetalStorage;
			}
		}

		if ( $CurrentPlanet['crystal'] <= $MaxCristalStorage )
		{
			$CristalProduction = (($ProductionTime * ($CurrentPlanet['crystal_perhour'] / 3600))) * (0.01 * $production_level);
			$CristalBaseProduc = (($ProductionTime * ($game_crystal_basic_income / 3600 )));
			$CristalTheorical  = $CurrentPlanet['crystal'] + $CristalProduction  +  $CristalBaseProduc;
			if ( $CristalTheorical <= $MaxCristalStorage )
			{
				$CurrentPlanet['crystal']  = $CristalTheorical;
			}
			else
			{
				$CurrentPlanet['crystal']  = $MaxCristalStorage;
			}
		}

		if ( $CurrentPlanet['deuterium'] <= $MaxDeuteriumStorage )
		{
			$DeuteriumProduction = (($ProductionTime * ($CurrentPlanet['deuterium_perhour'] / 3600))) * (0.01 * $production_level);
			$DeuteriumBaseProduc = (($ProductionTime * ($game_deuterium_basic_income / 3600 )));
			$DeuteriumTheorical  = $CurrentPlanet['deuterium'] + $DeuteriumProduction  +  $DeuteriumBaseProduc;
			if ( $DeuteriumTheorical <= $MaxDeuteriumStorage )
			{
				$CurrentPlanet['deuterium']  = $DeuteriumTheorical;
			}
			else
			{
				$CurrentPlanet['deuterium']  = $MaxDeuteriumStorage;
			}
		}

		if( $CurrentPlanet['metal'] < 0 )
		{
			$CurrentPlanet['metal']  = 0;
		}

		if( $CurrentPlanet['crystal'] < 0 )
		{
			$CurrentPlanet['crystal']  = 0;
		}

		if( $CurrentPlanet['deuterium'] < 0 )
		{
			$CurrentPlanet['deuterium']  = 0;
		}

		if ( $Simul == FALSE )
		{
			// SHIPS AND DEFENSES UPDATE
			$builded		= self::building_queue ( $CurrentUser, $CurrentPlanet, $ProductionTime );
			$ship_points	= 0;
			$defense_points	= 0;

			if ( $builded != '' )
			{
				foreach ( $builded as $element => $count )
				{
					if ( $element <> '' )
					{
						// POINTS
						switch ( $element )
						{
							case ( ( $element >= 202 ) && ( $element <= 215 ) ):
								$ship_points	+= Statistics_Lib::calculate_points ( $element , $count ) * $count;
							break;

							case ( ( $element >= 401 ) && ( $element <= 503 ) ):
								$defense_points	+= Statistics_Lib::calculate_points ( $element , $count ) * $count;
							break;

							default:
							break;
						}

						$sub_query .= "`". $resource[$element] ."` = '". $CurrentPlanet[$resource[$element]] ."', ";
					}
				}
			}

			// RESEARCH UPDATE
			if ( $CurrentPlanet['b_tech'] <= time() && $CurrentPlanet['b_tech_id'] != 0 )
			{
				$CurrentUser['research_points']	= Statistics_Lib::calculate_points ( $CurrentPlanet['b_tech_id'] , $CurrentUser[$resource[$CurrentPlanet['b_tech_id']]] , 'tech' );
				$CurrentUser[$resource[$CurrentPlanet['b_tech_id']]]++;

				$tech_query	 = "`b_tech` = '0',";
				$tech_query	.= "`b_tech_id` = '0',";
				$tech_query	.= "`".$resource[$CurrentPlanet['b_tech_id']]."` = '". $CurrentUser[$resource[$CurrentPlanet['b_tech_id']]] ."',";
				$tech_query	.= "`user_statistic_technology_points` = `user_statistic_technology_points` + '". $CurrentUser['research_points'] ."',";
				$tech_query	.= "`research_current_research` = '0',";
			}
			else
			{
				$tech_query	= "";
			}

			parent::$db->query ( "UPDATE " . PLANETS . " AS p
									INNER JOIN " . USERS_STATISTICS . " AS us ON us.user_statistic_user_id = p.id_owner
									INNER JOIN " . DEFENSES . " AS d ON d.defense_planet_id = p.id
									INNER JOIN " . SHIPS . " AS s ON s.ship_planet_id = p.id
									INNER JOIN " . RESEARCH . " AS r ON r.research_user_id = p.id_owner SET
									`metal` = '" . $CurrentPlanet['metal'] . "',
									`crystal` = '" . $CurrentPlanet['crystal'] ."',
									`deuterium` = '" . $CurrentPlanet['deuterium'] . "',
									`last_update` = '" . $CurrentPlanet['last_update'] . "',
									`b_hangar_id` = '" . $CurrentPlanet['b_hangar_id'] . "',
									`metal_perhour` = '" . $CurrentPlanet['metal_perhour'] . "',
									`crystal_perhour` = '" . $CurrentPlanet['crystal_perhour'] . "',
									`deuterium_perhour` = '" . $CurrentPlanet['deuterium_perhour'] . "',
									`energy_used` = '" . $CurrentPlanet['energy_used'] . "',
									`energy_max` = '" . $CurrentPlanet['energy_max'] . "',
									`user_statistic_ships_points` = `user_statistic_ships_points` + '" . $ship_points . "',
									`user_statistic_defenses_points` = `user_statistic_defenses_points`  + '" . $defense_points . "',
									{$sub_query}
									{$tech_query}
									`b_hangar` = '" . $CurrentPlanet['b_hangar'] . "'
									WHERE `id` = '" . $CurrentPlanet['id'] . "';" );
		}
	}

	private static function building_queue ( $CurrentUser, &$CurrentPlanet, $ProductionTime )
	{
		$resource	= parent::$objects->get_objects();

		if ($CurrentPlanet['b_hangar_id'] != 0)
		{
			$Builded                    = array ();
			$CurrentPlanet['b_hangar'] += $ProductionTime;
			$BuildQueue                 = explode(';', $CurrentPlanet['b_hangar_id']);
			$BuildArray					= array();

			foreach ( $BuildQueue as $Node => $Array )
			{
				if ( $Array != '' )
				{
					$Item              = explode(',', $Array);
					$AcumTime		   = Developments_Lib::development_time ( $CurrentUser , $CurrentPlanet , $Item[0] );
					$BuildArray[$Node] = array($Item[0], $Item[1], $AcumTime);
				}
			}

			$CurrentPlanet['b_hangar_id'] 	= '';
			$UnFinished 					= FALSE;

			foreach ( $BuildArray as $Node => $Item )
			{
				$Element   			= $Item[0];
				$Count     			= $Item[1];
				$BuildTime 			= $Item[2];
				$Builded[$Element] 	= 0;

				if (!$UnFinished and $BuildTime > 0)
				{
					$AllTime = $BuildTime * $Count;

					if($CurrentPlanet['b_hangar'] >= $BuildTime)
					{
						$Done = min($Count, floor( $CurrentPlanet['b_hangar'] / $BuildTime));

						if($Count > $Done)
						{
							$CurrentPlanet['b_hangar'] -= $BuildTime * $Done;
							$UnFinished = TRUE;
							$Count -= $Done;
						}
						else
						{
							$CurrentPlanet['b_hangar'] -= $AllTime;
							$Count = 0;
						}

						$Builded[$Element] += $Done;
						$CurrentPlanet[$resource[$Element]] += $Done;

					}
					else
					{
						$UnFinished = TRUE;
					}
				}
				elseif(!$UnFinished)
				{
					$Builded[$Element] += $Count;
					$CurrentPlanet[$resource[$Element]] += $Count;
					$Count = 0;
				}
				if ( $Count != 0 )
				{
					$CurrentPlanet['b_hangar_id'] .= $Element.",".$Count.";";
				}
			}
		}
		else
		{
			$Builded                   = '';
			$CurrentPlanet['b_hangar'] = 0;
		}

		return $Builded;
	}
}
/* end of UpdateResources_Lib.php */