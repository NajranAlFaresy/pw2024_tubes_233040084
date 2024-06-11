<?php

    require "session.php";
    require "koneksi.php";

    $id = $_GET['id'];
    
    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
    $data = mysqli_fetch_array($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details</title>

    <?php require "link.php" ?>
</head>
<body>

<div class="bg-main" style="position:fixed;"></div>

    <div>
        <?php require "navbar.php" ?>
        <div class="container mt-4 p-4 container-dasboard" style="height: 80vh; width: 70%">
            <center>
                <h2 class="text-white my-1  ">DETAIL CATEGORY</h2>
                <div class="text-white d-flex justify-content-center align-items-center" style=" width:100%; height: 40vh;">
                    <form action="" method="post" class="d-flex flex-column gap-2" style="width: 50%; height: auto;" >
                        <h3 class="space-grotesk-medium">"<?php echo $data['nama']; ?>"</h3>
                        <label for="kategori" class="roboto-regular">Category </label>
                        <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                            <input type="text" name="kategori" id="kategori" class="from-control" placeholder="category name" autocomplete="off" style="width:50vh" value="<?php echo $data['nama']; ?>">
                            <div>
                                <button type="submit" class="btn btn-primary my-2" name="btnedit" id="btnedit">edit</button>
                                <button type="submit" class="btn btn-danger my-2" name="btnhapus" id="btnhapus">delete</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="width: 50vh;">
                    <?php 
                        if(isset($_POST['btnedit'])){
                            $kategori = htmlspecialchars($_POST['kategori']);
                                
                            if($data['nama']==$kategori){
                                ?>
                                <meta http-equiv="refresh" content="0; url=kategori.php" />
                                <?php
                            }
                            else{
                                $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                                $jumlahData = mysqli_num_rows($query);
                                    
                                if($jumlahData > 0){
                                    ?>
                                    <div class="alert alert-danger" role="alert" style="width: auto; height: auto;">
                                    Categories already exist!
                                    </div>
                                    <?php
                                }
                                else{
                                    $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                                    if($querySimpan){
                                        ?>
                                        <div class="alert alert-success" role="alert" style="width: auto; height: auto;">
                                        Update Successful!
                                        </div>

                                        <meta http-equiv="refresh" content="2; url=kategori.php" />
                                        
                                        <?php
                                    }
                                    else{
                                        echo mysqli_error($conn);   
                                    }
                                }
                            }
                        }

                        if(isset($_POST['btnhapus'])){
                            $querycek = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                            $dataCount = mysqli_num_rows($querycek);

                            if($dataCount>0){
                    ?>
                                <div class="alert alert-danger" role="alert" style="width: auto; height: auto;">
                                    Cannot be deleted, this category has Products!
                                </div>
                    <?php
                                die();
                            }

                            $queryHapus = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
                            
                            if($queryHapus){
                                ?>
                                    <div class="alert alert-success" role="alert" style="width: auto; height: auto;">
                                        Delete Successful!
                                    </div>

                                    <meta http-equiv="refresh" content="2; url=kategori.php" />
                                        
                                <?php
                            }
                            else{
                                echo mysqli_error($conn);
                            }
                        }
                    ?>
                </div>
            </center>
        </div>
    </div>
<?php require "script.php" ?>
</body>
</html>