<?php

	// insert.php Script to execute from index.php to write to a MySQL database table

	include "cred_int.php";

	//Create connection
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	/*
		HTML form variable 		MySQL test_db.Apprentices field 	PHP variable
		fname 					FirstName 							firstname
		mname 					MiddleName 							middlename
		lname 					LastName 							lastname
		dbirth 					DayBirth 							daybirth
		mbirth 					MonthBirth 							monthbirth
		ybirth 					YearBirth 							yearbirth
		gender 					Gender 								gender
		age 					AgeCheck 							agecheck
	*/

	// Assign POST form values to PHP insert variables
	$firstname = mysqli_real_escape_string($con, $_POST['fname']);
	$middlename = mysqli_real_escape_string($con, $_POST['mname']);
	$lastname = mysqli_real_escape_string($con, $_POST['lname']);
	$daybirth = mysqli_real_escape_string($con, $_POST['dbirth']);
	$monthbirth = mysqli_real_escape_string($con, $_POST['mbirth']);
	$yearbirth = mysqli_real_escape_string($con, $_POST['ybirth']);
	$gender = mysqli_real_escape_string($con, $_POST['gender']);
	$agecheck = mysqli_real_escape_string($con, $_POST['age']);

	$sql = "INSERT INTO Apprentices (FirstName, MiddleName, LastName, DayBirth, MonthBirth, YearBirth, Gender, AgeCheck)
			VALUES ('$firstname', '$middlename', '$lastname', '$daybirth', '$monthbirth', '$yearbirth', '$gender', '$agecheck')";

	if (!mysqli_query($con,$sql)) {
		die('Error: ' . mysqli_eror($con));
	}
	else {
		echo "1 record added<br>";
		echo "<a href='index.php'>Click back</a>";
	}

	mysql_close($con);

?>