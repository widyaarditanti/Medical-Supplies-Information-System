<?php
	include_once 'connect.php';
	$id_trans = $_POST['id_trans'];

		$sql= "SELECT t.trans_id, t.tanggal, dt.id_detail_transaksi, g.nama AS nama_gudang, i.nama 
		AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, pk.nama AS nama_pk, dt.jumlah 
		AS jumlah_trs, s.satuan AS satuan_stock, kt.nama AS tipe_transaksi
		FROM transaksi t 
		JOIN kategori_transaksi kt
		ON kt.id = t.kategori_transaksi
		JOIN pusat_kesehatan pk 
		ON pk.pk_id = t.pk_provider 
		JOIN detail_transaksi dt 
		ON dt.id_transaksi = t.trans_id
		JOIN stock s 
		ON s.id_stock = dt.id_stock 
        JOIN gudang g
		ON g.gudang_id = s.gudang_id
		JOIN item i ON i.id_item = s.id_item
		 WHERE t.trans_id = ? AND dt.approval ='no'";

		$stmt = mysqli_stmt_init($con);
		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_bind_param($stmt, "i", $id_trans);
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