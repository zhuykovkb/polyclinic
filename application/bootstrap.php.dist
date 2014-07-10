<?php

$config = array(
	'dbtype'     => 'mysql',
	'dbhost'     => 'localhost',
	'dbname'     => 'polyclinic',
	'dbuser'     => 'root',
	'dbpass'     => '123321',
	'imagedir'   => '../images',
	'upLoadDir'  => __DIR__ . '/../images', //@todo remove me plz
);

$patientsPdo = new PDO("{$config['dbtype']}:host={$config['dbhost']};dbname={$config['dbname']}", $config['dbuser'], $config['dbpass']);
$patientsPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);