<?php
	include_once 'connect.php';

		$sql= "SELECT t.trans_id, dt.id_detail_transaksi, t.tanggal, i.nama AS nama_item, i.jumlah AS jumlah_item, 
		i.satuan AS satuan_item, pk.pk_id, pk.nama AS nama_pk, dt.jumlah AS jumlah_trs 
		FROM transaksi t 
		JOIN pusat_kesehatan pk ON pk.pk_id = t.pk_provider 
		JOIN detail_transaksi dt ON dt.id_transaksi = t.trans_id JOIN stock s 
		ON s.id_stock = dt.id_stock 
		JOIN item i ON i.id_item = s.id_item
		 WHERE t.status = 'waiting' AND t.kategori_transaksi=1
		 AND dt.buy = 0 AND dt.approval = 'no' GROUP BY t.trans_id ORDER BY t.tanggal DESC";		 
	
if (($stmt = $con->prepare($sql)) === false) {
    trigger_error($con->error, E_USER_ERROR);
}
if ($stmt->execute() === false) {
    trigger_error($stmt->error, E_USER_ERROR);
}
if (($result = $stmt->get_result()) === false) {
    trigger_error($stmt->error, E_USER_ERROR);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
 
$arr=[];
while($row = mysqli_fetch_assoc($result)) {
	array_push($arr,$row);
}
echo json_encode($arr);?>