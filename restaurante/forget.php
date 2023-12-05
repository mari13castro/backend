<?php
    require_once '../database.php';

    $message = "";
    $messageVerificate = "";

    if(isset($_POST["next"])){

        $validateUsername = $database->select("tb_users","*",[
           //"id_user"=>$_POST["id"],
            "usr"=>$_POST["username"], 
            "email"=> $_POST["email"]
        ]);

        $id = $validateUsername[0]["id_user"];

        if(count($validateUsername) > 0){
            header("location: change-pass.php?id=".$id);
        }else{
            $messageVerificate = "The user or email does not match with the registered";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password</title>
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
      
            <div>
                
            <section>
                    <h3>Forgot your Password?</h3>
                    <p>Please let us now it's you. Enter your registered username and email in the designated fields.</p>
                    <form method="post" action="forget.php">
                        <div>
                            <div>
                                <label for='username'>Username</label>
                            </div>
                            <div>
                                <input id='username' type='text' name='username'>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='email'>Email</label>
                            </div>
                            <div>
                                <input id='email' type='email' name='email'>
                            </div>
                        </div>
                        <div>
                            <div>
                                <input type='submit' value="NEXT">
                            </div>
                        </div>

                        <p><?php echo $messageVerificate; ?></p>
                        <input type="hidden" name="next" value="1">

                    
                </section>

    </main>


    <?php 
        include "./parts/footer.php";
    ?>

</body>
</html>