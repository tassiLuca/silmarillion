<?php
    require_once __DIR__ . '/bootstrap.php';

    $templateParams["css"] = array();
    $templateParams["js"] = array();
    $templateParams["main"] = "./templates/seller-page.php";

    if (!isSellerLoggedIn()) {
        header("location: ./not-found.php");
    }

    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        logout();
    }

    require 'templates/base.php';
?>