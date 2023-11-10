<?php
    require_once '../database.php';
    
    include('simple_html_dom.php');
    /*
    appetizers
    https://www.allrecipes.com/recipes/1214/world-cuisine/latin-american/mexican/appetizers/

    main dishes
    https://www.allrecipes.com/recipes/17504/world-cuisine/latin-american/mexican/main-dishes/

    desserts
    https://www.allrecipes.com/recipes/1217/world-cuisine/latin-american/mexican/desserts/

    drinks
    https://www.allrecipes.com/recipes/15936/world-cuisine/latin-american/mexican/drinks/

    main page
    https://www.allrecipes.com/recipes/728/world-cuisine/latin-american/mexican/
    
    regular drinks
    https://www.allrecipes.com/recipes/77/drinks/
    */

    //link
    $link = "https://www.allrecipes.com/recipes/15936/world-cuisine/latin-american/mexican/drinks/";

    $filenames = [];
    $menu_item_names = [];
    $menu_item_descriptions = [];
    $image_urls = [];

    $menu_items = 6;

    $items = file_get_html($link);

    //save meals info and filenames for the images
    foreach ($items->find('.card--no-image') as $item){
        
        $title = $item->find('.card__title-text');
        
        $details = file_get_html($item->href);
        $description = $details->find('.article-subheading');
        $image = $details->find('.primary-image__image');

        if(count($image) > 0){
            $image_urls[] = $image[0]->src;
        }else{
            $replace_img = $item->find('.universal-image__image');
            if(count($replace_img) > 0){
                $image_urls[] = $replace_img[0]->{'data-src'};
            }
        }
       
        if(count($description) > 0){
            if($menu_items == 0) break;

            $menu_item_names[] = trim($title[0]->plaintext);
            $menu_item_descriptions[] = $description[0]->plaintext;
            
            $filename = strtolower(trim($title[0]->plaintext));
            $filename = str_replace(' ', '-', $filename);
            $filenames[] = $filename;

            $menu_items--;
        }

    }

    foreach($filenames as $index=>$item){
        echo "******************";
        echo "<br>";
        echo $item;
        echo "<br>";
        echo $menu_item_names[$index];
        echo "<br>";
        echo $menu_item_descriptions[$index];
        echo "<br>";
        echo $image_urls[$index];
        echo "<br>";
        echo rand (1*10, 70*10)/10;
        echo "<br>";
        //$menu_items--;
        //if($menu_items == 0) break;
        $database->insert("tb_dish_info",[
            "id_categories"=> 2,
            "id_quantity_people"=> 1,
            "dish_name"=> $menu_item_names[$index],
            "dish_img"=> $item.'.jpg',
            "featured"=> "0",
            "dish_description"=> $menu_item_descriptions[$index],
            "price"=> rand (1*10, 70*10)/10
        ]);
    }

    //get and download images
    foreach ($filenames as $index=>$image){
        file_put_contents("../scraping/images/drinks/drink-".$image.".jpg", file_get_contents($image_urls[$index]));
    }

    //insert info
    // Reference: https://medoo.in/api/insert
    /*$database->insert("tb_name",[
        "field"=> value,
        "field"=> value
    ]);*/
    

?>