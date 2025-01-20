<?php
if(isset($_SESSION['role'])){
    if($_SESSION['role'] != "1"){
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

$sql = "SELECT * FROM books";
$statement = $pdo->prepare($sql);
$statement->execute();

?>
<h1>gereserveerde Boeken</h1>
<table id="boeken">
    <tr>
        <th>Naam</th>
        <th>Schrijver</th>
        <th>Genre</th>
        <th>ISBN-nummer</th>
        <th>Taal</th>
        <th>Aantal pagina's</th>
        <th>Aantal exemplaren</th>
        <th>Annuleren reseveren</th>
    </tr>
    <?php
    while($result = $statement->fetch(PDO::FETCH_ASSOC)){ ?>
    <tr>
        <td> <?= htmlspecialchars($result['name']) ?></td>
        <td> <?= htmlspecialchars($result['writer']) ?></td>
        <td> <?= htmlspecialchars($result['genre']) ?></td>
        <td> <?= htmlspecialchars($result['isbn_number']) ?></td>
        <td> <?= htmlspecialchars($result['language']) ?></td>
        <td> <?= htmlspecialchars($result['pages']) ?></td>
        <td> <?= htmlspecialchars($result['copies']) ?></td>
        <td><button type="submit" class="btn-lenen">Annuleren reseveren</button></td>
        <?php } ?>
    </tr>
</table>
