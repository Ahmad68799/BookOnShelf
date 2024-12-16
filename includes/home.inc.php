<?php
if(isset($_SESSION['role'])){
        header('location: index.php?page=NoAccess');
        die();
    }
?>
    <div class="page1">
        <h1>Book on Shelf</h1>
        <p>"Jouw reis begint met een boek"</p>
        <div class="page1btn">
            <button onclick="window.location.href='index.php?page=login';">Login</button>
        </div>
        <div class="page1btn">
            <button onclick="window.location.href='index.php?page=register';">Register</button>
        </div>
    </div>
