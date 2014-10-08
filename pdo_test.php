<?php
    include "cred_int.php";

    try {
        $dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        print "Connection successful.";

        $firstName = 'Scott';

//        $stmt = $dbh->prepare('SELECT * FROM :tablename');
//        $stmt->bindParam(':tablename', $tableName, PDO::PARAM_STR);

        $stmt = $dbh->prepare('SELECT * FROM Apprentices WHERE FirstName=:firstname');
        $stmt->bindParam(':firstname', $firstName, PDO::PARAM_STR);

//        $stmt = $dbh->prepare('SELECT * FROM ?');
//        $stmt->bindValue(1, $tableName, PDO::PARAM_STR);

//        $stmt = $dbh->query('SELECT * FROM Apprentices');

//        $stmt = $dbh->query('SELECT * FROM $tableName');


        $stmt->execute();

        print_r($stmt->queryString);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row) {
            print_r($row);
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
