<?php

    require "session.php";
    require "koneksi.php";

    $id = $_GET['id'];

    $query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
    $data = mysqli_fetch_array($query);
    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Deatils</title>
    <?php require "link.php" ?>
</head>
<body>
    
    <div class="bg-main" style="position:fixed;"></div>

    <div>
        <?php require "navbar.php" ?>
        <center>
            <div class="container mt-4 p-4 container-dasboard" style="height: auto; width: 70%">
                <h2 class="text-white my-1  ">DETAIL PRODUCT</h2>
                <div class="container p-5">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="text-white mb-1" >PRODUCT NAME</label>
                            <input type="text" id="nama" name="nama" autocomplete="off" class="form-control" value="<?php echo $data['nama'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="text-white mb-1">DETAILS</label>
                            <textarea name="detail" id="detail" cols="15" rows="5" class="form-control">
                                <?php echo $data['detail'] ?>
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="text-white mb-1">CATEGORY</label>
                            <select name="kategori" id="kategori" class="form-control" >
                                <option value="<?php echo $data['nama_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                                <?php  
                                  while($dataKategori=mysqli_fetch_array($queryKategori)){
                                    ?>
                                        <option value="<?php echo $dataKategori['id']; ?>"> <?php echo $dataKategori['nama']; ?> </option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="mb-3">
                             <label for="harga" class="text-white mb-1">PRICE</label>
                             <input type="number" class="form-control" name="harga" autocomplete="off" value="<?php echo $data['harga'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="fotoproduk" class="text-white p-3">CURRENT IMAGE</label>
                            <img src="image/<?php echo $data['foto'] ?>" alt="" width="250px">
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
                            <button class="btn btn-primary" name="simpan">UPDATE NOW!</button>
                            <button type="submit" class="btn btn-danger my-2" name="btnhapus" id="btnhapus">delete</button>
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
                            $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', stok='$stok' WHERE id='$id'");

                            if($nama_file!=''){
                                if($image_size > 3000000){
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
                    }
                ?>
                <?php 

                    if(isset($_POST['btnhapus'])){
                        $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
                        if($queryHapus){
                            ?>
                                <div class="alert alert-success" role="alert" style="width: auto; height: auto;">
                                    Delete Successful!
                                </div>

                                <meta http-equiv="refresh" content="2; url=produk.php" />
                                    
                            <?php
                        }
                        else{
                            echo mysqli_error($conn);
                        }
                    }

                ?>
                </div>
            </div>
        </center>
     </div>
     <?php require "script.php" ?>
</body>
</html>