<?php
require_once '../database.php';
$amount = 1;
if ($_GET) {
    if (isset($_GET["lang"]) && $_GET["lang"] == "es") {
        $item = $database->select("tb_dish_info", [
            "[>]tb_categories" => ["id_categories" => "id_categories"],
            "[>]tb_quantity_people" => ["id_quantity_people" => "id_quantity_people"]
        ], [
            "tb_dish_info.id_dish_info",
            "tb_dish_info.dish_lname",
            "tb_dish_info.dish_lname_es",
            "tb_dish_info.dish_sname",
            "tb_dish_info.dish_sname_es",
            "tb_dish_info.dish_img",
            "tb_dish_info.dish_description",
            "tb_dish_info.dish_description_es",
            "tb_dish_info.price",
            "tb_dish_info.id_categories",
            "tb_categories.category_name",
            "tb_categories.category_description",
            "tb_quantity_people.quantity_category_name",
            "tb_quantity_people.quantity_description"
        ], [

            "id_dish_info" => $_GET["id"]


        ]);

        $dish_id = $item[0]["id_dish_info"];

        //references
        $item[0]["dish_lname"] = $item[0]["dish_lname_es"];
        $item[0]["dish_description"] = $item[0]["dish_description_es"];
    } else {

        $item = $database->select("tb_dish_info", [
            "[>]tb_categories" => ["id_categories" => "id_categories"],
            "[>]tb_quantity_people" => ["id_quantity_people" => "id_quantity_people"]
        ], [
            "tb_dish_info.id_dish_info",
            "tb_dish_info.dish_lname",
            "tb_dish_info.dish_lname_es",
            "tb_dish_info.dish_sname",
            "tb_dish_info.dish_sname_es",
            "tb_dish_info.dish_img",
            "tb_dish_info.dish_description",
            "tb_dish_info.dish_description_es",
            "tb_dish_info.price",
            "tb_dish_info.id_categories",
            "tb_categories.category_name",
            "tb_categories.category_description",
            "tb_quantity_people.quantity_category_name",
            "tb_quantity_people.quantity_description"
        ], [
            "id_dish_info" => $_GET["id"]
        ]);
        $lang = "ES";
        $url_params = "?id=" . $item[0]["id_dish_info"] . "&lang=es";
    }
    $item2 = $database->select(
        "tb_dish_info",
        "*",
        [
            "id_categories" => $item[0]["id_categories"],
            "id_dish_info[!]" => $_GET["id"]
        ]
    );
    $dish_id = $_GET["id"];

}

?>

<!DOCTYPE html>
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
        <div class='description-container'>
            <div class='description-text-container'>
                <?php
                echo "<div class='description-inner-text-container'>";
                echo "<h2 class='about-dish-title'>" . $item[0]["dish_lname"] . "</h2>";
                echo "<p>" . $item[0]["dish_description"] . "</p>";
                echo "<p>Category: " . $item[0]["category_name"] . "</p>";
                echo "<p>" . $item[0]["quantity_category_name"] . ": " . $item[0]["quantity_description"] . "</p>";
                echo "<p id='price'>$" . $item[0]["price"] . "</p>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                ?>

                <form id="myForm" method="post" action="confirmation.php">
                    <input type="hidden" name="dish_id" value="<?php echo $item[0]['id_dish_info']; ?>">
                    <input type="hidden" id="date" name="date">
                    <input type="hidden" id="time" name="time">
                    <input type="hidden" id="last_price" name="last_price">
                    <input type="number" id="amount" name="amount" min="1" value="1">
                    <input type="submit" value="order">
                </form>
            </div>
        </div>


        <script>
            var amountInput = document.getElementById("amount");
            var price = <?php echo $item[0]["price"]; ?>;
            var dish_id = <?php echo $item[0]["id_dish_info"] ?>;
            var addCartButton = document.getElementById("add-cart-buttom");

            amountInput.addEventListener("change", function () {
                var total = amount * price;
                var totalInput = document.getElementById("total");
                totalInput.value = total;
                document.getElementById("price").innerHTML = "$" + total;
                document.getElementById("last_price").value = total;
            });
            document.getElementById('myForm').addEventListener('submit', function (event) {
                event.preventDefault();
                var amountInput = document.getElementById("amount");
                var price = <?php echo $item[0]["price"]; ?>;
                var totalInput = document.getElementById("last_price");

                var amount = amountInput.value;
                var total = amount * price;

                var currentDate = new Date();
                var date = currentDate.toISOString().split('T')[0]; // Fecha en formato YYYY-MM-DD
                var time = currentDate.toTimeString().split(' ')[0]; // Hora en formato HH:MM:SS

                document.getElementById('date').value = date;
                document.getElementById('time').value = time;
                totalInput.value = total;

                console.log('Date: ' + date);
                console.log('Time: ' + time);
                console.log('Amount: ' + amount); 
                console.log('Total: ' + total);
                this.submit();
            });

        </script>
        <script src="./js/main.js"></script>

    </main>
</body>
<?php
include "./parts/footer.php";
?>

</html>