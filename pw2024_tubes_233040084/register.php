<?php

require "koneksi.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <?php require "link.php" ?>
</head>

<style>
   

</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-4">
            <h3 class="login-text">REGIST NOW!</h3>
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
                    <button class="btn btn-success form-control" type="submit" name="clickbtn">Regist</button>
                </div>
            </form>
            <div class="text-info-box align-items-center">
                <p>already have an account?  <a href="login.php">login now!</a></p>
            </div>
        </div>
            <div class="m-3 text-center" style="width: 500px;">
            </div>
    </div>
</body>
</html>