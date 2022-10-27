<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Master_Header.php'; ?>
	<?php include 'css.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">

    	var ajaxcall, button = [1, 0, 0, 0, 0], filter = "All", editid;

    	function search(){
			// alert(<?php echo $_SESSION['pk_id']?>);
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
			if(category == 2 || category == 3 || category == 4){
				var btns;
				if(category == 3) btns= document.getElementsByClassName("edit_but");
				if(category == 4) btns= document.getElementsByClassName("delete_but");
				
				for(var i = 0; i < btns.length; i++){
					if(btns[i].style.display == "none") btns[i].style.display="inline";
					else btns[i].style.display="none";
				}

				
				if(button[category] == 0) button[category] = 1;
				else {
					button[category] = 0;
				}

			}
			else if(category == 0 || category == 1){
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
			if(category == 0 || category == 1 || category == 2 || category == 3 || category == 4){
				var btns = document.getElementsByClassName("btnsss");
				if(button[category] == 0) btns[category].style.backgroundColor="#e5e5e5";
			}
		}

		function notHoverButton(){
			var btns = document.getElementsByClassName("btnsss");

			if(button[0] == 0) btns[0].style.backgroundColor="white";
			if(button[1] == 0) btns[1].style.backgroundColor="white";
			if(button[2] == 0) btns[2].style.backgroundColor="white";
			if(button[3] == 0) btns[3].style.backgroundColor="white";
			if(button[4] == 0) btns[4].style.backgroundColor="white";
		} 

		function filterButton(parent) {
			// alert();
			var x = parent.children[1].children[3].innerHTML;
			$.ajax({
				url:"includes/ajaxhc.php",
				type:"POST",
				data :{
					filternama:x
				},
				success:function(show){
					// alert(show);
					$('#filter-modal-body').html(show);
				}
			});
			$('#Filter_Modal').modal('show');
		}

		function editButton(parent, id){
			document.getElementById("modal_kategori").innerHTML = parent.children[0].innerHTML;
			document.getElementById("modal_name").value = parent.children[3].innerHTML;
			document.getElementById("modal_address").value = parent.children[5].innerHTML;
			document.getElementById("modal_telephone").value = parent.children[7].innerHTML;
			editid = id;
		}

		function deleteButton(parent, id){
			document.getElementById("delete_name").innerHTML = parent.children[3].innerHTML;
			deleteid = id;
		}

    	$(document).ready(function(){
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

			$(".dropdown-menu.dd0 a").click(function(){
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

			//add data
			$(document).on("click", "#Add_HC", function(){
				var nama = document.getElementById("Form_Name").value;
				var alamat = document.getElementById("Form_Address").value;
				var nomer = document.getElementById("Form_Number").value;
				var kategori = $('.butkat').val();
				// alert(kategori);

				var fd = new FormData();
				var files = $('#file')[0].files;

				if(files.length > 0){
					fd.append('file',files[0]);
					fd.append('nama',nama);
					fd.append('alamat',alamat);
					fd.append('nomer',nomer);
					fd.append('kategori',kategori);
					fd.append('addhc', true);

					$.ajax({
				    	url:"includes/ajaxhc.php",
				        type:"POST",
						data:fd,
						contentType: false,
						processData: false,
						success:function(result){
							$("#state-success").html("Succeed to Add <b>"+ name +"</b> Health Center");
							$("#Delete_Modal").modal("hide");
							$("#Add_Edit_Delete_Modal_After").modal('show');
							search();
							// alert(result);
						},
		      			error:function(xhr,textStatus,errorThrown){
							var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
							alert(err);
					    }
					});
				}
				else{
					alert("Please select a file");
				}
				search();
			});

			//Edit HC
			$(document).on("click", "#Edit_HC", function(){
				var nama = document.getElementById("modal_name").value;
				var alamat = document.getElementById("modal_address").value;
				var nomer = document.getElementById("modal_telephone").value;
				var kategori = document.getElementById("modal_kategori").innerHTML;
				// alert(kategori);
				// alert();
				var edit = true;
				var id = editid;

				// alert(id);
				var fd = new FormData();
				var files = $('#file_edit')[0].files;

				if(files.length > 0){
					var adafile = true;
					fd.append('file',files[0]);
				}
				else{
					var adafile = false;
				}
				fd.append('adafile', adafile);
				fd.append('nama',nama);
				fd.append('alamat',alamat);
				fd.append('nomer',nomer);
				fd.append('edit',true);
				fd.append('kategori',kategori);
				fd.append('id',id);

				$.ajax({
			    	url:"includes/ajaxhc.php",
			        type:"POST",
					data:fd,
					contentType: false,
					processData: false,
					success:function(result){
						$("#state-success").html("Succeed to Add <b>"+ name +"</b> Health Center");
						$("#Edit_Modal").modal("hide");
						$("#Add_Edit_Delete_Modal_After").modal('show');
						search();
					},
	      				error:function(xhr,textStatus,errorThrown){
						var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
						alert(err);
				      	}
				});
			});

			//delete data
			$(document).on("click", "#Delete_HC", function(){
				var id = deleteid;
				// alert(id);

				$.ajax({
					url:"includes/ajaxhc.php",
					type:"POST",
					data :{
						id:id,
						delete:true
					},
					success:function(show){
						$("#state-success").html("Succeed to Delete <b>"+ name +"</b> Health Center");
						$("#Delete_Modal").modal("hide");
						$("#Add_Edit_Delete_Modal_After").modal('show');
						search();
						// alert(show);
					}
				});
			});

			$(".dropdown-menu.dd1 a").click(function(){
				$(".btn1:first-child").html($(this).text());
			});

			$(".dropdown-menu.dd2 a").click(function(){
				$(".btn2:first-child").html($(this).text());
			});
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Health Center </h3> 
	</div>
	<div class="d-flex justify-content-center"><input type="text" id="search_healthCenter"class="form-control" aria-label="Default" placeholder="Search" onkeyup="search()"></div>

	<!-- ADD, EDIT, DELETE, FILTER -->
	<div class="row d-flex justify-content-center" style="margin-left: -16px;">
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<button class="btnsss d-flex justify-content-center" type="button" onclick="buttonMenu(0)" onmouseover="hoverButton(0)" onmouseleave="notHoverButton()" type="button" value="Add" style="background-color: #e5e5e5;"><img src="img/Icon.png"></button>

		<button class="btnsss d-flex justify-content-center" onclick="buttonMenu(1)" onmouseover="hoverButton(1)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/List.png" style="margin-left: 2px;"></button>

		<div class="mx-2" style="width: 5px; height: 40px; background-color: white; border-radius: 10px; margin-top: 8px;"></div>

		<button class="btnsss Add_Button d-flex justify-content-center" type="button" data-toggle="modal" data-target="#Add_Modal" onmouseover="hoverButton(2)" onmouseleave="notHoverButton()" type="button" value="Add"><img src="img/add.png"></button>

		<button class="btnsss Edit_Button d-flex justify-content-center" onclick="buttonMenu(3)" onmouseover="hoverButton(3)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/edit.png" style="margin-left: 2px;"></button>

		<button class="btnsss Delete_Button d-flex justify-content-center" onclick="buttonMenu(4)" onmouseover="hoverButton(4)" onmouseleave="notHoverButton()" type="button" value="Delete"><img src="img/delete.png" style="width: 14px; height: 14px; margin-top: 7.5px;"></button>
	</div>

	<div class="dropdown d-flex justify-content-center">
	  	<button type="button" class="btn dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">All
	  	</button>
	 	<div class="dropdown-menu dd0 text-center">
	    	<?php 
				include "includes/connect.php";

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
		
	</div>

	<!-- TABLES -->
	<div id="Tables" style="display: none;">
	
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


	<!-- ADD MODAL -->
	<div class="modal" id="Add_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	    	<div class="modal-content" style="margin: auto; border: none;">
	     	   <div class="modal-body">
	           
	        		<form class="form-group ml-2 mr-2 justify-content-center">  
	        			<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
						<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Add Health Center</div><br>
		
						<div class="modalText"> 
							Health Center:
							<input type="text" class="form-control" id="Form_Name" placeholder="Name">
						</div>
					
						<div class="modalText">
							Address:
							<input type="text" class="form-control" id="Form_Address" name="harga" placeholder="Address">
						</div>

						<div class="modalText">
							Telephone:
							<input type="number" class="form-control" id="Form_Number" name="harga" placeholder="Number">
						</div>

						<div class="dropdown d-flex justify-content-center" id="divkat">
						  	<button type="button" id="Form_Kategori" class="btn1 border dropdown_btns butkat dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;" value="Hospital">Hospital</button>
						 	<div class="dropdown-menu dd1 text-center" id="dd1">
					    		<?php 
									$q = "select * from kategori_pk";
									$kat = mysqli_query($con, $q);
									while($rows = mysqli_fetch_array($kat)){
										echo '<a class="dropdown-item">'.$rows['nama'].'</a>';
									}
								?>
						  	</div>
						</div>

						<div class="d-flex justify-content-center" style="margin-left: 80px; margin-bottom: 10px;"><input type="file" id="file" name="file" /> 
						</div>

						<div class="text-center">
							<a id="Add_HC"  class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Add Data</a>
						</div>
					</form>

				</div>
			</div>
	    </div>
	</div>

	<!-- DELETE MODAL -->
	<div class="modal" id="Delete_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<img src="img/exclamation.png" style="width: 100px; height: 100px; display: block; margin-left: auto; margin-right: auto;">
	        		<div class="text-center" style="font-size: 25px; font-weight: bold; margin-top: 10px; margin-bottom: 10px;">Are you sure?</div>
	        		<div class="text-center" style="font-size: 14; margin-bottom: 15px;">Erase <span id="delete_name" style="font-weight: 600; color: red;">N A M E</span> from database? </div>
					<div class="text-center">
					<a data-dismiss="modal" class="btn mx-2" style="align-self: center; border-radius: 20px; border-width: 2px; font-weight: 600; border-color: #4fbbb2; background-color: white; color: #4fbbb2; height: 42px; width: 80px;" >Cancel</a>
					<a id="Delete_HC" class="btn mx-2" style="align-self: center; border-radius: 20px; font-weight: 600; background-color: #4fbbb2; color: white; height: 37px; width: 80px;" >Delete</a>
					</div>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- EDIT MODAL -->
	<div class="modal" id="Edit_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
					<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Edit Health Center</div><br>
		
					<div class="modalText"> 
						Health Center:
						<input id="modal_name" type="text" class="form-control" id="Edit_Name" placeholder="Name">
					</div>
					
					<div class="modalText">
						Address:
						<input id="modal_address" type="text" class="form-control" id="Edit_Address" name="harga" placeholder="Address">
					</div>

					<div class="modalText">
						Telephone:
						<input id="modal_telephone" type="number" class="form-control" id="Edit_Number" name="harga" placeholder="Number">
					</div>

					<div class="dropdown d-flex justify-content-center">
					  	<button id="modal_kategori" type="button" class="btn2 btnkat border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;" value="Hospital">Hospital
					  	</button>
					 	<div class="dropdown-menu dd2 text-center" id="filterkategori">
					    	<?php 
								$q = "select * from kategori_pk";
								$kat = mysqli_query($con, $q);
								while($rows = mysqli_fetch_array($kat)){
									echo '<a class="dropdown-item" value="'.$rows['nama'].'">'.$rows['nama'].'</a>';
								}
							?>
					  	</div>
					</div>

					<div class="d-flex justify-content-center" style="margin-left: 80px; margin-bottom: 10px;"><input type="file" id="file_edit" name="file_edit" /> 
					</div>

					<div class="text-center">
						<a id="Edit_HC" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Edit Data</a>
					</div>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<style type="text/css">
		.btnsss{
			margin-top: 13px;
			margin-bottom: -5px;
		}
	</style>
</body>

</html>