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
<table id="boeken">
    <tr>
        <th>Naam</th>
        <th>Schrijver</th>
        <th>Genre</th>
        <th>ISBN-nummer</th>
        <th>Taal</th>
        <th>Aantal pagina's</th>
        <th>Aantal exemplaren</th>
        <th colspan="2">
            <button onclick="window.location.href='index.php?page=toevoegen'" class="tvg">Toevoegen</button>
        </th>
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
            <button onclick="window.location.href='index.php?page=aanpassen&book_id=<?= htmlspecialchars($result['book_id']) ?>';">
                Aanpassen
            </button>
        </td>
        <td>
            <button onclick="confirmDelete(<?= htmlspecialchars($result['book_id']) ?>);">
                Verwijderen
            </button>
        </td>
        <?php } ?>
    </tr>
</table>
<script>
    function confirmDelete(bookId) {
        if (confirm("Weet je zeker dat je dit boek wilt verwijderen?")) {
            window.location.href = 'PHP/verwijderen.php?book_id=' + bookId;
        }
    }
</script>