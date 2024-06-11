<?php

    require "koneksi.php";
    $queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 3")

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JanCars | Home</title>
    <?php require "link.php" ?>
</head>
<body>
    <div class="bg-main"></div>
    <div>
        <?php  
            require "navbarmain.php"
            ?>
        <div class="container mt-4 p-4 d-flex flex-column align-items-center">
            <h3 class="text-white">ONLINE CAR SHOWROOM</h3>
            <h5 class="text-white">Find your dream car!</h5>
            <div class="col-md-6" o>
                <form action="produkmain.php" method="get">
                    <div class="input-group input-group-sm my-3">
                        <input type="text" class="form-control" placeholder="cars name" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button class="btn btn-primary">Search now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- kategori -->
     <div class="container-fluid py-5">
        <div class="container text-center text-white">
            <h3>CATEGORY HIGHLIGHTED</h3>
            <div class="row mt-5">
                <div class="col-4">
                    <h4>Sport Car</h4>
                    <a href="produkmain.php?kategori=SPORT">
                        <div class="kategori-hg" style="height: 250px; background: url(image/Sportcar.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover; border: solid 2px;">
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <h4>SUV Car</h4>
                    <a href="produkmain.php?kategori=SUV">
                        <div class="kategori-hg" style="height: 250px; background: url(image/SUVCAR.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover; border: solid 2px;">
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <h4>Sedan Car</h4>
                    <a href="produkmain.php?kategori=Sedan">
                        <div class="kategori-hg" style="height: 250px; background: url(image/SEDANCAR1.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; border: solid 2px;">
                        </div>
                    </a>
                </div>
            </div>
        </div>
     </div>

     <!-- about us -->
      <div class="container-fluid py-5 bg-dark">
        <div class="container text-center text-white">
            <h3>ABOUT US</h3>
            <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores neque nulla veniam, dicta iusto, laboriosam dolores pariatur aut iure commodi architecto provident harum sapiente impedit omnis. Doloremque numquam mollitia minus?</p>
        </div>
        <div class="container text-center text-white mt-5">
            <h4>Contact to make a purchase!</h4>
            <div class="mt-3">
                <a href=""><i class="fa-brands fa-whatsapp mx-2" style="color: #63E6BE; font-size: 70px;"></i></a>
                <a href=""><i class="fa-brands fa-telegram mx-2" style="color: #74C0FC; font-size: 70px;"></i></a>
                <a href=""><i class="fa-brands fa-instagram mx-2" style="color: #B197FC; font-size: 70px;"></i></a>
            </div>
        </div>
      </div>

      <!-- Produk -->
       <div class="container-fluid py-5">
        <div class="container text-center text-white">
            <h3>PRODUCT HIGHLIGHTED</h3>
            <center>
            <div class="row mt-5" >
                <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-1 text-dark " style="width: 14rem;">
                        <div style="height:250px;">
                            <img src="image/<?php echo $data['foto'] ?>" class="card-img-top" alt="..." style="height: 100%; width:100%; object-fit: cover; object-position: center;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['nama'] ?></h5>
                            <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                            <p style="font-size:20px;">Rp<?php echo $data['harga'] ?></p>
                            <a href="produkdetail.php?id=<?php echo $data['id'] ?>" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
                </center>
            <a href="produkmain.php" class="btn btn-primary my-5">SEE MORE!</a>
        </div>
       </div>
<?php require "footer.php" ?>
<?php require "script.php" ?>    
</body>
</html>