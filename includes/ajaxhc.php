<?php 
	include "connect.php";

	//refresh data ketika user mengetik di kolom search maupun kategori
	if(isset($_POST['search'])){	
		$nama=$_POST['search'];
		$kategori = $_POST['kategori']; 

		//kategori
		if($_POST['kategori'] == 'All'){
			if($nama != ''){
				$sql = "select * from pusat_kesehatan where nama like '%".$nama."%'";
				$pk = mysqli_query($con, $sql);
				// echo "search all cat";
			}
			else
			{
				$sql = "select * from pusat_kesehatan";
				$pk = mysqli_query($con, $sql);
				// echo "no search all cat";
			}
		}
		else 
		{
			if($nama != ''){
				$sql = "select pk.* from pusat_kesehatan pk join kategori_pk kat on kat.kategori_id = pk.kategori_id where kat.nama = '".$kategori."' and pk.nama like '%".$nama."%'";
				$pk = mysqli_query($con, $sql);
				// echo "search with cat";
			}
			else
			{
				// echo "no search with cat";
				$sql = "select pk.* from pusat_kesehatan pk join kategori_pk kat on kat.kategori_id = pk.kategori_id where kat.nama = '".$kategori."'";
				$pk = mysqli_query($con, $sql);
			}
		}


		//show
		if($_POST['icon'] == 1){
			while($row = mysqli_fetch_array($pk)){ 
				$sqls = "select * from kategori_pk where kategori_id = ".$row['kategori_id'];
				$pks = mysqli_query($con, $sqls);
				$rows = mysqli_fetch_assoc($pks);
				$kat =  $rows['nama'];
				
				echo '<div class="iconn container d-flex justify-content-center">
					<img class="Image_HealthCenter" src="img/Health Center/'.$row['image'].'">
					<div class="data container-fluid" style="margin-left: -3px;">
						<span class="HealthCenter_Type">'.$kat.'</span>
						<button class="delete_but" onclick="deleteButton(this.parentElement, '.$row['pk_id'].')" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
						<br>
						<span class="Name_HealthCenter">'.$row['nama'].'</span><br>
						<span class="Address_HealthCenter">'.$row['alamat'].'</span><br>
						<span class="Telepon_HealthCenter">'.$row['no_telp'].'</span>
						<button class="edit_but" onclick="editButton(this.parentElement, '.$row['pk_id'].')" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
					</div>
					<button class="Filter_HealthCenter" onclick="filterButton(this.parentElement)"></button>
				</div>';		
			}
		}
		else 
		{
			echo '<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
				<thead>
					<tr style="text-align: center;">
						<th style="width: 15%;">Category</th>
						<th style="width: 20%;">Health Center Name</th>
						<th style="width: 20%">Address</th>
						<th style="width: 10%">Number</th>
					</tr>
				</thead>

				<tbody class="text-center" id="body">';
					//nama
					while($row = mysqli_fetch_array($pk)){ 
						echo "<tr>"; 
							$sqls = "select * from kategori_pk where kategori_id = ".$row['kategori_id'];
							$pks = mysqli_query($con, $sqls);
							$rows = mysqli_fetch_assoc($pks);
							$kat =  $rows['nama'];
								echo "<td>".$kat."</td>";
								echo "<td>".$row['nama']."</td>";
								echo "<td>".$row['alamat']."</td>";
								echo "<td>".$row['no_telp']."</td>";
						echo "</tr>";
					}
				echo "</tbody>
			</table>";
		}
	}

	//refresh data pada modal filter box
	if(isset($_POST['filternama'])){	
		$nama=$_POST['filternama'];

		$sql = "select * from pusat_kesehatan where nama = '".$nama."'";
		$pk = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($pk);
		$alamat =  $row['alamat'];
		$katid = $row['kategori_id'];
		$telp = $row['no_telp'];
		// echo $alamat;

		$sqls = "select * from kategori_pk where kategori_id = ".$katid;
		$pks = mysqli_query($con, $sqls);
		$rows = mysqli_fetch_assoc($pks);
		$kat =  $rows['nama'];

		echo '<div class="ml-2 mr-2 justify-content-center">  
	        <button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
			<center><div class="text-center" id="Modal_T_ID" name="Modal_T_ID" style="color: #4fbbb2; font-weight: 500; font-size: 24px; margin-top: -20px; margin-bottom: -20px;" value="">'.$nama.'</div></center><br>
			<div class="Modal_Text">TYPE: &nbsp;<span class="Modal_Text2" id="Modal_T_Type">'.$kat.'</span></div>
			<div class="Modal_Text">ADDRESS: &nbsp;<span class="Modal_Text2" id="Modal_T_Address">'.$alamat.'</span></div>
			<div class="Modal_Text">NUMBER: &nbsp;<span class="Modal_Text2" id="Modal_T_Number">'.$telp.'</span></div><br>';

		echo '<div class="Modal_Table_Container">

			<div class="text-center Modal_Table_Title">WARE HOUSE</div>

			<div id="Modal_Table" style="max-height: 160px; overflow-y: auto;">
				<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
					<thead>
						<tr style="text-align: center;">
							<th style="width: 15%;">Warehouse Name</th>
							<th style="width: 35%;">Address</th>
							<th style="width: 15%">Number</th>
						</tr>
					</thead>

					<tbody class="text-center" id="body">';
						$z = "select * from gudang where pk_id = ".$row['pk_id'];
						$x = mysqli_query($con, $z);
						while($a = mysqli_fetch_array($x)){ 
							echo "<tr>
								<td>".$a['nama']."</td>
								<td>".$a['alamat']."</td>
								<td>".$a['no_telp']."</td>
							</tr>";
						}
					echo '</tbody>
				</table>
			</div>
		</div>';
	}	

	//menambah health center
	if(isset($_POST['addhc']))
	{
		$filename = $_FILES['file']['name'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$nomer = $_POST['nomer'];
		$kategori = $_POST['kategori'];
		// echo $kategori;
		// echo $nama;
		// echo $alamat;
		// echo $nomer;
		// echo $filename;

		$sqls = "select * from kategori_pk where nama = '".$kategori."'";
		$pks = mysqli_query($con, $sqls);
		$rows = mysqli_fetch_assoc($pks);
		$katid =  $rows['kategori_id'];
		// echo $katid;

		$sql = "INSERT INTO pusat_kesehatan (no_telp, nama, alamat, image, kategori_id) values (".$nomer.",'".$nama."','".$alamat."', '".$filename."', ".$katid.")";
		$cek = $con->query($sql);
		if(!$cek){
			mysqli_error($con);
		}
		
		/* Location */
		$location = "../img/Health Center/".$filename;
		$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);

		/* Valid extensions */
		$valid_extensions = array("jpg","jpeg","png");

		$response = 0;
		/* Check file extension */
		if(in_array(strtolower($imageFileType), $valid_extensions)) {
			/* Upload file */
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
				$response = $location;
			}
		}
	}

	//mengubah health center
	if(isset($_POST['edit']))
	{
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$nomer = $_POST['nomer'];
		$kategori = $_POST['kategori'];
		$id = $_POST['id'];
		// echo $kategori;
		// echo $nama;
		// echo $alamat;
		// echo $id;
	
		$sqls = "select * from kategori_pk where nama = '".$kategori."'";
		$pks = mysqli_query($con, $sqls);
		$rows = mysqli_fetch_assoc($pks);
		$katid =  $rows['kategori_id'];
		// echo $katid;
		
		// echo $_POST['adafile']; 
		if($_POST['adafile'] == 'true')
		{
			$filename = $_FILES['file']['name'];
			$sql = "UPDATE pusat_kesehatan SET no_telp = '".$nomer."', nama = '".$nama."', alamat = '".$alamat."', image = '".$filename."', kategori_id = ".$katid." where pk_id = ".$id;
			$cek = $con->query($sql);
			if(!$cek){
				mysqli_error($con);
			}

			/* Location */
			$location = "../img/Health Center/".$filename;
			$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);

			/* Valid extensions */
			$valid_extensions = array("jpg","jpeg","png");

			$response = 0;
			/* Check file extension */
			if(in_array(strtolower($imageFileType), $valid_extensions)) {
				/* Upload file */
				if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
					$response = $location;
				}
			}
		}
		else{
			$sql = "UPDATE pusat_kesehatan SET no_telp = '".$nomer."', nama = '".$nama."', alamat = '".$alamat."', kategori_id = ".$katid." where pk_id = ".$id;
			$cek = $con->query($sql);
			if(!$cek){
				mysqli_error($con);
			}
		}
	}

	//menghapus health center
	if(isset($_POST['delete']))
	{
		$id = $_POST['id'];
		// echo $id;
		$sql = "delete from pusat_kesehatan where pk_id = ".$id;
		$cek = $con->query($sql);
		if(!$cek){
			mysqli_error($con);
		}
	}

	//menerima semua request di basket
	if(isset($_POST['basket'])){
		echo'<button type="button" class="close" data-dismiss="modal" style="outline: none; margin-right: 2%">&times;</button><br>

				<center><div class= "Modal_Table_Container" style="margin: -40px 0 0 -24px; width: 1300px; height: 650px;">

					<br><center><div class="text-center" style="font-size: 25px; color: white; font-weight: 500;">CENTRAL ORDER-LIST</div><br></center>

						<div class="d-flex justify-content-center"><input type="text" onkeyup="searchbasket()" id="search_Detail" class="form-control" aria-label="Default" placeholder="Search" style="margin-top: -15px; margin-left: -10px; margin-bottom: 20px;"></div>

						<div id="Modal_Detail_Table" style="max-height: 500px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
										<th style="width: 25%;">Item</th>
										<th style="width: 20%">Info</th>
										<th style="width: 15%">Qty</th>
										<th style="width: 15%">T_ID</th>
										<th style="width: 25%">Health Center</th>
									</tr>
								</thead>

								<tbody class="text-center" id="body">';
									
								$sql = "select distinct t.trans_id from transaksi t
									join detail_transaksi dt on dt.id_transaksi = t.trans_id
									where lower(t.status) = 'on going' and dt.buy = 0 and lower(dt.approval) = 'yes'";
								$execute = mysqli_query($con, $sql);
								while($row = mysqli_fetch_array($execute)){
									$s = "select t.trans_id, s.id_stock, dt.jumlah as jumtrans, s.satuan as satstock, i.nama as namaitem, i.jumlah as jumitem, i.satuan as satitem, pk.nama as pk from detail_transaksi dt
										join stock s on s.id_stock = dt.id_stock
										join item i on s.id_item = i.id_item
										join transaksi t on t.trans_id = dt.id_transaksi
										join admin a on t.admin_id = a.admin_id 
										join pusat_kesehatan pk on pk.pk_id = a.pk_id
										where t.trans_id = ".$row['trans_id']." group by t.trans_id";
									$j = mysqli_query($con, $s);
									while($r = mysqli_fetch_array($j)){
										echo '<tr>
											<td>'.$r['namaitem'].'</td>   
											<td>'.$r['jumitem'].' '.$r['satitem'].'</td> 
											<td>'.$r['jumtrans'].' '.$r['satstock'].'</td>
											<td>'.$row['trans_id'].'</td> 
											<td>'.$r['pk'].'</td>  
										</tr>';
									}
								}
								echo '</tbody>
							</table>
						</div>

						<div class="d-flex justify-content-center"><button class="Buttonn" onclick="acceptbasket()" style="background-color: white; color: #4fbbb2;">Accept</button>
						</div>
				</div></center>';
	}

	if(isset($_POST['acceptbasket'])){ 
		//ambil basket
		$sql = "select distinct t.trans_id from transaksi t
			join detail_transaksi dt on dt.id_transaksi = t.trans_id
			where lower(t.status) = 'on going' and dt.buy = 0 and lower(dt.approval) = 'yes'";
		$execute = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($execute)){
			//ambil barang e
			$s = "select t.trans_id, t.pk_penyumbang, t.pk_provider, i.id_item, s.id_stock, dt.jumlah as jumtrans, s.jumlah as jumstock, i.nama as namaitem, i.jumlah as jumitem, i.satuan as satitem, pk.nama as pk from detail_transaksi dt
				join stock s on s.id_stock = dt.id_stock
				join item i on s.id_item = i.id_item
				join transaksi t on t.trans_id = dt.id_transaksi
				join admin a on t.admin_id = a.admin_id 
				join pusat_kesehatan pk on pk.pk_id = a.pk_id
				where t.trans_id = ".$row['trans_id']." group by t.trans_id";
			$j = mysqli_query($con, $s);
			while($r = mysqli_fetch_array($j)){
				//ditambah kurang dkk
				//kalo bukan preorder
				$exp = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));
				if($r['pk_penyumbang'] >= 1)
				{
					$find = 0;
					// echo "apapun";
					$q = "select s.id_stock as id, s.jumlah as qty, g.gudang_id, s.exp_date from stock s
						join item i on s.id_item = i.id_item
						join gudang g on g.gudang_id = s.gudang_id
						where i.id_item = ".$r['id_item']." and g.pk_id = ".$r['pk_penyumbang']." and s.jumlah >= ".$r['jumtrans'];
					$e = mysqli_query($con, $q);
					while($jalan = mysqli_fetch_array($e)){
						if($find == 0){
							$q = "UPDATE stock SET jumlah = ".$jalan['qty']."-".$r['jumtrans']." where id_stock = ".$jalan['id'];
							$cek = $con->query($q);
							if(!$cek){
								mysqli_error($con);
							}
							$find = 1;
							$exp = $jalan['exp_date'];
							// echo $exp;
						}
					}
				}

				//tambah stock
				$q = "UPDATE stock SET jumlah = ".$r['jumstock']." + ".$r['jumtrans']." , exp_date = '".$exp."' where id_stock = ".$r['id_stock'];
				$cek = $con->query($q);
				if(!$cek){
					mysqli_error($con);
				}

				$q = "UPDATE transaksi SET status = 'done' where trans_id = ".$row['trans_id'];
				$cek = $con->query($q);
				if(!$cek){
					mysqli_error($con);
				}
			}
		}
		echo 'Berhasil!';
	}
?>