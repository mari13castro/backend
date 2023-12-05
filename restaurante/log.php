<?php
require_once '../database.php';

$orders = $database->select("tb_order_registration", "*");
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
            foreach ($orders as $item) {
            echo "<section class='content'>";
            echo "<td>Order Number:".$item["id_order_registration"]."</td>";
            echo "<td>Dish Id:".$item["id_dish_info"]."</td>";
            echo "<td>Date:".$item["date"]."</td>";
            echo "<td>Hour:".$item["time"]."</td>";
            echo "<td>Amount:".$item["order_quantity"]."</td>";
            echo "<td><a href='delete.php?id=".$item["id_order_registration"]."'>Delete</a></td>";
            echo "</section>";
        }

        echo "</div>";
        echo "</section>";
    ?>

    <?php
    include "./parts/footer.php";
    ?>

</body>

</html>