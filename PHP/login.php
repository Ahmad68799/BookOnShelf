<?php
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$username_admin = "1@gmail.com";
$password_admin = "1";

$username_klant = "2@gmail.com";
$password_klant = "2";

$username_klant2 = "3@gmail.com";
$password_klant2 = "3";

if($username == $username_admin && $password == $password_admin){
    $_SESSION['role'] = 'admin';
    header('location: ../index.php?page=adminlijst');

}elseif ($username == $username_klant && $password == $password_klant){
    $_SESSION['role'] = 'klant';
    header('location: ../index.php?page=klantlijst');

}elseif ($username == $username_klant2 && $password == $password_klant2){
    $_SESSION['role'] = 'klant';
    header('location: ../index.php?page=klantlijst');
}
else {
    $_SESSION['error'] = 'Onjuiste gebruikersnaam of wachtwoord!';
    header('location: ../index.php?page=login');
   exit;
}
?>
