<?php
include_once 'connect.php';
ob_start();
session_start();

$data1 = $_POST['data1'];
$data2 = $_POST['data2'];
$drop1 = $_POST['drop1'];
$drop2 = $_POST['drop2'];  
$search = $_POST['searchtext'];
$data100 = $_POST['data100'];
$drop100=$_POST['drop100'];
$adminss=$_POST['adminss'];
//Wajin buat pagination
$jumlahDataPerHalaman=16;
$halamanaktif=$_POST["halaman"]; 
 //$halamanaktif=1;
$awalData=($jumlahDataPerHalaman*$halamanaktif)-$jumlahDataPerHalaman;
/* $data1 = "Move";
$data2 = "Waiting";
$drop1 = 0;
$drop2 = 0; 
$search = "2020-11-17";  
$data100 = "Tanggal";
$drop100 = 0;  */ 
 

/* $data1 = "Request";
$data2 = "Waiting";
$drop1 = 1;
$drop2 = 1; */

if($data1 == "Request"){
    $filter=1;
}
else if($data1 == "Move"){
    $filter=2;
}
else if($data1 == "Use"){
    $filter=3;
}
if($drop1==1 && $drop2==0 && $drop100==0){//drop1 nyala yang 2 kd
        //huhu 
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan 
        ON pusat_kesehatan.pk_id=transaksi.pk_provider 
        and transaksi.kategori_transaksi='$filter'
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan 
ON pusat_kesehatan.pk_id=transaksi.pk_provider 
and transaksi.kategori_transaksi='$filter'
ORDER BY transaksi.trans_id ASC" ;


/* SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan 
        ON pusat_kesehatan.pk_id=transaksi.pk_provider 
        and transaksi.kategori_transaksi=1
        ORDER BY transaksi.trans_id ASC */
        /* $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider 
        and transaksi.kategori_transaksi='$filter'
        where admin.username like '%$search%' 
        ORDER BY transaksi.trans_id ASC" ;
     */
    

}

else if($drop1==1 && $drop2==1 && $drop100==0){
    
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;
        $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC" ;
  
     
   
}

else if($drop1==0 && $drop2==1 && $drop100==0){
    
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;
    
    
    $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
    join pusat_kesehatan p1
    on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.status='$data2' 
    ORDER BY transaksi.trans_id ASC" ;

    
    
}

else if($drop1==0 && $drop2==0 && $drop100==0){
    
    $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider
    ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";
    
    $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider
    ORDER BY transaksi.trans_id ASC";
    
}
//whisker
else if($drop1==0 && $drop2==1 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where admin.username like '%$search%'
            and transaksi.status='$data2'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where admin.username like '%$search%'
and transaksi.status='$data2'
ORDER BY transaksi.trans_id ASC";
            }
            else if ($data100=="Tanggal"){
             $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where transaksi.tanggal like '%$search%'
            and transaksi.status='$data2'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where transaksi.tanggal like '%$search%'
and transaksi.status='$data2'
ORDER BY transaksi.trans_id ASC";
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
        and transaksi.status='$data2'
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
and transaksi.status='$data2'
ORDER BY transaksi.trans_id ASC";
    }
}

else if($drop1==1 && $drop2==1 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
         where admin.usernam like '%$search%'
         and  transaksi.kategori_transaksi='$filter' 
         and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
 where admin.usernam like '%$search%'
 and  transaksi.kategori_transaksi='$filter' 
 and transaksi.status='$data2' 
ORDER BY transaksi.trans_id ASC" ;
            }
            else if ($data100=="Tanggal"){
           
    $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider 
    where transaksi.tanggal like '%$search%'
    and  transaksi.kategori_transaksi='$filter' 
    and transaksi.status='$data2' 
    ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
    join pusat_kesehatan p1
    on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider 
where transaksi.tanggal like '%$search%'
and  transaksi.kategori_transaksi='$filter' 
and transaksi.status='$data2' 
ORDER BY transaksi.trans_id ASC" ;
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
    ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
    join pusat_kesehatan p1
    on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
ORDER BY transaksi.trans_id ASC" ;
    }
   

}

else if($drop1==1 && $drop2==0 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where admin.username like '%$search%'
            and transaksi.kategori_transaksi='$filter'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where admin.username like '%$search%'
and transaksi.kategori_transaksi='$filter'
ORDER BY transaksi.trans_id ASC";
            }
            else if ($data100=="Tanggal"){
             $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where transaksi.tanggal like '%$search%'
            and transaksi.kategori_transaksi='$filter'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where transaksi.tanggal like '%$search%'
and transaksi.kategori_transaksi='$filter'
ORDER BY transaksi.trans_id ASC";
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
ORDER BY transaksi.trans_id ASC";
    }

}
else if($drop1==0 && $drop2==0 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where admin.username like '%$search%'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where admin.username like '%$search%'
ORDER BY transaksi.trans_id ASC";
            }
            else if ($data100=="Tanggal"){
             $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where transaksi.tanggal like '%$search%'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where transaksi.tanggal like '%$search%'
ORDER BY transaksi.trans_id ASC";
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
ORDER BY transaksi.trans_id ASC";
    }
    

}

