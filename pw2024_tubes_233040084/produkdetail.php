<?php

    require "koneksi.php";

    $id = htmlspecialchars($_GET['id']);
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
    $produk = mysqli_fetch_array($queryProduk);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JanCar | Detail Produk</title>
    <?php require "link.php" ?>
</head>
<body>
    <div class="bg-main"></div>
    <div>
        <?php require "navbarmain.php" ?>
    </div>

    <!-- body -->
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="image/<?php echo $produk['foto']; ?>" alt=""  width="100%">
                </div>
                <div class="col-md-6 offset-md-1 text-white">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p><?php echo $produk['detail'] ?></p>
                    <p style="font-size: 30px; ">Rp. <?php echo $produk['harga']; ?></p>
                    <p style="font-size: 20px;"> Status : <strong><?php echo $produk['stok']; ?></strong> </p>
                    <div class="p-2 bg-dark" style="border-radius: 10px;">
                        <div class="text-white text-center mt-3">
                            <h4>Contact for purchase and other details of the product!</h4>
                        </div>
                        <div class="text-white text-center mt-5 mb-3">
                            <a href=""><i class="fa-brands fa-whatsapp mx-2" style="color: #63E6BE; font-size: 70px;"></i></a>
                            <a href=""><i class="fa-brands fa-telegram mx-2" style="color: #74C0FC; font-size: 70px;"></i></a>
                            <a href=""><i class="fa-brands fa-instagram mx-2" style="color: #B197FC; font-size: 70px;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
    <?php require "footer.php" ?>
    </div>
 <?php require "script.php" ?>
</body>
</html>