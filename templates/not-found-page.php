 <!-- Breadcrumb pagination -->
 <div>
    <ul>
        <li><a href="index.php"><img src="./img/home-icon.svg" alt="Home"></a></li>
        <li>Pagina errore</li>
    </ul>
</div>
<section>
    <header>
        <h3>Sei c091i0n3 hai fatto un marone !!</h3>
    </header>
    <div>
        <?php
            $images = glob("./img/not-found/*");
            $imgAmount = count($images)-1 < 0 ? 0 : count($images)-1;
        ?>
        <div><p>Wolf Wolf !!</p></div>
        <img src="<?php echo $images[random_int(0,$imgAmount)]?>" alt="">
    </div>
</section>