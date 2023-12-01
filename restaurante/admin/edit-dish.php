<?php 
     require_once '../../database.php';

     $categories = $database->select("tb_categories","*");

     $quantities = $database->select("tb_quantity_people","*");

     $message = "";

     if($_GET){
        $item = $database->select("tb_dish_info","*",[
            "id_dish_info" => $_GET["id"],
        ]);
     }

     if($_POST){

        $data = $database->select("tb_dish_info","*",[
            "id_dish_info"=>$_POST["id"]
        ]);

        if(isset($_FILES["dish_img"]) && $_FILES["dish_img"]["name"] != ""){

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
            }
        }else{
            $img = $data[0]["dish_img"];
        }

        $database->update("tb_dish_info",[
            "id_categories"=> $_POST["dish_category"],
            "id_quantity_people"=>$_POST["quantity_category"],
            "dish_lname"=>$_POST["dish_lname"],
            "dish_lname_es"=>$_POST["dish_lname_es"],
            "dish_sname"=>$_POST["dish_sname"],
            "dish_sname_es"=>$_POST["dish_sname_es"],
            "dish_description"=>$_POST["dish_description"],
            "dish_description_es"=>$_POST["dish_description_es"],
            "dish_img"=> $img,
            "price"=>$_POST["dish_price"]
        ],[
            "id_dish_info" => $_POST["id"]
        ]);

        header("location: dish-list.php");
        
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dish</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <div class="container">
        <h2>Edit Dish</h2>
        <?php 
            echo $message;
        ?>
        <form method="post" action="edit-dish.php" enctype="multipart/form-data">
            <div class="form-items">
                <label for="dish_lname">Dish Name</label>
                <input id="dish_lname" class="textfield" name="dish_lname" type="text" value="<?php echo $item[0]["dish_lname"] ?>">
            </div>

            <div class="form-items">
                <label for="dish_lname_es">Dish Name-ES</label>
                <input id="dish_lname_es" class="textfield" name="dish_lname_es" type="text" value="<?php echo $item[0]["dish_lname_es"] ?>">
            </div>
            
            <div class="form-items">
                <label for="dish_sname">Dish Short Name</label>
                <input id="dish_sname" class="textfield" name="dish_sname" type="text" value="<?php echo $item[0]["dish_sname"] ?>">
            </div>

            <div class="form-items">
                <label for="dish_sname_es">Dish Short Name-ES</label>
                <input id="dish_sname_es" class="textfield" name="dish_sname_es" type="text" value="<?php echo $item[0]["dish_sname_es"] ?>">
            </div>

            <div class="form-items">
                <label for="dish_category">Dish Category</label>
                <select name="dish_category" id="dish_category">
                    <?php 
                        foreach($categories as $category){
                            if($item[0]["id_categories"] == $category["id_categories"]){
                                echo "<option value='".$category["id_categories"]."' selected>".$category["category_name"]."</option>";
                            }else{
                                echo "<option value='".$category["id_categories"]."'>".$category["category_name"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="quantity_category">Quantity Category</label>
                <select name="quantity_category" id="quantity_category">
                    <?php 
                        foreach($quantities as $quantity){
                            if($item[0]["id_quantity_people"] == $quantity["id_quantity_people"]){
                                echo "<option value='".$quantity["id_quantity_people"]."' selected>".$quantity["quantity_category_name"]."</option>";
                            }else{
                                echo "<option value='".$quantity["id_quantity_people"]."'>".$quantity["quantity_category_name"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="dish_description">Dish Description</label>
                <textarea id="dish_description" name="dish_description" id="" cols="30" rows="10"><?php echo $item[0]["dish_description"]; ?></textarea>
            </div>

            <div class="form-items">
                <label for="dish_description_es">Dish Description-ES</label>
                <textarea id="dish_description_es" name="dish_description_es" id="" cols="30" rows="10"><?php echo $item[0]["dish_description_es"]; ?></textarea>
            </div>

            <div class="form-items">
                <label for="dish_img">Dish Image</label>
                <img id="preview" src="../imgs/<?php echo $item[0]["dish_img"]; ?>" alt="Preview">
                <input id="dish_img" type="file" name="dish_img" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="dish_price">Dish Price</label>
                <input id="dish_price" class="textfield" name="dish_price" type="text" value="<?php echo $item[0]["price"] ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $item[0]["id_dish_info"]; ?>">
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Update Dish">
            </div>
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