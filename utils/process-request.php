<?php
    require_once '../bootstrap.php';
/*
    if(isset($_SESSION['url'])){
         $lastPage = $_SESSION['url']; // holds url for last page visited.
    }
    else{
        $lastPage = "index.php"; 
    }
*/

    if(isset($_GET["action"]) && isset($_GET["id"])){
        $action = $_GET["action"];
        $idprod = $_GET["id"];
        $countCopies = $dbh->getAvaiableCopiesOfProd($idprod);
        $response = array("isLogged" => false,"execDone" => false, "count" => $countCopies);
        
        if(isCustomerLoggedIn()){
            $result = handleLoggedCustomerRequest($dbh,$action,$_SESSION['userId'],$idprod);
            $result = $result == 0 ? false : true; 

            $response["isLogged"] = true;
            $response["execDone"] = $result;
        }
        echo json_encode($response);
    }

    /**
     * Handle request about a product from a Customer that is logged-in, all action have effect on user's data on db
     * @param DatabaseHelper $dbh
     * @param string $action What to do with the product 
     * @param int $idCustomer Unique customer id 
     * @param int $idprod Unique product id
     * @return boolean If action not executed for any reason return false
    */
    function handleLoggedCustomerRequest($dbh,$action,$idCustomer,$idprod){
        if(!strcmp($action,'wish')){
            $isFav = $dbh -> isFavourite($_SESSION['userId'],$idprod);
            
            if(!$isFav){
                return $dbh -> addProductToWish($idCustomer,$idprod);
            }
            else{
                return $dbh -> removeProductToWish($idCustomer,$idprod);
            }


        }//--VVVVVVVV--NO ROBA MIA----VVVVVVVVVVV
        else if(!strcmp($action,'addtoCart')){
            $dbh -> addProductToCart($idCustomer,$idprod,1);
        }
        else if(!strcmp($action,'decToCart')){
            //decrement quantity of product in cart
            $dbh -> decrementProductToCart($idCustomer,$idprod,1);
        }
        else if(!strcmp($action,'delFromCart')){
            //completely remove product from cart in db
            $dbh -> deleteProductFromCart($idCustomer,$idprod,1);
        }
        else if(!strcmp($action,'notify')){
            //echo 'notify me id'. $idprod;
            $dbh -> addProductAlert($idCustomer,$idprod);
        }
    }
    
?>