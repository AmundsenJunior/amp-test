<?php

	// create_table.php - Script to create new table in existing MySQL database

	include "cred_ext.php";

	//Create connection
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	// Create table
	$sql = array(
		"ALTER TABLE Apprentices ADD COLUMN Gender VARCHAR(6)",
		"ALTER TABLE Apprentices ADD COLUMN AgeCheck VARCHAR(3)"
	);
	
	foreach ($sql as $stmt) {
		if (mysqli_query($con, $stmt)) {
			echo "Table Apprentices in test_db updated successfully.\n";
		}
		else {
			echo "Error updating database: " . mysqli_error($con);
		}

	// Close connection
	mysqli_close($con);

?>
