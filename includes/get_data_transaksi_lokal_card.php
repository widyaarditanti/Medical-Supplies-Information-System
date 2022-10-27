<?php
include_once 'connect.php';
ob_start();
session_start();

 $data1 = $_POST['data1'];
$data2 = $_POST['data2'];
$data100 = $_POST['data100'];
$drop1 = $_POST['drop1'];
$drop2 = $_POST['drop2']; 
$drop100 = $_POST['drop100']; 
$searchtext = $_POST['searchtext'];
$adminss = $_SESSION['admin_id']; 
//Wajin buat pagination
$jumlahDataPerHalaman=16;
 $halamanaktif=$_POST["halaman"];
 //$halamanaktif=1;
$awalData=($jumlahDataPerHalaman*$halamanaktif)-$jumlahDataPerHalaman;

 /* $data1 = "Request";
$data2 = "Waiting";
$drop1 = 1;
$drop2 = 0; 
$searchtext = "2020-11-17";  
$data100 = "Tanggal";
$drop100 = 0; */
 
/* $data1 = "Request";
$data2 = "Waiting";
$drop1 = 1;
$drop2 = 1;
 */

/* $data1 = " ";
$data2 = " "; 
$drop1 = 0;
$drop2 = 0;
$searchtexttext = 'pusmin';  */

$filter=0;

