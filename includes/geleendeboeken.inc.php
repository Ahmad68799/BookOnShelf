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


$user_id = $_SESSION['userid'];

$stmt = $pdo->prepare("
    SELECT books.name, books.writer, books.genre, books.isbn_number, books.language, books.pages, books.copies
FROM rented 
 JOIN books ON rented.book_id = books.book_id 
    WHERE rented.user_id = :user_id
");

$stmt->execute(['user_id' => $user_id]);
$geleende_boeken = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <th>Aantal exemplaren</th>
        <th>Geleende boeken</th>
    </tr>
    <?php foreach ($geleende_boeken as $boek): ?>
        <tr>
            <td> <?= htmlspecialchars($boek['name']) ?></td>
            <td> <?= htmlspecialchars($boek['writer']) ?></td>
            <td> <?= htmlspecialchars($boek['genre']) ?></td>
            <td> <?= htmlspecialchars($boek['isbn_number']) ?></td>
            <td> <?= htmlspecialchars($boek['language']) ?></td>
            <td> <?= htmlspecialchars($boek['pages']) ?></td>
            <td> <?= htmlspecialchars($boek['copies']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
