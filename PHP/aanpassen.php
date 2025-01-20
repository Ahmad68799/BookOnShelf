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
$book_id = $_POST['book_id'];

$sql = 'UPDATE books SET name= :name, writer= :writer, genre= :genre, isbn_number= :isbn_number, language= :language, pages= :pages, copies= :copies WHERE book_id= :book_id';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':writer', $writer);
$stmt->bindParam(':genre', $genre);
$stmt->bindParam(':isbn_number', $isbn_number);
$stmt->bindParam(':language', $language);
$stmt->bindParam(':pages', $pages);
$stmt->bindParam(':copies', $copies);
$stmt->bindParam(':book_id', $book_id);
$stmt->execute();

    header('Location: ../index.php?page=adminlijst');
?>