<?php

$lang['Version']     = 'Versión';
$lang['Description'] = 'Descripción';
$lang['changelog']   = array(

'1.0.1' => ' 01/05/2015
- [Seguridad]
- Error en la funcion escape_value cambiado todo los mysql_real_escape_string por mysqli_real_escape_string.

- [Removido]
- editor de lenguaje no funcionaba corectamente y desordenaba todo el codigo.
- Se eliminaron algunas imágenes.

- [Novedades]
- Se actualizaron las imagenes por las del rediseño.

- [Fix]
- Al instalar no colocaba bien el nombre del planeta principal del administrador.
- Al crear la cuenta tiraba error sql.
- mal lenguaje en el HOME.php.
- Error al editar un usuario.
- No dejaba crear lunas desde el panel administrativo.
- Varios errores E_NOTICES & E_WARNINGS solucionados.
- No mostraba usuarios al editar la alinaza.
- No mostraba correctamente la hora de inscripción cuando se editaba la alianza.
- No se mostraba la hora y los operadores en los mensajes para comandante y no comandante.
- No dejaba borrar los mensajes en modo comandante.
- Se solucionaron varios errores en Hangar, Defensas y Tecnologias (by samurairukasu).
',

'1.0 Beta 5' => ' 13/05/2013
- [Seguridad]
- Mejorada la seguridad de los archivos.
- Mejorada la seguridad de las sesiones/cookies HttpOnly Cookie (By jstar).

- [Novedades]
- Nuevo sistema para registrar errores dentro del juego.
- Sistema de Hooks, Hooks System, para extender el actual sistema de plugins.
- Sistema de módulos para todas las secciones del juego, configurable desde el panel administrativo, sencillo y poderoso.
- Sistema de backups de la base de datos manual o automático.
- Sistema de edición que permite editar el changelog de acuerdo al idioma activo, desde el panel administrativo, sin necesidad de abrir el file.
- Sistema de información ampliada sobre el sistema.
- Nuevo sistema de debugging [Más completo y específico].
- Nuevas páginas creadas para adaptar el juego como el OGame original, la ventaja es principalmente para aquellos que desean implementar un rediseño, ahorrandoles trabajo.
- Valores básicos de ingresos actualizados al OGame original, Metal 30 y Cristal 15.
- Al salir del modo vacaciones la producción se iniciará automáticamente, sin necesidad de ajustar los valores.
- Oficiales que funcionan al igual que el OGame, tiempos, precios, imágenes identicos (Gracias BeReal), configuraciones varias desde el panel administrativo.
- Nuevo sistema de manejo de estadísticas, mucho más rápido y estable.
- Nueva tecnología: Astrofísica. Permite las expediciones y colonización de nuevos planetas.
- Nuevo panel administrativo v3.
-- Nuevo diseño.
-- Nuevas funcionalidades.
-- Nueva sección de usuarios.
-- Más detalles y estadísticas del juego.
-- Más fácil de usar, simple y rápido.
-- Desarrollado con Bootstrap.

-[Mejoras]
- Nuevo sistema para el manejo de las queries.
- Mejoras en el envío de flotas desde galaxia, se actualizaron los scripts y textos de envio de flotas como en el OGame Original.
- Mejora en el panel administrativo en la edición de planetas, ahora es posible editar los campos actuales y no solo los totales.
- Los errores se guardan en un log de errores y pueden ser vistos desde el admin CP.
- Reducción de querys globalmente.
- Optimización de querys globalmente.
- Reemplazadas funciones "deprecated".
- MissilesAjax.php movido como un método a application/controllers/galaxy.php.
- FleetAjax.php movido como un método a application/controllers/galaxy.php.
- SendFleetBack.php movido como un método a application/controllers/fleet.php y application/controllers/fleetacs.php.
- CombatReport.php movido como un metodo a application/libraries/class.Functions.php.
- reg.php movido como una class a application/controllers/register.php.
- Recuperación de clave asignada a un archivo recoverpassword.php.
- Home o Index o página de inicio asignada a un archivo home.php.
- Copyright actualizado.
- Function doquery deprecated, reemplazada por la class Database.
- Rediseño y mejoras en el Core de XGP, mejoras de las class y optimización.
- Generador de estadísticas (adm/statfunctions.php) movido a application/libraries/class.Stats.php.
- class.xml.php movido a core como core/class.Xml.php.
- Nueva constante ADMIN_PATH por default adm/ (puede ser cambiada para mejorar la seguridad del panel administrativo).
- Re organizado el panel administrativo, reprogramadas algunas cosas para adaptarlo al nuevo Core.
- Functions del admin (Authorization y LogFunction) integradas a class.Administration.php.
- BBCode-Panel-Adm.php removido, se usa libraries/class.BBCode.php.
- Cambiados algunos textos (inglés y español) de la página de amigos.
- Nueva class Administration.
- Nueva class Development.
- Nueva class Update.
- Nueva class Functions.
- Nueva class Officiers.
- Nueva class Stats.
- Nueva class Template.
- Nueva class Update_resources.
- Nueva class MissionControl.
- Nueva class missions y respectivas clases hijas.
- Varias funciones incluidas en diversas clases de acuerdo a su función.
- Movidos InsertBuildListScript e InsertJavaScriptChronoApplet a plantillas.
- Agregados varios textos incompletos al infos de naves, defensas y tecnologías tomados del OGame original.
- Actualizados los fuegos rápidos de naves y defensas de acuerdo al OGame original.
- Actualizada la integridad del escudo, el poder del ataque, velocidades y consumo de deuterio de las naves al igual que el OGame original.
- Constante ADMINEMAIL, reemplazada por una configuración para el panel administrativo.
- Todas las functions fueron asignadas a su class correspondiente, o adaptadas para incorporar a una class.
- Mejorado el sistema de estadísticas [Más rápido y eficiente].
- Ahora cuando finalizan las naves y/o defensas en cola, recarga la página.
- Mejorada la vista de la página de estadísticas para los jugadores y las alianzas.
- Modificada la formula de espionaje, ahora funciona como en el OGame original.
- Mejorados los textos del reporte de espionaje que recibe el jugador espiado, al igual que OGame incluye el nombre del jugador y enlaces para ambas coordenadas.
- Reestructuración de varios archivos, funciones y clases.
-- [BASE DE DATOS]
-- Renombrada la tabla "buddy" a "buddys".
-- Modificada la estructura de la tabla buddy.
-- Modificada la estructura de la tabla users [removidos campos de los oficiales y materia oscura -> movido a la nueva tabla premium].
-- Modificada la estructura de la tabla users [removidos campos de configuraciones -> movido a la nueva tabla settings].
-- Modificada la estructura de la tabla users [removidos campos de investigaciones -> movido a la nueva tabla research].
-- Modificada la estructura de la tabla planets [removidos campos de los edificios -> movido a la nueva tabla buildings].
-- Modificada la estructura de la tabla planets [removidos campos de las defensas -> movido a la nueva tabla defenses].
-- Modificada la estructura de la tabla planets [removidos campos de las naves -> movido a la nueva tabla ships].

- [Cambios]
- Por defecto los edificios, naves, defensas e investigaciones se muestran en 2 columnas en el reporte de espionaje, y no 3.
- Eliminado el mensaje de despedida del juego, redirije directamente.
- El changelog quedará limpio para que el usuario lo edite sin necesidad de borrar el contenido por defecto.
- La lista de compañeros ahora se abre como un pop up.
- La lista de compañeros fue renombrada a "Amigos/Buddies".
- El panel administrativo ahora se abre en una nueva ventana.
- La protección de administradores, moderadores y GO es total, si se activa desde el panel del admin no se podrá interactuar con el administrador, moderador o GO, no como antes que además revisa el rango del planeta.
- No será posible acceder al panel administrativo sino fue removido el directorio de instalación.
- Cambiados algunos textos dentro del panel administrativo.
- Renombradas las plantillas del panel administrativo.
- Capacidad de los almacenes y formula actualizadas como el OGame original.
- Actualizados los valores mínimos y máximos para la creación de nuevos planetas, ahora utiliza el diámetro, en base a esto se calcula la cantidad de campos (Esto solo tiene impacto al momento de colonizar, el administrador seguirá creando los planetas por campos y no por diámetro).
- Nueva estructura de los archivos internos del juego.
- El sistema de limpieza de usuarios, reportes, y mensajes fue movido a la class Update y se realiza de forma periódica cada 6 horas.
- Movido el directorio styles a application, creadas las constantes necesarias para que el usuario pueda elegir el directorio que desee.

- [Removido]
- Configuración "Mostrar el logo de las alianzas" + (Campo asociado en la DB).
- Configuración "Protección de planetas" que estaba disponible únicamente para administradores/moderadores/GO + (Campo asociado en la DB).
- Configuración "Mostrar skin" + (Campo asociado en la DB).
- Configuración "Información sobre herramientas" + (Campo asociado en la DB).
- Removidos varios archivos viejos del AdminCP que habían quedado desde que se expandió y mejoro el panel en la versión 2.9.1 (PHP y Plantillas).
- Tabla errors.
- Tabla galaxy.
- Tabla statpoints.
- Característica "Recordarme" al momento de iniciar sesión.
- Característica "Mostrar solo los encabezados de los informes de espionaje".
- Característica "Mostrar reporte de espionaje en la galaxia".
- Sistema de plugins.

- [Fixs]
- Corregidos los permisos de los archivos de registro (logs).
- Varios fix y correciones menores.
- Corregido un bug que no tomaba correctamente los permisos para la actualización o no de las estadísticas de los administradores/moderadores/operadores.
- Corregido un bug que no mostraba el fuego rápido en las defensas.
- Corregido un bug que no mostraba los puntos de estructura, integridad del escudo y poder de ataque de los misiles.
- Corregido un bug que mostraba los tiempos erróneos en los movimientos de flota, ya se muestra correctamente el tiempo de salida, de objetivo y de retorno.
- Corregido un bug en el cual el ranking del usuario no concordaba con el ranking en estadísticas.
- Corregido un bug en el cual la energía se multiplicaba de acuerdo a la velocidad del servidor, ahora mantiene los valores normales.
- Corregido un bug que a no mostraba el tiempo de conexión de un jugador en la lista de miembros de la alianza.
- Agregada una imagen faltante: bg2.gif.
',

'1.0' => ' 13/05/2013
- Starting the project with ex 3.0 XG Proyect by Lucky.
',
);
/* end of CHANGELOG.php */