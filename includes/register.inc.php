<?php
if(isset($_SESSION['role'])){
    header('location: index.php?page=NoAccess');
    die();
}
?>
<?php
$currentDate = date('Y-m-d');
?>
<form action="PHP/register.php" method="post">

    <?php
    // Succesmelding
    if (isset($_SESSION['Success1'])) {
        echo '
    <div class="Success1">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['Success1'] . '</p>
    </div>';
        unset($_SESSION['Success1']); // Verwijder de melding na het tonen
    }

    // Foutmelding voor e-mailadres
    if (isset($_SESSION['alert'])) {
        echo '
    <div class="alert1">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['alert'] . '</p>
    </div>';
        unset($_SESSION['alert']); // Verwijder de melding na het tonen
    }
    ?>

        <h1>Registreren</h1>
        <div class="input-box">
            <label>Voornaam</label>
            <input type="text" name="Voornaam" required>
        </div>
        <div class="input-box">
            <label>Tussenvoegsel</label>
            <input type="text" name="Tussenvoegsel">
        </div>
        <div class="input-box">
            <label>Achternaam</label>
            <input type="text" name="Achternaam" required>
        </div>
        <div class="input-box">
            <label>Woonplaats</label>
            <input type="text" name="Woonplaats" required>
        </div>
        <div class="input-box">
            <label>Straat</label>
            <input type="text" name="Straat" required>
        </div>
        <div class="input-box">
            <label>Huisnummer</label>
            <input type="text" name="Huisnummer" required>
        </div>
        <div class="input-box">
            <label>Postcode</label>
            <input type="text" name="Postcode" required>
        </div>
        <div class="input-box">
            <label>Email</label>
            <input type="email" name="Email" required>
        </div>
        <div class="input-box">
            <label>Wachtwoord</label>
            <input type="text" name="Password" required>
        </div>
    <div class="input-box">
        <label>Geboortedatum</label>
        <input type="date" name="Geboortedatum" required max="<?= date('Y-m-d'); ?>">
    </div>
        <button type="submit" class="btn">Registreren</button>

        <div class="register-link">
            <p>Terug naar Login: <a href="index.php?page=login">Login</a></p>
        </div>
    </form>
