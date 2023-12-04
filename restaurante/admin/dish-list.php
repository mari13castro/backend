<?php 
    require_once '../../database.php';

    $items = $database->select("tb_dish_info","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Dishes</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

    <header>
        <div class="nav-bar">
            <ul class="nav-list">
                <li class="nav-text"><a class="nav-link" href="../menu.php">Go back</a></li>
                <li class="nav-text"><a class="nav-link" href="../index.html">Homepage</a></li>
            </ul>
        </div>
    </header>

    <h2 class="list-title">All the Registered Dishes</h2>
    <div  class="list-container">
    <table>
        <thead>
            <tr class="list-titles">
                <td>Dish Long Name</td>
                <td>ID Category</td>
            </tr>
        </thead>
        <?php

            foreach($items as $item){
                echo "<td class= 'list-text'>".$item["dish_lname"]."</td>";
                echo "<td class= 'list-text'>".$item["id_categories"]."</td>";
                echo "<td class= 'list-text'><a href='edit-dish.php?id=".$item["id_dish_info"]."'>Edit</a> <a href='delete-dish.php?id=".$item["id_dish_info"]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    </div>
    
</body>
</html>