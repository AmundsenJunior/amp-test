<?php

    // create_table.php - Script to create new table in existing MySQL database

    include "cred_ext.php";

    try {
	//Create connection
	$dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);

       	// Create table
	$stmt = $dbh->prepare('CREATE TABLE Apprentices(
		PID INT NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(PID),
		FirstName CHAR(30),
		MiddleName CHAR(30),
		LastName CHAR(30),
		DayBirth TINYINT(2),
		MonthBirth CHAR(15),
		YearBirth TINYINT(4)
		)');
        $stmt->execute();

	echo "Table Apprentices in test_db created successfully.\n";

	// Close connection
        $stmt->closeCursor();
        $stmt = null;
        $dbh = null;
    }
    catch (PDOException $e) {
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }

?>
