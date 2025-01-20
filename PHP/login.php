<?php
session_start();
include '../../private/connection.php';

$username = $_POST["email"];
$password = $_POST["password"];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $password == $user['password']) {
    // Controleer de rol van de gebruiker
    if ($user['role'] == '2') {
        $_SESSION['role'] = '2';
        header('location: ../index.php?page=adminlijst');
    } elseif ($user['role'] == '1') {
        $_SESSION['role'] = '1';
        header('location: ../index.php?page=klantlijst');
    }
    exit;
} else {
    // Foutmelding bij onjuiste inloggegevens
    $_SESSION['error'] = 'Onjuiste gebruikersnaam of wachtwoord!';
    header('location: ../index.php?page=login');
    exit;
}
?>
