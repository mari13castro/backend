<?php 
    require_once '../../database.php';

    if($_GET){
        $item = $database->select("tb_dish_info","*",[
            "id_dish_info" => $_GET["id"]
        ]);
    }

    if($_POST){
        $data = $database->delete("tb_dish_info",[
            "id_dish_info"=>$_POST["id"]
        ]);

        header("location: dish-list.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Dish</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

    <header>
        <div class="nav-bar">
            <ul class="nav-list">
                <li class="nav-text"><a class="nav-link" href="dish-list.php">Go back</a></li>
                <li class="nav-text"><a class="nav-link" href="../index.html">Homepage</a></li>
            </ul>
        </div>
    </header>

    <h1 class="list-title">¿Do you want to delete this dish? </h1>
        <div class="container">
            <div class="form-items">
                <?php
                    echo "<h3>".$item[0]["dish_lname"]."</h3>";
                ?>
                <img id="preview" src="../imgs/<?php echo $item[0]["dish_img"]; ?>" alt="Preview">
            </div>

            <div class="form-items">  
                <form method="post" action="delete-dish.php">
                    <input name="id" type="hidden" value="<?php echo $item[0]["id_dish_info"]; ?>">
                    <input type="button" onclick="history.back();" value="Cancel">
                    <input type="submit" value="Delete">
                </form>
            </div>
        </div>

</body>
</html>