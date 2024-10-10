<?php 
require_once "koneksi.php";

function edit($data) {
    $id = $data['id'];
    $nama_penyewa = $data['nama_penyewa'];
    $jam_sewa = $data['jam_sewa'];
    $hari = $data['hari'];
    $status = $data['status'];

    $query = mysqli_query($GLOBALS['koneksi'], "UPDATE t_penyewaan SET nama_penyewa = '$nama_penyewa', jam_sewa = '$jam_sewa', hari = '$hari', status = '$status' WHERE id = '$id'");
    return true;
}

if(isset($_POST['action'])) {
    if($_POST['action'] == 'edit') {
        edit($_POST);
        header('location: index.php');
    }
}

?>