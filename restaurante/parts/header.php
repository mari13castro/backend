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
            ?>
        </ul>
    </div>
</header>