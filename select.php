<?php

	// select.php Script to execute from index.php to view the contents of test_db.Apprentices

	include "cred_int.php";

	try {
		//Create connection
		 $con = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		//$con = new PDO('mysql:host=localhost;dbname=test_db', root, root);
		//echo $con;
		// $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		$tableName = "Apprentices";

		$query = $con->prepare("SELECT * FROM :tableName");
		$query->bindParam(':tableName', $tableName);

		echo $query;
		
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

		$query->execute();

		foreach($con->$query as $row) {
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

		$query->closeCursor();
		$query = null;
		$con = null;
	}

	catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

?>

