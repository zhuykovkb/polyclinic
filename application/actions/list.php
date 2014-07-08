<?php

$patientsListPrepared = $patientsPdo -> prepare('select * from patients');
$patientsListPrepared -> execute();
$list = $patientsListPrepared->fetchAll(PDO::FETCH_ASSOC);

require_once('application/views/listPatients.php');