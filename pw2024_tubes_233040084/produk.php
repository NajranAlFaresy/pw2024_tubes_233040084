<?php 

    require "session.php";
    require "koneksi.php";

    if(isset($_GET['keyword'])){
        $query = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
        $jumlahProduk = mysqli_num_rows($query);
    }
    else{
        $query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
        $jumlahProduk = mysqli_num_rows($query);
    }

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add and List Product</title>
    <?php require "link.php" ?>
</head>
<body>

    <div class="bg-main" style="position:fixed;"></div>

    <div>
        <?php require "navbar.php" ?>
        <div class="container mt-4 p-4 container-dasboard">
            <div>
                <div class="text-center" style="width:100%;">
                    <h2 style=" margin: 15px 0px; color: white;">PRODUCT</h2>
                </div>

                <div class="d-flex flex-column mb-3"  style="width: 40%;">
                 <h4 style=" margin: 15px 0px; color: white;">ADD PRODUCT</h4>

                 <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="text-white mb-1" >PRODUCT NAME</label>
                        <input type="text" id="nama" name="nama" placeholder="Product name..." autocomplete="off" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="text-white mb-1">DETAILS</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="text-white mb-1">CATEGORY</label>
                        <select name="kategori" id="kategori" class="form-control" >
                            <option value="">Select Category!</option>
                            <?php
                                while($baru=mysqli_fetch_array($queryKategori)){
                            ?>
                                <option value="<?php echo $baru['id']; ?>"> <?php echo $baru['nama']; ?> </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="text-white mb-1">PRICE</label>
                        <input type="number" class="form-control" name="harga" autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="text-white mb-1">IMAGE</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="text-white mb-1">STOCK AVAILABILITY</label>
                        <input type="text" name="stok" id="stok" class="form-control">
                    </div>
                    <div>
                        <button class="btn btn-primary" name="simpan">SAVE NOW!</button>
                    </div>
                 </form>

                <?php
                    if(isset($_POST['simpan'])){
                        $nama = htmlspecialchars($_POST['nama']);
                        $harga = htmlspecialchars($_POST['harga']);
                        $kategori = htmlspecialchars($_POST['kategori']);
                        $detail = htmlspecialchars($_POST['detail']);
                        $stok = htmlspecialchars($_POST['stok']);

                        $target_dir = "image/";
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $image_size = $_FILES["foto"]["size"];



                        if($nama=='' || $kategori=='' || $harga=='' ){
                ?>
                            <div class="alert alert-danger mt-3 ms-2" role="alert" style="width: auto; height: auto;">
                                Please input product name, category and price!
                            </div>
                <?php
                        }
                        else{
                            if($nama_file!=''){
                                if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                ?>
                                    <div class="alert alert-danger mt-3 ms-2" role="alert" style="width: auto; height: auto;">
                                     Files must be of type jpg, jpeg, png or gif!                                     
                                    </div>
                <?php
                                }
                                else{
                                    if($image_size > 30000000){
                ?>
                                       <div class="alert alert-danger mt-3 ms-2" role="alert" style="width: auto; height: auto;">
                                            File is too large, Cannot be more than 3mb!                                        
                                        </div> 
                <?php
                                    }
                                    else{
                                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                                    }
                                }
                            }

                            // insert

                            $queryTambah = mysqli_query($conn,  "INSERT INTO produk VALUES (NULL, '$kategori', '$nama', '$harga', '$nama_file', '$detail', '$stok')");

                            if($queryTambah){
                ?>
                                <div class="alert alert-success mt-3 ms-2" role="alert" style="width: auto; height: auto;">
                                    Successfully added product!                                        
                                </div> 
                                <meta http-equiv="refresh" content="1; url=produk.php" />

                <?php  
                            }
                        }
                    }
                ?>

                </div>

                    <form action="" method="get">
                        <div class="input-group input-group-sm my-3 mt-5" style="width: 50%;">
                            <input type="text" class="form-control" placeholder="cars name" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                            <button class="btn btn-primary">Search now</button>
                        </div>
                    </form>

                <table class="table table-striped table-hover mt-5 mb-5 ">
                    <thead>
                    <tr class="text-center text-white space-grotesk-medium">
                            <th>NO.</th>
                            <th>PRODUCT NAME</th>
                            <th width="300px">DETAILS</th>
                            <th>PRICE</th>
                            <th>STOCK AVAILABILITY</th>
                            <th>ACTION  </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                             if($jumlahProduk==0){
                                 ?>
                                     <tr>
                                         <td colspan=6 class="text-center text-white space-grotesk-small">Category data is EMPTY</td>
                                     </tr>
                                <?php
                             }
                             else {
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($query)){
                                    ?>
                                    <tr class="text-white">
                                         <td><?php echo $jumlah; ?></td>
                                         <td><?php echo $data['nama']; ?></td>
                                         <td><?php echo $data['detail']; ?></td>
                                         <td><?php echo $data['harga']; ?></td>
                                         <td><?php echo $data['stok']; ?></td>
                                         <td>
                                            <a href="produk_edit_del.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-lg "><i class="fa-solid fa-pen-to-square"></i></a>
                                         </td>
                                     </tr>
                                    <?php
                                    $jumlah++;
                                }
                             }
                        ?>
                    </tbody>
                 </table>
            </div>
        </div>
    </div>
    <?php require "script.php" ?>
</body>
</html>