<?php
$patientToDeleteId = (int)$_GET['patientId'];
$deleteQuery = 'delete from patients where id=?';
$patientDeletePrepared = $patientsPdo -> prepare($deleteQuery);
$patientDeletePrepared -> execute(array($patientToDeleteId));
echo succeedDeletion();