else{
    if($drop1==1 && $drop2==0 && $drop100==0){//drop1 nyala yang 2 kd
    
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider 
        and transaksi.kategori_transaksi='$filter'
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider 
and transaksi.kategori_transaksi='$filter'
ORDER BY transaksi.trans_id ASC" ;
        /* $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider 
        and transaksi.kategori_transaksi='$filter'
        where admin.username like '%$search%' 
        ORDER BY transaksi.trans_id ASC" ;
     */

}

else if($drop1==1 && $drop2==1 && $drop100==0){
    
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;
  
        
  $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
  JOIN kategori_transaksi 
  ON transaksi.kategori_transaksi=kategori_transaksi.id 
  join admin 
  ON admin.admin_id=transaksi.admin_id 
  join pusat_kesehatan p1
  on p1.pk_id=transaksi.pk_penyumbang
  join pusat_kesehatan
  ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
  ORDER BY transaksi.trans_id ASC" ;
   
}

else if($drop1==0 && $drop2==1 && $drop100==0){
    
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;
    
    $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
    join pusat_kesehatan p1
    on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.status='$data2' 
    ORDER BY transaksi.trans_id ASC" ;
    
    
}

else if($drop1==0 && $drop2==0 && $drop100==0){
    
    $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider
    ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";
    
    $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider
    ORDER BY transaksi.trans_id ASC";
    
}
//whisker
else if($drop1==0 && $drop2==1 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where admin.username like '%$search%'
            and transaksi.status='$data2'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where admin.username like '%$search%'
and transaksi.status='$data2'
ORDER BY transaksi.trans_id ASC";
            }
            else if ($data100=="Tanggal"){
             $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where transaksi.tanggal like '%$search%'
            and transaksi.status='$data2'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";
             $sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
             JOIN kategori_transaksi 
             ON transaksi.kategori_transaksi=kategori_transaksi.id 
             join admin 
             ON admin.admin_id=transaksi.admin_id 
         join pusat_kesehatan p1
         on p1.pk_id=transaksi.pk_penyumbang
             join pusat_kesehatan
             ON pusat_kesehatan.pk_id=transaksi.pk_provider
             where transaksi.tanggal like '%$search%'
             and transaksi.status='$data2'
             ORDER BY transaksi.trans_id ASC";
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
        and transaksi.status='$data2'
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
and transaksi.status='$data2'
ORDER BY transaksi.trans_id ASC";
    }
}

else if($drop1==1 && $drop2==1 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
         where admin.usernam like '%$search%'
         and  transaksi.kategori_transaksi='$filter' 
         and transaksi.status='$data2' 
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
 where admin.usernam like '%$search%'
 and  transaksi.kategori_transaksi='$filter' 
 and transaksi.status='$data2' 
ORDER BY transaksi.trans_id ASC" ;
            }
            else if ($data100=="Tanggal"){
           
    $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider 
    where transaksi.tanggal like '%$search%'
    and  transaksi.kategori_transaksi='$filter' 
    and transaksi.status='$data2' 
    ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
    join pusat_kesehatan p1
    on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider 
where transaksi.tanggal like '%$search%'
and  transaksi.kategori_transaksi='$filter' 
and transaksi.status='$data2' 
ORDER BY transaksi.trans_id ASC" ;
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
    JOIN kategori_transaksi 
    ON transaksi.kategori_transaksi=kategori_transaksi.id 
    join admin 
    ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
    join pusat_kesehatan
    ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
    ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman " ;

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
    join pusat_kesehatan p1
    on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider and transaksi.kategori_transaksi='$filter' and transaksi.status='$data2' 
ORDER BY transaksi.trans_id ASC" ;
    }
   

}

else if($drop1==1 && $drop2==0 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where admin.username like '%$search%'
            and transaksi.kategori_transaksi='$filter'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where admin.username like '%$search%'
and transaksi.kategori_transaksi='$filter'
ORDER BY transaksi.trans_id ASC";
            }
            else if ($data100=="Tanggal"){
             $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where transaksi.tanggal like '%$search%'
            and transaksi.kategori_transaksi='$filter'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where transaksi.tanggal like '%$search%'
and transaksi.kategori_transaksi='$filter'
ORDER BY transaksi.trans_id ASC";
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
ORDER BY transaksi.trans_id ASC";
    }

}
else if($drop1==0 && $drop2==0 && $drop100==1){
    if($search!=" "){
        if($data100=="Nama Admin"){
            $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where admin.username like '%$search%'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where admin.username like '%$search%'
ORDER BY transaksi.trans_id ASC";
            }
            else if ($data100=="Tanggal"){
             $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
            JOIN kategori_transaksi 
            ON transaksi.kategori_transaksi=kategori_transaksi.id 
            join admin 
            ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
            join pusat_kesehatan
            ON pusat_kesehatan.pk_id=transaksi.pk_provider
            where transaksi.tanggal like '%$search%'
            ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
where transaksi.tanggal like '%$search%'
ORDER BY transaksi.trans_id ASC";
            }
    }
    else{
        $sql= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
        JOIN kategori_transaksi 
        ON transaksi.kategori_transaksi=kategori_transaksi.id 
        join admin 
        ON admin.admin_id=transaksi.admin_id 
        join pusat_kesehatan p1
        on p1.pk_id=transaksi.pk_penyumbang
        join pusat_kesehatan
        ON pusat_kesehatan.pk_id=transaksi.pk_provider
        ORDER BY transaksi.trans_id ASC LIMIT $awalData, $jumlahDataPerHalaman ";

$sql2= "SELECT kategori_transaksi.nama as katas,admin.username as namad,pusat_kesehatan.nama as namas,transaksi.trans_id,transaksi.tanggal,transaksi.status,transaksi.admin_id,transaksi.pk_provider,p1.nama as namax,kategori_transaksi.nama FROM transaksi 
JOIN kategori_transaksi 
ON transaksi.kategori_transaksi=kategori_transaksi.id 
join admin 
ON admin.admin_id=transaksi.admin_id 
join pusat_kesehatan p1
on p1.pk_id=transaksi.pk_penyumbang
join pusat_kesehatan
ON pusat_kesehatan.pk_id=transaksi.pk_provider
ORDER BY transaksi.trans_id ASC";
    }
    

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
    echo "FAILED TO GET data1";
}
?>