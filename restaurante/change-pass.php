<?php 
   require_once '../database.php';
    
    $data = $database->select("tb_users", "*");

    if($_GET){
        $data = $database->select("tb_users","*",[
            "id_user"=>$_GET["id"]
        ]);
    }

    if($_POST){
    
        $database->update("tb_users",[
            "pw"=>$_POST["pw"],
        ],[
            "id_user"=>$_POST["id"]
        ]);

        if(isset($_POST["reset"])){
            header("location: forms.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password</title>
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
          
            <section>
                    <h3>Reset Password</h3>
                    <p>Please enter your new password.</p>
                    <form method="post" action="change-pass.php">
                        <label for="password">New Password</label>
                        <input id="pw" name="password" type="text" value="<?php echo $data[0]["pw"] ?>">
                    </form>
                        <div>
                            <div>
                                <input type='submit' value="RESET">
                            </div>
                        </div>

                        <input type="hidden" name="reset" value="1">

                    
                </section>

    </main>


    <?php 
        include "./parts/footer.php";
    ?>

</body>
</html>
