<?php

    // create_table.php - Script to create new table in existing MySQL database

    include "cred_ext.php";

    try {
	//Create connection
	$dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);

	// Create table

	$stmts = array(
		"ALTER TABLE Apprentices ADD COLUMN Gender VARCHAR(6)",
		"ALTER TABLE Apprentices ADD COLUMN AgeCheck VARCHAR(3)"
	);

	foreach ($stmts as $stmt) {
            $stmt = $dbh->prepare($stmt);
            $stmt->execute();

            echo "Table Apprentices in test_db updated successfully.\n";
	}

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
