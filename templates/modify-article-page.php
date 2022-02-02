<!-- Breadcrumb pagination -->
<div>
    <ul>
        <!-- TODO: link -->
        <li><a href="./index.php"><img src="./img/home-icon.svg" alt="Home"></a></li><li><a href="./login.php">Area personale</a></li><li>Modifica Articolo</li>
    </ul>
</div>
<section>
    <header>
        <!-- TODO nel caso di modifica metti modifica !-->
        <h2>Inserisci articolo</h2>
    </header>
    <form>
        <ul>
            <li>
                <fieldset>
                    <legend>Tipologia di articolo</legend>
                    <input type="radio" id="comic" name="articleToInsert" value="Fumetto" required />
                    <label for="comic">Fumetto</label>
                    <input type="radio" id="funko" name="articleToInsert" value="Funko" required />
                    <label for="funko">Funko</label>
                </fieldset>
            </li>
            <!-- for funko -->
            <li>
                <label for="funkoName">Nome</label>
                <input type="text" placeholder="es. Joan Jett Pop" id="funkoName" name="funkoName" required />
            </li>
            <!-- for comics -->
            <li>
                <label for="title">Titolo</label>
                <input type="text" placeholder="es. Two Moons 1" id="title" name="title" required />
            </li>
            <li>
                <label for="author">Autore</label>
                <input type="text" placeholder="es. John Arcudi" id="author" name="author" required />
            </li>
            <li>
                <label for="language">Lingua</label>
                <input type="text" placeholder="es. Italiano" id="language" name="language" required />
            </li>
            <li>
                <label for="publishDate">Data di pubblicazione</label>
                <input type="text" placeholder="es. 10/02/2020" id="publishDate" name="publishDate" required />
            </li>
            <li>
                <label for="isbn">ISBN</label>
                <input type="text" placeholder="es. 9781534319110" id="isbn" name="isbn" required />
            </li>
            <!-- for all articles -->
            <li>
                <label for="category">Categoria</label>
                <input type="text" placeholder="es. Comics" id="category" name="category" required />
            </li>
            <li>
                <label for="price">Prezzo</label>
                <input type="text" placeholder="es. 15,00" id="price" name="price" required />
            </li>
            <li>
                <label for="discountedPrice">Prezzo Scontato</label>
                <input type="text" placeholder="es. 14,00" id="discountedPrice" name="discountedPrice" />
            </li>
            <li>
                <label for="desc">Descrizione</label>
                <input type="text" placeholder="es. Descrizione sintetica del prodotto" id="desc" name="desc" required />
            </li>
            <li>
                <label for="img">Immagine di Copertina</label>
                <input type="file" id="img" name="img" required />
            </li>
            <li>
                <!-- TODO nel caso di modifica metti modifica !-->
                <input type="submit" value="INSERISCI" />
            </li>
        </ul>
    </form>
</section>