<?php
session_start();
include '../../private/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];
    $user_id = $_SESSION["user_id"];

    try {

        $checkAlreadyRented = $pdo->prepare("
            SELECT COUNT(*) AS already_rented 
            FROM rented 
            WHERE user_id = :user_id AND book_id = :book_id
        ");
        $checkAlreadyRented->execute(['user_id' => $user_id, 'book_id' => $book_id]);
        $alreadyRented = $checkAlreadyRented->fetch(PDO::FETCH_ASSOC)['already_rented'];

        if ($alreadyRented > 0) {
            $_SESSION['alert'] = "Je kunt dit boek niet reserveren omdat je het al hebt geleend.";
            header('Location: ../index.php?page=klantlijst');
            exit;
        }

        // Controleer of het boek al gereserveerd is door deze gebruiker
        $checkAlreadyReserved = $pdo->prepare("
            SELECT COUNT(*) AS already_reserved 
            FROM reserve 
            WHERE user_id = :user_id AND book_id = :book_id
        ");
        $checkAlreadyReserved->execute(['user_id' => $user_id, 'book_id' => $book_id]);
        $alreadyReserved = $checkAlreadyReserved->fetch(PDO::FETCH_ASSOC)['already_reserved'];

        if ($alreadyReserved > 0) {
            $_SESSION['alert'] = "Je hebt dit boek al gereserveerd.";
            header('Location: ../index.php?page=klantlijst');
            exit;
        }

        // Voeg de reservering toe aan de database
        $addReservation = $pdo->prepare("
            INSERT INTO reserve (book_id, user_id, startdate) 
            VALUES (:book_id, :user_id, NOW())
        ");
        $addReservation->execute(['book_id' => $book_id, 'user_id' => $user_id]);

        $_SESSION['Success1'] = "Boek succesvol gereserveerd!";
    } catch (Exception $e) {
        $_SESSION['alert'] = "Er is een fout opgetreden: " . $e->getMessage();
    }
}

// Redirect terug naar de boekenlijst
header('Location: ../index.php?page=klantlijst');
exit;
?>