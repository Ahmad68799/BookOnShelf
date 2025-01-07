<?php

include '../private/connection.php';

$sql = "SELECT * FROM users";

//query meegeven aan $pdo object
$statement = $pdo->prepare($sql);

//query uitvoeren
$statement->execute();

//resultaten opslaan
//$results = $statement->fetchAll(PDO::FETCH_ASSOC);

while($results = $statement->fetch(PDO::FETCH_ASSOC)){
    echo $results['userid'];
}
?>