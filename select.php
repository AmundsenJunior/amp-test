<?php

	// select.php Script to execute from index.php to view the contents of test_db.Apprentices

	include "cred_int.php";

	try {
		//Create connection
         	$dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		
		$stmt = $dbh->prepare("SELECT * FROM Apprentices");
		
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

		$stmt->execute();

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach($rows as $row) {
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

		$stmt->closeCursor();
		$stmt = null;
		$dbh = null;
	}

	catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

?>

