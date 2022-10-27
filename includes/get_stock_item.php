<?php
	include_once 'connect.php';

	$admin = "central";
	// $admin = 3;
	$admin = $_POST['admin'];
	$pk_id = 3;
	$pk_id = "";
	if(isset($_POST['pk_id'])){
		$pk_id = $_POST['pk_id'];
	}

	// if($admin == "local"){
	if(is_numeric($admin)){
		$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item, j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe, s.jumlah AS jumlah_stock, s.satuan AS satuan_stock, s.exp_date FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe JOIN stock s ON s.id_item = i.id_item
			JOIN gudang g ON g.gudang_id = s.gudang_id
			JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id WHERE pk.pk_id = ? ORDER BY i.id_item ASC";

		$stmt = mysqli_stmt_init($con);

		if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "i", $pk_id);
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
	}
	else if($admin == "central"){
		$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
		         j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe,
				 s.jumlah AS jumlah_stock, s.satuan AS satuan_stock, s.exp_date
		         FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe 
				 JOIN tipe t ON j.id_tipe = t.id_tipe JOIN stock s ON s.id_item = i.id_item
				 ORDER BY i.id_item ASC";

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
	}
	else if($admin == "master"){
		$sql= "SELECT i.id_item,i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
		         j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe,
				 s.jumlah AS jumlah_stock, s.satuan AS satuan_stock, s.exp_date
		         FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe 
				 JOIN tipe t ON j.id_tipe = t.id_tipe JOIN stock s ON s.id_item = i.id_item
				 ORDER BY i.id_item ASC";

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
	}
?>