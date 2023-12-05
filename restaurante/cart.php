<?php
require_once '../database.php';

if ($_GET) {
    $item = $database->select("tb_dish_info", [
        "[>]tb_categories" => ["id_categories" => "id_categories"],
        "[>]tb_quantity_people" => ["id_quantity_people" => "id_quantity_people"]
    ], [
        "tb_dish_info.id_dish_info",
        "tb_dish_info.dish_lname",
        "tb_dish_info.dish_lname_es",
        "tb_dish_info.dish_sname",
        "tb_dish_info.dish_sname_es",
        "tb_dish_info.dish_img",
        "tb_dish_info.dish_description",
        "tb_dish_info.dish_description_es",
        "tb_dish_info.price",
        "tb_dish_info.id_categories",
        "tb_categories.category_name",
        "tb_categories.category_description",
        "tb_quantity_people.quantity_category_name",
        "tb_quantity_people.quantity_description"
    ], [
        "id_dish_info" => $_GET["id"]
    ]);

    $dish = $database->select("tb_dish_info", "*");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Details</title>
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
    <main>
        <?php
        echo "<div class='description-container'>";
        echo "<div class='description-image-container'>";
        echo "<img src='./imgs/" . $item[0]["dish_img"] . "' alt='" . $item[0]["dish_lname"] . "'>";
        echo "</div>";

        echo "<div class='description-text-container'>";
        echo "<div class='description-inner-text-container'>";
        echo "<h2 class='about-dish-title'>" . $item[0]["dish_lname"] . "</h2>";
        echo "<p>" . $item[0]["dish_description"] . "</p>";
        echo "<p>Category: " . $item[0]["category_name"] . "</p>";
        echo "<p>" . $item[0]["quantity_category_name"] . ": " . $item[0]["quantity_description"] . "</p>";
        echo "<p>$" . $item[0]["price"] . "</p>";

        echo "<div class='button-container'>";
        echo "<button class='about-cart-button'>Add to cart</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        ?>

    <script>
        
    </script>
    </main>

</body>

</html>