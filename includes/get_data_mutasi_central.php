<?php
include_once 'connect.php';
ob_start();
session_start();
$data99 = $_POST['data99'];
/* $sql= "SELECT m.mutasi_id,m.tanggal,m.jumlah,g.nama as prev_loc,g.nama as next_loc,m.transaksi_id,m.stock_id
 FROM mutasi m 
 Join gudang g
 on m.prev_loc=g.gudang_id
 and m.next_loc=g.gudang_id"; */
 if($data99==0){
    $sql="SELECT m.mutasi_id,m.tanggal,m.jumlah,g1.nama as prev_loc, g2.nama as next_loc ,m.transaksi_id,m.stock_id
    FROM mutasi m 
    Join gudang g1
    on m.prev_loc=g1.gudang_id 
    Join gudang g2
    on m.next_loc = g2.gudang_id";
 }
else{
    $data99=$_SESSION['admin_id'];
    $sql="SELECT m.mutasi_id,m.tanggal,m.jumlah,g1.nama as prev_loc, g2.nama as next_loc ,m.transaksi_id,m.stock_id
    FROM mutasi m 
    Join gudang g1
    on m.prev_loc=g1.gudang_id 
    Join gudang g2
    on m.next_loc = g2.gudang_id
    join gudang g3
    on m.prev_loc=g3.gudang_id
    join admin a
    on a.pk_id=g3.pk_id
    and a.admin_id=$data99 ";
}
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