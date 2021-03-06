<!-- Breadcrumb pagination -->
<div>
    <ul>
        <li><a href="index.php"><img src="./img/commons/home-icon.svg" alt="Home"></a></li><li>Login</li>
    </ul>
</div>
<section>
    <header>
        <div>
            <img src="./img/login/user-men-icon.svg" alt="">
        </div>
        <ul>
            <li id="userloginbtn"><h3><a href="#userlogin">Utente</a></h3></li><li id="sellerloginbtn"><h3><a href="#sellerlogin">Venditore</a></h3></li>
        </ul>
    </header>
    <!-- User login form -->
    <form action="#" method="POST">
        <ul id="userlogin">
            <li>
                <label for="customerUsr">Username</label>
                <input type="text" placeholder="es. tassiluchino" id="customerUsr" name="customerUsr" required />
            </li>
            <li>
                <label for="customerPwd">Password</label>
                <input type="password" placeholder="Password" id="customerPwd" name="customerPwd" required />
            </li>
            <li>
                <p>Silmarillion rispetta la tua privacy &#128525;. La password inserita nel form viene inviata al server solo dopo essere stata precedentemente crittografata. </p>
            </li>
            <li>
                <a href="recovery.php">Hai dimenticato la password?</a>
                <input type="submit" name="submit" value="ACCEDI" />
            </li>
            <li>
                <p>Non sei registrato?</p>
                <a href="./registration.php">CREA IL TUO ACCOUNT</a>
            </li>
        </ul>
    </form>
    <!-- Seller login form -->
    <form action="#" method="POST">
        <ul id="sellerlogin">
            <li>
                <label for="sellerUsr">Username</label>
                <input type="text" placeholder="es. silmarillion" id="sellerUsr" name="sellerUsr" />
            </li>
            <li>
                <label for="sellerPwd">Password</label>
                <input type="password" placeholder="Password" id="sellerPwd" name="sellerPwd" />
            </li>
            <li>
                <p>Silmarillion rispetta la tua privacy &#128525;. La password inserita nel form viene inviata al server solo dopo essere stata precedentemente crittografata. </p>
            </li>
            <li>
                <a href="recovery.php">Hai dimenticato la password?</a>
                <input type="submit" name="submit" value="ACCEDI" />
            </li>
        </ul>
    </form>
</section>