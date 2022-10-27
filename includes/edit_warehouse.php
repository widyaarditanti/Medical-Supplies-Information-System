<?php
	include_once "connect.php";

	if(isset($_POST['name']) && isset($_POST['add']) && isset($_POST['telp']) && isset($_POST['id'])){

		$nama = $_POST['name'];
		$alamat = $_POST['add'];
		$notelp = $_POST['telp'];
		$id = $_POST['id'];

			$sql = "UPDATE gudang SET nama = ?, alamat=?,no_telp=? WHERE gudang_id=?";
			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt,"ssii",$nama,$alamat,$notelp,$id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);

				echo 1;
			}
			else{
				echo 0;
			}
			
	}
?>