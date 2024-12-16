<?php
session_start();
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dit is de index</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
    <body>
        <?php  if($page == "login" || $page == "register" || $page == "toevoegen" || $page=="aanpassen" ){ ?>
            <div class="wrapper">
        <?php }else{ ?>
            <div class="box">
        <?php } ?>
            <?php include 'includes/navbar.inc.php'; ?>
            <?php include 'includes/' . $page .'.inc.php'; ?>
        </div>
    </body>
</html>
