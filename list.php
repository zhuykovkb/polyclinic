<?php

$patientsListPrepared = $patientsPdo->prepare('select * from patients');  
$patientsListPrepared->execute(); 
$list = $patientsListPrepared->fetchAll(PDO::FETCH_ASSOC);

if (count($list)) {
	echo '<h1>Patients List</h1>';
	echo '<ul>';
		foreach ($list as $row) {

		echo '<li>'
		 . $row['name'] . ' (' . $row['sex'] . ') E-mail: ' . $row['email']
		 . '<br/> Card #' . $row['card_num'] . '</li>';

		echo $row['history'];

		echo '<a href="?action=show&patientId='. $row['id'] .'">Show</a>';
	}
	echo '</ul>';
} else {
	echo "No rows returned.";
}
