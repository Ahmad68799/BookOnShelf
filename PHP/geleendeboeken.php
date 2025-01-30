<?php
session_start();
include '../../private/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];
    $user_id = $_SESSION["user_id"]; // Huidige gebruiker

    try {
        // 1. Controleer of de gebruiker al 3 boeken heeft geleend
        $checkMax = $pdo->prepare("
            SELECT COUNT(*) AS total_books 
            FROM rented 
            WHERE user_id = :user_id
        ");
        $checkMax->execute(['user_id' => $user_id]);
        $totalBooks = $checkMax->fetch(PDO::FETCH_ASSOC)['total_books'] ?? 0;

        if ($totalBooks >= 3) {
            $_SESSION['alert'] = "Je mag maximaal 3 boeken tegelijk lenen.";
            header('Location: ../index.php?page=klantlijst');
            exit;
        }

        // 2. Controleer of de gebruiker het boek al heeft geleend
        $checkAlreadyRented = $pdo->prepare("
            SELECT COUNT(*) AS already_rented 
            FROM rented 
            WHERE user_id = :user_id AND book_id = :book_id
        ");
        $checkAlreadyRented->execute(['user_id' => $user_id, 'book_id' => $book_id]);
        $alreadyRented = $checkAlreadyRented->fetch(PDO::FETCH_ASSOC)['already_rented'];

        if ($alreadyRented > 0) {
            $_SESSION['alert'] = "Je hebt dit boek al geleend.";
            header('Location: ../index.php?page=klantlijst');
            exit;
        }

        // 3. Controleer of het boek beschikbaar is
        $checkCopies = $pdo->prepare("SELECT copies FROM books WHERE book_id = :book_id");
        $checkCopies->execute(['book_id' => $book_id]);
        $book = $checkCopies->fetch(PDO::FETCH_ASSOC);

        if ($book && $book["copies"] > 0) {
            // 4. Voeg het boek toe aan de geleende boeken van de gebruiker
            $addRental = $pdo->prepare("
                INSERT INTO rented (book_id, user_id, startdate) 
                VALUES (:book_id, :user_id, NOW())
            ");
            $addRental->execute(['book_id' => $book_id, 'user_id' => $user_id]);

            // 5. Verminder het aantal exemplaren in de boekenlijst
            $updateCopies = $pdo->prepare("
                UPDATE books SET copies = copies - 1 WHERE book_id = :book_id
            ");
            $updateCopies->execute(['book_id' => $book_id]);

            $_SESSION['Success1'] = "Boek succesvol geleend!";
        }

    } catch (Exception $e) {
        // 7. Foutafhandeling
        error_log("Fout in lenen.php: " . $e->getMessage());
        $_SESSION['alert'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
    }

    // Redirect terug naar de klantlijstpagina
    header('Location: ../index.php?page=klantlijst');
    exit;
}
?>