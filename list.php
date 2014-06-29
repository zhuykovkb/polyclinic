<?php

$patientsListPrepared = $patientsPdo->prepare('select * from patients');  
      //object(PDOStatement)#2 (1) { ["queryString"]=> string(22) "select * from patients" } 
$patientsListPrepared->execute(); 
      //object(PDOStatement)#2 (1) { ["queryString"]=> string(22) "select * from patients" }
      
$list = $patientsListPrepared->fetchAll(PDO::FETCH_ASSOC);

if (count($list)) {
	echo '<h1>Patients List</h1>';
	echo '<ul>';
		foreach ($list as $row) {
		echo '<li>' . 
		$row['name'] . ' ' . $row['card_num'] . ' ' . $row['history'] . ' ' . $row['email'] . ' ' . $row['sex'] . 
		'</li>';

		echo '<a href="?action=show&patientId='. $row['id'] .'">Show</a>';
	}
	echo '</ul>';
} else {
	echo "No rows returned.";
}
?>