<?php
session_start();
include '../../private/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];
    $current_user_id = $_SESSION["user_id"]; // De gebruiker die het boek teruggeeft

    try {
        // 1. Verwijder het boek uit de geleende boeken van de huidige gebruiker
        $removeFromRented = $pdo->prepare("
            DELETE FROM rented
            WHERE book_id = :book_id AND user_id = :user_id
        "); 
        $removeFromRented->execute(['book_id' => $book_id, 'user_id' => $current_user_id]);

        // 2. Controleer of er reserveringen voor dit boek zijn
        $getNextReservation = $pdo->prepare("
            SELECT reserve_id, user_id 
            FROM reserve
            WHERE book_id = :book_id
            ORDER BY startdate ASC, reserve_id ASC
            LIMIT 1
        ");
        $getNextReservation->bindParam(':book_id' , $book_id);
        $getNextReservation->execute();
        $nextReservation = $getNextReservation->fetch(PDO::FETCH_ASSOC);

        if ($nextReservation) {
            // 3. Haal de gegevens van de eerstvolgende gebruiker uit de reservering
            $nextUserId = $nextReservation['user_id'];
            $reservationId = $nextReservation['reserve_id'];

            // 4. Controleer of deze gebruiker het boek niet al heeft geleend
            $checkAlreadyRented = $pdo->prepare("
                SELECT COUNT(*) AS already_rented 
                FROM rented 
                WHERE book_id = :book_id AND user_id = :user_id
            ");
            $checkAlreadyRented->execute(['book_id' => $book_id, 'user_id' => $nextUserId]);
            $alreadyRented = $checkAlreadyRented->fetch(PDO::FETCH_ASSOC)['already_rented'];

            if ($alreadyRented == 0) {
                // 5. Voeg het boek toe aan de geleende boeken van deze gebruiker
                $addToRented = $pdo->prepare("
                    INSERT INTO rented (book_id, user_id, startdate)
                    VALUES (:book_id, :user_id, NOW())
                ");
                $addToRented->execute(['book_id' => $book_id, 'user_id' => $nextUserId]);

                // 6. Verwijder de reservering omdat deze is verwerkt
                $deleteReservation = $pdo->prepare("
                    DELETE FROM reserve
                    WHERE reserve_id = :reserve_id
                ");
                $deleteReservation->execute(['reserve_id' => $reservationId]);


            }
        } else {
            // 7. Als er geen reserveringen zijn, verhoog het aantal beschikbare exemplaren
            $updateCopies = $pdo->prepare("
                UPDATE books 
                SET copies = copies + 1 
                WHERE book_id = :book_id
            ");
            $updateCopies->execute(['book_id' => $book_id]);

            $_SESSION['Success1'] = "Het boek is succesvol teruggebracht.";
        }
    } catch (Exception $e) {
        // Log fout voor debugging
        error_log("Fout in teruggeven.php: " . $e->getMessage());
        $_SESSION['alert'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
    }

    // Redirect naar de pagina met geleende boeken
    header('Location: ../index.php?page=geleendeboeken');
    exit;
}
?>