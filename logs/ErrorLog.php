|0|SQL Error|Database query failed:  Last SQL Query: SELECT u.`user_id`, u.`onlinetime`, u.`authlevel`, s.`setting_vacations_status`
														FROM ogp_users AS u
														INNER JOIN ogp_settings AS s ON s.setting_user_id = u.user_id
														WHERE `id` = '2';|Where called: line 683 of Database <br/>(in C:\xampp\htdocs\OGP1.0.2\application\controllers\game\galaxy.php)|28.04.2015 13:58:27||
|0|SQL Error|Database query failed:  Last SQL Query: SELECT
														(SELECT user_statistic_total_points
															FROM ogp_users_statistics
																WHERE `user_statistic_user_id` = 1
																) AS user_points,
														(SELECT user_statistic_total_points
															FROM ogp_users_statistics
																WHERE `user_statistic_user_id` = 
																) AS target_points|Where called: line 69 of Database <br/>(in C:\xampp\htdocs\OGP1.0.2\application\libraries\NoobsProtection_Lib.php)|28.04.2015 13:58:56||
|0|SQL Error|Database query failed:  Last SQL Query: SELECT
														(SELECT user_statistic_total_points
															FROM ogp_users_statistics
																WHERE `user_statistic_user_id` = 1
																) AS user_points,
														(SELECT user_statistic_total_points
															FROM ogp_users_statistics
																WHERE `user_statistic_user_id` = 
																) AS target_points|Where called: line 69 of Database <br/>(in C:\xampp\htdocs\OGP1.0.2\application\libraries\NoobsProtection_Lib.php)|28.04.2015 13:59:07||
