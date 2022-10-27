<?php
include_once 'connect.php';
$datas = $_POST['datas'];
$adminss = $_POST['adminss'];
//$datas = 2;


    $sql="SELECT m.mutasi_id,m.tanggal,m.jumlah,
    g1.nama as prev_loc, g2.nama as next_loc ,m.transaksi_id,m.stock_id
     FROM mutasi m 
     Join gudang g1
     on m.prev_loc=g1.gudang_id 
     Join gudang g2
     on m.next_loc = g2.gudang_id
     where m.transaksi_id=$datas";



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