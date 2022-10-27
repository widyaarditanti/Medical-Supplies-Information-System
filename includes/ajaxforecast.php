<?php 
    session_start();
	include "connect.php";
	
	//refresh data forecast berdasarkan kategori maupun search
	if(isset($_POST['kategori'])){
        // echo $_POST['kategori'];
		$nama=$_POST['search'];
		$kategori = $_POST['kategori']; 

		// $pkid = 4;
		echo '<thead>
			<tr style="text-align: center;">
				<th style="width: 15%;">ID_Item</th>
				<th style="width: 35%;">Item</th>
				<th style="width: 20%">Quantity</th>
				<th style="width: 20%">Forecast</th>
			</tr>
		</thead>

		<tbody class="text-center" id="body">';

		if($_POST['kategori'] == 'Master Health Center'){
			$s = "select pk_id from admin where kategori_id = 1";
			$j = mysqli_query($con, $s);
			$pk = mysqli_fetch_array($j);
			$pkid = $pk['pk_id'];
			if($nama != ''){
				$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
					join stock s on s.id_item = i.id_item 
					where s.gudang_id in (select distinct g.gudang_id from gudang g
						join pusat_kesehatan pk on pk.pk_id = g.pk_id
						where pk.pk_id = ".$pkid.")
					and i.nama like '%".$nama."%'
					group by s.id_item;";
				$jalan = mysqli_query($con, $sql);
				while($item = mysqli_fetch_array($jalan)){
					echo ' <tr>
						<td>'.$item["id_item"].'</td>
						<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
						<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
						$day = 10;
						// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
						$sqls = "select sum(dt.jumlah) as sum from detail_transaksi dt 
							join transaksi t on t.trans_id = dt.id_transaksi 
							join kategori_transaksi k on k.id = t.kategori_transaksi 
							where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
							group by dt.id_stock";
						$jalans = mysqli_query($con, $sqls);
						$jums = mysqli_fetch_array($jalans);
						$jum = $jums['sum'];

						if($item['sums'] == 0)
							echo '<td style="color: red"> 0 day </td>';
						else if(!isset($jum) || $jum <= 0)
							echo '<td style="color: green"> 10 days</td>';
						else{
							$day = floor($item['sums'] / $jum);
							if($day <= 1)
								echo '<td style="color: red">'.$day.' day</td>';
							else if($day <= 2)
								echo '<td style="color: red">'.$day.' days</td>';
							else if ($day <= 7)
								echo '<td style="color: #e5c100">'.$day.' days</td>';
							else if ($day > 8)
								echo '<td style="color: green">'.$day.' days </td>';
						}
					echo '</tr>';
				}
			}
			else
			{
				$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
					join stock s on s.id_item = i.id_item 
					where s.gudang_id in (select distinct g.gudang_id from gudang g
						join pusat_kesehatan pk on pk.pk_id = g.pk_id
						where pk.pk_id = ".$pkid.")
					group by s.id_item;";
				$jalan = mysqli_query($con, $sql);
				while($item = mysqli_fetch_array($jalan)){
					echo ' <tr>
						<td>'.$item["id_item"].'</td>
						<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
						<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
						$day = 10;
						// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
						$sqls = "select sum(dt.jumlah) as sum from detail_transaksi dt 
							join transaksi t on t.trans_id = dt.id_transaksi 
							join kategori_transaksi k on k.id = t.kategori_transaksi 
							where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
							group by dt.id_stock";
						$jalans = mysqli_query($con, $sqls);
						$jums = mysqli_fetch_array($jalans);
						$jum = $jums['sum'];

						if($item['sums'] == 0)
							echo '<td style="color: red"> 0 day </td>';
						else if(!isset($jum) || $jum <= 0)
							echo '<td style="color: green"> 10 days</td>';
						else{
							$day = floor($item['sums'] / $jum);
							if($day <= 1)
								echo '<td style="color: red">'.$day.' day</td>';
							else if($day <= 2)
								echo '<td style="color: red">'.$day.' days</td>';
							else if ($day <= 7)
								echo '<td style="color: #e5c100">'.$day.' days</td>';
							else if ($day > 8)
								echo '<td style="color: green">'.$day.' days </td>';
						}
					echo '</tr>';
				}
			}
		}
		else if($_POST['kategori'] == 'Central Health Center'){
			$s = "select pk_id from admin where kategori_id = 3";
			$j = mysqli_query($con, $s);
			$pk = mysqli_fetch_array($j);
			$pkid = $pk['pk_id'];
			if($nama != ''){
				//ikan hiu makan tomat, yang ada disitu semangat !
				$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
					join stock s on s.id_item = i.id_item 
					where s.gudang_id in (select distinct g.gudang_id from gudang g
						join pusat_kesehatan pk on pk.pk_id = g.pk_id 
						join admin a on pk.pk_id = a.pk_id 
						join kategori_admin ka on ka.kategori_id = a.kategori_id 
						where ka.nama = 'pusat')
					and i.nama like '%".$nama."%'
					group by s.id_item";
				$jalan = mysqli_query($con, $sql);
				while($item = mysqli_fetch_array($jalan)){
					echo ' <tr>
						<td>'.$item["id_item"].'</td>
						<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
						<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
					$day = 10;
					// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
					$sqls = "select sum(dt.jumlah) as sums from detail_transaksi dt 
						join transaksi t on t.trans_id = dt.id_transaksi 
						join kategori_transaksi k on k.id = t.kategori_transaksi 
						where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
						group by dt.id_stock";
					$jalans = mysqli_query($con, $sqls);
					$jum = mysqli_fetch_array($jalans);

					$q = "select sum(dt.jumlah) as sums from detail_transaksi dt 
						join transaksi t on t.trans_id = dt.id_transaksi 
						join kategori_transaksi k on k.id = t.kategori_transaksi 
						where t.tanggal > sysdate()-7 and t.status = 'done' and dt.approval = 'yes' and dt.id_stock = ".$row['id_stock']." group by dt.id_stock";
					$ex = mysqli_query($con, $q);
					$jumreq = mysqli_fetch_array($ex);

					$jum = $jum['sums'] + $jumreq['sums'];

					if($item['sums'] == 0)
						echo '<td style="color: red"> 0 day </td>';
					else if(!isset($jum) || $jum <= 0)
						echo '<td style="color: green"> 10 days</td>';
					else{
						$day = floor($item['sums'] / $jum);
						if($day <= 1)
							echo '<td style="color: red">'.$day.' day</td>';
						else if($day <= 2)
							echo '<td style="color: red">'.$day.' days</td>';
						else if ($day <= 7)
							echo '<td style="color: #e5c100">'.$day.' days</td>';
						else if ($day > 8)
							echo '<td style="color: green">'.$day.' days </td>';
					}
					echo '</tr>';
				}
			}
			else
			{
				$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
					join stock s on s.id_item = i.id_item 
					where s.gudang_id in (select distinct g.gudang_id from gudang g
						join pusat_kesehatan pk on pk.pk_id = g.pk_id 
						join admin a on pk.pk_id = a.pk_id 
						join kategori_admin ka on ka.kategori_id = a.kategori_id 
						where ka.nama = 'pusat')
					group by s.id_item";
				$jalan = mysqli_query($con, $sql);
				while($item = mysqli_fetch_array($jalan)){
					echo ' <tr>
						<td>'.$item["id_item"].'</td>
						<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
						<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
					$day = 10;
					// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
					$sqls = "select sum(dt.jumlah) as sums from detail_transaksi dt 
						join transaksi t on t.trans_id = dt.id_transaksi 
						join kategori_transaksi k on k.id = t.kategori_transaksi 
						where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
						group by dt.id_stock";
					$jalans = mysqli_query($con, $sqls);
					$jum = mysqli_fetch_array($jalans);

					$q = "select sum(dt.jumlah) as sums from detail_transaksi dt 
						join transaksi t on t.trans_id = dt.id_transaksi 
						join kategori_transaksi k on k.id = t.kategori_transaksi 
						where t.tanggal > sysdate()-7 and t.status = 'done' and dt.approval = 'yes' and dt.id_stock = ".$row['id_stock']." group by dt.id_stock";
					$ex = mysqli_query($con, $q);
					$jumreq = mysqli_fetch_array($ex);

					$jum = $jum['sums'] + $jumreq['sums'];

					if($item['sums'] == 0)
						echo '<td style="color: red"> 0 day </td>';
					else if(!isset($jum) || $jum <= 0)
						echo '<td style="color: green"> 10 days</td>';
					else{
						$day = floor($item['sums'] / $jum);
						if($day <= 1)
							echo '<td style="color: red">'.$day.' day</td>';
						else if($day <= 2)
							echo '<td style="color: red">'.$day.' days</td>';
						else if ($day <= 7)
							echo '<td style="color: #e5c100">'.$day.' days</td>';
						else if ($day > 8)
							echo '<td style="color: green">'.$day.' days </td>';
					}
					echo '</tr>';
				}
			}
		}
		else {
			$s = "select pk_id from pusat_kesehatan where nama = '".$kategori."'";
			$j = mysqli_query($con, $s);
			$pk = mysqli_fetch_array($j);
			$pkid = $pk['pk_id'];
			if($nama != ''){
				$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
					join stock s on s.id_item = i.id_item 
					where s.gudang_id in (select distinct g.gudang_id from gudang g
						join pusat_kesehatan pk on pk.pk_id = g.pk_id
						where pk.pk_id = ".$pkid.")
					and i.nama like '%".$nama."%'
					group by s.id_item;";
				$jalan = mysqli_query($con, $sql);
				while($item = mysqli_fetch_array($jalan)){
					echo ' <tr>
						<td>'.$item["id_item"].'</td>
						<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
						<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
						$day = 10;
						// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
						$sqls = "select sum(dt.jumlah) as sum from detail_transaksi dt 
							join transaksi t on t.trans_id = dt.id_transaksi 
							join kategori_transaksi k on k.id = t.kategori_transaksi 
							where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
							group by dt.id_stock";
						$jalans = mysqli_query($con, $sqls);
						$jums = mysqli_fetch_array($jalans);
						$jum = $jums['sum'];

						if($item['sums'] == 0)
							echo '<td style="color: red"> 1 day </td>';
						else{
							$day = floor($item['sums'] / $jum);
							if($day <= 1)
								echo '<td style="color: red">'.$day.' day</td>';
							else if($day <= 2)
								echo '<td style="color: red">'.$day.' days</td>';
							else if ($day <= 7)
								echo '<td style="color: #e5c100">'.$day.' days</td>';
							else if ($day > 8)
								echo '<td style="color: green">'.$day.' days </td>';
						}
					echo '</tr>';
				}
			}
			else
			{
				$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
					join stock s on s.id_item = i.id_item 
					where s.gudang_id in (select distinct g.gudang_id from gudang g
						join pusat_kesehatan pk on pk.pk_id = g.pk_id
						where pk.pk_id = ".$pkid.")
					group by s.id_item;";
				$jalan = mysqli_query($con, $sql);
				while($item = mysqli_fetch_array($jalan)){
					echo ' <tr>
						<td>'.$item["id_item"].'</td>
						<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
						<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
					$day = 10;
					// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
					$sqls = "select sum(jumlah) as sums from detail_transaksi dt 
						join transaksi t on t.trans_id = dt.id_transaksi 
						join kategori_transaksi k on k.id = t.kategori_transaksi 
						where dt.id_transaksi in 
							(select t.trans_id from transaksi t 
							join kategori_transaksi k on k.id = t.kategori_transaksi 
							where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$item['idstock']."
                        group by dt.id_stock";
					$jalans = mysqli_query($con, $sqls);
					$jum = mysqli_fetch_array($jalans);
					if($item['sums'] == 0)
						echo '<td style="color: red"> 1 day </td>';
					else if(!isset($jum['sums']) || $jum['sums'] <= 0)
						echo '<td style="color: green"> 10 days</td>';
					else{
						$day = floor($item['sums'] / $jum['sums']);
						if($day <= 1)
							echo '<td style="color: red">'.$day.' day</td>';
						else if($day <= 2)
							echo '<td style="color: red">'.$day.' days</td>';
						else if ($day <= 7)
							echo '<td style="color: #e5c100">'.$day.' days</td>';
						else if ($day > 8)
							echo '<td style="color: green">'.$day.' days </td>';
					}
					echo '</tr>';
				}
			}
		}
	}

    //forecast milik Health Center Lokal
	if(isset($_POST['kat'])){
        echo '<thead>
			<tr style="text-align: center;">
				<th style="width: 15%;">ID_Item</th>
				<th style="width: 35%;">Item</th>
				<th style="width: 20%">Quantity</th>
				<th style="width: 20%">Forecast</th>
			</tr>
		</thead>

		<tbody class="text-center" id="body">';

        $pkid = $_SESSION['pk_id'];;
        $nama = $_POST['search'];
		$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
			join stock s on s.id_item = i.id_item 
			where s.gudang_id in (select distinct g.gudang_id from gudang g
				join pusat_kesehatan pk on pk.pk_id = g.pk_id
				where pk.pk_id = ".$pkid.")
			and i.nama like '%".$nama."%'
			group by s.id_item;";
		$jalan = mysqli_query($con, $sql);
		while($item = mysqli_fetch_array($jalan)){
			echo ' <tr>
				<td>'.$item["id_item"].'</td>
				<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
				<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
					
			$day = 10;
			// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
			$sqls = "select sum(jumlah) as sums from detail_transaksi dt 
				join transaksi t on t.trans_id = dt.id_transaksi 
				join kategori_transaksi k on k.id = t.kategori_transaksi 
				where dt.id_transaksi in 
					(select t.trans_id from transaksi t 
					join kategori_transaksi k on k.id = t.kategori_transaksi 
					where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$item['idstock']."
                group by dt.id_stock";
			$jalans = mysqli_query($con, $sqls);
			$jum = mysqli_fetch_array($jalans);

			if($item['sums'] == 0)
				echo '<td style="color: red"> 0 day </td>';
			else if(!isset($jum['sums']) || $jum['sums'] <= 0)
				echo '<td style="color: green"> 10 days</td>';
			else{
				$day = floor($item['sums'] / $jum['sums']);
				if($day <= 1)
					echo '<td style="color: red">'.$day.' day</td>';
				else if($day <= 2)
					echo '<td style="color: red">'.$day.' days</td>';
				else if ($day <= 7)
					echo '<td style="color: #e5c100">'.$day.' days</td>';
				else if ($day > 8)
					echo '<td style="color: green">'.$day.' days </td>';
			}
			echo '</tr>';
		}
	}

	//Mengupdate Forecast
	if(isset($_POST['update'])){
		$sql = "select distinct s.*, ka.nama as admin, pk.pk_id from stock s 
			join gudang g on g.gudang_id = s.gudang_id 
			join pusat_kesehatan pk on pk.pk_id = g.pk_id 
			join admin a on a.pk_id = pk.pk_id 
			join kategori_admin ka on ka.kategori_id = a.kategori_id 
			group by s.id_item, pk.pk_id";
		$jalan = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($jalan)){
			$day = 10;
			$jum = 0;
			if($row['admin'] == 'pusat'){
				$jumsum = 0;
				$jumr = 0;
				$sqls = "select sum(dt.jumlah) as sums from detail_transaksi dt 
					join transaksi t on t.trans_id = dt.id_transaksi 
					join kategori_transaksi k on k.id = t.kategori_transaksi 
					where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
					group by dt.id_stock";
				$jalans = mysqli_query($con, $sqls);
				while($jums = mysqli_fetch_array($jalans)) $jumsum = $jums['sums'];

				$q = "select sum(dt.jumlah) as sums from detail_transaksi dt 
					join transaksi t on t.trans_id = dt.id_transaksi 
					join kategori_transaksi k on k.id = t.kategori_transaksi 
					where t.tanggal > sysdate()-7 and t.status = 'done' and dt.approval = 'yes' and dt.id_stock = ".$row['id_stock']." group by dt.id_stock";
				$ex = mysqli_query($con, $q);
				while($jumreq = mysqli_fetch_array($ex)) $jumr = $jumreq['sums'];
				
				$jum = $jumsum + $jumr;
			}
			else{
				$sqls = "select sum(dt.jumlah) as sum from detail_transaksi dt 
					join transaksi t on t.trans_id = dt.id_transaksi 
					join kategori_transaksi k on k.id = t.kategori_transaksi 
					where k.nama = 'Use' and t.tanggal > sysdate()-7 and dt.id_stock = ".$row['id_stock']."
					group by dt.id_stock";
				$jalans = mysqli_query($con, $sqls);
				while($jums = mysqli_fetch_array($jalans)) $jum = $jums['sum'];
			}

			
			if($jum == 0){ 
				echo "10 ".$row['id_item']."   ".$row['pk_id']. " 	";
				$sql = "UPDATE forecast SET forecast_day = 10 where item_id = ".$row['id_item']." and pk_id = ".$row['pk_id'];
				$cek = $con->query($sql);
				if($cek){
					mysqli_error($con);
				}
			}
			else{ 
				echo $day." ";
				$day = floor($row['jumlah'] / $jum);
				$sql = "UPDATE forecast SET forecast_day = ".$day." where item_id = ".$row['id_item']." and pk_id = ".$row['pk_id'];
				$cek = $con->query($sql);
				if($cek){
					mysqli_error($con);
				}
			}
		}
	}
?>