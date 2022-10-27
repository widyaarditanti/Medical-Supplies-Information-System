<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Central_Header.php'; ?>
	<?php include 'css.php'; ?>
	<?php include 'includes/connect.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">
		var cari = 2, filter = "Central Health Center";

    	function search()
    	{
    		// alert(filter);
    		var text = document.getElementById("search").value;
    		$.ajax({
				url:"includes/ajaxforecast.php",
				type:"POST",
				data :{
					search:text,
					kategori:filter
				},
				success:function(show){
					// alert(show);
					$('#table').html(show);					
				}
			});
    	}

    	$(document).ready(function(){
			var text = document.getElementById("search").value;
    		$.ajax({
				url:"includes/ajaxforecast.php",
				type:"POST",
				data :{
					search:text,
					kategori:filter
				},
				success:function(show){
					// alert(show);
					$('#table').html(show);					
				}
			});

    		$.ajax({
				url:"includes/ajaxforecast.php",
				type:"POST",
				data :{
					update:true
				},
				success:function(show){
					// alert(show);			
				}
			});
			
			$(".dropdown-menu.dd1 a").click(function(){
				// alert(filter);
				filter = $(this).text();
				// alert(text);
				$(".btn1:first-child").html($(this).text());
				(function(){
					var search = document.getElementById("search").value;
					$.ajax({
						url:"includes/ajaxforecast.php",
						type:"POST",
						data :{
							search: search,
							kategori: filter
						},
						success:function(show){
							// alert(show);
							$('#table').html(show);
						}
					});
				})();
			});
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Item Forecasting </h3> 
	</div>
	<div class="d-flex justify-content-center"><input type="text" id="search"class="form-control" aria-label="Default" placeholder="Search" onkeyup="search()"></div>

	<div class="dropdown d-flex justify-content-center">
	  	<button type="button" class="btn btn1 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="width: 300px;">Central Health Center
	  	</button>
	 	<div class="dropdown-menu dd1 text-center" style="width: 300px; margin-left: 0px;">
	    	<?php
				$sql = "select * from pusat_kesehatan";
				$jalan = mysqli_query($con, $sql);
				while($row = mysqli_fetch_array($jalan)){
					if($row['pk_id'] == 1)
						echo '<a class="dropdown-item" value="'.$row['pk_id'].'">Master Health Center</a>';
					else if($row['pk_id'] == 2)
						echo '<a class="dropdown-item" value="'.$row['pk_id'].'">Central Health Center</a>';
					else 
						echo '<a class="dropdown-item" value="'.$row['pk_id'].'">'.$row['nama'].'</a>';
				}
			?>
	  	</div>
	</div>

	<table class="container table table-striped table-borderless table-sm" id="table" style="font-size: 13px;">
		<?php
			// echo '<thead>
			// 	<tr style="text-align: center;">
			// 		<th style="width: 15%;">ID_Item</th>
			// 		<th style="width: 35%;">Item</th>
			// 		<th style="width: 20%">Quantity</th>
			// 		<th style="width: 20%">Forecast</th>
			// 	</tr>
			// </thead>

			// <tbody class="text-center" id="body">';
			// 	$sql = "select i.*, sum(s.jumlah) as sums, s.satuan as satuanstock, s.id_stock as idstock from item i
			// 		join stock s on s.id_item = i.id_item 
			// 		where s.gudang_id in (select distinct g.gudang_id from gudang g
			// 			join pusat_kesehatan pk on pk.pk_id = g.pk_id 
			// 			join admin a on pk.pk_id = a.pk_id 
			// 			join kategori_admin ka on ka.kategori_id = a.kategori_id 
			// 			where ka.nama = 'pusat')
			// 		group by s.id_item";
			// 	$jalan = mysqli_query($con, $sql);
			// 	while($item = mysqli_fetch_array($jalan)){
			// 		echo ' <tr>
			// 			<td>'.$item["id_item"].'</td>
			// 			<td>'.$item["nama"].' '.$item["jumlah"].' '.$item["satuan"].'</td>
			// 			<td>'.$item["sums"].' '.$item["satuanstock"].'</td>';
						
			// 			$day = 10;
			// 			// ambil detail trans buat pusat (status done, aprroval yes sama udah di use
			// 			$sqls = "select sum(jumlah) as sums from detail_transaksi dt 
			// 				join transaksi t on t.trans_id = dt.id_transaksi 
			// 				join kategori_transaksi k on k.id = t.kategori_transaksi 
			// 				where (dt.id_transaksi in 
			// 					(select t.trans_id from transaksi t 
			// 					join kategori_transaksi k on k.id = t.kategori_transaksi 
			// 					where t.admin_id in 
			// 						(select a.admin_id from admin a 
			// 						join kategori_admin ka on ka.kategori_id = a.kategori_id 
			// 						where ka.nama = 'pusat') 
			// 					and t.status = 'done') 
			// 				and dt.approval = 'yes') 
			// 				or (dt.id_transaksi in 
			// 					(select t.trans_id from transaksi t 
			// 					join kategori_transaksi k on k.id = t.kategori_transaksi 
			// 					where t.admin_id in 
			// 						(select a.admin_id from admin a 
			// 						join kategori_admin ka on ka.kategori_id = a.kategori_id 
			// 						where ka.nama = 'pusat') 
			// 					and k.nama = 'Use')) 
			// 				group by id_stock 
			// 				having dt.id_stock = ".$item['idstock'];
			// 			$jalans = mysqli_query($con, $sqls);
			// 			$jum = mysqli_fetch_array($jalans);

			// 			if(!isset($jum['sums']) || $jum['sums'] <= 0)
			// 			echo '<td style="color: green"> 10 days</td>';
			// 			else{
			// 				$day = floor($item['sums'] / $jum['sums']);
			// 				if($day <= 2)
			// 					echo '<td style="color: red">'.$day.'</td>';
			// 				else if ($day <= 7)
			// 					echo '<td style="color: #e5c100">'.$day.'</td>';
			// 				else if ($day > 8)
			// 					echo '<td style="color: green">'.$day.'</td>';
			// 			}
			// 		echo '</tr>';
			// 	}
			?>
		</tbody>
	</table>

	<div class="container d-flex justify-content-center">
		<!-- <button type="button" class="btn btnPage">Prev</button> -->
		<button type="button" class="btn btnPage" style="background-color: rgb(220,220,220);">1</button>
		<!-- <button type="button" class="btn btnPage">2</button>
		<button type="button" class="btn btnPage">3</button>
		<button type="button" class="btn btnPage">Next</button> -->
	</div>

	<style type="text/css">
		.table{
			background-color: white;
			border-radius: 20px;
			color: #182936;
			border-color: white;
			border-width: 3px;
			width: 1500px;
		}
		.table thead{
			border-radius: 20px 20px 0px 0px;
			font-size: 16px;
		}
		.table tbody{
			border: none;
			font-weight: bold;
			width: 100%;
		}
		.table tbody tr{
			border: none;
		}
	</style>
</body>
</html>