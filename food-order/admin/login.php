<?php include('../config/constants.php')?> 


<html>
    <head>
        <title>Login Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);

                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);

                }
            ?>
            <br><br> 
            <!--Login form starts here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br> 

                <input type="submit" name="submit" value="Login" class="btn-priary"> <br><br>
            </form>

            <p class="text-center">Created by - <a href="#">Swaroop & Yashavanth</a>
        </div>
    </body>
</html>

<?php

    //check weather the submit button is clicked
    if(isset($_POST['submit']))
    {
        //process for login 
        //1. get the data from login form
       $username = $search = mysqli_real_escape_string($conn, $_POST['username']);
       $password = mysqli_real_escape_string($conn, md5($_POST['password']));

       //2. create SQL to check weather user with username and password exist
       $sql = "SELECT * FROM tbl_admin WHERE user_name = '$username' AND password = '$password' ";
       
       //3. Execute Query
        $res = mysqli_query($conn, $sql);

        //4. count rows to check weather user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login success
            $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
            $_SESSION[ 'user'] = $username; //TO check wheather user is logged in or  not and logout will unset it 

            //redirect to home page/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match </div>";
            //redirect to home page/dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>