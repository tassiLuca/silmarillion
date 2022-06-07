<!-- Breadcrumb pagination -->
<div>
    <ul>
        <li><a href="./index.php"><img src="./img/commons/home-icon.svg" alt="Home"></a></li>
        <li><a href="./user-area.php">Area personale</a></li>
        <li><a href="#">Wishlist</a></li>
    </ul>
</div>


<!-- TODO - controllare i tag accessibilità non messi!! -->
<section>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th>Prodotto</th>
            <th>€/pz</th>
            <th>Stock</th>
            <th></th>
        </tr>

        <?php
        if (!empty($templateParams)) {
            foreach($templateParams["fav-elem"] as $prod):?>

            <tr>
                <td>
                <a class="wishButton" href="./engines/process-request.php?action=wish&amp;id=<?php echo $prod['ProductId']?>">
                    <img src="./img/user-page/Delete.svg"  alt="rimuovi articolo" class="delete">
                </a>
                </td>
                <td><img src="<?php echo UPLOAD_DIR_PRODUCTS.$prod['CoverImg'] ?>" alt="" /></td>
                <th><?php echo $prod['Name'] ?></th>
                <td><?php echo $prod['Price'] ?><p><?php echo $prod['DiscountedPrice'] ?> </p></td>
                <td>In Stock<p class="miniText">Quantità: <?php echo $prod['copies'] ?> pz</p></td>
                <td><div class="whiteBtn"><a class=" cartButton" href="./engines/process-request.php?action=addtoCart&id=<?php echo $prod['ProductId']?>">Aggiungi al carrello</a></div></td>
            </tr>

            <?php endforeach;
        } ?>

    </table>

</section>
