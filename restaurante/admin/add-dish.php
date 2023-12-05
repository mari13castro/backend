<?php 
     require_once '../../database.php';

     $categories = $database->select("tb_categories","*");

     $quantities = $database->select("tb_quantity_people","*");

     $message = "";

     if($_POST){

        if(isset($_FILES["dish_img"])){
            $errors = [];
            $file_name = $_FILES["dish_img"]["name"];
            $file_size = $_FILES["dish_img"]["size"];
            $file_tmp = $_FILES["dish_img"]["tmp_name"];
            $file_type = $_FILES["dish_img"]["type"];
            $file_ext_arr = explode(".", $_FILES["dish_img"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = ["jpeg", "png", "jpg", "webp"];

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not valid";
                $message = "File type is not valid";
            }

            if(empty($errors)){
                $filename = strtolower($_POST["dish_lname"]);
                $filename = str_replace(',', '', $filename);
                $filename = str_replace('.', '', $filename);
                $filename = str_replace(' ', '-', $filename);
                $img = "dish-".$filename.".".$file_ext;
                move_uploaded_file($file_tmp, "../imgs/".$img);

                $database->insert("tb_dish_info",[
                    "id_categories"=> $_POST["dish_category"],
                    "id_quantity_people"=>$_POST["quantity_category"],
                    "dish_lname"=>$_POST["dish_lname"],
                    "dish_sname"=>$_POST["dish_sname"],
                    "dish_description"=>$_POST["dish_description"],
                    "dish_img"=> $img,
                    "price"=>$_POST["dish_price"]
                ]);
            }
        }
        
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dish</title>
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

    
        <h2 class="list-title">Add New Dish</h2>
        <div class="container">
        <?php 
            echo $message;
        ?>
        <form method="post" action="add-dish.php" enctype="multipart/form-data">
            <table>
            <tr>
                <td class="td-content">
            <div class="form-items">
                <label for="dish_lname">Dish Name</label>
                <input id="dish_lname" class="textfield" name="dish_lname" type="text">
            </div>
            <div class="form-items">
                <label for="dish_sname">Dish Short Name</label>
                <input id="dish_sname" class="textfield" name="dish_sname" type="text">
            </div>
            <div class="form-items">
                <label for="dish_category">Dish Category</label>
                <select name="dish_category" id="dish_state">
                    <?php 
                        foreach($categories as $category){
                            echo "<option value='".$category["id_categories"]."'>".$category["category_name"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="quantity_category">Quantity Category</label>
                <select name="quantity_category" id="quantity_category">
                    <?php 
                        foreach($quantities as $quantity){
                            echo "<option value='".$quantity["id_quantity_people"]."'>".$quantity["quantity_category_name"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="dish_description">Dish Description</label>
                <textarea id="dish_description" name="dish_description" id="" cols="30" rows="10"></textarea>
            </div>
            </td>
            <td class="td-content">
            <div class="form-items">
                <label for="dish_img">Dish Image</label>
                <img id="preview" src="../imgs/dish-placeholder.webp" alt="Preview">
                <input id="dish_img" type="file" name="dish_img" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="dish_price">Dish Price</label>
                <input id="dish_price" class="textfield" name="dish_price" type="text">
            </div>
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Add New Dish">
            </div>
            </td>
            </tr>
            </table>
        </form>
    </div>

    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>
    
</body>
</html>