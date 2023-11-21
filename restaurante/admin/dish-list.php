<?php 
    require_once '../../database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_dish_info","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Dishes</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <h2>All the Registered Dishes</h2>
    <table>
        <?php
            foreach($items as $item){
                echo "<tr>";
                echo "<td>".$item["dish_lname"]."</td>";
                echo "<td><a href='edit-dish.php?id=".$item["id_dish_info"]."'>Edit</a> <a href='delete-dish.php?id=".$item["id_dish_info"]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>