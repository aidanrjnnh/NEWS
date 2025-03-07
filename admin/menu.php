<?php

session_start();
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
} else {
  // handling ketika $_SESSION['user'] belum di-set
  $user = '';
}
require "../db/koneksi.php";

if (isset($_POST['upload'])) {
  $_SESSION["upload"]="upload";
  $result = mysqli_query($conn,"SELECT*FROM berita ORDER BY ID_Berita ASC");
}else if(isset($_POST['writer'])){
  $result = mysqli_query($conn,"SELECT*FROM artikel ORDER BY ID_Berita ASC");
  $_SESSION["upload"]="";
}else{
  $result = mysqli_query($conn,"SELECT*FROM berita ORDER BY ID_Berita ASC");
  $_SESSION["upload"]="upload";
}

?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>BERITA</title>

  <link rel="stylesheet" href="../assets/style.css">

  <script src="https://kit.fontawesome.com/5c90e171df.js" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 

  rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 

  crossorigin="anonymous">

</head>

<body>

<?php 
include 'navbar.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>
<div style="width:100%;">

<br>

<!-- <img src="assets/Image/img1.jpg" style="width: 100%; margin-top:5%;" alt=""> -->
<h1 style="text-align:center; padding: 5% 0 5% 0; font-weight:bold; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; text-decoration: solid underline rgb(48, 48, 162)  6px;"
>SEMUA BERITA</h1>

<div class="row" style="justify-content:center; margin:0;">

  <form class="row" style="justify-content:center; margin:0;" action="" method="post">
    <button id="tb" type="submit" style="width:auto; margin-right:5px; background: -webkit-linear-gradient(right, rgb(48, 48, 162), rgb(93, 93, 189))" class="btn btn-primary" name="upload">
        Ter Upload
    </button>
    <button id="tb" type="submit" style="width:auto; margin-left:5px; background: -webkit-linear-gradient(right, rgb(48, 48, 162), rgb(93, 93, 189))" class="btn btn-primary" name="writer">
        Writer
    </button>
  </form>

<?php

while($row=mysqli_fetch_assoc($result)){

    echo '<div class="col-sm-3" style="margin:1.5%;">

    <div id="box" class="card" style="min-height:35rem;">

        <img src="../db/'.$row["Gambar"].'" class="card-img-top" alt="...">

        <div class="card-body">

        <h5 class="card-title text-center" id="nama">'.$row["Judul"].'</h5>';

        // <h6 class="card-title text-left" id="harga">'.implode(' ', array_slice(str_word_count($row["Isi"], 1), 0, 30)).'</h6>

        echo'</div>
        <button id="tb" class="btn btn-dark" style="background: -webkit-linear-gradient(right, rgb(48, 48, 162), rgb(93, 93, 189))">
        <a href="berita.php?judul='.$row["Judul"].'"style="text-decoration:None; color:white;">Baca Selengkapnya</a>
        </button>
        '?> 
        <?php
        if($_SESSION["user"]=="admin"){

            echo'
            <div style="text-align:center; margin:2%;">';
            if($_SESSION["upload"] !="upload"){
              echo'
              <button id="tb" class="btn btn-primary">
              <a href="upload.php?judul='.$row["Judul"].'"style="text-decoration:None; color:white;">Upload</a>
              </button>';
            }
            echo'
            <button id="tb" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Hapus
          </button>
          </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah anda yakin ingin menghapus
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button class="btn btn-danger">

                  <a href="hapus.php?judul='.$row["Judul"].'"style="text-decoration:None; color:white;">Hapus</a>
      
                  </button>
                </div>
              </div>
            </div>
          </div>';
            }
        echo'
        </div>
        </div>';
}
?>

</div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
<footer>

  <div class="footers container-fluid" style="padding-left:50px; padding-bottom:10%;">

    <div class="row justify-content-center">

      <div class="col-sm-5">

        <img src="../assets/Image/icon.png" style="width:250px;" alt="">

        <br>

        <a style="font-size:medium;">Puji syukur kita panjatkan Kehadirat Tuhan Yang Maha Esa sehubungan dengan telah berfungsinya Website Kejaksaan Tinggi Balikpapan yang merupakan salah satu langkah upaya penerapan teknologi informasi menuju reformasi birokrasi kejaksaan untuk Indonesia lebih maju.</a>

      </div>

      <div class="col-md-3">

        <h6 style="font-weight: bold; font-size:larger;">Kontak Kami</h6>

        <ul class="social-icons">

          <li><a class="instagram" href="https://www.instagram.com/kejari.balikpapan/"><i class="fa fa-instagram"></i></a></li>

          <li><a class="twitter" href="https://twitter.com/KN_Balikpapan"><i class="fa fa-twitter"></i></a></li>

          <li><a class="facebook" href=" https://www.facebook.com/kejari.balikpapan/?_rdc=1&_rdr"><i class="fa fa-facebook"></i></a></li>

          <li><a class="youtube" href="https://www.youtube.com/@kejari.balikpapan848"><i class="fa fa-youtube"></i></a></li>   

        </ul>

      </div>

      <div class="col-md-3">

        <h6 style="font-weight: bold; font-size:larger;">Alamat</h6>

        <ul class="footer-links">

          <li><a href="https://goo.gl/maps/HHyHtfyVDYx34YFi8" style="text-decoration:none; color:black;"> Jln.Jendral Sudirman No.70 Kota Balikpapan, Kalimantan Timur</a></li>

        </ul>

      </div>

    </div>

  </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 

integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 

crossorigin="anonymous"></script>

</body>

</html>