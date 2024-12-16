<?php
if(isset($_SESSION['role'])){
    header('location: index.php?page=NoAccess');
    die();
}
?>
    <form action="">
        <h1>Registreren</h1>
        <div class="input-box">
            <input type="text" placeholder="Voornaam"required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Tussenvoegsel">
        </div>
        <div class="input-box">
            <input type="text" placeholder="Achternaam"required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Woonplaats"required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Straat"required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Huisnummer"required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Postcode"required>
        </div>
        <div class="input-box">
            <input type="email" placeholder="Email"required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Wachtwoord"required>
        </div>
        <div class="input-box">
            <input type="date" placeholder="Geboortedatum"required>
        </div>
        <button type="submit" class="btn">Registreren</button>

        <div class="register-link">
            <p>Terug naar Login: <a href="index.php?page=login">Login</a></p>
        </div>
    </form>
