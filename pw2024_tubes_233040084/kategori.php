<?php

    require "session.php";
    require "koneksi.php";

    // echo $_GET['p']; 

    $queryKategory = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategory);

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

    <div class="bg-main" style="position:fixed;"></div>

    <div>
        <?php require "navbar.php" ?>
        <div class="container mt-4 p-4 container-dasboard">
            <div>
                <div class="text-center" style="width:100%;">
                    <h2 style=" margin: 15px 0px; color: white;">CATEGORY</h2>
                </div>
                <div class="my-4 col-12 col-md-6 row d-flex ms-5 me-5">
                 <h4 style=" margin: 15px 0px; color: white;">ADD CATEGORY</h4>

                 <form action="kategori.php" method="post">
                    <div>
                        <label for="kategori" class="text-white mb-1">Category</label>
                        <input type="text" id="kategori" name="baru" placeholder="Enter the category name here!" autocomplete="off" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="save" style="width:200px;">SAVE</button>
                    </div>
                 </form>
                    <?php 
                     if(isset($_POST['save'])){
                        $kategori = htmlspecialchars($_POST['baru']);
                        $queriex = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");
                        $jumlahDataBaru = mysqli_num_rows($queriex);

                        if($jumlahDataBaru > 0){
                            ?>
                            <div class="alert alert-danger mt-3 ms-2" role="alert" style="width: auto; height: auto;">
                            Categories already exist!
                            </div>
                            <?php
                        }
                        else{
                            $querysave = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                            if($querysave){
                                ?>
                                <div class="alert alert-success mt-3 ms-2" role="alert" style="width: auto; height: auto;">
                                successfully added category!
                                </div>

                                <meta http-equiv="refresh" content="1; url=kategori.php" />
                                <?php
                            }
                            else{
                                echo mysqli_error($conn);
                            }
                        }
                     }
                     ?>
            </div>
                <div class="row m-5">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center text-white space-grotesk-medium">
                                <th>NO.</th>
                                <th>CATEGORY NAME</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                if($jumlahKategori==0) {
                                    ?>
                                        <tr>
                                            <td colspan=3 class="text-center text-white space-grotesk-small">Category data is EMPTY</td>
                                        </tr>
                                    <?php
                                }       
                                else{
                                    $jumlah = 1;
                                    while($data=mysqli_fetch_array($queryKategory)){
                                        ?>
                                            <tr class="text-center text-white space-grotesk-small">
                                                <td><?php echo $jumlah; ?></td>
                                                <td><?php echo $data['nama'];?></td>
                                                <td>
                                                     <a href="kategori_edit_del.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-lg "><i class="fa-solid fa-pen-to-square"></i></a>
                                                </td>
                                            </tr>
                                        <?php

                                        if(isset($_POST['btndelet'])){
                                            $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
                                        }



                                        $jumlah++;
                                    }
                                }                     
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require "script.php" ?>
</body>
</html>