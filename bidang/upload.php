<?php

    session_start();

    require "../db/koneksi.php";

    $username = $_SESSION['username'];

    if($username == '' ){

        header('location:../login.php');

    }else{

    if(isset($_POST["tambah"])){

        if(isset($_POST['judul'])) { 

            $judul = $_POST["judul"];

          }

        $nama = $_POST["nama"];

        $tanggal = $_POST["tanggal"];

        $isi = $_POST["isi"];

        $target_dir = "uploads/";

        // Definisikan nama file dan path-nya

        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

        && $imageFileType != "gif" ) {

            echo "Hanya file gambar yang diperbolehkan.";

            exit;

        }

        // Pindahkan file yang diupload ke direktori yang dituju

        if (!file_exists($target_dir)) {

            mkdir($target_dir, 0777, true);

        }

        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {

            // Simpan alamat gambar ke database

            $query = "INSERT INTO informasi_bidang VALUES('', '$username' , '$nama' ,'$judul', '$target_file', '$tanggal', '$isi')";

            if (mysqli_query($conn, $query)) {

                echo "Gambar berhasil diunggah.";

            } else {

                echo "Terjadi kesalahan saat menyimpan data ke database.";

            }

        } else {

            echo "Terjadi kesalahan saat mengunggah gambar.";

        }

        echo "<script>

            alert('Berhasil');";

        if($judul=="pembinaan"){

            echo "document.location.href='pembinaan.php';    

        </script>";

        }

        else if($judul=="intelijen"){

            echo "document.location.href='intelijen.php';    

        </script>";

        }

        else if($judul=="khusus"){

            echo "document.location.href='khusus.php';    

        </script>";

        }

        else if($judul=="perdata"){

            echo "document.location.href='perdata.php';    

        </script>";

        }

        else if($judul=="umum"){

            echo "document.location.href='umum.php';    

        </script>";

        }

    }

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>KEJAKSAAN</title>

<link rel="stylesheet" href="../assets/style.css">

<script src="https://kit.fontawesome.com/5c90e171df.js" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 

rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 

crossorigin="anonymous">

</head>

<body>

<header>

<nav class="navbar navbar-expand-lg navbar-light bg-white" >

    <div class="container-fluid">

    <a class="navbar-brand" href="#">

        <img src="../assets/Image/icon.png" style="width:180px;" alt="">

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="font-weight:bold;">

        <ul class="navbar-nav">

        <li class="nav-item">

            <a class="nav-link" aria-current="page" href="../index.php">Beranda</a>

        </li>

        <li class="nav-item">

            <a class="nav-link" href="../Main/menu.php">Berita</a>

        </li>

            <li class="nav-item dropdown">

            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            Bidang

            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <li><a class="dropdown-item" href="../bidang/pembinaan.php">Pembinaan</a></li>

            <li><a class="dropdown-item" href="../bidang/intelijen.php">Intelijen</a></li>

            <li><a class="dropdown-item" href="../bidang/umum.php">Tindak Pidana Umum</a></li>

            <li><a class="dropdown-item" href="../bidang/khusus.php">Tindak Pidanan Khusus</a></li>

            <li><a class="dropdown-item" href="../bidang/perdata.php">Perdata dan Tata Usaha</a></li>

            </ul>

        </li>

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            Profile

            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <li><a class="dropdown-item" href="../profile/struktur.php">Strutur Organisasi</a></li>

            <li><a class="dropdown-item" href="../profile/visimisi.php">Visi Misi</a></li>

            <li><a class="dropdown-item" href="../profile/perintah.php">Perintah Harian</a></li>

            <li><a class="dropdown-item" href="../profile/doktrin.php">Doktrin</a></li>

            <li><a class="dropdown-item" href="../profile/tugas.php">Tugas dan Wewenang</a></li>

            </ul>

        </li>

        </li>

        </ul>

    </div>

    </div>

</nav>

</header>

<body>

<div class="container">

    <h1 style="text-align:center; margin-bottom:5px;">Tambah Data</h1>

    <form action="" method="POST" enctype="multipart/form-data">

        <input type="file" name="gambar" accept=".gif,.jpg,.jpeg,.png">

        <br>

        Judul

        <input type="text" name="nama">

        <br>

        Pilih

        <select name="judul">

            <option value="pembinaan">Pembinaan</option>

            <option value="intelijen">Intelijen</option>

            <option value="umum">Pidana Umum</option>

            <option value="khusus">Pidana Khusus</option>

            <option value="perdata">Perdata dan TU</option>

        </select>

        <br>

        Tanggal

        <input type="date" name="tanggal">

        <br>

        Isi

        <textarea name="isi" style="width:100%;" rows="40" id="isi"></textarea>

        <br>

        <button class="btn btn-success" type="submit" name="tambah" style="margin:10px; float:right;">Upload</button>

        <!-- <button type="submit" name="tambah">Tambah</button> -->

    </form>

<?php }?>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
<footer>
<div class="footers">
  <a href="#"><i class="fa fa-facebook"></i></a>
  <a href="#"><i class="fa fa-instagram"></i></a>
  <a href="#"><i class="fa fa-youtube"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <div class="cp">ENJOY YOUR NEWS</div>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 

integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 

crossorigin="anonymous"></script>

</body>

