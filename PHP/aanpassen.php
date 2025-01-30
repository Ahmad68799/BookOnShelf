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

if ($pages < 0 || $copies < 0) {
    $_SESSION['alert'] = 'Aantal pagina\'s en aantal exemplaren mogen niet negatief zijn!';
    header('Location: ../index.php?page=aanpassen&book_id=' . $book_id);
    exit;
}


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

    $_SESSION['Success1'] = 'Het boek is successful aangepast!';
    header('Location: ../index.php?page=adminlijst');
?>