<header>
    <div class="nav-bar">
        <ul class="nav-list">
            <li class="nav-text"><a class="nav-link" href="./menu.php">Go back</a></li>
            <li class="nav-text"><a class="nav-link" href="./index.php">Homepage</a></li>
            <li class="nav-text"><a class="nav-link" href="#">Support</a></li>
            <?php
            session_start();

            if (isset($_SESSION["isLoggedIn"])) {
                echo "<li><a class='nav-link' href='profile.php'>" . $_SESSION["fullname"] . "</a></li>";
                echo "<li><a class='nav-link' href='logout.php'>Logout</a></li>";
            } else {
                echo "<li><a class='nav-link' href='./forms.php'>Login</a></li>";
            }
            if (isset($_SESSION['foodList'])) {
                // Accede a los datos de 'foodList' y muéstralo
                $foodList = $_SESSION['foodList'];
                // Puedes imprimirlo como texto, mostrarlo en un menú desplegable, o usarlo como necesites
                echo '<P>';
                print_r($foodList); // Esto mostrará el contenido de 'foodList'
                echo '</P>';
            }
            ?>
        </ul>
    </div>
</header>