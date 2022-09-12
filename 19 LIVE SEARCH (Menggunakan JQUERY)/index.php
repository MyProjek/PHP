<?php

// Untuk mengembalikan ke halaman login menggunakan fitur session
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// ambil data dari tabel mahasiswa / query data mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");

// mengurutkan isi tabel dari atas ke bawah ( id yg terkecil )
// $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id ASC");

// mengurutkan isi tabel dari bawah ke atas ( id yang terbesar )
// $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

if( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabel Mahasiswa (CRUD)</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 118px;
            left: 290px;
            z-index: -1;
            display: none;
        }
    </style>
    
    <!-- menghubungkan ke jQuery -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- menghubungkan ke file script.js -->
    <script src="js/script.js"></script>  
</head>
<body>

<a href="logout.php">logout</a>

<h1>Daftar Mahasiswa</h1>


<a href="tambah.php"> Tambah Data Mahasiswa </a>
<br><br>

<form action="" method="post">

    <input type="text" name="keyword" size="40" autofocus
    placeholder="masukkan keyword pencarian..." autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari">Cari</button>

    <img src="img/loader.gif" class="loader">

</form>

<br>

<!-- div membungkus fitur ajax -->
<div id="container">
<table border="1" cellpadding="10" cellspacing="2">

    <tr>
        <td>No.</td>
        <td>Aksi</td>
        <td>Gambar</td>
        <td>NIM</td>
        <td>Nama</td>
        <td>Email</td>
        <td>Jurusan</td>
    </tr>

    <?php  $i = 1; ?>
    <?php foreach( $mahasiswa as $row) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">UBAH</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ?');">HAPUS</a>
        </td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="80" height="80"></td>
        <td><?= $row["nim"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>
</div>

</body>
</html>