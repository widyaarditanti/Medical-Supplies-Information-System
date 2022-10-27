<?php
ob_start();
session_start();
	include_once 'connect.php';
        $tipe=$_POST['tipe'];
        //$tipe=2;
        $username=$_POST['username'];
       // $username="stienley";
        $password=$_POST['password'];
        //$password="stienley";
        $sql= mysqli_query($con,"SELECT admin.admin_id,admin.username,admin.password,admin.email,admin.no_telp,admin.kategori_id,admin.pk_id,pusat_kesehatan.nama FROM admin JOIN pusat_kesehatan 
		ON admin.pk_id=pusat_kesehatan.pk_id WHERE admin.username='$username' and admin.password='$password' and admin.kategori_id='$tipe'");
        
	if(mysqli_num_rows($sql) > 0){
		$row_user = mysqli_fetch_array($sql);
		$_SESSION['admin_id'] = $row_user['admin_id'];
		$_SESSION['username'] = $row_user['username'];
		$_SESSION['password'] = $row_user['password'];
		$_SESSION['email'] = $row_user['email'];
		$_SESSION['no_telp'] = $row_user['no_telp'];
		$_SESSION['kategori_id'] = $row_user['kategori_id'];
		$_SESSION['pk_id'] = $row_user['pk_id'];
		$_SESSION['nama'] = $row_user['nama'];
		echo 1;
	}else{
		echo 0;
	}

?>
