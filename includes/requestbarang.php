<?php
include "connect.php";
ob_start();
session_start();
/* $pk_id = 3;
$id_gud = 3;
$admin_id =2;
$status="waiting";
$satuan=array("Kantong","Dus");
$item=array("Darah o","Panadol");
$v="Request"; 
$qty = array(1, 1);
$iditem = array(5, 7); */
$dt=date("Y-m-d");
$exp=date('Y-m-d', strtotime($dt. ' + 1 years'));
$pk_id = $_SESSION['pk_id'];
$id_gud = $_POST['idgud'];
$admin_id =$_SESSION['admin_id'];
$status=$_POST['status'];

$satuan=$_POST['satuan'];
$item=$_POST['item'];
$v=$_POST['jenis']; 
$qty = $_POST['qty'];
$iditem = $_POST['iditem']; 

if ($v=="Request"){
    $ktrans=1;
}
else if($v=="Move"){
    $ktrans=2;
}
else if($v=="Use"){
    $ktrans=3;
}
      
$sql = "INSERT into `transaksi` (trans_id, tanggal, status,admin_id,pk_provider,pk_penyumbang,kategori_transaksi) 
VALUES (NULL,'$dt','$status',$admin_id,$pk_id,NULL,$ktrans)";
$stmt = mysqli_stmt_init($con);

if (mysqli_query($con, $sql)) {
    //echo "sukses transaksi+";
    //cari id transaksi buat detail transaksi
    $owo = mysqli_query($con,"SELECT Max(trans_id) from transaksi");
    $row = mysqli_fetch_row($owo);
    $highest_id = $row[0];
    //echo $highest_id;
    for ($x = 0; $x < count($qty); $x++) {
    $j=$qty[$x];
    $k=$satuan[$x];
    $l=$item[$x];
    $m=$iditem[$x];
   
        $sql = "INSERT into `stock` 
        (id_stock, satuan,id_item,gudang_id) 
        VALUES (NULL,'$k',$m,$id_gud)";
        $stmt = mysqli_stmt_init($con); //nentuin exipred masih rancu
        if(mysqli_query($con, $sql)){
        //echo "sukses menambah";
        }
        else{
        
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        $sql = "INSERT into forecast values (NULL, 10,  $m ,  $pk_id)";
        $stmt = mysqli_stmt_init($con);  
        if(mysqli_query($con, $sql)){
        
        }
        else{
        
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    //buat ambil id tertinggi stock dulu 
    $los = mysqli_query($con,"SELECT Max(id_stock) from stock");
    $rows = mysqli_fetch_row($los);
    $highest_stock = $rows[0];
    //buat dtrans tapi NULL karena belum diapprove
    $sql = "INSERT into `detail_transaksi` 
    (id_detail_transaksi, id_transaksi, id_stock,jumlah,approval,buy) 
    VALUES (NULL,$highest_id,$highest_stock,$j,'no',0)";  
    $stmt = mysqli_stmt_init($con); //nentuin exipred masih rancu
        if(mysqli_query($con, $sql)){
            echo "sukses menambahkan request :".$l.", ";
        }
        else{
            
         echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

} 
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
?>