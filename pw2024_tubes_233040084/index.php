<?php

    require "session.php";
    require "koneksi.php";

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <?php require "link.php" ?>
</head>
<body>
    <div class="bg-main"></div>
    <div>
        <?php  
        require "navbar.php"
        ?>
        <div class="container container-dasboard mt-4 p-4">
            <h2 style="margin: 15px 0px; color: white;">DASBOARD ADMIN</h2>
            <div class="row">
                <div class="col-lg-4 m-2" style="background: rgb(15,0,116);
                background: linear-gradient(90deg, rgba(15,0,116,1) 9%, rgba(42,153,189,1) 87%); border-radius: 10px;">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-car-rear fa-7x" style="color: #d4d4d4;"></i>
                        </div>
                        <div class="col-6 mt-3 text-white d-flex flex-column justify-content-center">
                            <h3 class=" poppins-semibold">OUR CAR</h3>
                            <p class="space-grotesk-small"><?php echo $jumlahProduk ?> Cars</p>
                            <p></p><a href="produk.php" class="text-white" style="text-decoration: none;">details product</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 m-2 " style="background: rgb(15,0,116);
                background: linear-gradient(90deg, rgba(15,0,116,1) 9%, rgba(42,153,189,1) 87%); border-radius: 10px;">
                <div class="row">
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-layer-group fa-7x" style="color: #d4d4d4;"></i>
                        </div>
                        <div class="col-6 mt-3 text-white d-flex flex-column justify-content-center">
                            <h3 class=" poppins-semibold">CATEGORY</h3>
                            <p class="space-grotesk-small"><?php echo $jumlahKategori; ?> Category</p>
                            <p><a href="kategori.php" class="text-white" style="text-decoration: none;">details category</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php require "script.php" ?>
</body>
</html>