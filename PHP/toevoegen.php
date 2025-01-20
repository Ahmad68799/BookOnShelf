<?php
session_start();
include '../../private/connection.php';

$name = $_POST['naam'];
$writer = $_POST['schrijver'];
$genre = $_POST['genre'];
$isbn_number = $_POST['isbn'];
$language = $_POST['taal'];
$pages = $_POST['paginas'];
$copies = $_POST['aantal'];

$sql = 'INSERT INTO books VALUES (NULL, :name, :writer, :genre, :isbn_number, :language, :pages, :copies)';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':writer', $writer);
$stmt->bindParam(':genre', $genre);
$stmt->bindParam(':isbn_number', $isbn_number);
$stmt->bindParam(':language', $language);
$stmt->bindParam(':pages', $pages);
$stmt->bindParam(':copies', $copies);
$stmt->execute();

$_SESSION['Success'] = "Het boek is succesvol toegevoegd!";
header('Location: ../index.php?page=toevoegen');



?>