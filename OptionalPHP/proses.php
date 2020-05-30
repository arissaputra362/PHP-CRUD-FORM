<?php

session_start();

$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nama = '';
$asal_kota = '';

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];

    $mysqli->query("INSERT INTO data (nama, asal_kota) VALUES ('$nama', '$asal_kota')") or die($mysqli->error);

    $_SESSION['message'] = "Data telah tersimpan!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Data telah terhapus!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $row = $result->fetch_array();
    $nama = $row['nama'];
    $asal_kota = $row['asal_kota'];
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];

    $mysqli->query("UPDATE data SET nama='$nama', asal_kota = '$asal_kota' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Data telah diperbarui";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}