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

if ($pages < 0 || $copies < 0) {
    $_SESSION['alert'] = 'Aantal pagina\'s en aantal exemplaren mogen niet negatief zijn!';
    header('Location: ../index.php?page=toevoegen');
    exit;
}

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

$_SESSION['Success1'] = "Het boek is succesvol toegevoegd!";
header('Location: ../index.php?page=adminlijst');
?>