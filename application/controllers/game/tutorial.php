<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo techtree.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

/*
* Falta reparar la mision 8 y 10
* Falta traducir al ingles
*/

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

class Tutorial extends OGPCore
{
	const MODULE_ID = 25;

	private $_lang;
	private $_resource;
	private $_requeriments;
	private $_current_user;
	private $_current_planet;

	/**
	 * __construct()
	 */
	public function __construct()
	{
		parent::__construct();

		// check if session is active
		parent::$users->check_session();

		// Check module access
		Functions_Lib::module_message ( Functions_Lib::is_module_accesible ( self::MODULE_ID ) );

		$this->_lang			= parent::$lang;
		$this->_resource		= parent::$objects->get_objects();
		$this->_requeriments	= parent::$objects->get_relations();
		$this->_current_user	= parent::$users->get_user_data();
		$this->_current_planet	= parent::$users->get_planet_data();

		$this->build_page();
	}

	/**
	 * method __destruct
	 * param
	 * return close db connection
	 */
	public function __destruct()
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
		$parse 				= $this->_lang;
		$parse['dpath'] 	= DPATH;
		$requer 			= 0;
		$page       		= '';
		$button				= '';
		$messages			= '';
		$m 					= 0;
		$tut_page 			= isset ( $_GET['mision'] ) ? $_GET['mision'] : NULL;

