<?php
if(isset($_SESSION['role'])){
    header('location: index.php?page=NoAccess');
    die();
}
?>
<form action="PHP/register.php" method="post">

    <?php
    // Succesmelding
    if (isset($_SESSION['Success'])) {
        echo '
    <div class="Success">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['Success'] . '</p>
    </div>';
        unset($_SESSION['Success']); // Verwijder de melding na het tonen
    }

    // Foutmelding voor e-mailadres
    if (isset($_SESSION['em-error'])) {
        echo '
    <div class="alert">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['em-error'] . '</p>
    </div>';
        unset($_SESSION['em-error']); // Verwijder de melding na het tonen
    }
    ?>

        <h1>Registreren</h1>
        <div class="input-box">
            <input type="text" name="Voornaam" placeholder="Voornaam" required>
        </div>
        <div class="input-box">
            <input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel">
        </div>
        <div class="input-box">
            <input type="text" name="Achternaam" placeholder="Achternaam" required>
        </div>
        <div class="input-box">
            <input type="text" name="Woonplaats" placeholder="Woonplaats" required>
        </div>
        <div class="input-box">
            <input type="text" name="Straat" placeholder="Straat" required>
        </div>
        <div class="input-box">
            <input type="text" name="Huisnummer" placeholder="Huisnummer" required>
        </div>
        <div class="input-box">
            <input type="text" name="Postcode" placeholder="Postcode" required>
        </div>
        <div class="input-box">
            <input type="email" name="Email" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="text" name="Password" placeholder="Wachtwoord"  required>
        </div>
        <div class="input-box">
            <input type="date" name="Geboortedatum" placeholder="Geboortedatum" required>
        </div>
        <button type="submit" class="btn">Registreren</button>

        <div class="register-link">
            <p>Terug naar Login: <a href="index.php?page=login">Login</a></p>
        </div>
    </form>
