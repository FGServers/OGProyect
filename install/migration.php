<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo migration.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

function migrate_to_xml ()
{
	$query = $db->query ( "SELECT * FROM " . DB_PREFIX . "config");

	$search		=	array	(
								'¡',
								'¿',
								'º',
								'ª',
								'"',
								'#',
								'$',
								'%',
								'(',
								')',
								'¬',
								'€',
								'|',
								'~'
							);
	$replace	=	array	(
								'&#161;',
								'&#191;',
								'&#176;',
								'&#170;',
								'&#34;',
								'&#35;',
								'&#36;',
								'&#37;',
								'&#40;',
								'&#41;',
								'&#172;',
								'&#8364;',
								'&#124;',
								'&#126;'
							);

	while ( $row = $db->fetch_array ( $query ) )
	{
		if ( $row['config_name'] != 'BuildLabWhileRun' )
		{
			Functions_Lib::update_config ( strtolower ( $row['config_name'] ) , str_replace ( $search , $replace , $row['config_value'] )  );
		}
	}
}

?>