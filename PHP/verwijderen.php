<?php

include '../../private/connection.php';

$book_id = $_GET["book_id"];

$sql = "DELETE FROM books WHERE book_id = :book_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':book_id', $book_id);
$stmt->execute();

header('Location: ../index.php?page=adminlijst');

?>