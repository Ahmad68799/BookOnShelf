<?php
session_start();
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=bookonshelf", "root", "");

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $password == $user['password']) {
    // Controleer de rol van de gebruiker
    if ($user['role'] === 'admin') {
        $_SESSION['role'] = 'admin';
        header('location: ../index.php?page=adminlijst');
    } elseif ($user['role'] === 'user') {
        $_SESSION['role'] = 'user';
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
