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
$user_id = $_SESSION['user_id'];
if ($user_id) {
    $stmt = $pdo->prepare("
        SELECT books.book_id, books.name, books.writer, books.genre, books.isbn_number, books.language, books.pages
        FROM rented 
        JOIN books ON rented.book_id = books.book_id 
        WHERE rented.user_id = :user_id
    ");
    $stmt->execute(['user_id' => $user_id]);
    $geleende_boeken = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $geleende_boeken = [];
}
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
<h1>Geleende Boeken</h1>
<?php if (empty($geleende_boeken)): ?>
    <p>Je hebt nog geen boeken geleend.</p>
<?php else: ?>
<table id="boeken">
    <tr>
        <th>Naam</th>
        <th>Schrijver</th>
        <th>Genre</th>
        <th>ISBN-nummer</th>
        <th>Taal</th>
        <th>Aantal pagina's</th>
        <th></th>
    </tr>
    <?php foreach ($geleende_boeken as $result): ?>
        <tr>
            <td> <?= htmlspecialchars($result['name']) ?></td>
            <td> <?= htmlspecialchars($result['writer']) ?></td>
            <td> <?= htmlspecialchars($result['genre']) ?></td>
            <td> <?= htmlspecialchars($result['isbn_number']) ?></td>
            <td> <?= htmlspecialchars($result['language']) ?></td>
            <td> <?= htmlspecialchars($result['pages']) ?></td>
            <td>
            <form action="PHP/teruggeven.php" method="POST" >
                <input type="hidden" name="book_id" value="<?= $result['book_id']?>" >
                <button type="submit" class="btn-teruggeven">Teruggeven</button>
            </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>
