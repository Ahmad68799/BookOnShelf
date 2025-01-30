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
    $getReservations = $pdo->prepare("
        SELECT r.reserve_id, r.book_id, b.name, b.writer, b.genre, b.isbn_number, b.language, b.pages
        FROM reserve r
        INNER JOIN books b ON r.book_id = b.book_id
        WHERE r.user_id = :user_id
        ORDER BY r.startdate ASC
    ");

    $getReservations->execute(['user_id' => $user_id]);
    $reservedBooks = $getReservations->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>gereserveerde Boeken</h1>
    <?php if (empty($reservedBooks)): ?>
        <p>Je hebt geen boeken gereserveerd.</p>
    <?php else: ?>
    <table id="boeken">
        <tr>
            <th>Naam</th>
            <th>Schrijver</th>
            <th>Genre</th>
            <th>ISBN-nummer</th>
            <th>Taal</th>
            <th>Aantal pagina's</th>
            <th>Annuleren reseveren</th>

        </tr>
        <?php foreach ($reservedBooks as $result): ?>
            <tr>
                <td> <?= htmlspecialchars($result['name']) ?></td>
                <td> <?= htmlspecialchars($result['writer']) ?></td>
                <td> <?= htmlspecialchars($result['genre']) ?></td>
                <td> <?= htmlspecialchars($result['isbn_number']) ?></td>
                <td> <?= htmlspecialchars($result['language']) ?></td>
                <td> <?= htmlspecialchars($result['pages']) ?></td>
                <td>
                    <form action="PHP/reseveren_annuleren.php" method="POST" >
                        <input type="hidden" name="book_id" value="<?= $result['book_id'] ?>" >
                        <button type="submit" class="btn-annuleren">Annuleren reseveren</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>