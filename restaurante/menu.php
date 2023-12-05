<?php
require_once '../database.php';
// Reference: https://medoo.in/api/select

$categories = $database->select("tb_categories", "*");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Open+Sans:ital,wght@0,400;0,500;1,400;1,700&family=Raleway:wght@200;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>

    <?php
    include "./parts/header.php";
    ?>

    <?php
    foreach ($categories as $category) {
        echo "<h1 class='separator'>" . $category["category_name"] . "</h1>";
        echo "<section class='content'>";

        //select destinations with the same category id/name
        $dishes = $database->select("tb_dish_info", [
            "[>]tb_quantity_people" => ["id_quantity_people" => "id_quantity_people"]
        ], [
            "tb_dish_info.id_dish_info",
            "tb_dish_info.dish_lname",
            "tb_dish_info.dish_sname",
            "tb_dish_info.dish_img",
            "tb_dish_info.dish_description",
            "tb_dish_info.price",
            "tb_quantity_people.quantity_category_name"
        ], [
            "tb_dish_info.id_categories" => $category["id_categories"]
        ]);

        foreach ($dishes as $dish) {
            echo "<section class='grid-item'>";
            echo "<div class='dish-thumb'>";
            echo "<img class='dish' src='./imgs/" . $dish["dish_img"] . "' alt='" . $dish["dish_lname"] . "'>";
            echo "<span class='price'>$" . $dish["price"] . "</span>";
            echo "<a class='about-btn' href='details.php?id=" . $dish["id_dish_info"] . "'>About</a>";
            echo "</div>";
            echo "<div class= 'text-card-container'>";
            echo "<p class='text-card'>" . $dish["dish_sname"] . "</p>";
            echo "</div>";
            echo "<div class='card-icon-container'>";
            echo "<img class='cart-img' src='./imgs/carrito_de_compras.png' alt='cart'>";
            echo "</div>";
            echo "</section>";
        }

        echo "</div>";
        echo "</section>";
    }
    ?>

    <?php
    include "./parts/footer.php";
    ?>

</body>

</html>