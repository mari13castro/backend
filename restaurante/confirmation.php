<?php
require_once '../database.php';
$categories = $database->select("tb_categories", "*");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['user_id'])) {
        // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
        header('Location: forms.php');
        exit;
    }

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

    <body>

        <?php
        include "./parts/header.php";
        ?>

        <main>

        </main>


    </body>

    </html>