<?php

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
        include 'includes/navbar_admin.inc.php';
    }
    if($_SESSION['role'] == 'klant'){
        include 'includes/navbar_klant.inc.php';
    }
}else{
    include 'includes/navbar_guest.inc.php';
}
?>