		switch ( $tut_page )
		{
			/*Case Exit*/
			case 'exit':
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}
				Functions_Lib::redirect ( 'game.php?page=overview' );
			break;
			/*Case Finish*/
			case 'finish':
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}
				$page .= parent::$page->get_template ( 'tutorial/tutorial_end' );
			break;
			case 10:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_user['user_tutorial_10_rec'] >= 1){
					$parse['recycle'] = 'accept';
					++$requer;
				}else{
					$parse['recycle'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 1 and $this->_current_user['user_tutorial_10'] == 0 ){

					parent::$db->query("UPDATE ".SHIPS."
												SET `".$this->_resource[209]."` = `".$this->_resource[209]."` + 1
													WHERE `ship_planet_id` = '". $this->_current_planet['id'] ."';");
					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_10` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");

					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=10', 1 );
				}

				if($requer == 1 and $this->_current_user['user_tutorial_10'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=10&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_10'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_10'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=finish\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial_10' );
			break;
			case 9:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				$this->make_counts();

				if($this->_extra_count['planet_count'] >= 2){
					$parse['found_colony'] = 'accept';
					++$requer;
				}else{
					$parse['found_colony'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 1 and $this->_current_user['user_tutorial_9'] == 0 ){


					parent::$db->query("UPDATE ".PREMIUM."
												SET `premium_officier_commander` = '".(time()+(60*60*24*3))."'
													WHERE `premium_user_id` = '". $this->_current_user['user_id'] ."';");
					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_9` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");

					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=9', 1 );
				}

				if($requer == 1 and $this->_current_user['user_tutorial_9'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=9&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_9'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_9'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=10\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;


				$page .= parent::$page->get_template ( 'tutorial/tutorial_9' );
			break;
			case 8:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				$parse['exp_pln'] = ( MAX_PLANET_IN_SYSTEM + 1 );
				if($this->_current_user['user_tutorial_8_exp'] >= 1){
					$parse['expedition'] = 'accept';
					++$requer;
				}else{
					$parse['expedition'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 1 and $this->_current_user['user_tutorial_8'] == 0 ){
					
					parent::$db->query("UPDATE ".SHIPS."
												SET `".$this->_resource[202]."` = `".$this->_resource[202]."` + 5, 
													`". $this->_resource[205] ."` = `". $this->_resource[205] ."` + 2
													WHERE `ship_planet_id` = '". $this->_current_planet['id'] ."';");

					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_8` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");

					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=8', 1 );
				}

				if($requer == 1 and $this->_current_user['user_tutorial_8'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=8&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_8'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_8'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=9\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial_8' );
			break;
			case 7:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_planet[$this->_resource[210]] >= 1){
					$parse['probes'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_probes']  = '<a href="game.php?page=shipyard">('. $this->_current_planet[$this->_resource[210]] .'/1)</a>';
					$parse['probes'] = 'none';
				}
				if($this->_current_user['user_tutorial_7_spy'] >= 1){
					$parse['spy'] = 'accept';
					++$requer;
				}else{
					$parse['spy'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 2 and $this->_current_user['user_tutorial_7'] == 0 ){

					parent::$db->query("UPDATE ".SHIPS."
												SET `".$this->_resource[210]."` = `".$this->_resource[210]."` + 2
													WHERE `ship_planet_id` = '". $this->_current_planet['id'] ."';");

					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_7` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");

					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=7', 1 );
				}

				if($requer == 2 and $this->_current_user['user_tutorial_7'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=7&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_7'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_7'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=8\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;


				$page .= parent::$page->get_template ( 'tutorial/tutorial_7' );
			break;
			case 6:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_planet[$this->_resource[22]] >= 1 or $this->_current_planet[$this->_resource[23]] >= 1 or $this->_current_planet[$this->_resource[24]] >= 1){
					$parse['storeage'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_store']  = '<a href="game.php?page=resources">('. $this->_current_planet[$this->_resource[22]] .'/1)</a>';
					$parse['storeage'] = 'none';
				}
				if($this->_current_user['user_tutorial_6_mer'] >= 1){
					$parse['merchand'] = 'accept';
					++$requer;
				}else{
					$parse['merchand'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 2 and $this->_current_user['user_tutorial_6'] == 0 ){

					$rand = mt_rand(22, 24);
					$this->_current_planet[$this->_resource[$rand]] += 1;
					
					parent::$db->query("UPDATE ".BUILDINGS."
												SET `". $this->_resource[$rand] ."` = '". $this->_current_planet[$this->_resource[$rand]] ."' 
													WHERE `building_planet_id` = '". $this->_current_planet['id'] ."';");
					
					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_6` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");
					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=6', 1 );
				}

				if($requer == 2 and $this->_current_user['user_tutorial_6'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=6&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_6'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_6'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=7\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial_6' );
			break;
			case 5:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				$this->make_counts();

				if($this->_current_planet['name'] != $this->_lang['ge_home_planet'] and $this->_current_planet['name'] != $this->_lang['ge_colony']){
					$parse['planet_rename'] = 'accept';
					++$requer;
				}else{
					$parse['planet_rename'] = 'none';
				}
				if($this->_extra_count['buddys_count'] >= 1){
					$parse['buddy_count'] = 'accept';
					++$requer;
				}else{
					$parse['buddy_count'] = 'none';
				}
				if($this->_current_user['user_ally_id'] != 0 and $this->_extra_count['alliance_count'] >= 4){
					$parse['alliance_count'] = 'accept';
					++$requer;
				}else{
					$parse['alliance_count'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 3 and $this->_current_user['user_tutorial_5'] == 0 ){

					$this->_current_user['darkmatter'] += 3500;
					parent::$db->query("UPDATE ".PREMIUM."
												SET `". $this->_current_user['darkmatter'] ."`
													WHERE `premium_user_id` = '". $this->_current_user['user_id'] ."';");
					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_5` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");
					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=5', 1 );
				}

				if($requer == 3 and $this->_current_user['user_tutorial_5'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=5&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_5'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_5'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=6\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;


				$page .= parent::$page->get_template ( 'tutorial/tutorial_5' );
			break;
			case 4:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_planet[$this->_resource[31]] >= 1){
					$parse['laboratory_1'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_lab']  = '<a href="game.php?page=station">('.$this->_current_planet[$this->_resource[31]] .'/1)</a>';
					$parse['laboratory_1'] = 'none';
				}
				if($this->_current_planet[$this->_resource[202]] >= 1){
					$parse['small_cargo_ship_1'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_ship']  = '<a href="game.php?page=shipyard">('.$this->_current_planet[$this->_resource[202]] .'/1)</a>';
					$parse['small_cargo_ship_1'] = 'none';
				}
				if($this->_current_user[$this->_resource[115]] >= 2){
					$parse['combustion_drive_2'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_drive']  = '<a href="game.php?page=research">('.$this->_current_user[$this->_resource[115]] .'/2)</a>';
					$parse['combustion_drive_2'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 3 and $this->_current_user['user_tutorial_4'] == 0 ){

					$this->_current_planet['deuterium'] += 200;

					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_4` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");
					UpdateResources_Lib::update_resource ( $this->_current_user, $this->_current_planet, time() );
					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=4', 1 );
				}

				if($requer == 3 and $this->_current_user['user_tutorial_4'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=4&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_3'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_4'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=5\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial_4' );
			break;
			case 3:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_planet[$this->_resource[1]] >= 10){
					$parse['metal_mine_10'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_met_2']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[1]] .'/10)</a>';
					$parse['metal_mine_10'] = 'none';
				}
				if($this->_current_planet[$this->_resource[2]] >= 7){
					$parse['cristal_mine_7'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_crist_2']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[2]] .'/7)</a>';
					$parse['cristal_mine_7'] = 'none';
				}
				if($this->_current_planet[$this->_resource[3]] >= 5){
					$parse['deuterium_sintetizer_5'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_deute_2']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[3]] .'/5)</a>';
					$parse['deuterium_sintetizer_5'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 3 and $this->_current_user['user_tutorial_3'] == 0 ){

					$this->_current_planet['metal'] += 2000;
					$this->_current_planet['crystal'] += 500;

					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_3` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");
					UpdateResources_Lib::update_resource ( $this->_current_user, $this->_current_planet, time() );
					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=3', 1 );
				}

				if($requer == 3 and $this->_current_user['user_tutorial_3'] == 0){
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=3&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_3'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_3'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=4\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;


				$page .= parent::$page->get_template ( 'tutorial/tutorial_3' );
			break;
			case 2:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_planet[$this->_resource[3]] >= 2){
					$parse['deuterium_sintetizer_2'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_deute']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[3]] .'/2)</a>';
					$parse['deuterium_sintetizer_2'] = 'none';
				}
				if($this->_current_planet[$this->_resource[14]] >= 2){
					$parse['robot_factory_2'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_robot']  = '<a href="game.php?page=station">('.$this->_current_planet[$this->_resource[14]] .'/2)</a>';
					$parse['robot_factory_2'] = 'none';
				}
				if($this->_current_planet[$this->_resource[21]] >= 1){
					$parse['hangar_1'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_hangar']  = '<a href="game.php?page=station">('.$this->_current_planet[$this->_resource[21]] .'/1)</a>';
					$parse['hangar_1'] = 'none';
				}
				if($this->_current_planet[$this->_resource[401]] >= 1){
					$parse['rocket_launcher_1'] = 'accept';
					++$requer;
				}else{
					$parse['lvl_required_roket']  = '<a href="game.php?page=shipyard">('.$this->_current_planet[$this->_resource[401]] .'/1)</a>';
					$parse['rocket_launcher_1'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 and $requer == 4 and $this->_current_user['user_tutorial_2'] == 0){
					
					parent::$db->query("UPDATE ".DEFENSES."
												SET `".$this->_resource[401]."` = `".$this->_resource[401]."` + 1
													WHERE `defense_planet_id` = '". $this->_current_planet['id'] ."';");

					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_2` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");

					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=2', 1 );
				}

				if($requer == 4 and $this->_current_user['user_tutorial_2'] == 0) {
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=2&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_2'] == 1) {
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_2'].'</p>';
					$button .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=3\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else {
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial_2' );
			break;
			case 1:
				for($m = 1; $m <= 10; $m++ ){
					if( $this->_current_user['user_tutorial_'. $m ] == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				if($this->_current_planet[$this->_resource[1]] >= 4) {
					$parse['metal_mine_4'] = 'accept';
					++$requer;
				} else {
					$parse['lvl_required_metall']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[1]] .'/4)</a>';
					$parse['metal_mine_4'] 		   = 'none';
				}

				if($this->_current_planet[$this->_resource[2]] >= 2) {
					$parse['cristal_mine_2'] = 'accept';
					++$requer;
				} else {
					$parse['lvl_required_cristal']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[2]] .'/2)</a>';
					$parse['cristal_mine_2'] = 'none';
				}

				if($this->_current_planet[$this->_resource[4]] >= 4) {
					$parse['solar_plant_4'] = 'accept';
					++$requer;
				} else {
					$parse['lvl_required_solar']  = '<a href="game.php?page=resources">('.$this->_current_planet[$this->_resource[4]] .'/4)</a>';
					$parse['solar_plant_4'] = 'none';
				}

				if( isset ( $_GET['continue'] ) == 1 && $requer == 3 && $this->_current_user['user_tutorial_1'] == 0){
					$this->_current_planet['metal'] += 150;
					$this->_current_planet['crystal'] += 75;

					parent::$db->query("UPDATE ".USERS."
												SET `user_tutorial_1` = '1' 
													WHERE `user_id` = '". $this->_current_user['user_id'] ."';");

					UpdateResources_Lib::update_resource ( $this->_current_user, $this->_current_planet, time() );
					Functions_Lib::redirect ( 'game.php?page=tutorial&mision=1', 1 );
				}

				if($requer == 3 and $this->_current_user['user_tutorial_1'] == 0){
					$button   .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=1&continue=1\'" value="'. $this->_lang['tut_btn_reward_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				elseif($this->_current_user['user_tutorial_1'] == 1){
					$messages .= '<p style="color:#9c0;text-align:left;">'.$this->_lang['tut_tusk_messages_mission_1'].'</p>';
					$button   .= '<input class="next_step" type="button" onclick="window.location = \'game.php?page=tutorial&mision=2\'" value="'. $this->_lang['tut_btn_next_mission_tutorial'] .'" style="width:150px;height:30px;"/>';
				}
				else{
					$messages .= '';
					$button   .= '';
				}

				$parse['messages']  = $messages;
				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial_1' );
			break;
			default:
				for($m = 1; $m <= 10; $m++ ){
					if( isset( $this->_current_user['user_tutorial_'. $m ] ) == 1 ){
						$parse['tut_' . $m] = 'accept';
					}else{
						$parse['tut_' . $m] = 'delete';
					}
				}

				$parse['tutorial_title'] = $this->_lang['tut_title_welcome'] .' '.Functions_Lib::read_config('game_name');

				if ($this->_current_user['user_tutorial_1'] == 0)
				{
					$button .= '<input type="button" onclick="window.location = \'game.php?page=tutorial&mision=1\'" value="'. $this->_lang['tut_btn_start_tutorial'] .'" style="cursor:pointer;width:180px;height:27px;"/>';
				} 
				else 
				{
					$button .= '<input type="button" value="'. $this->_lang['tut_btn_continue_tutorial'] .'" onclick="window.location = \'game.php?page=tutorial&mision=1\'" style="cursor:pointer;width:180px;height:27px;"/>';
				}

				$parse['button']	= $button;

				$page .= parent::$page->get_template ( 'tutorial/tutorial' );
			break;
		}

		return parent::$page->display ( parent::$page->parse_template ( $page , $parse ) );
	}


	/**
	 * method make_counts
	 * param
	 * return some counts
	 */
	private function make_counts ()
	{
		$this->_extra_count		= parent::$db->query_fetch ( "SELECT
																( SELECT COUNT(`user_id`)
																		FROM `" . USERS . "`
																		WHERE `user_ally_id` = '" . $this->_current_user['user_ally_id'] . "' AND `user_ally_id` <> 0
																 ) AS alliance_count,

																 ( SELECT COUNT(`buddy_id`)
																 		FROM `" . BUDDY . "`
																 		WHERE `buddy_sender` = '" . $this->_current_user['user_ally_id'] . "' OR `buddy_receiver` = '" . $this->_current_user['user_ally_id'] . "'
																 ) AS buddys_count,

																 ( SELECT COUNT(`id`)
																 		FROM `" . PLANETS . "`
																 		WHERE `id_owner` = '" . $this->_current_user['user_ally_id'] . "'
																 ) AS planet_count"
															);
	}
}
/* end of tutorial.php */