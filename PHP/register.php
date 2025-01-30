<?php
session_start();

include '../../private/connection.php';

// Haal gegevens van het formulier op
$username = $_POST["Voornaam"];
$prefix = $_POST["Tussenvoegsel"];
$lastname = $_POST["Achternaam"];
$place = $_POST["Woonplaats"];
$street = $_POST["Straat"];
$house_number = $_POST["Huisnummer"];
$zip_code = $_POST["Postcode"];
$email = $_POST["Email"];
$password = $_POST["Password"];
$birth = $_POST["Geboortedatum"];
$role = 1; // Standaardrol

if ($house_number < 0 || $zip_code < 0) {
    $_SESSION['alert'] = 'Huisnummer en Postcode mogen niet negatief zijn!';
    header('Location: ../index.php?page=register');
    exit;
}

$currentDate = date('Y-m-d');
if ($birth >= $currentDate) {
    $_SESSION['alert'] = 'Geboortedatum mag niet in de toekomst liggen!';
    header('location: ../index.php?page=register');
    exit;
}
// Controleer of het e-mailadres al bestaat
$sql = "SELECT COUNT(*) FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
if ($stmt->fetchColumn() > 0) {
    $_SESSION['alert'] = 'E-mail al in gebruik!';
    header('location: ../index.php?page=register');
    exit;
}


// Bereid de SQL-query voor
$sql = "
    INSERT INTO users (username, prefix, lastname, place, street, house_number, zip_code, email, password, birth, role)
    VALUES (:username, :prefix, :lastname, :place, :street, :house_number, :zip_code, :email, :password, :birth, :role)
";

$stmt = $pdo->prepare($sql);

try {
    // Voer de query uit met gebonden parameters
    $stmt->execute([
        ':username' => $username,
        ':prefix' => $prefix,
        ':lastname' => $lastname,
        ':place' => $place,
        ':street' => $street,
        ':house_number' => $house_number,
        ':zip_code' => $zip_code,
        ':email' => $email,
        ':password' => $password,
        ':birth' => $birth,
        ':role' => $role,
    ]);

    // Succesbericht opslaan in sessie
    $_SESSION['Success1'] = "Registratie succesvol! U kunt nu inloggen.";
    header('Location: ../index.php?page=register');
    exit;
} catch (PDOException $e) {
    echo "Foutmelding: " . $e->getMessage();
}
?>