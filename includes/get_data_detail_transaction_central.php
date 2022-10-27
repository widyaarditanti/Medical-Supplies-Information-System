<?php
include_once 'connect.php';
ob_start();
session_start();
$datas=$_POST['datas'];
$adminss=$_POST['adminss']; 

/* $datas=34;
$adminss=0; */
if($adminss==1){
    if ($datas!=0) {
  
        $sql= "SELECT dt.id_detail_transaksi, dt.id_transaksi,i.nama,dt.jumlah,dt.approval,dt.buy
        FROM detail_transaksi dt
        join stock s 
        on dt.id_stock=s.id_stock
        join item i
        on s.id_item=i.id_item
        where dt.id_transaksi=$datas
        ORDER BY dt.id_detail_transaksi ASC";  
        } else {  
            $sql= "SELECT dt.id_detail_transaksi, dt.id_transaksi,i.nama,dt.jumlah,dt.approval,dt.buy
            FROM detail_transaksi dt
            join stock s 
            on dt.id_stock=s.id_stock
            join item i
            on s.id_item=i.id_item
            ORDER BY dt.id_detail_transaksi ASC";
        }
        
}
else{
    $adminss=$_SESSION['admin_id'];
    if ($datas!=0) {
  
        $sql= "SELECT dt.id_detail_transaksi, dt.id_transaksi,i.nama,dt.jumlah,dt.approval,dt.buy,a.username
        FROM detail_transaksi dt
        join stock s 
        on dt.id_stock=s.id_stock
        join item i
        on s.id_item=i.id_item
        join gudang g 
        on g.gudang_id=s.gudang_id
        join admin a
        on a.pk_id= g.pk_id
        and a.admin_id=$adminss 
        where dt.id_transaksi=$datas  
        ORDER BY dt.id_detail_transaksi ASC";  
        } else {  
            $sql= "SELECT dt.id_detail_transaksi, dt.id_transaksi,i.nama,dt.jumlah,dt.approval,dt.buy,a.username
    FROM detail_transaksi dt
    join stock s 
    on dt.id_stock=s.id_stock
    join item i
    on s.id_item=i.id_item
    join gudang g 
    on g.gudang_id=s.gudang_id
    join admin a
    on a.pk_id= g.pk_id
    where a.admin_id=$adminss
    ORDER BY dt.id_detail_transaksi ASC";
        }
    //echo $adminss;
    
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