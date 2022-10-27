<?php
	include_once 'connect.php';

	$admin = $_POST['admin'];
	// $admin = "central";
	$categoryorsub = $_POST['categoryorsub'];
	// $categoryorsub = "";
	// $value_category = "";
	$value_category = $_POST['valuecat'];
	// $nama_item = "m";
	$nama_item = $_POST['nama_item'];
	$pk = $_POST["HC"];
	// $pk = "Siloam";

	// if($admin == "local"){
	if(is_numeric($admin)){
		if($categoryorsub == ""){
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE g.pk_id = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "i", $pk);
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
		else if($categoryorsub == 1){
			//CATEGORY AKTIF
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE g.pk_id = ? AND t.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "is", $pk, $value_category);
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
		else if($categoryorsub == 0){
			//SUBCATEGORY AKTIF
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE g.pk_id = ? AND j.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "is", $pk,$value_category);
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
	}
	else if($admin == "central"){

		if($pk != "" && $categoryorsub == ""){
			//HC AJA YG BERUBAH
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe 
			JOIN tipe t ON j.id_tipe = t.id_tipe JOIN stock s ON s.id_item = i.id_item
			JOIN gudang g ON g.gudang_id = s.gudang_id JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE pk.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "s", $pk);
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
		elseif($pk !="" && $categoryorsub == 1){

			//DROPDOWN HC GANII TRS CATEGORY JG GANTI
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id 
			JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id
			JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE pk.nama = ? AND t.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "ss", $pk, $value_category);
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
		else if($pk != "" && $categoryorsub == 0){

			//DROPDOWN HC GANII TRS subCATEGORY JG GANTI
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id 
			JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id
			JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE pk.nama = ? AND j.nama=? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "ss", $pk, $value_category);
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
		else if($categoryorsub == ""){

			//ADMIN CENTRALL ALL (LOAD HTML)
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe 
			JOIN tipe t ON j.id_tipe = t.id_tipe JOIN stock s ON s.id_item = i.id_item
			JOIN gudang g ON g.gudang_id = s.gudang_id JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item
			WHERE i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

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
		else if($categoryorsub == 1){

			//CATEGORY AKTIF
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id 
			JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE t.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "s",$value_category);
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
		else if($categoryorsub == 0){

			//SUBCATEGORY AKTIF
			$sql= "SELECT  i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock,j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day
			FROM item i JOIN stock s ON s.id_item = i.id_item JOIN gudang g ON g.gudang_id = s.gudang_id 
			JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id
			JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE j.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "s", $value_category);
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
		else{

			//HC AJA YG BERUBAH
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item, i.deskripsi, i.image AS image_item,
			j.nama AS nama_jenis_tipe,t.nama AS nama_tipe, forecast.forecast_day,
			SUM(s.jumlah) AS jumlah_stock, s.satuan AS satuan_stock
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe 
			JOIN tipe t ON j.id_tipe = t.id_tipe JOIN stock s ON s.id_item = i.id_item
			JOIN gudang g ON g.gudang_id = s.gudang_id JOIN pusat_kesehatan pk ON pk.pk_id = g.pk_id 
			JOIN (SELECT item_id, forecast_day FROM forecast GROUP BY item_id) as forecast ON forecast.item_id = i.id_item 
			WHERE pk.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY s.id_item ORDER BY s.id_item ASC";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "s", $pk);
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
	}
	else if($admin == "master"){
		if($nama_item == ""){
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item,i.deskripsi, i.image AS image_item, 
			j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe 
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			GROUP BY i.id_item ORDER BY i.id_item ASC LIMIT 16";

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
		else if($categoryorsub ==""){
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item,i.deskripsi, i.image AS image_item, 
			j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe 
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			WHERE i.nama like '%".$nama_item."%' GROUP BY i.id_item ORDER BY i.id_item ASC LIMIT 16";

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
		else if($categoryorsub == 1){
			//FILTER CATEGORY NYA AKTIF
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item,i.deskripsi, i.image AS image_item, 
			j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe 
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			WHERE t.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY i.id_item ORDER BY i.id_item ASC LIMIT 16";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "s", $value_category);
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
		else if($categoryorsub == 0){
			//SUBCATEGORY NYA AKTIF
			$sql= "SELECT i.id_item, i.nama AS nama_item, i.jumlah AS jumlah_item, i.satuan AS satuan_item,i.deskripsi, i.image AS image_item, j.id_jenis_tipe, j.nama AS nama_jenis_tipe, t.id_tipe, t.nama AS nama_tipe 
			FROM item i JOIN jenis_tipe j ON i.id_jenis_tipe = j.id_jenis_tipe JOIN tipe t ON j.id_tipe = t.id_tipe 
			WHERE j.nama = ? AND i.nama like '%".$nama_item."%' GROUP BY i.id_item ORDER BY i.id_item ASC LIMIT 16";

			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "s", $value_category);
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
	}
?>