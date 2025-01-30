<?php
session_start();
include '../../private/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_id"])) {

    $user_id = $_SESSION["user_id"];
    $book_id = $_POST["book_id"];

    try {
        // Controleer of de reservering bestaat
        $checkReservation = $pdo->prepare("
            SELECT COUNT(*) AS existing 
            FROM reserve 
            WHERE user_id = :user_id AND book_id = :book_id
        ");
        $checkReservation->execute(['user_id' => $user_id, 'book_id' => $book_id]);
        $existing = $checkReservation->fetch(PDO::FETCH_ASSOC)['existing'] ?? 0;

        if ($existing > 0) {
            // Verwijder de reservering
            $deleteReservation = $pdo->prepare("
                DELETE FROM reserve 
                WHERE user_id = :user_id AND book_id = :book_id
            ");
            $deleteReservation->execute(['user_id' => $user_id, 'book_id' => $book_id]);

            $_SESSION['Success1'] = "Reservering succesvol geannuleerd.";
        }
    } catch (Exception $e) {
        error_log("Fout bij annuleren reservering: " . $e->getMessage()); 
    }

    header('Location: ../index.php?page=gereserveerdeboeken');
    exit;
}
?>
