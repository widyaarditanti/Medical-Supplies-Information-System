<?php
	include_once "connect.php";

	if(isset($_POST['name']) && isset($_POST['add']) && isset($_POST['telp'])){

		$nama = $_POST['name'];
		$idpk = $_POST['idpk']; // dari session user
		$alamat = $_POST['add'];
		$notelp = $_POST['telp'];
                    
		//MASUKKAN KE DB
		$sql = "INSERT INTO gudang(nama,alamat,no_telp,pk_id) VALUES (?,?,?,?)";
		$stmt = mysqli_stmt_init($con);
		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_bind_param($stmt,"ssii",$nama,$alamat, $notelp,$idpk);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);	
			echo 1;
		}
		else{
			echo 0;
		}
	}
?>