<?php
if(isset($_SESSION['role'])){
    if($_SESSION['role'] != "2"){
        header('location: index.php?page=NoAccess');
        die();
    }
}else{
    header('location: index.php?page=NoAccess');
    die();
}
?>

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

<form action="PHP/toevoegen.php"method="post">
    <h1>Toevoegen</h1>
    <div class="input-box">
        <input type="text" name="naam" placeholder="Naam"required>
    </div>
    <div class="input-box">
        <input type="text" name="schrijver" placeholder="Schrijver">
    </div>
    <div class="input-box">
        <input type="text" name="genre" placeholder="Genre"required>
    </div>
    <div class="input-box">
        <input type="text" name="isbn" placeholder="ISBN-nummer"required>
    </div>
    <div class="input-box">
        <input type="text" name="taal" placeholder="Taal"required>
    </div>
    <div class="input-box">
        <input type="number" name="paginas" placeholder="Aantal pagina's"required>
    </div>
    <div class="input-box">
        <input type="number" name="aantal" placeholder="Aantal exemplaren"required>
    </div>
    <button type="submit" class="tvgboek">Toevoegen</button>
</form>
