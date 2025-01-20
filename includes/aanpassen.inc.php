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
<form action="PHP/aanpassen.php" method="post">
    <h1>Aanpassen</h1>
    <div class="input-box">
        <input type="text" name="naam" value="<?php echo $result['name'] ?>" placeholder="Naam" required>
    </div>
    <div class="input-box">
        <input type="text" name="schrijver" value="<?php echo $result['writer'] ?>" placeholder="Schrijver">
    </div>
    <div class="input-box">
        <input type="text" name="genre" value="<?php echo $result['genre'] ?> "placeholder="Genre" required>
    </div>
    <div class="input-box">
        <input type="text" name="isbn" value="<?php echo $result['isbn_number'] ?> "placeholder="ISBN-nummer" required>
    </div>
    <div class="input-box">
        <input type="text" name="taal" value="<?php echo $result['language'] ?> "placeholder="Taal" required>
    </div>
    <div class="input-box">
        <input type="text" name="paginas" value="<?php echo $result['pages'] ?> "placeholder="Aantal pagina's" required min="1">
    </div>
    <div class="input-box">
        <input type="text" name="aantal" value="<?php echo $result['copies'] ?> "placeholder="Aantal exemplaren" required min="0">
        <input type="hidden" name="book_id" value="<?= htmlspecialchars($result['book_id']) ?>">
    </div>
    <button type="submit" class="tvgboek">Aanpassen</button>
</form>