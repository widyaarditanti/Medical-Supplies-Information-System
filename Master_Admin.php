<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Master_Header.php'; ?>
	<?php include 'css.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">
		var ajaxcall, buttonActive="All", button = [1, 0, 0, 0, 0], kat="All", addkat="Master", editkat="Master";
		var editid, deleteid;

		function search(){
			// alert(kat);
    		var text = document.getElementById("search").value;
			var icon = button[0];
			$.ajax({
				url:"includes/ajaxadmin.php",
				type:"POST",
				data :{
					search:text,
					icon:icon,
					kategori:kat
				},
				success:function(show){
					// alert(show);
					if(button[0] == 1)	$('#Icons').html(show);
					else $('#Tables').html(show);
				}
			});
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
			else{
				buttonActive = category;
				kat = category;
				var btns = document.getElementsByClassName("btns");
				for(var i = 0 ; i < btns.length; i++){
					if(btns[i].innerHTML != buttonActive){
						btns[i].style.color="#BCC6CC";
						btns[i].style.fontWeight="normal";
						btns[i].style.outline="none";
					}
				}
				search();
			}
		}

		function hoverButton(category){
			if(category == 0 || category == 1 || category == 2 || category == 3 || category == 4){
				var btns = document.getElementsByClassName("btnsss");
				if(button[category] == 0) btns[category].style.backgroundColor="#e5e5e5";
			}
			else{
				var btns = document.getElementsByClassName("btns");
				for(var i = 0 ; i < btns.length; i++){
					if(btns[i].innerHTML == category || btns[i].innerHTML == buttonActive){
						btns[i].style.color="#4fbbb2";
						btns[i].style.fontWeight="bold";
						btns[i].style.outline="none";
					}
				}
			}
		}

		function notHoverButton(){
			var btns = document.getElementsByClassName("btns");
			for(var i = 0 ; i < btns.length; i++){
				if(btns[i].innerHTML == buttonActive){
					btns[i].style.color="#4fbbb2";
					btns[i].style.fontWeight="bold";
					btns[i].style.outline="none";
				}
				else{
					btns[i].style.color="#BCC6CC";
					btns[i].style.fontWeight="normal";
					btns[i].style.outline="none";
				}
			}

			var btns = document.getElementsByClassName("btnsss");

			if(button[0] == 0) btns[0].style.backgroundColor="white";
			if(button[1] == 0) btns[1].style.backgroundColor="white";
			if(button[2] == 0) btns[2].style.backgroundColor="white";
			if(button[3] == 0) btns[3].style.backgroundColor="white";
			if(button[4] == 0) btns[4].style.backgroundColor="white";
		} 

		function editButton(parent, id){
			// alert();
			document.getElementById("modal_type").innerHTML = parent.children[0].innerHTML;
			document.getElementById("edituname").value = parent.children[3].innerHTML;
			document.getElementById("editemail").value = parent.children[5].innerHTML;
			document.getElementById("edittelpon").value = parent.children[7].innerHTML;
			editid= id;
		}

		function deleteButton(parent, id){
			// alert();
			document.getElementById("delete_name").innerHTML = parent.children[3].innerHTML;
			deleteid = id;
		}

		$(document).ready(function(){
			var text = document.getElementById("search").value;
			var icon = button[0];
			$.ajax({
				url:"includes/ajaxadmin.php",
				type:"POST",
				data :{
					search:text,
					icon:icon,
					kategori:kat
				},
				success:function(show){
					// alert(show);
					if(button[0] == 1)	$('#Icons').html(show);
					else $('#Tables').html(show);
				}
			});
			
			//add
			$(document).on("click", "#Add_Admin", function(){
				var nama = document.getElementById("Form_Nama").value;
				var email = document.getElementById("Form_Email").value;
				var nomer = document.getElementById("Form_Number").value;
				var kategori = addkat;

				// alert(kategori);
				var fd = new FormData();
				var files = $('#file')[0].files;

				if(files.length > 0){
					// alert();
					fd.append('file',files[0]);
					fd.append('nama',nama);
					fd.append('email',email);
					fd.append('nomer',nomer);
					fd.append('kategori',kategori);
					fd.append('add', true);

					$.ajax({
				    	url:"includes/ajaxadmin.php",
				        type:"POST",
						data:fd,
						contentType: false,
						processData: false,
						success:function(result){
							$("#state-success").html("Succeed to Add <b>"+ nama +"</b> Admin");
							$("#Add_Modal").modal("hide");
							search();
							// alert(result);
						},
		      			error:function(xhr,textStatus,errorThrown){
							// var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
							alert(err);
					    }
					});
				}
				else{
					alert("Please select a file");
				}
				search();
			});

			//edit
			$(document).on("click", "#Edit_Admin", function(){
				var nama = document.getElementById("edituname").value;
				var email = document.getElementById("editemail").value;
				var nomer = document.getElementById("edittelpon").value;
				var kategori = editkat;
				
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
				fd.append('email',email);
				fd.append('nomer',nomer);
				fd.append('edit',true);
				fd.append('kategori',kategori);
				fd.append('id',id);

				$.ajax({
			    	url:"includes/ajaxadmin.php",
			        type:"POST",
					data:fd,
					contentType: false,
					processData: false,
					success:function(result){
						$("#state-success").html("Succeed to Add <b>"+ name +"</b> Health Center");
						$("#Edit_Modal").modal("hide");
						// search();
						// $("#Add_Edit_Delete_Modal_After").modal('show');
						// alert(result);
					},
	      				error:function(xhr,textStatus,errorThrown){
							var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
							alert(err);
				      	}
				});

				var text = document.getElementById("search").value;
				var icon = button[0];
				$.ajax({
					url:"includes/ajaxadmin.php",
					type:"POST",
					data :{
						search:text,
						icon:icon,
						kategori:kat
					},
					success:function(show){
						// alert(show);
						if(button[0] == 1)	$('#Icons').html(show);
						else $('#Tables').html(show);
					}
				});
			});

			//delete data
			$(document).on("click", "#Delete_Admin", function(){
				var id = deleteid;
				$.ajax({
					url:"includes/ajaxadmin.php",
					type:"POST",
					data :{
						id:id,
						delete:true
					},
					success:function(show){
						$("#state-success").html("Succeed to Delete <b>"+ name +"</b> Health Center");
						$("#Delete_Modal").modal("hide");
						search();
						// $("#Add_Edit_Delete_Modal_After").modal('show');
						// alert(show);
					}
				});
				search();
			});

			$(".dropdown-menu.dd1 a").click(function(){
				addkat = $(this).text();
				$(".btn1:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd2 a").click(function(){
				editkat = $(this).text();
				$(".btn2:first-child").html($(this).text());
			});
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Administrator </h3> 
	</div>
	<div class="d-flex justify-content-center"><input type="text" id="search" class="form-control" aria-label="Default" placeholder="Search" onkeyup="search()" style="margin-bottom: 5px;"></div>


	<!-- ADD, EDIT, DELETE, FILTER -->
	<div class="row d-flex justify-content-center" style="margin-left: -16px;">
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<button class="btnsss d-flex justify-content-center" type="button" onclick="buttonMenu(0)" onmouseover="hoverButton(0)" onmouseleave="notHoverButton()" type="button" value="Add" style="background-color: #e5e5e5;"><img src="img/Icon.png"></button>

		<button class="btnsss d-flex justify-content-center" onclick="buttonMenu(1)" onmouseover="hoverButton(1)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/List.png" style="margin-left: 2px;"></button>

		<div class="mx-2" style="width: 5px; height: 40px; background-color: white; border-radius: 10px; margin-top: 8px;"></div>

		<button class="btnsss Add_Button d-flex justify-content-center" type="button" data-toggle="modal" data-target="#Add_Modal" onmouseover="hoverButton(2)" onmouseleave="notHoverButton()" type="button" value="Add"><img src="img/add.png"></button>

		<button class="btnsss Edit_Button d-flex justify-content-center" onclick="buttonMenu(3)" onmouseover="hoverButton(3)" data-target="#Edit_Modal" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/edit.png" style="margin-left: 2px;"></button>

		<button class="btnsss Delete_Button d-flex justify-content-center" onclick="buttonMenu(4)" onmouseover="hoverButton(4)" data-target="#Delete_Modal" onmouseleave="notHoverButton()" type="button" value="Delete"><img src="img/delete.png" style="width: 14px; height: 14px; margin-top: 7.5px;"></button>
	</div>

	<div class="row d-flex justify-content-center" style="margin-top: 15px; margin-bottom: 15px;">
		<button class="btns px-3 py-1" onclick="buttonMenu('All')" onmouseover="hoverButton('All')" onmouseleave="notHoverButton()" type="button" style="color: #4fbbb2; font-weight: bold;">All</button>
		<button class="btns px-3 py-1" onclick="buttonMenu('Master')" onmouseover="hoverButton('Master')" onmouseleave="notHoverButton()" type="button">Master</button>
		<button class="btns px-3 py-1" onclick="buttonMenu('Central')" onmouseover="hoverButton('Central')" onmouseleave="notHoverButton()" type="button">Central</button>
		<button class="btns px-3 py-1" onclick="buttonMenu('Local')" onmouseover="hoverButton('Local')" onmouseleave="notHoverButton()" type="button">Local</button>
	</div>

	<!-- LIST DATA -->
	<div class="container-fluid row justify-content-center" id="Icons" style="margin-left: 0px;">
		
	</div>

	<!-- TABLES -->
	<div id="Tables" style="display: none;">
		
	</div>


	<!-- PAGES -->
	<br><div class="container d-flex justify-content-center">
		<!-- <button type="button" class="btn btnPage">Prev</button> -->
		<button type="button" class="btn btnPage" style="background-color: rgb(220,220,220);">1</button>
		<!-- <button type="button" class="btn btnPage">2</button>
		<button type="button" class="btn btnPage">3</button>
		<button type="button" class="btn btnPage">Next</button> -->
	</div><br>

	<!-- ADD MODAL -->
	<div class="modal" id="Add_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
					<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Add Admin</div><br>
		
					<div class="modalText"> 
						Username:
						<input type="text" class="form-control" id="Form_Nama" placeholder="Username">
					</div>

					<div class="modalText">
						Email:
						<input type="text" class="form-control" id="Form_Email" name="harga" placeholder="Email">
					</div>

					<div class="modalText">
						Telephone:
						<input type="number" class="form-control" id="Form_Number" name="harga" placeholder="Number">
					</div>

					<div class="dropdown d-flex justify-content-center">
					  	<button id="kategori" type="button" class="btn1 butkat border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">Master
					  	</button>
					 	<div class="dropdown-menu dd1 text-center" id="filterkategori">
					    	<a class="dropdown-item" value="1">Master</a>
					    	<a class="dropdown-item" value="3">Central</a>
					    	<a class="dropdown-item" value="2">Local</a>
					  	</div>
					</div>

					<div class="d-flex justify-content-center" style="margin-left: 80px; margin-bottom: 10px;"><input type="file" id="file" name="file" /> 
					</div>

					<div class="text-center">
						<a id="Add_Admin" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Add Data</a>
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
					<a id="Delete_Admin" class="btn mx-2" style="align-self: center; border-radius: 20px; font-weight: 600; background-color: #4fbbb2; color: white; height: 37px; width: 80px;" >Delete</a>
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
					
					<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Edit Admin</div><br>
		
					<div class="modalText"> 
						Username:
						<input id="edituname" type="text" class="form-control" id="Form_Nama" placeholder="Username">
					</div>

					<div class="modalText">
						Email:
						<input id="editemail" type="text" class="form-control" id="Form_Address" name="harga" placeholder="Email">
					</div>

					<div class="modalText">
						Telephone:
						<input id="edittelpon" type="number" class="form-control" id="Form_Address" name="harga" placeholder="Number">
					</div>

					<div class="dropdown d-flex justify-content-center">
					  	<button id="modal_type" type="button" class="btn2 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">Master
					  	</button>
					 	<div class="dropdown-menu dd2 text-center">
					    	<a class="dropdown-item">Master</a>
					    	<a class="dropdown-item">Central</a>
					    	<a class="dropdown-item">Local</a>
					  	</div>
					</div>

					<div class="d-flex justify-content-center" style="margin-left: 80px; margin-bottom: 10px;"><input type="file" id="file_edit" name="file_edit" /> 
					</div>

					<div class="text-center">
						<a id="Edit_Admin" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Edit Data</a>
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