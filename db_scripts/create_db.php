<?php

	//create_db.php - Script to create new MySQL database

	include "cred_ext.php";

	//Create connection
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	// Create database
	$sql = "CREATE DATABASE test_db";
	if (mysqli_query($con, $sql)) {
		echo "Database test_db created successfully.\n";
	}
	else {
	 	echo "Error creating database: " . mysqli_error($con);
	}



	// Close connection
	mysqli_close($con);

?>