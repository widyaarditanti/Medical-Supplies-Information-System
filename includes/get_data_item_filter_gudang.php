<?php
	include_once 'connect.php';

	$gudang = $_POST['nama_gudang'];
		$sql= "SELECT s.id_stock, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, s.jumlah AS jumlah_stock, s.satuan AS satuan_stock, s.exp_date
        FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
        JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id
			WHERE g.nama = ? ORDER BY s.id_stock ASC";

		$stmt = mysqli_stmt_init($con);

		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_bind_param($stmt, "s", $gudang);
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