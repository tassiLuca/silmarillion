<?php
    require_once 'bootstrap.php';
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    
    $templateParams["css"] = array("article.css");
    $templateParams["js"] = array("");
    $templateParams["main"] = "./templates/single-article.php";

    $idprodotto = -1;
    if(isset($_GET["id"])){
        $idprodotto = $_GET["id"];
    }   
    $templateParams["product"] = $dbh -> getProductById($idprodotto)[0];
    $templateParams["copies"] = $dbh -> getAvaiableCopiesOfProd($idprodotto);
    $templateParams["logged"] = isCustomerLoggedIn();

    require 'templates/base.php';
?>