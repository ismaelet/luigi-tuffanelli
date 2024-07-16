<?php

//variables table
DB::run('
	CREATE TABLE IF NOT EXISTS variables (

		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(30),
		value VARCHAR(300) 

	)
');

if (!DB::exists('variables WHERE name="public"')) DB::add('variables (name, value) VALUES (?, ?)', ['public', 0]);

//users table
DB::run('
	CREATE TABLE IF NOT EXISTS users (

		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		guest TINYINT(1) DEFAULT 0,
		username VARCHAR(50) DEFAULT "",
		password VARCHAR(128) DEFAULT "",
		mail VARCHAR(50) DEFAULT "",
		firstname VARCHAR(50) DEFAULT "",
		lastname VARCHAR(50) DEFAULT "",
		admin TINYINT(1) DEFAULT 0,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP

	)
');

//authentication table
DB::run('
	CREATE TABLE IF NOT EXISTS auth_tokens (

		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		selector VARCHAR(12),
		validator VARCHAR(64),
		userID INT(11),
		expiration TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()

	)
');