<?php
    require_once 'bootstrap.php';

    $templateParams["css"] = array("manage-article.css");
    $templateParams["js"] = array("manage-article.js");
    $templateParams["main"] = "./templates/modify-article-page.php";
    $templateParams["categories"] = $dbh->getCategories();
    $templateParams["publishers"] = $dbh->getPublishers();

    // if the seller is not logged in or get request is not complete redirect to login page
    if (!isSellerLoggedIn() || !isset($_GET['action']) ||
        ($_GET['action'] != 'insert' && $_GET['action'] != 'modify' && $_GET['action'] != 'delete' ) ||
        ($_GET['action'] != 'insert' && !isset($_GET['id']))) {
            header("location: login.php");
    }

    if ($_GET["action"] != 'insert') {
        $productInfo = $dbh->getProduct($_GET['id']);
        print_r($productInfo);
        if (count($productInfo) == 0) {
            $templateParams["product"] = null;
        } else {
            $templateParams["product"] = $productInfo[0];
        }
    } else {
    }

    if (isset($_GET['formMsg'])) {
        $templateParams["formMsg"] = $_GET['formMsg'];
    }

    require 'templates/base.php';
?>