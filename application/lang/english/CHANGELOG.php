<?php

$lang['Version']     = 'Version';
$lang['Description'] = 'Description';
$lang['changelog']   = array(

'1.0.1' => ' 13/05/2013
- [Security]
- Error in function escape_value changed all the mysql_real_escape_string by mysqli_real_escape_string.

- [Removed]
- Language editor not working proper activation and ruffled all code.
- Some images removed

- [New]
- The images were updated by the redesign.
- New ads improvements for commander.
- Tutorial as the redesign ogame.

- [Fix]
- When installing either did not put the name of the main planet administrator.
- When creating the account pulled sql error.
- Bad language in Home.php.
- Error when editing a user.
- Let not post moons from the administrative panel.
- Several bugs fixed E_NOTICES & E_WARNINGS.
- He showed alinaza users to edit.
- Do not display properly when enrollment when the alliance was edited.
- Time and operators are not displayed in the messages to commander and no commander.
- I kept delete messages commander mode.
- Several bugs have been fixed in Shipyard, Defenses and Technology (by samurairukasu).
',

'1.0 Beta 5' => ' 13/06/2013
- [Security]
- Improved file security.
- Improved security of sessions / cookies HttpOnly Cookie (By jstar).

- [New]
- New system for recording errors in the game.
- System Hooks, Hooks System, to extend the current system of plugins.
- System modules for all sections of the game, configurable from the administrative, simple and powerful panel.
- System backups Base manual or automatic data.
- Editing system that lets you edit the changelog according to the active language, from the administrative panel, without opening the file.
- System extended information about the system.
- New system debugging [More complete and specific].
- New pages created to adapt the game as the original OGame, the advantage is mainly for those who want to implement a redesign, saving them work.
- Basic Income Securities upgraded the original OGame, Metal and Glass 30 15.
- Leaving the holiday production mode starts automatically, without having to adjust the values.
- Officers that work like the OGame, times, prices, identical images (Thanks Bereal), several configurations from the administrative panel.
- New statistics management system much faster and stable.
- New technology: Astrophysics. Allows expeditions and colonization of new planets.
- New Admin Panel v3.
- New design.
- New functions.
- New section of users.
- More details and game statistics.
- Easier to use, simple and fast.
- Powered with Bootstrap.

- [Improvement]
- New system for handling the queries.
- Improvements in shipping fleets from galaxy, scripts and texts shipping fleet as in the Original OGame updated.
- Improved administrative panel in the edition of planets is now possible to edit the current fields and not just the totals.
- Errors are stored in an error log and can be seen from the admin CP.
- Reduction of querys globally.
- Optimization of querys globally.
- Replaced functions "deprecated".
- MissilesAjax.php moved as a method to application / controllers / galaxy.php.
- FleetAjax.php moved as a method to application / controllers / galaxy.php.
- SendFleetBack.php moved as a method to application / controllers / fleet.php and application / controllers / fleetacs.php.
- CombatReport.php moved as a method to application / libraries / class.Functions.php.
- Reg.php moved as a class to application / controllers / register.php.
- Recovery recoverpassword.php key assigned to a file.
- Home or Index or homepage assigned to a home.php file.
- Copyright updated.
- Function doQuery deprecated, replaced by the Database class.
- Redesign and improvements Core XGP, improvements and optimization class.
- Statistics Generator (adm / statfunctions.php) moved to application / libraries / class.Stats.php.
- Class.xml.php moved to core and core / class.Xml.php.
- New constant ADMIN_PATH by default adm / (can be changed to improve the security of the administrative panel).
- Re-organized the administrative panel, rescheduled some things to adapt to the new Core.
- Functions of admin (Authorization and LogFunction) integrated class.Administration.php.
- BBCode-Panel-Adm.php removed, using libraries / class.BBCode.php.
- Changed some texts (English and Spanish) of the friends page.
- New class Administration.
- New Development class.
- New class Update.
- New class Functions.
- New class Officiers.
- New class Stats.
- New class Template.
- New class Update_resources.
- New class MissionControl.
- New missions respective class and subclasses.
- A number of features included in different classes according to their function.
- Moved InsertBuildListScript e InsertJavaScriptChronoApplet templates.
- Added several incomplete to info of ships, defenses and technologies OGame taken from the original texts.
- Updated the rapid fire of ships and defenses according to the original OGame.
- Updated the integrity of the shield, the power of attack, speed and consumption of deuterium ships like the original OGame.
- Constant adminEmail, replaced by a configuration for the administrative panel.
- All functions were assigned to the corresponding class, or adapted to incorporate a class.
- Improved system statistics [More rapid and efficient].
- Now when they leave the ships and / or defenses queued and reload the page.
- Improved page view statistics for players and alliances.
- Modified the formula of espionage, now works as the original OGame.
- Improved texts spy report the player receives spied, like OGame includes the name of the player and links to both coordinates.
- Restructuring of multiple files, functions and classes.
- [DATABASE]
- Renamed the table "buddy" to "buddys".
- Modified the structure of the buddy list.
- Modified the structure of the users table [removed camps officers and dark matter -> moved to the new premium table].
- Modified the structure of the users table [removed fields settings -> moved to the new table settings].
- Modified the structure of the users table [removed fields of research -> moved to the new table research].
- Modified the structure of the planets table [removed fields of buildings -> moved to the new buildings table].
- Modified the structure of the planets table [removed fields defenses -> moved to the new defenses table].
- Modified the structure of the planets table [removed camps ships -> moved to the new ships Table].

- [Changes]
- Default buildings, ships, defenses and investigations are displayed in 2 columns on the report of espionage, and 3.
- Removed the message of farewell game, redirects directly.
- The changelog will be clean for the user to edit it without deleting the default content.
- The list of colleagues now opens as a pop up.
- The list of peers was renamed "Friends / Buddies".
- The administrative panel now opens in a new window.
- Protection administrators, moderators and GO is complete, if activated from the admin panel is not able to interact with the administrator, moderator or GO, not like before also reviews the range of the planet.
- It will not be possible to access the administrative panel was removed but the installation directory.
- Changed some text within the administrative panel.
- Leading templates administrative panel.
- Ability stores and makes updated as the original OGame.
- Updated the minimum and maximum values ​​for the creation of new planets, now uses the diameter, on this basis the number of fields is calculated (This only has an impact upon colonize, the administrator will create the planets fields and not by diameter).
- New structure of the internal files of the game.
- The cleaning system users, reports, and messages was moved to the class Update and performed regularly every 6 hours.
- Moved the styles to application directory, created the necessary constants for the user to choose the desired directory.

- [Removed]
- Configuration "Show the logo of alliances" + (Campo partner in the DB).
- Configuration "Protection of planets" was available only for administrators / moderators / GO + (partner in the DB field).
- Configuration "Show skin" + (partner in the DB field).
- Configuration "Tooltip" + (partner in the DB field).
- Removed several old files that were left AdminCP since expanded and improved the panel in version 2.9.1 (PHP and Templates).
- Table errors.
- Table galaxy.
- Table statpoints.
- Feature "Remember Me" when logging in.
- Feature "Show only headers spy reports".
- Feature "Show report espionage in the galaxy."
- System plugins.

- [Fixs]
- Fixed permissions log files (logs).
- Several fix and minor corrections.
- Fixed a bug that did not take permissions to update or statistics administrators / moderators / operators correctly.
- Fixed a bug that did not show the rapid fire defenses.
- Fixed a bug that did not show the points of structure integrity of the shield and attack power of the missiles.
- Fixed a bug that showed the wrong time in the movements of the fleet, and displays correctly exit time, target and return.
- Fixed a bug where the user ranking did not agree with the ranking statistics.
- Fixed a bug in which energy is multiplied according to the speed of the server, now maintains normal.
- Fixed a bug that showed no connection time a player in the list of members of the alliance.
- Added a missing image: bg2.gif.
',
'1.0' => ' 13/05/2013
- Ejemplo 1.-
',

);
/* end of CHANGELOG.php */