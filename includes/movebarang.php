<?php
include "connect.php";
ob_start();
session_start();

$pk_id = $_SESSION['pk_id'];
$admin_id =$_SESSION['admin_id'];
$status=$_POST['status'];
$satuan=$_POST['satuan'];
$item=$_POST['item'];
$v=$_POST['jenis']; 
$qty = $_POST['qty'];
$iditem = $_POST['iditem']; 
$dari = $_POST['dari']; 
$tujuan = $_POST['tujuan']; 
$jenis = $_POST['jenis'];
/* $pk_id = 4;
$admin_id = 4;
$status="Waiting";
$satuan=array("Kantong","Dus");
$item=array("Darah o","Panadol");
$v="Move"; 
$qty = array(1, 1);
$iditem = array(5, 7); 
$dari = "siwamangu"; 
$tujuan = "Gudang Baru";  */
$pertama=TRUE;
$dt=date("Y-m-d");
if ($v=="Request"){
    $ktrans=1;
}
else if($v=="Move"){
    $ktrans=2;
}
else if($v=="Use"){
    $ktrans=3;
}
   
// cari idasal
$sql=mysqli_query($con,"SELECT gudang_id FROM gudang where nama='$dari'");
$row = mysqli_fetch_row($sql);
$id_dari = $row[0];
// cari idtujuan

$sql=mysqli_query($con,"SELECT gudang_id FROM gudang where nama='$tujuan'");
$row = mysqli_fetch_row($sql);
$id_tujuan = $row[0]; 

for ($x = 0; $x < count($item); $x++) {
    $j=$qty[$x];
    $k=$satuan[$x];
    $l=$item[$x];
    $m=$iditem[$x];
    //ngecek barangnya memang ada digudang atau tidak
    $sql = "SELECT exp_date 
    FROM stock join item ON item.id_item=stock.id_item and stock.gudang_id = $id_dari AND item.nama='$l' ";
    $result = $con->query($sql); 
    if ($result->num_rows > 0) {
        //cek ditujuan sudah ada barang tersebut atau tidak
        $sql = "SELECT item.nama,stock.jumlah,stock.id_stock 
        FROM stock 
        join item 
        ON item.id_item=stock.id_item 
        and stock.gudang_id = $id_tujuan 
        AND item.nama='$l' ";
         $result = $con->query($sql); 
        if ($result->num_rows > 0) {
            $sql="UPDATE stock 
            join item 
            on stock.id_item=item.id_item 
            SET stock.jumlah = stock.jumlah+$j 
            WHERE stock.gudang_id='$id_tujuan'
            and item.nama='$l'";
            if ($con->query($sql) === TRUE) {
               // echo "stock asal terganti";
            } else {
              //  echo "Error updating record: " . $con->error;
            }
            $los = mysqli_query($con,"SELECT  id_stock  from stock 
            join item 
            on stock.id_item=item.id_item  
            WHERE stock.gudang_id='$id_tujuan'
            and item.nama='$l'");
            $rows = mysqli_fetch_row($los);
            $highest_stock = $rows[0];
        }
        else{
            //car Exp date sebelu,
            $sql=mysqli_query($con,"SELECT stock.exp_date 
            FROM stock join item ON item.id_item=stock.id_item and stock.gudang_id = $id_dari AND item.nama='$l' 
            AND stock.exp_date!='0000-00-00'");
            $row = mysqli_fetch_row($sql);
            $exp = $row[0];
            //echo $exp;
            //
            $sql = "INSERT into `stock` 
            (id_stock,jumlah,satuan,id_item,exp_date,gudang_id) 
            VALUES (NULL,$j,'$k',$m,'$exp',$id_tujuan)";
            if ($con->query($sql) === TRUE) {
               // echo "New record created successfully";
              } else {
               // echo "Error: " . $sql . "<br>" . $con->error;
            }
             //buat ambil id tertinggi stock dulu 
            $los = mysqli_query($con,"SELECT Max(id_stock) from stock");
            $rows = mysqli_fetch_row($los);
            $highest_stock = $rows[0];
        }

        $owo = mysqli_query($con,"SELECT (s.jumlah) from stock s 
        join item i on i.id_item=s.id_item
        WHERE i.nama='$i'
        and s.gudang_id = '$id_dari'  ");
        $row = mysqli_fetch_row($owo);
        $cekJumlah = $row[0];
        if ($cekJumlah-$j >= 0){
            //update squantity barang dari gudang asal
            $sql="UPDATE stock 
            join item 
            on stock.id_item=item.id_item 
            SET stock.jumlah = stock.jumlah-$j 
            WHERE stock.gudang_id='$id_dari'
            and item.nama='$l'";

            if ($con->query($sql) === TRUE) {
            // echo "New record created successfully";
            } 
            else {
            //  echo "Error: " . $sql . "<br>" . $con->error;
            }
            //insert transaksi
            if ($pertama == TRUE){
                $sql = "INSERT into `transaksi` 
                (trans_id, tanggal, status,admin_id,pk_provider,pk_penyumbang,kategori_transaksi) 
                VALUES (NULL,'$dt','$status',$admin_id,$pk_id,$pk_id,$ktrans)";
                $stmt = mysqli_stmt_init($con);
                if (mysqli_query($con, $sql)) {
                $owo = mysqli_query($con,"SELECT Max(trans_id) from transaksi");
                $row = mysqli_fetch_row($owo);
                $highest_id = $row[0];
                }
                $pertama=false;
            }
       
            //buat dtrans tapi NULL karena belum diapprove
            $sql = "INSERT into `detail_transaksi` 
            (id_detail_transaksi, id_transaksi, id_stock,jumlah,approval,buy) 
            VALUES (NULL,$highest_id,$highest_stock,$j,'yes',0)";// kalo uda di ccc nullnua diupdate. Namnaya cari susah ini anjay
            $stmt = mysqli_stmt_init($con); //nentuin exipred masih rancu
            if(mysqli_query($con, $sql)){
              echo "sukses memindahkan barang= ".$l.", ";
            }
            else{
                
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
        else{

            //minus ??
            echo "barang :".$l." akan minus digudang :".$dari." mohon dicek untuk pemindahannya,  "
        }

        

    }
    else{
        echo "barang :".$l." tidak tersedia digudang ".$dari.", ";
    }
}



?>