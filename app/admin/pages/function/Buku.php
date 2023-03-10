<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['act'] == "tambah") {
    $judul_buku = $_POST['judulBuku'];
    $kategori_buku = $_POST['kategoriBuku'];
    $penerbit_buku = $_POST['penerbitBuku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $isbn = $_POST['iSbn'];
    $j_buku_baik = $_POST['jumlahBukuBaik'];
    $j_buku_rusak = $_POST['jumlahBukuRusak'];

    // Gambar handling
    $gambar_buku_name = $_FILES['gambarBuku']['name'];
    $gambar_buku_size = $_FILES['gambarBuku']['size'];
    $gambar_buku_tmp = $_FILES['gambarBuku']['tmp_name'];
    $direktori = "../gambar/";

    // PROCESS INSERT DATA TO DATABASE
    $sql = "INSERT INTO buku(judul_buku,kategori_buku,penerbit_buku,pengarang,tahun_terbit,isbn,j_buku_baik,j_buku_rusak, gambar_buku)
        VALUES('" . $judul_buku . "','" . $kategori_buku . "','" . $penerbit_buku . "','" . $pengarang . "','" . $tahun_terbit . "','" . $isbn . "', '" . $j_buku_baik . "', '" . $j_buku_rusak . "', '" . $gambar_buku_name . "')";
    $sql .= mysqli_query($koneksi, $sql);

    // Append buku to local directory
    move_uploaded_file($gambar_buku_tmp, $direktori . $gambar_buku_name);

    if ($sql) {
        $_SESSION['berhasil'] = "Data buku berhasil ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['act'] == "edit") {
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judulBuku'];
    $kategori_buku = $_POST['kategoriBuku'];
    $penerbit_buku = $_POST['penerbitBuku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $isbn = $_POST['iSbn'];
    $j_buku_baik = $_POST['jumlahBukuBaik'];
    $j_buku_rusak = $_POST['jumlahBukuRusak'];
    
    // Delete current gambar
    
    
    // Update gambar
    $gambar_buku_name = $_FILES['gambarBuku']['name'];
    $gambar_buku_size = $_FILES['gambarBuku']['size'];
    $gambar_buku_tmp = $_FILES['gambarBuku']['tmp_name'];
    $direktori = "../gambar/";

    // Append buku to local directory
    move_uploaded_file($gambar_buku_tmp, $direktori . $gambar_buku_name);
    
    // PROCESS EDIT DATA
    $query = "UPDATE buku SET judul_buku = '$judul_buku', kategori_buku = '$kategori_buku', penerbit_buku = '$penerbit_buku', 
                pengarang = '$pengarang', tahun_terbit = '$tahun_terbit', isbn = '$isbn', j_buku_baik = '$j_buku_baik', j_buku_rusak = '$j_buku_rusak', gambar_buku = '$gambar_buku_name'";

    $query .= "WHERE id_buku = $id_buku";

    $sql = mysqli_query($koneksi, $query);
    if ($sql) {
        $_SESSION['berhasil'] = "Data buku berhasil diedit !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal diedit !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['act'] == "hapus") {
    $id_buku = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id_buku'");

    if ($sql) {
        $_SESSION['berhasil'] = "Data buku berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}
