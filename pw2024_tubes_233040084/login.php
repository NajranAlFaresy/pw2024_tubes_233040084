<?php

session_start();
require "koneksi.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <?php require "link.php" ?>
</head>

<style>
   

</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-4">
            <h3 class="login-text">LOGIN</h3>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control mb-2 mt-1 dark" placeholder="Username" name="username" id="username" autocomplete="off">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control mb-4 mt-1 dark" placeholder="password" name="password" id="password" autocomplete="off">
                </div>
                <div>
                    <button class="btn btn-success form-control" type="submit" name="clickbtn">Login</button>
                </div>
            </form>
            <div class="text-info-box align-items-center">
                <p>don't have an account? <a href="register.php">register here now!</a></p>
            </div>
        </div>
            <div class="m-3 text-center" style="width: 500px;">
                <?php 
                if(isset($_POST['clickbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                    $count = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if($count>0){
                        if (password_verify($password, $data['password'])){
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: index.php');
                        }
                        else{
                            ?>
                        <div class="alert alert-danger" role="alert">
                        Incorrect password! please try again.
                        </div>
                        <?php
                        }
                    }
                    else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                        Incorrect! account not found, please try again.
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
    </div>
    <?php require "script.php" ?>
</body>
</html>