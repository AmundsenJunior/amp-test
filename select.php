<?php

	// select.php Script to execute from index.php to view the contents of test_db.Apprentices

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

	$result = mysqli_query($con, "SELECT * FROM Apprentices");

	echo "<table border='1'>
	<tr>
	<th>First Name</th>
	<th>Middle Name</th>
	<th>Last Name</th>
	<th>Birth Day</th>
	<th>Birth Month</th>
	<th>Birth Year</th>
	<th>Gender</th>
	<th>18 or Older</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['FirstName'] . "</td>";
		echo "<td>" . $row['MiddleName'] . "</td>";
		echo "<td>" . $row['LastName'] . "</td>";
		echo "<td>" . $row['DayBirth'] . "</td>";
		echo "<td>" . $row['MonthBirth'] . "</td>";
		echo "<td>" . $row['YearBirth'] . "</td>";
		echo "<td>" . $row['Gender'] . "</td>";
		echo "<td>" . $row['AgeCheck'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";

	mysqli_close($con);

?>

