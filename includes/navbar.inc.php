<?php

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == '2'){
        include 'includes/navbar_admin.inc.php';
    }
    if($_SESSION['role'] == '1'){
        include 'includes/navbar_klant.inc.php';
    }
}else{
    include 'includes/navbar_guest.inc.php';
}
?>

