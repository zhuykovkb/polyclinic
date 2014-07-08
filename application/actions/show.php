<?php

$patientId = (!empty($_GET['patientId'])) ? $_GET['patientId'] : null;
$queryPatientById = 'select * from patients where id=:id';
$patientRecordPrepared = $patientsPdo->prepare($queryPatientById);
$patientRecordPrepared->bindParam(':id', $patientId);
$patientRecordPrepared->execute();
$record = $patientRecordPrepared->fetch(PDO::FETCH_ASSOC);

if ($record) {
    require_once('application/views/showPatient.php');
} else {
    echo "User not found";
}
