<?php 
define('SPACE', ' ');
define('EQ', '=');
define('AND_S', ' and ');
define('OR_S', ' or ');

define('NOT_AVAILABLE', 0);
define('AVAILABLE', 1);
define('ALL_AVAILABILITY', 2);

define('ONLY_COMICS', 0);
define('ONLY_FUNKOS', 1);
define('ALL_PRODS', 2);

$varTypes = ''; //string containing all types of passed var to bind_param()
$varArray = []; //array of references of all variables to be binded

$priceInterval = ["cheap"=> ["from"=>'0',"to"=>'99.99'],
"medium"=> ["from"=>'100',"to"=>'199.99'],
"expensive"=>["from"=>'99.99']];
/*
filters = lang, author, price, availability, publisher,category*/
    require_once '../bootstrap.php';
    
    if(isset($_POST)){  //TODO: make some chek of what server receive in post method
        $availabFilter = ALL_AVAILABILITY;
        $keys = array_keys($_POST);
        $data = $_POST;
        
        if(isset($keys) && count($keys)){
            $filtQuery = AND_S.'(';
        /**
         * is first filter applied ? Used to append or not 'and' keyword in SQLquery
         * If one filter selected not add 'or' statement, if more than one filter is applied
         * add 'or statement in sql query'
         * The change of $isFirst happen in method getCorrectConcat()
         */
            $isFirst = true;
            foreach($keys as $k){
                //KEEP IN MIND: strcmp return 0 if strings are equal
                if(isset($data['category']) && in_array('funko',$data['category'])){
                    $isFunko = ONLY_FUNKOS;
                }
                else{
                    $isFunko = ONLY_COMICS;
                }

                if(!strcmp($k,'category') && $isFunko != ONLY_FUNKOS){
                    $filtQuery .= appendEqualFilter($data[$k],'P.CategoryName');
                }
                else if(!strcmp($k,'publisher') && $isFunko != ONLY_FUNKOS){
                    $filtQuery .= appendEqualFilter($data[$k],'PB.Name');
                }
                else if(!strcmp($k,'availability')){
                    if(count($keys)==1){ //the only key present is avaialbility
                        $filtQuery .= '1'; //sql condition always true to get all comics
                    }
                    if(!strcmp($data[$k][0],'available')){
                        $availabFilter = AVAILABLE;
                    }
                    else if(!strcmp($data[$k][0],'notavailable')){
                        $availabFilter = NOT_AVAILABLE;
                    }
                    else{
                        $availabFilter = ALL_AVAILABILITY;
                    }
                }
                else if(!strcmp($k,'price')){
                    $filtQuery .= appendBetweenFilter($data[$k],'P.Price',$priceInterval);
                }
                else if(!strcmp($k,'author') && $isFunko != ONLY_FUNKOS){
                    $filtQuery .= appendEqualFilter($data[$k],'C.Author');
                }
                else if(!strcmp($k,'lang') && $isFunko != ONLY_FUNKOS){
                    $filtQuery .= appendEqualFilter($data[$k],'C.Lang');
                }

            }
            if($isFunko==ONLY_FUNKOS && !in_array('price', $keys)){
                $filtQuery .= ' 1)';
            }
            else{
                $filtQuery .= ' )';
            }
            
            sendData($filtQuery,$availabFilter,$dbh,$isFunko);
        }
        else{
            sendData('',$availabFilter,$dbh,ALL_PRODS);
        }
    }
   
    function appendEqualFilter($arr,$filt){
        $strQUery ='';
            foreach($arr as $e){
            $concatMode = getCorrectConcat();
            $strQUery .= $concatMode.$filt.SPACE.EQ.SPACE."'".$e."'";
        }
        return $strQUery;
    }

    /**
     * $interval must be structured as $intervalDef = ["rangeTag"=> ["from"=>'value',"to"=>'value'],
     * "rangeTag-1"=> ["from"=>'value',"to"=>'value'],...];
     */
    function appendBetweenFilter($arr,$filt,$interval){
        global $isFirst;
        $strQUery ='';
            foreach($arr as $e){
                $concatMode = getCorrectConcat();
                if(isset($interval[$e]["to"]) && isset($interval[$e]["from"])){
                    $strQUery .= $concatMode.$filt.SPACE.'BETWEEN'.SPACE."'".$interval[$e]["from"]."'".AND_S."'".$interval[$e]["to"]."'";
                }
                else if(!isset($interval[$e]["to"]) && isset($interval[$e]["from"])){
                    $strQUery .= $concatMode.$filt.SPACE.'>='.SPACE."'".$interval[$e]["from"]."'";
                }
                else if(isset($interval[$e]["to"]) && !isset($interval[$e]["from"])){
                    $strQUery .= $concatMode.$filt.SPACE.'<='.SPACE."'".$interval[$e]["to"]."'";
                }
        }
        return $strQUery;
    }
    function getCorrectConcat(){
        global $isFirst;
        $concatKeyword = $isFirst ? SPACE : AND_S;
        $isFirst = false;
        return $concatKeyword;
    }
    
    function addAvaiableCopiesInfo($prods,$dbh){
        $allProd = $prods;
        for($i=0; $i < count($prods);$i++){
            $allProd[$i]["copies"] = $dbh -> getAvaiableCopiesOfProd($allProd[$i]["ProductId"]);
        }
        return $allProd;
    }

    function applyFilterAvailable($prods,$selFilter){
        $allProd = array();
        for($i=0; $i < count($prods);$i++){
            if(($prods[$i]["copies"] > 0 && $selFilter==AVAILABLE) ||  
            ($prods[$i]["copies"] <= 0 && $selFilter==NOT_AVAILABLE) ||
            $selFilter==ALL_AVAILABILITY){
                array_push($allProd,$prods[$i]);
            }
        }
        return $allProd;
    }

    function sendData($query,$avail,$dbh,$typeReq){
        
        if($typeReq == ONLY_FUNKOS){
            $prods = $dbh -> getAllFunkosMatch($query);
        }
        else if($typeReq == ONLY_COMICS){
            $prods = $dbh -> getAllComicsMatch($query); //get all products that match filters
        }
        else if($typeReq == ALL_PRODS){
            $funkos = $dbh -> getAllFunkosMatch($query);
            $comics = $dbh -> getAllComicsMatch($query);
            $prods = array_merge($funkos,$comics);
        }
        $prods = addAvaiableCopiesInfo($prods,$dbh);
        $prods = applyFilterAvailable($prods,$avail);
        echo json_encode($prods); //before send json add numCopies info foreach products
    }
?>