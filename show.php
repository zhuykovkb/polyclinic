<?php
/*show patient full data*/
$patientId = $_GET['patientId'];
$queryPatientById = 'select * from patients where id=' . $patientId;
$patientRecordPrepared = $patientsPdo->prepare($queryPatientById);
$patientRecordPrepared->execute(); 
$record = $patientRecordPrepared->fetch(PDO::FETCH_ASSOC);

echo '<h1>' . $record['name'] . '</h1>';
echo '<img src="' . $record['photo'] . '">';
echo '<h2>History:</h2><p>' . $record['history'] . '</p>';
echo '<h3>Patient card number: ' . $record['card_num'] . '</h3>';
if (!(empty($record['email']))) {
	echo '<p>'. $record['email'] . '</p>';
}
?>