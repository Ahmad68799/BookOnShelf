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
include '../private/connection.php';
$book_id = $_GET['book_id'];

$sql = "SELECT * FROM books WHERE book_id = :book_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam('book_id', $book_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php
if (isset($_SESSION['alert'])) {
    echo '
    <div class="alert1">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['alert'] . '</p>
    </div>';
    unset($_SESSION['alert']);
}
?>
<form action="PHP/aanpassen.php" method="post">
    <h1>Aanpassen</h1>
    <div class="input-box">
        <label>Naam</label>
        <input type="text" name="naam" value="<?php echo $result['name'] ?>" required>
    </div>
    <div class="input-box">
        <label>Schrijver</label>
        <input type="text" name="schrijver" value="<?php echo $result['writer'] ?>">
    </div>
    <div class="input-box">
        <label>Genre</label>
        <input type="text" name="genre" value="<?php echo $result['genre'] ?> " required>
    </div>
    <div class="input-box">
        <label>ISBN-nummer</label>
        <input type="text" name="isbn" value="<?php echo $result['isbn_number'] ?>" required>
    </div>
    <div class="input-box">
        <label>Taal</label>
        <input type="text" name="taal" value="<?php echo $result['language'] ?> " required>
    </div>
    <div class="input-box">
        <label>Aantal pagina's</label>
        <input type="text" name="paginas" value="<?php echo $result['pages'] ?> " required>
    </div>
    <div class="input-box">
        <label>Aantal exemplaren</label>
        <input type="text" name="aantal" value="<?php echo $result['copies'] ?> " required>
        <input type="hidden" name="book_id" value="<?= htmlspecialchars($result['book_id']) ?>">
    </div>
    <button type="submit" class="tvgboek">Aanpassen</button>
</form>