<?php

if (!$sysData['static'] && $migration) migrate($con);

function migrate($con) {

	//migrate system tables
	$tables = glob(__SERVER_ROOT__.'/system/migration/*.php');
	foreach($tables as $table) include_once($table);

	//migrate app tables
	$tables = glob(__SERVER_ROOT__.'/app/migration/*.php');
	foreach($tables as $table) include_once($table);
	
}
