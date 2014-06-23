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
	$sql = "CREATE TABLE Apprentices(
		PID INT NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(PID),
		FirstName CHAR(30),
		MiddleName CHAR(30),
		LastName CHAR(30),
		DayBirth TINYINT(2),
		MonthBirth CHAR(15),
		YearBirth TINYINT(4)
		)";
	if (mysqli_query($con, $sql)) {
		echo "Table Apprentices in test_db created successfully.\n";
	}
	else {
		echo "Error creating database: " . mysqli_error($con);
	}



	// Close connection
	mysqli_close($con);

?>