<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Central_Header.php'; ?>
	<?php include 'css.php'; ?>
	<?php include "includes/connect.php"; ?>

	<!-- CODING -->
    <script type="text/javascript">

    	var ajaxcall, filter = "All", button = [1, 0];

    	function search(){
			// alert("masuk");
    		var text = document.getElementById("search_healthCenter").value;
    		var btns = document.getElementsByClassName("btnsss");
			var icon = button[0];
			$.ajax({
				url:"includes/ajaxhc.php",
				type:"POST",
				data :{
					search:text,
					icon:icon,
					kategori:filter
				},
				success:function(show){
					//alert(show);
					if(button[0] == 1)	$('#Icons').html(show);
					else $('#Tables').html(show);
				}
			});
			// alert(filter);
     	}

		function buttonMenu(category){
			// refreshData("", category);
			if(category == 0 || category == 1){
				if(button[category] == 0){
					if(category == 0){
						button[0] = 1;
						button[1] = 0;
						search();
						document.getElementById("Icons").style.display="flex";
						document.getElementById("Tables").style.display="none";
					}
					if(category == 1){
						button[0] = 0;
						button[1] = 1;
						search();
						document.getElementById("Icons").style.display="none";
						document.getElementById("Tables").style.display="inline";
					}
				}
			}
		}

		function hoverButton(category){
			if(category == 0 || category == 1){
				var btns = document.getElementsByClassName("btnsss");
				if(button[category] == 0) btns[category].style.backgroundColor="#e5e5e5";
			}
		}

		function notHoverButton(){
			var btns = document.getElementsByClassName("btnsss");

			if(button[0] == 0) btns[0].style.backgroundColor="white";
			if(button[1] == 0) btns[1].style.backgroundColor="white";
		} 

		function filterButton(parent) {
			var x = parent.children[1].children[3].innerHTML;
			$.ajax({
				url:"includes/ajaxhc.php",
				type:"POST",
				data :{
					filternama:x
				},
				success:function(show){
					$('#filter-modal-body').html(show);
				}
			});
			$('#Filter_Modal').modal('show');
		}

    	$(document).ready(function(){
			$(".dropdown-menu.dd10 a").click(function(){
				var text = $(this).text();
				$(".dropdown_btns").html($(this).text());
				filter = $(this).text();
				(function(){
					var text = document.getElementById("search_healthCenter").value;
		    		var btns = document.getElementsByClassName("btnsss");
					var icon = button[0];
					$.ajax({
						url:"includes/ajaxhc.php",
						type:"POST",
						data :{
							search:text,
							icon:icon,
							kategori:filter
						},
						success:function(show){
							//alert(show);
							if(button[0] == 1)	$('#Icons').html(show);
							else $('#Tables').html(show);
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
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Health Center </h3> 
	</div>
	<div class="d-flex justify-content-center"><input type="text" id="search_healthCenter"class="form-control" aria-label="Default" placeholder="Search" onkeyup="search()" style="margin-bottom: 5px;"></div>

	<div class="row d-flex justify-content-center">
		<button class="btnsss d-flex justify-content-center" type="button" onclick="buttonMenu(0)" onmouseover="hoverButton(0)" onmouseleave="notHoverButton()" type="button" value="Add" style="background-color: #e5e5e5;"><img src="img/Icon.png"></button>

		<button class="btnsss d-flex justify-content-center" onclick="buttonMenu(1)" onmouseover="hoverButton(1)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/List.png" style="margin-left: 2px;"></button>
	</div>

	<div class="dropdown d-flex justify-content-center" style="margin-top: -10px;">
	  	<button type="button" class="btn dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">All
	  	</button>
	 	<div class="dropdown-menu dd10 text-center" id="filterkategori">
	 		<?php 
				echo '<a class="dropdown-item" value="all">All</a>';

				$q = "select * from kategori_pk";
				$kat = mysqli_query($con, $q);
				while($rows = mysqli_fetch_array($kat))
				{
					echo '<a class="dropdown-item" value="'.$rows['nama'].'">'.$rows['nama'].'</a>';
				}
			?>
	  	</div>
	</div>

	<!-- LIST DATA -->
	<div class="container-fluid row justify-content-center" id="Icons" style="margin-left: 0px;">

		<?php 
			$sql = "select * from  pusat_kesehatan order by kategori_id asc";
			$pk = mysqli_query($con, $sql);
			while($row = mysqli_fetch_array($pk))
			{ 
				$q = "select nama from kategori_pk where kategori_id = ".$row['kategori_id'];
				$kat = mysqli_query($con, $q);
				while($rows = mysqli_fetch_array($kat))
				{ 
					$kategori = $rows['nama'];
				}
				echo '<div class="iconn container d-flex justify-content-center">
					<img class="Image_HealthCenter" src="img/Health Center/'.$row['image'].'">
					<div class="data container-fluid" style="margin-left: -3px;">
						<span class="HealthCenter_Type">'.$kategori.'</span>
						<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
						<br>
						<span class="Name_HealthCenter">'.$row['nama'].'</span><br>
						<span class="Address_HealthCenter">'.$row['alamat'].'</span><br>
						<span class="Telepon_HealthCenter">'.$row['no_telp'].'</span>
						<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
					</div>
					<button class="Filter_HealthCenter" onclick="filterButton(this.parentElement)"></button>
				</div>';		
			}
		?>
	</div>

	<!-- TABLES -->
	<div id="Tables" style="display: none;">
		<?php 
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
					$sql = "select * from  pusat_kesehatan order by kategori_id asc";
					$pk = mysqli_query($con, $sql);
					while($row = mysqli_fetch_array($pk))
					{ 
						echo "<tr>";

						$q = "select nama from kategori_pk where kategori_id = ".$row['kategori_id'];
						$kat = mysqli_query($con, $q);
						while($rows = mysqli_fetch_array($kat))
						{ 
							echo "<td>".$rows['nama']."</td>";
						}
						echo "<td>".$row['nama']."</td>";
						echo "<td>".$row['alamat']."</td>";
						echo "<td>".$row['no_telp']."</td>";

						echo "</tr>";
					}
				echo "</tbody>
				</table>";
		?>
	</div>

	<!-- PAGES -->
	<br><div class="container d-flex justify-content-center">
		<!-- <button type="button" class="btn btnPage">Prev</button> -->
		<button type="button" class="btn btnPage" style="background-color: rgb(220,220,220);">1</button>
		<!-- <button type="button" class="btn btnPage">2</button>
		<button type="button" class="btn btnPage">3</button>
		<button type="button" class="btn btnPage">Next</button> -->
	</div><br>

	<!-- SIDE NAV -->
	<div class="sidenav" id="mySidenav">
         <a href="#" id="SideNav_StockHouse" data-toggle="modal" data-target="#Warehouse_Modal"><img src="img/Stock_House.png"
         width="44" height="44" style="padding-bottom: 5px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px;">&nbsp;Ware House</b></a>
	</div>


	<!-- FILTER MODAL -->
	<div class="modal modalmodal" id="Filter_Modal" role="dialog" style="top: 20%;">
	    <div class="modal-dialog d-flex justify-content-center">

	      <div class="modal-content" style="margin: auto; border: none; height: 400px;">
	        <div class="modal-body" id="filter-modal-body">
	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- WARE HOUSE MODAL -->
	<div class="modal modalmodal" id="Warehouse_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;" onclick="modalwarehouse()">&times;</button><br>

					<div class="Modal_Table_Container" style="margin: -40px 0 0 -24px; width: 1300px; height: 650px;" id="modal-warehouse">
						<br><div class="text-center" style="font-size: 25px; color: white; font-weight: 500;">WARE HOUSE</div><br>

						<div class="d-flex justify-content-center">
							<input type="text" id="search_Stock" class="form-control" aria-label="Default" placeholder="Search" style="margin-top: -15px; margin-left: -10px; margin-bottom: 20px;">
						</div>

						<div id="Modal_Detail_Table" style="max-height: 500px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
										<th style="width: 20%;">Health Center</th>
										<th style="width: 15%;">Warehouse Name</th>
										<th style="width: 15%">Warehouse Address</th>
										<th style="width: 15%">Warehouse Number</th>
									</tr>
								</thead>

								<tbody class="text-center" id="body">
									<?php
										$z = "select * from gudang order by pk_id asc";
										$x = mysqli_query($con, $z);
										while($a = mysqli_fetch_array($x)){ 
											echo '<tr>';
												$sql = "select * from pusat_kesehatan where pk_id = ".$a['pk_id'];
												$pk = mysqli_query($con, $sql);
												$row = mysqli_fetch_assoc($pk);
												$nama =  $row['nama'];
		
												echo '<td>'.$nama.'</td>';
												echo '<td>'.$a['nama'].'</td>';
												echo '<td>'.$a['alamat'].'</td>';
												echo '<td>'.$a['no_telp'].'</td>';
											echo '</tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					
					</div>
				</div>
	        </div>
	      </div>
	      
	    </div>
	</div>
</body>

</html>