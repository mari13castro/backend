<?php
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    
    $item = $database->select("tb_dish_info",[
        "[>]tb_categories"=>["id_categories" => "id_categories"],
        "[>]tb_quantity_people"=>["id_quantity_people" => "id_quantity_people"]
    ],[
        "tb_dish_info.id_dish_info",
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
    ],[

        "id_dish_info"=>$_GET["id"]
        
    ]);

    $item2 = $database->select("tb_dish_info","*",
    [
        "id_categories"=>$item[0]["id_categories"],
        "id_dish_info[!]" =>$_GET["id"]
        ]
);

    $relatedDish1 = rand(0,count($item2)-1);
    do{
        $relatedDish2 = rand(0,count($item2)-1);

    }while($relatedDish1==$relatedDish2);

    do{
        $relatedDish3 = rand(0,count($item2)-1);

    }while($relatedDish1==$relatedDish3||$relatedDish2==$relatedDish3);
    
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
        <div class="nav-bar">
            <ul class="nav-list">
                <li class="nav-text"><a class="nav-link" href="./menu.php">Go back</a></li>
                <li class="nav-text"><a class="nav-link" href="../index.html">Homepage</a></li>
                <li class="nav-text"><a class="nav-link" href="#">Login</a></li>
                <li class="nav-text"><a class="nav-link" href="#">Support</a></li>
            </ul>
        </div>
    </header>
<main>
    <?php
        echo "<div class='description-container'>";
        echo "<div class='description-image-container'>";
            echo "<img src='./imgs/".$item[0]["dish_img"]."' alt='".$item[0]["dish_lname"]."'>";
        echo "</div>";
        echo "<div class='description-text-container'>";
            echo "<div class='description-inner-text-container'>";
                echo "<h2 class='about-dish-title'>".$item[0]["dish_lname"]."</h2>";
                echo "<p>".$item[0]["dish_description"]."</p>";
                echo "<p>Category: ".$item[0]["category_name"]."</p>";
                echo "<p>".$item[0]["quantity_category_name"].": ".$item[0]["quantity_description"]."</p>";
                echo "<p>$".$item[0]["price"]."</p>";
                echo "<ul class='related-dishes-container'>";
                echo "</ul>";

                echo "<div class='button-container'>";
                    echo "<button class='about-cart-button' onclick='window.location.href='./menu.html''>Add to
                            cart</button>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";

        echo "<div class='dishes-title-container'>";
        echo "<h1 class='top-dishes-title'>Related Dishes</h1>";
    echo "</div>";

    echo "<div class='top-dishes'>";
    for($i=0; $i<3; $i++){
        if($i==0){$randomRelated=$relatedDish1;}
        if($i==1){$randomRelated=$relatedDish2;}
        if($i==2){$randomRelated=$relatedDish3;}
            echo "<div class='reversible-card'>";
                echo "<div class='face front'>";
                    echo "<img src='./imgs/".$item2[$randomRelated]["dish_img"]."' alt='".$item2[$randomRelated]["dish_lname"]."'>";
                    echo "<h3>".$item2[$randomRelated]["dish_sname"]."</h3>";
                echo "</div>";
                echo "<div class='face back'>";
                    echo "<h3>".$item2[$randomRelated]["dish_lname"]."</h3>";
                    echo "<p>".$item2[$randomRelated]["dish_description"]."</p>";
                echo "</div>";
            echo "</div>";
    }
    echo "</div>";

    echo "<footer class='footer'>";
        echo "<p class='footer-text'>&copy; 2023. All rights reserved.</p>";
        echo "<div class='footer-image-container'>";
            echo "<a class='footer-image' href='#'><img src='./imgs/instagram.svg' alt='instagram'></a>";
            echo "<a class='footer-image' href='#'><img src='./imgs/faceboook.svg' alt='facebook'></a>";
            echo "<a class='footer-image' href='#'><img src='./imgs/twitter.svg' alt='twitter'></a>";
        echo "</div>";
    echo "</footer>";
    
    ?>

    <script src="./js/main.js"></script>
   
</main>
</body>

</html>