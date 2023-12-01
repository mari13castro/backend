<?php 
    require_once '../database.php';

    $dish = [];

    if(isset($_SERVER["CONTENT_TYPE"])){
        $contentType = $_SERVER["CONTENT_TYPE"];

        if($contentType == "application/json"){
            $content = trim(file_get_contents("php://input"));

            $decoded = json_decode($content, true);
            
            if($decoded["language"] == "en"){
                $item = $database->select("tb_dish_info",[
                    "tb_dish_info.dish_lname",
                    "tb_dish_info.dish_description"
                ],
                [
                    "id_dish_info"=>$decoded["id_dish_info"]
                ]);

                $dish["name"] = $item[0]["dish_lname"];
                $dish["description"] = $item[0]["dish_description"];

                }else{

                    $item = $database->select("tb_dish_info",[
                        "tb_dish_info.dish_lname_es",
                        "tb_dish_info.dish_description_es"
                    ],
                    [
                        "id_dish_info"=>$decoded["id_dish_info"]
                    ]);
    
                    $dish["name"] = $item[0]["dish_lname_es"];
                    $dish["description"] = $item[0]["dish_description_es"];
            }

            echo json_encode($dish);
        }
    }
?>