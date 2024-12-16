<?php
if(isset($_SESSION['role'])){
    header('location: index.php?page=NoAccess');
    die();
}
?>
    <form action="PHP/login.php" method="post">
        <h1>Login</h1>
        <div class="input-box">
            <input type="email" name="username" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Wachtwoord" required>
        </div>
        <button type="submit" class="btn">Inloggin</button>

        <div class="register-link">
            <p>Heeft u geen account?<a href="index.php?page=register">Registreren</a></p>
        </div>
    </form>
<?php
if (isset($_SESSION['error'])) {
    echo '
<div class="alert">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
    <p>' . $_SESSION['error'] . '</p>
</div>';
    unset($_SESSION['error']); // Verwijder de foutmelding na het tonen
}
?>
