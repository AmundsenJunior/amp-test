<?php
    include "cred_int.php";

    try {
        $dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        print "Connection successful.";

        $tableName = 'Apprentices';

//        $stmt = $dbh->prepare('SELECT * FROM :tablename');
//        $stmt->bindValue(':tablename', $tableName, PDO::PARAM_STR);

//        $stmt = $dbh->prepare('SELECT * FROM ?');
//        $stmt->bindValue(1, $tableName, PDO::PARAM_STR);

        $stmt = $dbh->query('SELECT * FROM Apprentices');

//        $stmt = $dbh->query('SELECT * FROM $tableName');

        print_r($stmt->queryString);

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row) {
            print_r($row);
        }
    }
    catch (PDOException $e) {
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }
?>
