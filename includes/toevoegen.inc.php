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

<form action="PHP/toevoegen.php"method="post">
    <h1>Toevoegen</h1>
    <div class="input-box">
        <label>Naam</label>
        <input type="text" name="naam" required>
    </div>
    <div class="input-box">
        <label>Schrijver</label>
        <input type="text" name="schrijver" >
    </div>
    <div class="input-box">
        <label>Genre</label>
        <input type="text" name="genre" required>
    </div>
    <div class="input-box">
        <label>ISBN-nummer</label>
        <input type="text" name="isbn" required>
    </div>
    <div class="input-box">
        <label>Taal</label>
        <input type="text" name="taal" required>
    </div>
    <div class="input-box">
        <label>Aantal pagina's</label>
        <input type="number" name="paginas" required>
    </div>
    <div class="input-box">
        <label>Aantal exemplaren</label>
        <input type="number" name="aantal" required>
    </div>
    <button type="submit" class="tvgboek">Toevoegen</button>
</form>
