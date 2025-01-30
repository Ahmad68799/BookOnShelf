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
<?php
if (isset($_SESSION['Success1'])) {
    echo '
    <div class="Success">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['Success1'] . '</p>
    </div>';
    unset($_SESSION['Success1']); // Verwijder de melding na het tonen
}
?>
<?php
if (isset($_SESSION['alert'])) {
    echo '
    <div class="alert">
        <span onclick="this.parentElement.style.display=\'none\'"
              class="close-btn">&times;</span>
        <p>' . $_SESSION['alert'] . '</p>
    </div>';
    unset($_SESSION['alert']); // Verwijder de melding na het tonen
}
?>

<h1>Welkom bij Book On Shelf</h1>
<table id="boeken">
    <tr>
        <th>Naam</th>
        <th>Schrijver</th>
        <th>Genre</th>
        <th>ISBN-nummer</th>
        <th>Taal</th>
        <th>Aantal pagina's</th>
        <th>Aantal exemplaren</th>
        <th>Lenen/reseveren</th>
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

    <td>
    <?php if ($result['copies'] > 0): ?>
        <form action="PHP/geleendeboeken.php" method="POST" >
            <input type="hidden" name="book_id" value="<?= $result['book_id'] ?>">
            <button type="submit" class="btn-lenen">Lenen</button>
        </form>
    <?php else: ?>
        <form action="PHP/gereserveerdeboeken.php" method="POST">
            <input type="hidden" name="book_id" value="<?= $result['book_id'] ?>">
            <button type="submit" class="btn-reserveren">Reserveren</button>
    <?php endif; ?>
    </td>

    </tr>
<?php } ?>
</table>
