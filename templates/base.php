<!DOCTYPE html>
<html lang="it">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php 
            /**
             * Insert here all the style sheets needed by the single page.
             * To do so declare a $templateParams["css"] with an array of style sheet files name to import.
             */
            if (isset($templateParams["css"])):
                foreach($templateParams["css"] as $styleSheet): 
        ?>
                    <link rel="stylesheet" type="text/css" href=<?php echo "./css/" . $styleSheet ?> />
        <?php
                endforeach;
            endif;
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/navbar.js"></script>
        <script src="js/login-form.js"></script>
        <script src="js/sha512.js"></script>
        <?php
            /**
             * Insert here all the javascript files needed by the single page.
             * To do so declare a $templateParams["js"] with an array of js script files name to import.
             */
            if (isset($templateParams["js"])):
                foreach($templateParams["js"] as $jsScript):
        ?>
                    <script src=<?php echo "js/" . $jsScript ?>></script>
        <?php
                endforeach;
            endif;
        ?>
        <title>Silmarillion</title>
    </head>
    <body>
        <header>
            <h1 class="hide">Silmarillion Comics</h1>
            <nav>
                <ul>
                    <li>
                        <button type="button">
                            <img src="./img/commons/menu.svg" alt="Menu"/>
                        </button>
                    </li><li>
                        <button type="button">
                            <img src="./img/commons/menu-search.svg" alt="Cerca"/>
                        </button>
                    </li><li>
                        <!-- TODO: modify pages name -->
                        <?php if (isUserLoggedIn()): ?>
                            <a href="<?php echo (isCustomerLoggedIn() ? 'userArea.php' : 'sellerArea.php'); ?>">
                                <img src="./img/commons/menu-login-checked.svg" alt="Login"/>
                            </a>
                        <?php else: ?>
                            <button type="button"><img src="./img/commons/menu-login.svg" alt="Login"/></button>
                        <?php endif; ?>
                    </li><li>
                        <button type="button" >
                            <img src="./img/commons/menu-cart.svg" alt="Carrello"/>
                        </button>
                    </li>
                </ul>
                <div id="navMenu">
                    <ul>
                        <li>
                            <a href="catalog.php">Nuovi Arrivi</a>
                        </li><li>
                            <a href="catalog.html">Manga</a>
                        </li><li>
                            <a href="catalog.html">Supoereroi</a>
                        </li><li>
                            <a href="catalog.html">Funko Pop</a>
                        </li><li id="login">
                            <a href="login.html">Login</a>
                        </li><li>
                            <a href="index.php#reviews">Recensioni</a>
                        </li><li>
                            <a href="index.php#partners">Partner</a>
                        </li><li>
                            <a href="">Supporto</a>
                        </li>
                    </ul> 
                </div>
                <div id="navCart">
                    <ul>
                        <li>
                            <img src="img/cart/Deadpool_Cake_POP_GLAM-1-WEB_700x 1.svg" alt="">
                            <div>
                                <p>Deadpool_Cake_POP_GLAM</p>
                                <div>
                                    <p>15,99€</p>
                                    <p>x2</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="img/cart/Deadpool_Cake_POP_GLAM-1-WEB_700x 1.svg" alt="">
                            <div>
                                <p>Deadpool_Cake_POP_GLAM</p>
                                <div>
                                    <p>15,99€</p>
                                    <p>x2</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a href="cart.html">Visualizza carrello</a>
                </div>
                <!-- search dropdown menu -->
                <div id="navSearch">
                    <form action="#" method="GET">
                        <h2>Cerca</h2>
                        <ul>
                            <li>
                                <label for="search">Cerca</label>
                                <input type="text" placeholder="Cerca..." id="search" name="search" required /><button type="submit"><img src="./img/commons/search-icon.svg" alt="Vai!"/></button>
                            </li>
                        </ul>
                    </form>
                </div>
                <!-- login dropdown menu -->
                <div id="navLogin">
                    <form action="#" method="POST">
                        <h2>Login</h2>
                        <ul>
                            <li>
                                <label for="usernameNav">Username</label>
                                <input type="text" placeholder="es. giovadelnevo" id="usernameNav" name="customerUsr" required />
                            </li>
                            <li>
                                <label for="userpasswordNav">Password</label>
                                <input type="password" placeholder="Password" id="userpasswordNav" name="customerPwd" required />
                            </li>
                            <li 
                                <?php 
                                    if (isset($templateParams["loginError"])) :
                                        echo 'class=active'; 
                                ?>
                            >
                                        <strong><?php echo $templateParams["loginError"] ?></strong>
                                <?php 
                                    endif;
                                ?>
                            </li>
                            <li>
                                <div>
                                    <a href="">Dimenticato la password?</a>
                                    <a href="login.html">Accedi come venditore</a>
                                </div>
                                <input type="submit" name="submit" value="ACCEDI" />
                            </li>
                            <li>
                                <p>Non sei registrato?</p>
                                <a href="./register.html">CREA IL TUO ACCOUNT</a>
                            </li>
                        </ul>
                    </form>
                </div>
            </nav>
        </header>
        <main>          
            <?php
                /**
                 * Insert here main section. 
                 * To do so declare a $templateParams["main"] with the template file name.
                 */
                if (isset($templateParams["main"])) {
                    require $templateParams["main"];
                }
            ?>
        </main>
        <footer>
            <h4 class="hide">Silmarillion Comics</h4>
            <div>
                <h4>INFO</h4> 
                <ul>
                    <li>Chi Siamo</li>
                    <li>Contattaci</li>
                    <li>FAQs</li>
                </ul>
            </div><div>
                <h4>ACCOUNT</h4>
                <ul>
                    <li>Account utente</li>
                    <li>Account venditore</li>
                </ul>
                <h4>CONDIZIONI</h4>
                <ul>
                    <li>Termini e condizioni di utilizzo</li>
                    <li>Reso di un ordine</li>
                </ul>
            </div><div>
                <h4>CONTATTI</h4>
                <ul>
                    <li>Via del Campus 5814</li>
                    <li><a href="mailto:info@silmarillion.it">info@silmarillion.it</a></li>
                    <li> <a href="tel:+390587932451"> 05 879 32 451</a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>