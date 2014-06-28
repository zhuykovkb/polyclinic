<?php
if (count($list)) {
	echo '<h1>Patients List</h1>';
	echo '<ul>';
		foreach ($list as $row) {
		echo '<li>' . 
		$row['name'] . ' ' . $row['card_num'] . ' ' . $row['history'] . ' ' . $row['email'] . ' ' . $row['sex'] . 
		'</li>';

		echo '<a href="show/?patient_id='. $row['id'] .'">Show</a>';
	}
	echo '</ul>';
} else {
	echo "No rows returned.";
}
?>