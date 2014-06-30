<?php
$dbtype     = "mysql";
$dbhost     = "localhost";
$dbname     = "polyclinic";
$dbuser     = "root";
$dbpass     = "123321";
$patientsPdo = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
$patientsPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$imagedir = '/images';
$upLoadDir = __DIR__.$imagedir;
