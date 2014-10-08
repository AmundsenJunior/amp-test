<?php

    // insert.php Script to execute from index.php to write to a MySQL database table

    include "cred_int.php";

    // Assign POST form values to PHP insert variables
    $firstName = $_POST['fname'];
    $middleName = $_POST['mname'];
    $lastName = $_POST['lname'];
    $dayBirth = $_POST['dbirth'];
    $monthBirth = $_POST['mbirth'];
    $yearBirth = $_POST['ybirth'];
    $gender = $_POST['gender'];
    $ageCheck = $_POST['age'];

    try {
        //Create connection
	$dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);

        $stmt = $dbh->prepare('INSERT INTO Apprentices 
            (FirstName, MiddleName, LastName, DayBirth, MonthBirth, YearBirth, Gender, AgeCheck)
	    VALUES (:firstname, :middlename, :lastname, 
            :daybirth, :monthbirth, :yearbirth, :gender, :agecheck)');
        $stmt->bindParam(':firstname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':middlename', $middleName, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':daybirth', $dayBirth, PDO::PARAM_INT);
        $stmt->bindParam(':monthbirth', $monthBirth, PDO::PARAM_STR);
        $stmt->bindParam(':yearbirth', $yearBirth, PDO::PARAM_INT);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':agecheck', $ageCheck, PDO::PARAM_STR);

        $stmt->execute();

	echo "1 record added<br>";
	echo "<a href='index.php'>Click back</a>";
    }
    catch (PDOException $e) {
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }

?>
