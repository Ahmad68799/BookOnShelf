<?php
if(isset($_SESSION['role'])){
    if($_SESSION['role'] != "admin"){
        header('location: index.php?page=NoAccess');
        die();
    }
}else{
    header('location: index.php?page=NoAccess');
    die();
}
?>
<form action="">
    <h1>Aanpassen</h1>
    <div class="input-box">
        <input type="text" placeholder="Naam"required>
    </div>
    <div class="input-box">
        <input type="text" placeholder="Schrijver">
    </div>
    <div class="input-box">
        <input type="text" placeholder="Genre"required>
    </div>
    <div class="input-box">
        <input type="text" placeholder="ISBN-nummer"required>
    </div>
    <div class="input-box">
        <input type="text" placeholder="Taal"required>
    </div>
    <div class="input-box">
        <input type="number" placeholder="Aantal pagina's"required>
    </div>
    <div class="input-box">
        <input type="number" placeholder="Aantal exemplaren"required>
    </div>
    <button type="submit" class="tvgboek">Aanpassen</button>
</form>
