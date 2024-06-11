<?php 

    require "koneksi.php";

    $queryKategory = mysqli_query($conn, "SELECT * FROM kategori");

    // get product by nama product
    if(isset($_GET['keyword'])){
        $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }

    // get product by nama kategori
    else if(isset($_GET['kategori'])){
        $queryGetKategori = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategori);

        $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    }

    // get product by nama deafult
    else{
        $queryProduk = mysqli_query($conn, "SELECT * FROM produk");

        }

        $countdata = mysqli_num_rows($queryProduk);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JanCars | Product</title>
    <?php require "link.php" ?>
</head>
<body>
    <div class="bg-main"></div>
    <div>
        <?php require "navbarmain.php" ?>
    </div>

    <!-- body -->
    <div class="container p-5 mb-5">
        <div>
            <form action="produkmain.php" method="get">
                <div class="input-group input-group-sm my-3">
                 <input type="text" class="form-control" placeholder="cars name" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                 <button class="btn btn-primary">Search now</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <h4 class="text-white text-center mb-4">Category</h4>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategory)){ ?>
                    <a href="produkmain.php?kategori=<?php echo $kategori['nama'] ?>" style="text-decoration: none;"><li class="list-group-item mb-1"><?php echo $kategori['nama'] ?></li></a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <div>
                    <h4 class="text-white text-center mb-4">Product</h4>
                </div>
                <div class="container d-flex flex-column align-items-center">
                <?php 
                    if($countdata<1){
                        ?>  
                    <div class="alert alert-warning" role="alert">
                        Product does not exist!
                    </div>
                        <?php
                    }
                ?>
                <?php while($produk = mysqli_fetch_array($queryProduk)){ ?>
                    <div class="card mb-3 mt-3 text-center" style=" width: 70%;">
                        <div class="row g-0">
                                <div class="col-md-3">
                                <img src="image/<?php echo $produk['foto']; ?>" class="img-fluid rounded-start" alt="..." style="height: 200px ; width: 100% ; object-fit: cover; object-position: center;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $produk['nama'] ?></h5>
                                        <p class="card-text text-truncate"><?php echo $produk['detail'] ?></p>
                                        <p>Rp. <?php echo $produk['harga'] ?></></p>
                                        <a href="produkdetail.php?id=<?php echo $produk['id'] ?>" class="btn btn-primary">See Details</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                <?php } ?>
                </div>    
            </div>
        </div>
    </div>
    <div class="pt-5">
        <?php require "footer.php" ?>
    </div>
    <?php require "script.php" ?>
</body>
</html>