if($data1 == "Request"){
    $filter=1;
}
else if($data1 == "Move"){
    $filter=2;
}
else if($data1 == "Use"){
    $filter=3;
}

    if($drop1==1 && $drop2==0 && $drop100==0){
        if($searchtext==" "){
            $sql= "SELECT t.trans_id,p1.nama as namax,
            a.username,
            t.tanggal,
            t.kategori_transaksi,
            t.status,
            t.admin_id,
            t.pk_provider,
            pk.nama
            FROM transaksi t 
            JOIN admin a ON t.admin_id=a.admin_id 
            JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang  
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id and t.kategori_transaksi=$filter
            where t.admin_id=$adminss
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

            $sql2="SELECT t.trans_id,p1.nama as namax,
            a.username,
            t.tanggal,
            t.kategori_transaksi,
            t.status,
            t.admin_id,
            t.pk_provider,
            pk.nama
            FROM transaksi t 
            JOIN admin a ON t.admin_id=a.admin_id 
            JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang  
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id and t.kategori_transaksi=$filter
            where t.admin_id=$adminss
            ORDER BY t.trans_id ASC";
        }
        else{
            $sql= "SELECT t.trans_id,p1.nama as namax,
            a.username,
            t.tanggal,
            t.kategori_transaksi,
            t.status,
            t.admin_id,
            t.pk_provider,
            pk.nama 
            FROM transaksi t 
            JOIN admin a ON t.admin_id=a.admin_id 
            JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id and t.kategori_transaksi=$filter
            where t.admin_id=$adminss
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

            $sql2= "SELECT t.trans_id,p1.nama as namax,
            a.username,
            t.tanggal,
            t.kategori_transaksi,
            t.status,
            t.admin_id,
            t.pk_provider,
            pk.nama 
            FROM transaksi t 
            JOIN admin a ON t.admin_id=a.admin_id 
            JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id and t.kategori_transaksi=$filter
            where t.admin_id=$adminss
            ORDER BY t.trans_id ASC" ;
            
        }
    
    }
    else if($drop1==1 && $drop2==1 && $drop100==0){
        
        $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
        FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
        JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
        JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id and t.kategori_transaksi='$filter' 
        and t.status='$data2' where t.admin_id=$adminss
        ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";
        
        $sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
        FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
        JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
        JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id and t.kategori_transaksi='$filter' 
        and t.status='$data2' where t.admin_id=$adminss
        ORDER BY t.trans_id ASC ";
        
      
    }
    else if($drop1==0 && $drop2==1 && $drop100==0){
     
            $sql= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
            JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            and  t.status='$data2' where t.admin_id=$adminss ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

            $sql2= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
            JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            and  t.status='$data2' where t.admin_id=$adminss ORDER BY t.trans_id ASC   " ;
    
    }
    else if($drop1==1 && $drop2==1 && $drop100==1){
        if($searchtext==" "){
            $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            where t.kategori_transaksi='$filter' 
            and t.status='$data2'
            and t.admin_id=$adminss
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where t.kategori_transaksi='$filter' 
and t.status='$data2'
and t.admin_id=$adminss
ORDER BY t.trans_id ASC   ";
            }
            else{
            if($data100=="Nama Admin"){
            $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            where a.username like '%$searchtext%' and t.kategori_transaksi='$filter' 
            and t.status='$data2'
            and t.admin_id=$adminss
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where a.username like '%$searchtext%' and t.kategori_transaksi='$filter' 
and t.status='$data2'
and t.admin_id=$adminss
ORDER BY t.trans_id ASC  " ;
            }
            else if($data100=="Tanggal"){
                
            $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            where t.tanggal like '%$searchtext%' and t.kategori_transaksi='$filter' 
            and t.status='$data2'
            and t.admin_id=$adminss 
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman 
            " ;
            $sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            where t.tanggal like '%$searchtext%' and t.kategori_transaksi='$filter' 
            and t.status='$data2'
            and t.admin_id=$adminss 
            ORDER BY t.trans_id ASC 
            " ;
            }
            
        }
    }
    else if($drop1==0 && $drop2==1 && $drop100==1){
        if($searchtext==" "){
            $sql= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            where t.status='$data2'
            and t.admin_id=$adminss ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where t.status='$data2'
and t.admin_id=$adminss ORDER BY t.trans_id ASC  " ;
        }
        else{
            if($data100=="Nama Admin"){
                $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
                FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
                JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
                where a.username like '%$searchtext%' 
                and t.status='$data2'
                and t.admin_id=$adminss
                ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where a.username like '%$searchtext%' 
and t.status='$data2'
and t.admin_id=$adminss
ORDER BY t.trans_id ASC   " ;
                }
                else if($data100=="Tanggal"){
                    
                $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
                FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
                JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
                where t.tanggal like '%$searchtext%'
                and t.status='$data2' and t.admin_id=$adminss
                ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where t.tanggal like '%$searchtext%'
and t.status='$data2' and t.admin_id=$adminss
ORDER BY t.trans_id ASC  " ;
                }
        }
    }
    else if($drop1==0 && $drop2==0 && $drop100==1){
        if($searchtext==" "){
            $sql= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            and t.admin_id=$adminss ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
and t.admin_id=$adminss ORDER BY t.trans_id ASC " ;
        }
        else{
            if($data100=="Nama Admin"){
             
                $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
                FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
                JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
                where a.username like '%$searchtext%' and t.admin_id=$adminss 
                ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where a.username like '%$searchtext%' and t.admin_id=$adminss 
ORDER BY t.trans_id ASC  " ;
                }
                else if($data100=="Tanggal"){
                    
                $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
                FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
                JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
                where t.tanggal like '%$searchtext%' and t.admin_id=$adminss 
                ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where t.tanggal like '%$searchtext%' and t.admin_id=$adminss 
ORDER BY t.trans_id ASC  " ;
                }
        }
    
    }
    else if($drop1==1 && $drop2==0 && $drop100==1){
        if($searchtext==" "){
            $sql= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
            JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id where
            t.kategori_transaksi=$filter
            and t.admin_id=$adminss
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id where
t.kategori_transaksi=$filter
and t.admin_id=$adminss
ORDER BY t.trans_id ASC " ;
        }
        else{
            if($data100=="Nama Admin"){
                $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
                FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
                JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
                where a.username like '%$searchtext%' and t.kategori_transaksi=$filter and t.admin_id=$adminss 
                ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where a.username like '%$searchtext%' and t.kategori_transaksi=$filter and t.admin_id=$adminss 
ORDER BY t.trans_id ASC   " ;
                }
                else if($data100=="Tanggal"){
                    
                $sql= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
                FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
                JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
                where t.tanggal like '%$searchtext%' and t.kategori_transaksi=$filter and t.admin_id=$adminss
                ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax,a.username,t.tanggal,t.kategori_transaksi,t.status,t.admin_id,t.pk_provider,pk.nama 
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   
JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
where t.tanggal like '%$searchtext%' and t.kategori_transaksi=$filter and t.admin_id=$adminss
ORDER BY t.trans_id ASC   " ;
                }
        }
    
    }
    
    else{
    
        if($searchtext==" "){
            $sql= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            and t.admin_id=$adminss
            ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
and t.admin_id=$adminss
ORDER BY t.trans_id ASC " ;
        }
        else{
            $sql= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
            FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
            and t.admin_id=$adminss
             ORDER BY t.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT t.trans_id,p1.nama as namax, a.username, t.tanggal, t.kategori_transaksi, t.status, t.admin_id, t.pk_provider, pk.nama
FROM transaksi t JOIN admin a ON t.admin_id=a.admin_id 
JOIN pusat_kesehatan p1 on p1.pk_id=t.pk_penyumbang   JOIN pusat_kesehatan pk ON a.pk_id=pk.pk_id 
and t.admin_id=$adminss
 ORDER BY t.trans_id ASC " ;
        }
    }

if ($result=mysqli_query($con,$sql2))
    {
    // Return the number of rows in result set
    $jumlahData=mysqli_num_rows($result);
      
}
  $jumlahHalaman=ceil($jumlahData/$jumlahDataPerHalaman);
  //   
  $_SESSION['jumlahDataPerHalaman']=$jumlahDataPerHalaman;
  $_SESSION['halamanaktif']=$halamanaktif;
  $_SESSION['jumlahData']=$jumlahData;
  $_SESSION['awalData']=$awalData;
  $_SESSION['jumlahHalaman']=$jumlahHalaman;
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
    echo "FAILED TO GET data";
}


?>