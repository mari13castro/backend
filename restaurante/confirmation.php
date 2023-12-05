<?php
require_once '../database.php';
$categories = $database->select("tb_categories", "*");
if ($_SERVER["REQUEST_METHOD"] == "POST") {



    $database->insert("tb_order_registration", [
        "id_dish_info" => $_POST['dish_id'],
        "date" => $_POST["date"],
        "time" => $_POST["time"],
        "order_quantity" => $_POST["amount"],    
    ]);
}
?>

<<!DOCTYPE html>
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
    <?php
    include "./parts/header.php";
    ?>

    <body>
        <main>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<h2 style='font-size: 2.5em; color: purple;'>Thank you for your order!</h2>";
                echo "<h3 style='font-size: 1.5em; color: purple;'>Your order number is: " . $database->id() . "</h3>";
            }

            ?>

        </main>
    </body>

    </html>