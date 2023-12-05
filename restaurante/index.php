<?php
require_once '../database.php';
// Reference: https://medoo.in/api/select

$item = $database->select("tb_dish_info", [
    "[>]tb_categories" => ["id_categories" => "id_categories"],
    "[>]tb_quantity_people" => ["id_quantity_people" => "id_quantity_people"]
], [
    "tb_dish_info.dish_lname",
    "tb_dish_info.dish_sname",
    "tb_dish_info.dish_img",
    "tb_dish_info.dish_description",
    "tb_dish_info.price",
    "tb_dish_info.id_categories",
    "tb_categories.category_name",
    "tb_categories.category_description",
    "tb_quantity_people.quantity_category_name",
    "tb_quantity_people.quantity_description"
]);

$featured = $database->select("tb_dish_info", "*", ["featured" => 1]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Open+Sans:ital,wght@0,400;0,500;1,400;1,700&family=Raleway:wght@200;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="./css/main.css">
</head>

<body>

    <header>
        <section class="hero-container">
            <div class="top-container">
                <div class="hero-text-container">
                        <?php
                        include "./parts/header.php";
                        ?>
                    <div class="hero-title-container">
                        <h1 class="hero-title">La Cantina</h1>
                    </div>
                    <div class="hero-description-container">
                        <ul>
                            <li class="hero-description">"Welcome to our vibrant Mexican culinary paradise! Discover the
                            </li>
                            <li class="hero-description">authentic flavors of Mexico in a cozy and festive atmosphere.
                            </li>
                            <li class="hero-description">Delight in our exquisite enchiladas, tacos, and fresh
                                guacamole.</li>
                            <li class="hero-description">Immerse yourself in Mexican culture with fresh ingredients and
                            </li>
                            <li class="hero-description">authentic traditional recipes, we will take you on an
                                unforgettable</li>
                            <li class="hero-description">gastronomic journey."</li>
                        </ul>
                        <div class="button-container">
                            <button class="hero-menu-button" onclick="window.location.href='./menu.php'">Menu</button>
                        </div>

                    </div>


                </div>
                <div class="header-skull-container">
                    <img class="rest-icon" src="./imgs/calaca.png" alt="calaca">
                </div>
            </div>
        </section>
    </header>

    <body>
        <div class="dishes-title-container">
            <h1 class="top-dishes-title">Top Dishes</h1>
        </div>
        <div class="top-dishes">
            <?php
            foreach ($featured as $index => $featuredItem) {

                echo "<div class='reversible-card'>";

                echo "<div class='face front'>";
                echo "<img class='top-dish-img' src='./imgs/" . $featuredItem["dish_img"] . "' alt='" . $featuredItem["dish_sname"] . "'>";
                echo "<h3>" . $featuredItem["dish_sname"] . "</h3>";
                echo "</div>";
                echo "<div class='face back'>";
                echo "<h3>" . $featuredItem["dish_sname"] . "</h3>";
                echo "<p>" . $featuredItem["dish_description"] . "</p>";
                echo "<div class='card-link'>";
                echo "<a class='card-link-style' href='details.php?id=" . $featuredItem["id_dish_info"] . "'>About</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </body>

    <footer class="footer">
        <p class="footer-text">&copy; 2023. All rights reserved.</p>
        <div class="footer-image-container">
            <a class="footer-image" href="#"><img src="./imgs/instagram.svg" alt="instagram"></a>
            <a class="footer-image" href="#"><img src="./imgs/faceboook.svg" alt="facebook"></a>
            <a class="footer-image" href="#"><img src="./imgs/twitter.svg" alt="twitter"></a>
        </div>
    </footer>
    <script src="./js/main.js"></script>


</html>