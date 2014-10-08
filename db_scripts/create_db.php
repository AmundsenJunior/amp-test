<?php

    //create_db.php - Script to create new MySQL database

    include "cred_ext.php";

   try {
   	//Create connection
	$dbh = new PDO('mysql:host=localhost', DB_USERNAME, DB_PASSWORD);

	// Create database
	$stmt = $dbh->prepare('CREATE DATABASE test_db');
        $stmt->execute();

	echo "Database test_db created successfully.\n";

        $stmt->closeCursor();
        $stmt = null;
        $dbh = null;
    }
    catch (PDOException $e) {
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }

?>
