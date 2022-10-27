<?php
	include_once 'connect.php';

		$sql= "SELECT i.nama AS nama_item, i.jumlah 
		AS jumlah_item, i.satuan AS satuan_item, dt.jumlah,s.satuan 
		AS satuan_stock, pk.nama AS nama_pk, t.trans_id FROM transaksi t 
		JOIN detail_transaksi dt ON dt.id_transaksi = t.trans_id 
		JOIN pusat_kesehatan pk ON pk.pk_id = t.pk_provider 
		JOIN stock s ON s.id_stock = dt.id_stock 
		JOIN item i ON i.id_item = s.id_stock 
		WHERE buy = 0 AND approval = 'yes'";

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
	
?>