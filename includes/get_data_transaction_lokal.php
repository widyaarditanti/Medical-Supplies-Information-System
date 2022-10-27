<?php
include_once 'connect.php';
ob_start();
session_start();
$id=$_SESSION['admin_id'];

$sql= "SELECT transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.vendor_id,kategori_transaksi.nama FROM transaksi JOIN kategori_transaksi ON transaksi.kategori_transaksi=kategori_transaksi.id and transaksi.admin_id='$id' " ;
$stmt = mysqli_stmt_init($con);
if(mysqli_stmt_prepare($stmt,$sql)){
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $arr=[];
    while($row = mysqli_fetch_assoc($result)) {
        array_push($arr,$row);
    }
    echo json_encode($arr);
}
else{
    echo "FAILED TO GET DATA";
}
?>