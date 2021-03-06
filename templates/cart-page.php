
<!-- Breadcrumb pagination -->
<div>
    <ul>
        <li><a href="index.php"><img src="./img/commons/home-icon.svg" alt="Home"></a></li><li>Carrello</li>
    </ul>
</div>
<section>
    <header><h3>Carrello</h3></header>
    <div>
        <div>
            <!-- insert foreach product in cart an article-->
            <?php
                $isSomeProdNotAvialable = false;
                if(isset($templateParams["cart"]) && count($templateParams["cart"]) > 0){
                    foreach($templateParams["cart"] as $prod):
            ?>
            <article <?php
                    $av = $dbh -> getAvaiableCopiesOfProd($prod['ProductId']);
                    if($prod['Quantity'] > $av){
                        echo 'class="notAvaialable" ';
                        $isSomeProdNotAvialable = true;
                    }
                    ?>id="<?php echo $prod['ProductId']?>">
                <div><img src="<?php echo UPLOAD_DIR_PRODUCTS.$prod['CoverImg']?>" alt="copertina fumetto"></div>
                <div>
                    <header><h3><?php echo $prod['Title']?></h3></header>
                    <p><?php 
                            if(isset($prod['DiscountedPrice'])){
                                echo formatPrice($prod['DiscountedPrice']);
                            }
                            else{
                                echo formatPrice($prod['Price']);
                            }?> €</p>
                </div>
                <div>
                    <div>
                        <!--here we call php page to add or edit quantity of an article sending a query to specify which product and the action to do-->
                        <div><a class="cartButtonDec" href="./engines/process-request.php?action=decToCart&id=<?php echo $prod['ProductId']?>"><img src="img/cart/subtract.svg" alt="riduci quantità"></a></div>
                        <div><p><?php echo $prod['Quantity']?></p></div>
                        <div><a class="cartButton" href="./engines/process-request.php?action=addtoCart&id=<?php echo $prod['ProductId']?>"><img src="img/cart/plus_math.svg" alt="aumenta quantità"></a></div>
                    </div>
                    <div><a class="removeCart" href="./engines/process-request.php?action=delFromCart&id=<?php echo $prod['ProductId']?>">Rimuovi</a></div>
                </div>
            </article>
            <?php 
                    endforeach;
                }
                else{
                    echo "<p>Carrello vuoto</p>";
                }    
            ?>
            <!-- end of article list-->
        </div>
        <?php 

            if($isSomeProdNotAvialable){
                echo '<p id="cartInfoBanner">Alcuni prodotti non sono più disponibili, verranno esclusi dall`ordine </p>';
            }
        ?>
        <div>
            <p>Totale:</p><p id="totalPrice"></p>
        </div>
        <div><a <?php 
                    if(isset($templateParams["cart"]) && count($templateParams["cart"]) <= 0){echo "class=disabled";}
                ?> href="payment.php">PROCEDI ALL'ORDINE</a></div>
    </div>
</section>
