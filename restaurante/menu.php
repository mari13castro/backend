<?php
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    
    $items = $database->select("tb_dish_info",[
        "[>]tb_quantity_people"=>["id_quantity_people" => "id_quantity_people"]
    ],[
        "tb_dish_info.id_dish_info",
        "tb_dish_info.dish_lname",
        "tb_dish_info.dish_sname",
        "tb_dish_info.dish_img",
        "tb_dish_info.dish_description",
        "tb_dish_info.price",
        "tb_quantity_people.quantity_category_name"
    ]);
   
    $mains = $database->select("tb_dish_info", "*", ["id_categories" => 1]);
    $drinks = $database->select("tb_dish_info", "*", ["id_categories" => 2]);
    $desserts = $database->select("tb_dish_info", "*", ["id_categories" => 3]);
    $starters = $database->select("tb_dish_info", "*", ["id_categories" => 4]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menú</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Open+Sans:ital,wght@0,400;0,500;1,400;1,700&family=Raleway:wght@200;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>
    <header>
        <div class="banner">
            <ul class="nav-list">
                <li class="nav-text"><a class="nav-link" href="../index.html">Go back</a></li>
                <li class="nav-text"><a class="nav-link" href="#">Login</a></li>
                <li class="nav-text"><a class="nav-link" href="#">Contact Us</a></li>
                <li class="nav-text"><a class="nav-link" href="#">Support</a></li>
            </ul>

            <h1 class="banner-title">Menu</h1>
        </div>
    </header>

    <h1 class="separator">Starters</h1>
    <section class="content">

    <?php 
        foreach($starters as $index => $starter){
            echo "<section class='grid-item'>";
                echo "<div class='dish-thumb'>";
                    echo "<img class='dish' src='./imgs/".$starter["dish_img"]."' alt='".$starter["dish_lname"]."'>";
                    echo "<span class='price'>$".$starter["price"]."</span>";
                    echo "<a class='about-btn' href='details.php?id=".$starter["id_dish_info"]."'>About</a>";
                echo "</div>";
                echo "<div class= 'text-card-container'>";
                    echo "<p class='text-card'>".$starter["dish_sname"]."</p>";
                echo "</div>";
                echo "<div class='card-icon-container'>";
                    echo "<img class='cart-img' src='./imgs/carrito_de_compras.png' alt='cart'>";
                echo "</div>";
            echo "</section>";
        }
    ?>
    </section>
    

    <h1 class="separator">Main Dish</h1>

    <section class="content">

    <?php 
        foreach($mains as $index => $main){
            echo "<section class='grid-item'>";
                echo "<div class='dish-thumb'>";
                    echo "<img class='dish' src='./imgs/".$main["dish_img"]."' alt='".$main["dish_lname"]."'>";
                    echo "<span class='price'>$".$main["price"]."</span>";
                    echo "<a class='about-btn' href='details.php?id=".$main["id_dish_info"]."'>About</a>";
                echo "</div>";
                echo "<div class= 'text-card-container'>";
                    echo "<p class='text-card'>".$main["dish_sname"]."</p>";
                echo "</div>";
                echo "<div class='card-icon-container'>";
                    echo "<img class='cart-img' src='./imgs/carrito_de_compras.png' alt='cart'>";
                echo "</div>";
            echo "</section>";
        }
    ?>
    </section>

    <h1 class="separator">Desserts</h1>

    <section class="content">
    
    <?php 
        foreach($desserts as $index => $dessert){
            echo "<section class='grid-item'>";
                echo "<div class='dish-thumb'>";
                    echo "<img class='dish' src='./imgs/".$dessert["dish_img"]."' alt='".$dessert["dish_lname"]."'>";
                    echo "<span class='price'>$".$dessert["price"]."</span>";
                    echo "<a class='about-btn' href='details.php?id=".$dessert["id_dish_info"]."'>About</a>";
                    
                echo "</div>";
                echo "<div class= 'text-card-container'>";
                    echo "<p class='text-card'>".$dessert["dish_sname"]."</p>";
                echo "</div>";
                echo "<div class='card-icon-container'>";
                    echo "<img class='cart-img' src='./imgs/carrito_de_compras.png' alt='cart'>";
                echo "</div>";
            echo "</section>";
        }
    ?>
    </section>
    

    <h1 class="separator">Drinks</h1>

    <section class="content">

    <?php 
        foreach($drinks as $index => $drink){
            echo "<section class='grid-item'>";
                echo "<div class='dish-thumb'>";
                    echo "<img class='dish' src='./imgs/".$drink["dish_img"]."' alt='".$drink["dish_lname"]."'>";
                    echo "<span class='price'>$".$drink["price"]."</span>";
                    echo "<a class='about-btn' href='details.php?id=".$drink["id_dish_info"]."'>About</a>";
                echo "</div>";
                echo "<div class= 'text-card-container'>";
                    echo "<p class='text-card'>".$drink["dish_sname"]."</p>";
                echo "</div>";
                echo "<div class='card-icon-container'>";
                    echo "<img class='cart-img' src='./imgs/carrito_de_compras.png' alt='cart'>";
                echo "</div>";
            echo "</section>";
        }
    ?>
    </section> 

    <footer class="footer">
        <p class="footer-text">&copy; 2023. All rights reserved.</p>
        <div class="footer-image-container">
            <a class="footer-image" href="#"><img src="./imgs/instagram.svg" alt="instagram"></a>
            <a class="footer-image" href="#"><img src="./imgs/faceboook.svg" alt="facebook"></a>
            <a class="footer-image" href="#"><img src="./imgs/twitter.svg" alt="twitter"></a>
        </div>
    </footer>




</body>



</html>