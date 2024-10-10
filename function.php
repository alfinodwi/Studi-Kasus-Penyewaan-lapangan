<?php
require_once "koneksi.php";

function tambah($data)
{
    $nama_penyewa = $data["nama_penyewa"];
    $jam_sewa = $data["jam_sewa"];
    $hari = $data["hari"];
    $status = $data["status"];

    $query = mysqli_query($GLOBALS['koneksi'], "INSERT INTO t_penyewaan (nama_penyewa, jam_sewa, hari, status) VALUES ('$nama_penyewa', '$jam_sewa', '$hari', '$status')");

    return true;
}

function edit($data)
{
    $id = $data['id'];
    $nama_penyewa = $data['nama_penyewa'];
    $jam_sewa = $data['jam_sewa'];
    $hari = $data['hari'];
    $status = $data['status'];

    $query = mysqli_query($GLOBALS['koneksi'], "UPDATE t_penyewaan SET nama_penyewa = '$nama_penyewa', jam_sewa = '$jam_sewa', hari = '$hari', status = '$status' WHERE id = '$id'");

    return true;
}

function hapus($data)
{
    $id = $data['id'];
    $query = mysqli_query($GLOBALS['koneksi'], "DELETE FROM t_penyewaan WHERE id='$id'");

    return true;
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'tambah') {
        tambah($_POST);
        header('location: index.php');
    } elseif ($_POST['action'] == 'edit') {
        edit($_POST);
        header('location: index.php');
    }
} elseif (isset($_GET['id'])) {
    hapus($_GET);
    header('location: index.php');
}
