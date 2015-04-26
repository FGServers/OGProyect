<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo spy.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) die ( header ( 'location:../../' ) );

class Spy extends Missions
{
	/**
	 * __construct()
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * method spy_mission
	 * param $fleet_row
	 * return the spy result
	*/
	public function spy_mission ( $fleet_row )
	{
		if ( $fleet_row['fleet_mess'] == 0 && $fleet_row['fleet_start_time'] <= time() )
		{
			$current_data	= parent::$db->query_fetch ( "SELECT p.name, p.galaxy, p.system, p.planet, u.user_name, r.research_espionage_technology, pr.premium_officier_technocrat
															FROM " . PLANETS . " AS p
															INNER JOIN " . USERS . " AS u ON u.user_id = p.id_owner
															INNER JOIN " . PREMIUM . " AS pr ON pr.premium_user_id = p.id_owner
															INNER JOIN " . RESEARCH . " AS r ON r.research_user_id = p.id_owner
															WHERE p.`galaxy` = " . $fleet_row['fleet_start_galaxy'] . " AND
																	p.`system` = " . $fleet_row['fleet_start_system'] . " AND
																	p.`planet` = " . $fleet_row['fleet_start_planet'] . " AND
																	p.`planet_type` = " . $fleet_row['fleet_start_type'] . ";" );

			$target_data	= parent::$db->query_fetch ( "SELECT p.id, p.id_owner, p.name, p.galaxy, p.system, p.planet, p.metal, p.crystal, p.deuterium, p.energy_max, s.*, d.*, b.*, r.*, pr.premium_officier_technocrat
															FROM " . PLANETS . " AS p
															INNER JOIN " . SHIPS . " AS s ON s.ship_planet_id = p.id
															INNER JOIN " . DEFENSES . " AS d ON d.defense_planet_id = p.id
															INNER JOIN " . BUILDINGS . " AS b ON b.building_planet_id = p.id
															INNER JOIN " . USERS . " AS u ON u.user_id = p.id_owner
															INNER JOIN " . PREMIUM . " AS pr ON pr.premium_user_id = p.id_owner
															INNER JOIN " . RESEARCH . " AS r ON r.research_user_id = p.id_owner
															WHERE p.`galaxy` = '" . $fleet_row['fleet_end_galaxy'] . "' AND
																	p.`system` = '" . $fleet_row['fleet_end_system'] . "' AND
																	p.`planet` = '" . $fleet_row['fleet_end_planet'] . "' AND
																	p.`planet_type` = '" . $fleet_row['fleet_end_type'] . "';" );

			$CurrentSpyLvl       = Officiers_Lib::get_max_espionage ( $current_data['research_espionage_technology'] , $current_data['premium_officier_technocrat'] );
			$TargetSpyLvl        = Officiers_Lib::get_max_espionage ( $target_data['research_espionage_technology'] , $target_data['premium_officier_technocrat'] );
			$fleet               = explode ( ';' , $fleet_row['fleet_array'] );
			$fquery              = '';

			parent::make_update ( $fleet_row , $fleet_row['fleet_end_galaxy'] , $fleet_row['fleet_end_system'] , $fleet_row['fleet_end_planet'] , $fleet_row['fleet_end_type']  );

			foreach ( $fleet as $a => $b )
			{
				if ( $b != '' )
				{
					$a	= explode ( "," , $b );

					if ( $a[0] == "210" )
					{
						$LS    			  	= $a[1];
						$SpyToolDebris		= $LS * 300;

						$MaterialsInfo    	= $this->spy_target ( $target_data , 0 , $this->_lang['sys_spy_maretials'] );
						$Materials        	= $MaterialsInfo['String'];

						$PlanetFleetInfo  	= $this->spy_target ( $target_data , 1 , $this->_lang['sys_spy_fleet'] );
						$PlanetFleet      	= $Materials;
						$PlanetFleet       .= $PlanetFleetInfo['String'];

						$PlanetDefenInfo  	= $this->spy_target ( $target_data , 2 , $this->_lang['sys_spy_defenses'] );
						$PlanetDefense    	= $PlanetFleet;
						$PlanetDefense     .= $PlanetDefenInfo['String'];

						$PlanetBuildInfo 	= $this->spy_target ( $target_data , 3 , $this->_lang['tech'][0] );
						$PlanetBuildings  	= $PlanetDefense;
						$PlanetBuildings   .= $PlanetBuildInfo['String'];

						$TargetTechnInfo  	= $this->spy_target ( $target_data , 4 , $this->_lang['tech'][100] );
						$TargetTechnos    	= $PlanetBuildings;
						$TargetTechnos     .= $TargetTechnInfo['String'];

						$TargetForce      	= ( $PlanetFleetInfo['Count'] * $LS ) / 4;

						if ( $TargetForce > 100 )
						{
							$TargetForce	= 100;
						}

						$TargetChances = mt_rand ( 0 , $TargetForce );
						$SpyerChances  = mt_rand ( 0 , 100 );

						if ( $TargetChances >= $SpyerChances )
						{
							$DestProba	= "<font color=\"red\">" . $this->_lang['sys_mess_spy_destroyed'] . "</font>";
						}
						elseif ( $TargetChances < $SpyerChances )
						{
							$DestProba	= sprintf ( $this->_lang['sys_mess_spy_lostproba'] , $TargetChances );
						}

						$AttackLink	 = "<center>";
						$AttackLink	.= "<a href=\"game.php?page=fleet1&galaxy=" . $fleet_row['fleet_end_galaxy'] . "&system=" . $fleet_row['fleet_end_system'] . "";
						$AttackLink .= "&planet=" . $fleet_row['fleet_end_planet'] . "&planettype=" . $fleet_row['fleet_end_type'] . "";
						$AttackLink .= "&target_mission=1";
						$AttackLink .= " \">" . $this->_lang['type_mission'][1] . "";
						$AttackLink .= "</a></center>";
						$MessageEnd  = "<center>" . $DestProba . "</center>";

						$spionage_difference	= abs ( $CurrentSpyLvl - $TargetSpyLvl );

						if ( $TargetSpyLvl >= $CurrentSpyLvl )
						{
							$ST 		= pow ( $spionage_difference , 2 );
							$resources	= 1;
							$fleet		= $ST + 2;
							$defense	= $ST + 3;
							$buildings	= $ST + 5;
							$tech		= $ST + 7;
						}

						if ( $CurrentSpyLvl > $TargetSpyLvl )
						{
							$ST 		= pow ( $spionage_difference , 2 ) * -1;
							$resources	= 1;
							$fleet		= $ST + 2;
							$defense	= $ST + 3;
							$buildings	= $ST + 5;
							$tech		= $ST + 7;
						}

						if ( $resources <= $LS )
						{
							$SpyMessage = $Materials . "<br />" . $AttackLink . $MessageEnd;
						}

						if ( $fleet <= $LS )
						{
							$SpyMessage = $PlanetFleet . "<br />" . $AttackLink . $MessageEnd;
						}

						if ( $defense <= $LS )
						{
							$SpyMessage = $PlanetDefense . "<br />" . $AttackLink . $MessageEnd;
						}

						if ( $buildings <= $LS )
						{
							$SpyMessage = $PlanetBuildings . "<br />" . $AttackLink . $MessageEnd;
						}

						if ( $tech <= $LS )
						{
							$SpyMessage = $TargetTechnos . "<br />" . $AttackLink . $MessageEnd;
						}

						Functions_Lib::send_message ( $fleet_row['fleet_owner'] , '' , $fleet_row['fleet_start_time'] , 0 , $this->_lang['sys_mess_qg'] , $this->_lang['sys_mess_spy_report'] , $SpyMessage );

						$TargetMessage  	 = $this->_lang['sys_mess_spy_ennemyfleet'] ." ". $current_data['name'];
						$TargetMessage 		.= " <a href=\"game.php?page=galaxy&mode=3&galaxy=" . $current_data["galaxy"] . "&system=" . $current_data["system"] . "\">";
						$TargetMessage 		.= "[" . $current_data["galaxy"] . ":" . $current_data["system"] . ":" . $current_data["planet"] . "]</a> (" . $current_data['user_name'] . ") ";
						$TargetMessage 		.= $this->_lang['sys_mess_spy_seen_at'] . " " . $target_data['name'];
						$TargetMessage 		.= " <a href=\"game.php?page=galaxy&mode=3&galaxy=" . $target_data["galaxy"] . "&system=" . $target_data["system"] . "\">";
						$TargetMessage 		.= "[" . $target_data["galaxy"] . ":" . $target_data["system"] . ":" . $target_data["planet"] . "]</a>.";

						Functions_Lib::send_message ( $target_data['id_owner']  , '' , $fleet_row['fleet_start_time'] , 0 , $this->_lang['sys_mess_spy_control'] , $this->_lang['sys_mess_spy_activity'] , $TargetMessage . ' ' . sprintf ( $this->_lang['sys_mess_spy_lostproba'] , $TargetChances ) );

						if ( $TargetChances >= $SpyerChances )
						{

							parent::$db->query ( "UPDATE " . PLANETS . " SET
													`invisible_start_time` = '".time()."',
													`planet_debris_crystal` = `planet_debris_crystal` + '". (0 + $SpyToolDebris) ."'
													WHERE `id` = '". $target_data['id'] ."';" );

							parent::remove_fleet ( $fleet_row["fleet_id"] );
						}
						else
						{
							parent::return_fleet ( $fleet_row['fleet_id'] );
						}
					}
				}
			}
		}
		elseif ( $fleet_row['fleet_mess'] == 1 && $fleet_row['fleet_end_time'] <= time() )
		{
			parent::restore_fleet ( $fleet_row , TRUE );
			parent::remove_fleet ( $fleet_row["fleet_id"] );
		}
	}

	/**
	 * method spy_target
	 * param $target_data
	 * param $mode
	 * param $TitleString
	 * return the spy result
	*/
	private function spy_target ( $target_data , $mode , $TitleString )
	{
		$LookAtLoop	= TRUE;
		$Count		= 0;

		switch ( $mode )
		{
			case 0:

				$String  = "<table width=\"440\"><tr><td class=\"c\" colspan=\"5\">";
				$String .= $TitleString ." ". $target_data['name'];
				$String .= " <a href=\"game.php?page=galaxy&mode=3&galaxy=". $target_data["galaxy"] ."&system=". $target_data["system"]. "\">";
				$String .= "[". $target_data["galaxy"] .":". $target_data["system"] .":". $target_data["planet"] ."]</a>";
				$String .= $this->_lang['sys_the'] . date(Functions_Lib::read_config ( 'date_format_extended' ), time()) ."</td>";
				$String .= "</tr><tr>";
				$String .= "<td width=220>". $this->_lang['Metal']     ."</td><td width=220 align=right>". Format_Lib::pretty_number($target_data['metal'])      ."</td><td>&nbsp;</td>";
				$String .= "<td width=220>". $this->_lang['Crystal']   ."</td></td><td width=220 align=right>". Format_Lib::pretty_number($target_data['crystal'])    ."</td>";
				$String .= "</tr><tr>";
				$String .= "<td width=220>". $this->_lang['Deuterium'] ."</td><td width=220 align=right>". Format_Lib::pretty_number($target_data['deuterium'])  ."</td><td>&nbsp;</td>";
				$String .= "<td width=220>". $this->_lang['Energy']    ."</td><td width=220 align=right>". Format_Lib::pretty_number($target_data['energy_max']) ."</td>";
				$String .= "</tr>";

				$LookAtLoop = FALSE;

			break;

			case 1:

				$ResFrom[0]	= 200;
				$ResTo[0]   = 299;
				$Loops      = 1;

			break;

			case 2:

				$ResFrom[0]	= 400;
				$ResTo[0]   = 499;
				$ResFrom[1] = 500;
				$ResTo[1]   = 599;
				$Loops      = 2;

			break;

			case 3:

				$ResFrom[0] = 1;
				$ResTo[0]   = 99;
				$Loops      = 1;

			break;

			case 4:

				$ResFrom[0] = 100;
				$ResTo[0]   = 199;
				$Loops      = 1;

			break;
		}

		if ( $LookAtLoop == TRUE )
		{
			$String  		= "<table width=\"440\" cellspacing=\"1\"><tr><td class=\"c\" colspan=\"". ((2 * 2) + (2 - 1))."\">". $TitleString ."</td></tr>";
			$Count       	= 0;
			$CurrentLook 	= 0;

			while ( $CurrentLook < $Loops )
			{
				$row     = 0;
				for ( $Item = $ResFrom[$CurrentLook] ; $Item <= $ResTo[$CurrentLook] ; $Item++ )
				{
					if ( isset ( $this->_resource[$Item] ) && $target_data[$this->_resource[$Item]] > 0 )
					{
						if ($row == 0)
						{
							$String  .= "<tr>";
						}

						$String  .= "<td align=left>".$this->_lang['tech'][$Item]."</td><td align=right>".$target_data[$this->_resource[$Item]]."</td>";

						if ($row < 2 - 1)
						{
							$String  .= "<td>&nbsp;</td>";
						}

						$Count   += $target_data[$this->_resource[$Item]];
						$row++;

						if ( $row == 2 )
						{
							$String  .= "</tr>";
							$row      = 0;
						}
					}
				}

				while ( $row != 0 )
				{
					$String  .= "<td>&nbsp;</td><td>&nbsp;</td>";
					$row++;

					if ( $row == 2 )
					{
						$String  .= "</tr>";
						$row      = 0;
					}
				}
				$CurrentLook++;
			}
		}

		$String .= "</table>";

		$return['String']	= $String;
		$return['Count']	= $Count;

		return $return;
	}
}
/* end of spy.php */