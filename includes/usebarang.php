<?php 
    //PHP untuk USE BARANG 
    
    include "connect.php";
    ob_start();
    session_start();
	
    $item=$_POST['item'];
 
   $qty = $_POST['qty'];
 
    $idgud=$_POST['idgud'];
    
    $pk_id = $_SESSION['pk_id'];
    $admin_id =$_SESSION['admin_id'];
    $status=$_POST['status'];
    $v=$_POST['jenis'];
    $hasil=" ";
    $date=date("Y-m-d");
    $pertama=1;
  

        if ($v=="Request"){
            $ktrans=1;
        }
        else if($v=="Move"){
            $ktrans=2;
        }
        else if($v=="Use"){
            $ktrans=3;
        }
    for ($x = 0; $x < count($item); $x++) {
        $i=$item[$x];
      
        $sql = "SELECT item.nama,stock.jumlah,stock.id_stock FROM stock join item ON item.id_item=stock.id_item and stock.gudang_id = $idgud AND item.nama='$i' ";
        $result = $con->query($sql); 
        if ($result->num_rows > 0) {
            
            $checker1=0;
            $j=$qty[$x];

            $owo = mysqli_query($con,"SELECT sum(s.jumlah) from stock s 
            join item i on i.id_item=s.id_item
            WHERE i.nama='$i'
            and s.gudang_id = $idgud  ");
            $row = mysqli_fetch_row($owo);
            $cekJumlah = $row[0];
            if($cekJumlah-$j >= 0){
                $aww = mysqli_query($con,"SELECT Max(s.jumlah),s.id_stock from stock s 
                join item i on i.id_item=s.id_item
                WHERE i.nama='$i'
                and s.gudang_id = $idgud  ");
                $row = mysqli_fetch_row($aww);
                $idupdate = $row[1];
                //
                $sql = "UPDATE stock  join item on item.id_item=stock.id_item set stock.jumlah = stock.jumlah-$j WHERE item.nama='$i' and stock.gudang_id = $idgud and stock.id_stock=$idupdate";
                if ($con->query($sql) === TRUE) {
                
                $hasil.="item :".$i." berhasil diuse " ;
                }
                if($pertama==1){
                $sql = "INSERT into `transaksi` (trans_id, tanggal, status,admin_id,pk_provider,pk_penyumbang,kategori_transaksi) 
                VALUES (NULL,'$date','$status',$admin_id,$pk_id,$pk_id,$ktrans)";
                $stmt = mysqli_stmt_init($con);
               
                if (mysqli_query($con, $sql)) {
                //$hasil.= "sukses";
                } 
                else {
                //$hasil.= "Error: " . $sql . "<br>" . mysqli_error($con);
                }
               
                $pertama=0;
                $owo = mysqli_query($con,"SELECT Max(trans_id) from transaksi");
                $row = mysqli_fetch_row($owo);
                $highest_id = $row[0];
                }
                
                $wew =  mysqli_query($con,"SELECT stock.id_stock FROM stock join item ON item.id_item=stock.id_item and stock.gudang_id = $idgud AND item.nama='$i' ");
                $row = mysqli_fetch_row($wew);
                $id_stock = $row[0];
               
           
                $sql = "INSERT into `detail_transaksi` 
                (id_detail_transaksi, id_transaksi, id_stock,jumlah,approval,buy) 
                VALUES (NULL,$highest_id,$id_stock,$j,'yes',0)";
                $stmt = mysqli_stmt_init($con);
               
                if (mysqli_query($con, $sql)) {
                //$hasil.= "sukses" ;
                } 
                else {
                //$hasil.= "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }       
            else{
                $hasil.= "Untuk Barang ".$i." Jumlah Minus / stok barang habis "  ;
            }   
            
          
        
        }
        else{
            $hasil.= "Untuk Barang ".$i." tidak ada "  ;
        }
    }

      echo $hasil;
  


?>