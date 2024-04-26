<html>
    <?php
        session_start();

        if(isset($_GET['error'])){
            $errormessage = " ";

            if($_GET['error'] == 1){
                $errormessage = "Username does not exist";
            } else if($_GET['error'] == 2){
                $errormessage = "Username already taken";
            }

            echo "<script language='javascript'>
                alert ('$errormessage');
            </script>";
        }

        if(isset($_GET['success'])){
            $alertmessage = " ";

            if($_GET['success'] == 1){
                $alertmessage = "user registered successfully";
            }

            echo "<script language='javascript'>
                alert ('$alertmessage');
            </script>";
        }
    ?>

    <head>
        <link rel="stylesheet" type="text/css" href="../style/login.css">
    </head>
    <body>
        <div class="LoginWrapper">
            <div class="LoginHeader">Log In</div>
            <form action='Login_handler.php' method='post'>
                <div class="LoginDetails">
                    <div class="UsernameDetails">
                        <Label>Username</Label>
                        <input type="text" name='username' placeholder="Enter Username">
                    </div>
                    <div class="PasswordDetails">
                        <Label>Password</Label>
                        <input type="password" name='userpassword' placeholder="Enter Password">
                    </div>
                </div>
                <div class="LoginButtons">                  
                    <button type='submit' name='action' value='LogIn' class='LogInbtn'>Log In</button>
                    <button type='submit' name='action' value='Register' class='Registerbtn'>Register</button>
                </div>
            </form>
        </div>
    </body>
</html>