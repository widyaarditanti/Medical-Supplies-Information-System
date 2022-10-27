<?php
	include_once "connect.php";

	$nama_item = $_POST['nama'];
	// $nama_item = 'Darah A';
	// $nama_gudang = 'joyoboyo';
	$nama_gudang = $_POST['gudang'];
	// $id_item = 2;
	$id_item = $_POST['id'];
	// $qty_item = 10;
	$qty_item = $_POST['qty']; //masuk ke jumlah detailtransaksi
	// $tdate = '2020-11-13';
	$tdate = $_POST['tdate'];
	// $satuan ='Kantong';
	$satuan =$_POST['satuan'];
	$app = "yes";
	$buy = 0; // buy == false
	$qty_stock = 0; //karena blm beli 
	$admin_id = $_POST['admin_id']; 
	$status = 'waiting';
	$kategori_transaksi = 1; //REQUEST

		//CARI ID GUDANG
			$sql = "SELECT gudang_id FROM gudang WHERE nama=?";
			$stmt = mysqli_stmt_init($con);
			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt,"s",$nama_gudang);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				if($row = mysqli_fetch_assoc($result)){
                    $gudang_id = $row['gudang_id'];
                    
					//CREATE ID STOCK
					$sql = "INSERT INTO stock(jumlah,satuan,id_item,gudang_id) VALUES (?,?,?,?)";
					$stmt = mysqli_stmt_init($con);

					if(mysqli_stmt_prepare($stmt,$sql)){

						mysqli_stmt_bind_param($stmt,"isii",$qty_stock,$satuan,$id_item,$gudang_id);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);	
						echo 1;
					}
					else{
						echo 0;
					}

					//CREATE TRANSAKSI
					$sql = "INSERT INTO transaksi(tanggal,status,admin_id,kategori_transaksi) VALUES (?,?,?,?)";
					$stmt = mysqli_stmt_init($con);

					if(mysqli_stmt_prepare($stmt,$sql)){

						mysqli_stmt_bind_param($stmt,"ssii",$tdate,$status, $admin_id,$kategori_transaksi);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);	
						echo 1;
					}
					else{
						echo 0;
					}

					//SELECT ID_TRANSAKSI & ID_STOCK BARUSAN
					$sql = "SELECT trans_id FROM transaksi ORDER BY trans_id DESC LIMIT 1 ";
					$stmt = mysqli_stmt_init($con);

					if(mysqli_stmt_prepare($stmt,$sql)){
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);

						if($row = mysqli_fetch_assoc($result)){
	                    	$id_transaksi = $row['trans_id'];

	                    	$sql = "SELECT id_stock FROM stock ORDER BY id_stock DESC LIMIT 1";
							$stmt = mysqli_stmt_init($con);

							if(mysqli_stmt_prepare($stmt,$sql)){
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);

		                    	if($row = mysqli_fetch_assoc($result)){
			                    	$id_stock = $row['id_stock'];

			                    	//CREATE DETAIL TRANSAKSI
									$sql = "INSERT INTO detail_transaksi(id_transaksi,id_stock,jumlah,approval,buy) VALUES (?,?,?,?,?)";
									$stmt = mysqli_stmt_init($con);

									if(mysqli_stmt_prepare($stmt,$sql)){

										mysqli_stmt_bind_param($stmt,"iiisi",$id_transaksi,$id_stock, $qty_item,$app, $buy);
										mysqli_stmt_execute($stmt);
										mysqli_stmt_store_result($stmt);	
										echo 1;
									}
									else{
										echo 0;
									}
			                    }
			                }
						}
					}
				}
			}

?>