<?php
    require_once '../database.php';
    $message = "";
    $messageLogin = "";

    if($_POST){

        if(isset($_POST["login"])){
            $user = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);
            if(count($user) > 0){
                if(password_verify($_POST["password"], $user[0]["pw"])){
                    session_start();
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["fullname"] = $user[0]["fullname"];
                    header("location: menu.php");
                }else{
                    $messageLogin = "wrong username or password";
                }
            }else{
                $messageLogin = "wrong username or password";
            }
        }

        if(isset($_POST["register"])){
            //validate if user already registered
            $validateUsername = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{
                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);
                $database->insert("tb_users",[
                    "fullname"=> $_POST["fullname"],
                    "usr"=> $_POST["username"],
                    "pw"=> $pass,
                    "email"=> $_POST["email"]
                ]);

                //header("location: book.php?id=".$_POST["register"]);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Restaurant</title>
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
                    <h3 class='activity-title'>Sign In</h3>
                    <p>Complete the registration process to enjoy our menu.</p>
                    <form method="post" action="forms.php">
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='fullname'>Fullname</label>
                            </div>
                            <div>
                                <input id='fullname' class='form-input' type='text' name='fullname'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='email'>Email Address</label>
                            </div>
                            <div>
                                <input id='email' class='form-input' type='text' name='email'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='username'>Username</label>
                            </div>
                            <div>
                                <input id='username' class='form-input' type='text' name='username'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='password'>Password</label>
                            </div>
                            <div>
                                <input id='password' class='form-input' type='password' name='password'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <input class='form-input login-btn' type='submit' value="REGISTER">
                            </div>
                        </div>
                        <p><?php echo $message; ?></p>
                        <input type="hidden" name="register" value="1">
                    </form>
                </section>
 
            </div>

        </section>
 
    </main>
    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>

