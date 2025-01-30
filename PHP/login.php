<?php
session_start();
include '../../private/connection.php';

$username = $_POST["email"];
$password = $_POST["password"];

try {
    // Zoek gebruiker op basis van e-mailadres
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password == $user['password']) {
        // Sla de user_id en rol op in de sessie
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        // Controleer de rol van de gebruiker en stuur door naar de juiste pagina
        if ($user['role'] == '2') {
            header('Location: ../index.php?page=adminlijst');
        } elseif ($user['role'] == '1') {
            header('Location: ../index.php?page=klantlijst');
        }
        exit;
    } else {
        // Foutmelding bij onjuiste inloggegevens
        $_SESSION['alert'] = 'Onjuiste gebruikersnaam of wachtwoord!';
        header('Location: ../index.php?page=login');
        exit;
    }
} catch (Exception $e) {
    error_log("Fout in login.php: " . $e->getMessage());
    $_SESSION['alert1'] = 'Er is een fout opgetreden. Probeer het later opnieuw.';
    header('Location: ../index.php?page=login');
    exit;
}
?>