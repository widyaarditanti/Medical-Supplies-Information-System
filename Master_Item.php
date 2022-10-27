<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Master_Header.php'; ?>
	<?php include 'css.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">

    	var ajaxcall, button = [1, 0, 0, 0, 0], filter="All", buttonActive = "All";

		function buttonMenu(category){
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

						document.getElementById("Icons").style.display="flex";
						document.getElementById("Tables").style.display="none";
					}
					if(category == 1){
						button[0] = 0;
						button[1] = 1;

						document.getElementById("Icons").style.display="none";
						document.getElementById("Tables").style.display="inline";
					}
				}
			}
			else{
				buttonActive = category;
				var btns = document.getElementsByClassName("btns");
				for(var i = 0 ; i < btns.length; i++){
					if(btns[i].innerHTML != buttonActive){
						btns[i].style.color="#BCC6CC";
						btns[i].style.fontWeight="normal";
						btns[i].style.outline="none";
					}
				}
				$.ajax({
		          url:"includes/get_data_filter_subcategory_item.php",
		          type:"POST",
		          data:{tipe:category},
		          dataType:'json',
		          success:function(result){
					var str = "<a class='dropdown-item'>Sub-Category</a>";
					for(var i in result){
						var d = result[i];
						str += "<a class='dropdown-item'>"+d.nama+"</a>";
					}

					$(".dd1").html(str);
					$(".dd2").html(str);
				 },
		          error:function(xhr,textStatus,errorThrown){
		            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		            alert(err);
		          }
				});

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

		function editButton(parent){
			document.getElementById("modal_subcategory").innerHTML = parent.children[2].innerHTML;
			document.getElementById("modal_name").value = parent.children[6].innerHTML;
			document.getElementById("modal_qty").value = parent.children[8].innerHTML;
			document.getElementById("modal_unit").value = parent.children[9].innerHTML;
			var btns = document.getElementsByClassName("btns");
			for(var i = 0 ; i < btns.length; i++){
				if(btns[i].innerHTML == parent.children[0].innerHTML){
					btns[i].style.color="#4fbbb2";
					btns[i].style.fontWeight="bold";
					btns[i].style.outline="none";
				}
			}
			var x = parent.children[6].getAttribute("value");
			document.getElementById("Edit_Data").setAttribute("value",x);
		}

		function deleteButton(parent){
			document.getElementById("delete_name").innerHTML = parent.children[6].innerHTML;
			var x = parent.children[6].getAttribute("value");		
			document.getElementById("Delete_Data").setAttribute("value",x);
		}

		function filterButton(parent) {
			var name = parent.children[1].children[6].innerHTML;
			var jenis_tipe = parent.children[1].children[2].innerHTML;
			var tipe = parent.children[1].children[0].innerHTML;
			var qty = parent.children[1].children[8].innerHTML;
			var unit = parent.children[1].children[9].innerHTML;
			var desc = parent.children[1].children[12].innerHTML;
			var id = parent.children[1].children[6].getAttribute("value"); 
			
			document.getElementById("Modal_T_Type_Name").innerHTML = name;
			document.getElementById("Modal_T_Type_JenisTipe").innerHTML = jenis_tipe;
			document.getElementById("Modal_T_Type_Tipe").innerHTML = tipe;
			document.getElementById("Modal_T_Type_Qty").innerHTML = qty;
			document.getElementById("Modal_T_Type_Unit").innerHTML = unit;
			document.getElementById("Modal_T_Type_Desc").innerHTML = desc;
			document.getElementById("Modal_T_ID").innerHTML = "#000"+id;

			//ITEM STOCK
			var admin = "master";
			$.ajax({
	          url:"includes/get_filter_stock_item.php",
	          type:"POST",
	          data:{admin:admin, iditem:id},
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					if(d.jumlah_stock != 0){ //KARENA PRE ORDER DI SET STOCK-NYA 0
						str += "<tr>";   
						str +="<td>"+d.id_stock+"</td>"; 
						str +="<td>"+d.jumlah_stock+" "+ d.satuan_stock+"</td>"; 
						str +="<td>"+d.jumlah_item+" "+ d.satuan_item+"</td>"; 
						str +="<td>"+parseInt(d.jumlah_item) * parseInt(d.jumlah_stock)+" "+ d.satuan_item+"</td>";  
						str +="<td>"+d.exp_date+"</td>"; 
						str += "</tr>";
					}
				}

				$("#tbody-filter-modal").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}


		function getDataItem(namacategory, catorsub,admin,HC){
			var cat = namacategory;

			$.ajax({
				type:'POST',
				url: 'includes/get_all_data_item.php',
			    dataType: 'json',
				data:{cat:cat, catorsub:catorsub,admin:admin,HC:HC},
				success: function(result){
					var str = "";
					var str_list ="";
					for(var i in result){
						var d = result[i];
						str += "<tr>";   
						str +="<td>"+d.id_item+"</td>"; 
						str +="<td class='Name_Item_Table'>"+d.nama_item+"</td>"; 
						str +="<td>"+d.jumlah_item+"</td>"; 
						str +="<td>"+d.satuan_item+"</td>"; 
						str +="<td>"+d.deskripsi+"</td>"; 
						str += "</tr>";

						str_list += '<div class="iconn container d-flex justify-content-center" onclick="click()">';
						str_list += '<img class="Image_Item" src="img/Items/'+d.image_item+'">';
						str_list += '<div class="data container-fluid" style="margin-left: -3px;">';
						str_list += '<span class="Category_Item">'+d.nama_tipe+'</span>&nbsp;<b>[</b><span class="SubCategory_Item">'+d.nama_jenis_tipe+'</span><b>]</b>';
						str_list += '<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button><br>';
						str_list += '<span class="Name_Item" value="'+d.id_item+'">'+d.nama_item+'</span><br>';
						str_list += '<span class="Qty_Item">'+d.jumlah_item+'</span>&nbsp;<span class="Unit_Item">'+d.satuan_item+'</span><br>';
						str_list += '<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>';
						str_list += "<a hidden>"+d.deskripsi+"</a>";
						str_list += '</div>';
						str_list += '<button class="Filter_Item" data-toggle="modal" data-target="#Filter_Modal" onclick="filterButton(this.parentElement)" ></button>';
						str_list += "</div>";
					}

					//TABLE
					$("#tbody-table").html(str);

					//LIST DATA
					$("#Icons").html(str_list);
				},
				error:function(xhr,textStatus,errorThrown){
			        var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
			        alert(err);
			    }
			});

		}

		function getStockItem(){
			var admin = "master";
			$.ajax({
	          url:"includes/get_stock_item.php",
	          type:"POST",
	          data:{admin:admin},
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					if(d.jumlah_stock != 0){ //KARENA PRE ORDER DI SET STOCK-NYA 0
						str += "<tr>";   
						str +="<td>"+d.id_item+"</td>"; 
						str +="<td class='Name_Item_List'>"+d.nama_item+"</td>"; 
						str +="<td>"+d.jumlah_stock+" "+ d.satuan_stock+"</td>"; 
						str +="<td>"+d.jumlah_item+" "+ d.satuan_item+"</td>"; 
						str +="<td>"+parseInt(d.jumlah_item) * parseInt(d.jumlah_stock)+" "+d.satuan_item+"</td>"; 
						str +="<td>"+d.exp_date+"</td>"; 
						str += "</tr>";
					}
				}

				$("#tbody-stock-modal").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function getDataFilterCategory(){
	        $.ajax({
	          url:"includes/get_data_filter_category_item.php",
	          type:"POST",
	          dataType:'json',
	          success:function(result){
				var str = "<a class='dropdown-item'>Category</a>";
				for(var i in result){
					var d = result[i];
					str += "<a class='dropdown-item'>"+d.nama+"</a>";
				}
				
				$(".dd3").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
	    }

		function getDataFilterSubCategory(){
			var subtipe ="";
	        $.ajax({
	          url:"includes/get_data_filter_subcategory_item.php",
	          type:"POST",
	          data:{tipe:subtipe},
	          dataType:'json',
	          success:function(result){
				var str = "<a class='dropdown-item'>Sub-Category</a>";
				for(var i in result){
					var d = result[i];
					str += "<a class='dropdown-item'>"+d.nama+"</a>";
				}
				$(".dd0").html(str);
			  },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
	    }

		window.onload = function(){
			getDataItem("","","master","");
			getDataFilterSubCategory();
			getDataFilterCategory();
			getStockItem();
		}

    	$(document).ready(function(){
			$(".dropdown-menu.dd0 a").click(function(){
				$(".btn0:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd1 a").click(function(){
				$(".btn1:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd2 a").click(function(){
				$(".btn2:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd3 a").click(function(){
				$(".btn3:first-child").html($(this).text());
			});

			//FILTER SEARCH
			$("#search_Item").on("keyup", function() {
	            var value = $(this).val().toLowerCase();
	            var catorsub ="";
	            var value_category = "";
	            if($("#title-dd3").text() !="Category"){
	            	catorsub = 1;
	            	value_category = $("#title-dd3").text();
	            }
	            if($("#title-dd0").text() != "Sub-Category"){
	            	catorsub = 0;
	            	value_category = $("#title-dd0").text();
	            }

	            var admin = "master";
				var HC =""; //HANYA UNTUK CENTRAL
	            $.ajax({
		          url:"includes/get_filter_search_item.php",
		          type:"POST",
		          data:{admin:admin, 
		          	nama_item:value,
		          	categoryorsub:catorsub,
		          	valuecat:value_category,
		          	HC:HC
		          },
		          dataType:'json',
		          success:function(result){
					var str_list = "";
					for(var i in result){
						var d = result[i];

						str_list += '<div class="iconn container d-flex justify-content-center" onclick="click()">';
						str_list += '<img class="Image_Item" src="img/Items/'+d.image_item+'">';
						str_list += '<div class="data container-fluid" style="margin-left: -3px;">';
						str_list += '<span class="Category_Item">'+d.nama_tipe+'</span>&nbsp;<b>[</b><span class="SubCategory_Item">'+d.nama_jenis_tipe+'</span><b>]</b>';
						str_list += '<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button><br>';
						str_list += '<span class="Name_Item" value="'+d.id_item+'">'+d.nama_item+'</span><br>';
						str_list += '<span class="Qty_Item">'+d.jumlah_item+'</span>&nbsp;<span class="Unit_Item">'+d.satuan_item+'</span><br>';
						str_list += '<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>';
						str_list += "<a hidden>"+d.deskripsi+"</a>";
						str_list += '</div>';
						str_list += '<button class="Filter_Item" data-toggle="modal" data-target="#Filter_Modal" onclick="filterButton(this.parentElement)" ></button>';
						str_list += "</div>";
					}
					//LIST DATA
					$("#Icons").html(str_list);
				  },
		          error:function(xhr,textStatus,errorThrown){
		            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		            alert(err);
		          }
				});

	            //FILTER TABLE
				$(".Name_Item_Table").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
	            });
			});

			$("#search_Stock").on("keyup", function() {
	            var value = $(this).val().toLowerCase();
				$(".Name_Item_List").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
	            });
			});

			//DROPDOWN CHANGES
			$(document).on("click", ".dropdown-menu.dd3 a", function(){
				var category = $(this).text();
				if(category == "Category"){
					getDataItem("","","master","");
					getDataFilterSubCategory();
					$("#title-dd3").html(category);
					$("#title-dd0").html("Sub-Category");
				}
				else{
					getDataItem(category,1,"master","");
					$("#title-dd3").html(category);

					//DD0 /subcategory IKUT GANTI
					$.ajax({
			          url:"includes/get_data_filter_subcategory_item.php",
			          type:"POST",
			          data:{tipe:category},
			          dataType:'json',
			          success:function(result){
						var str = "";
			    		str += '<a class="dropdown-item">Sub-Category</a>';
						for(var i in result){
							var d = result[i];
							str += "<a class='dropdown-item'>"+d.nama+"</a>";
						}

						$(".dd0").html(str);
					  },
			          error:function(xhr,textStatus,errorThrown){
			            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
			            alert(err);
			          }
					});
				}

			});
			
			$(document).on("click", ".dropdown-menu.dd0 a", function(){
				var subcategory = $(this).text();
				getDataItem(subcategory,0,"master","");
				$("#title-dd0").html(subcategory);
			});

			$(document).on("click",".dropdown-menu.dd1 a",function(){
				var subcategory =$(this).text();
				$("#title-jenis-tipe").html(subcategory);
			});

			$(document).on("click",".dropdown-menu.dd2 a",function(){
				var subcategory =$(this).text();
				$("#modal_subcategory").html(subcategory);
			});
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Item </h3> 
	</div>
	<div class="d-flex justify-content-center"><input type="text" id="search_Item"class="form-control" aria-label="Default" placeholder="Search"></div>

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

	<div class="row d-flex justify-content-center">
		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" id="title-dd3" class="btn btn3 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Category</button>
		 	<div class="dropdown-menu dd3 text-center">
		 		<!-- ajax -->
		  	</div>
		</div>

		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" id="title-dd0" class="btn btn0 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Sub-Category</button>
		 	<div class="dropdown-menu dd0 text-center">
		    	<!-- ajax -->
		  	</div>
		</div>
	</div>

	<!-- LIST DATA -->
	<div class="container-fluid row justify-content-center" id="Icons" style="margin-left: 0px;">
		<div class="iconn container d-flex justify-content-center" onclick="click()">
			<img class="Image_Item" src="img/Items/Obat2.jpg">
			<div class="data container-fluid" style="margin-left: -3px;">
				<span class="Category_Item">Supplies</span>&nbsp;<b>[</b><span class="SubCategory_Item">Medicine</span><b>]</b>
				<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
				<br>
				<span class="Name_Item">Paramex</span><br>
				<span class="Qty_Item">20</span>&nbsp;<span class="Unit_Item">mg</span><br>
				<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
			</div>
			<button class="Filter_Item" data-toggle="modal" data-target="#Filter_Modal" onclick="filterButton(this.parentElement)" ></button>
		</div>
		<div class="iconn container d-flex justify-content-center" onclick="click()">
			<img class="Image_Item" src="img/Items/Equip2.jpg">
			<div class="data container-fluid" style="margin-left: -3px;">
				<span class="Category_Item">Supplies</span>&nbsp;<b>[</b><span class="SubCategory_Item">Equipment</span><b>]</b>
				<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
				<br>
				<span class="Name_Item">Jarum</span><br>
				<span class="Qty_Item">10</span>&nbsp;<span class="Unit_Item">cm</span><br>
				<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
			</div>
			<button class="Filter_Item" onclick="filterButton(this.parentElement)"></button>
		</div>
	</div>

	<!-- TABLES -->
	<div id="Tables" style="display: none;">
		<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
			<thead>
				<tr style="text-align: center;">
					<th style="width: 15%;">ID_Item</th>
					<th style="width: 20%;">Item</th>
					<th style="width: 15%">Jumlah</th>
					<th style="width: 15%">Satuan</th>
					<th style="width: 25%">Deskripsi</th>
				</tr>
			</thead>

			<tbody class="text-center" id="tbody-table">
				<!-- ajax -->
			</tbody>
		</table>
	</div>
	
	<br>
	<!-- PAGES -->
	<div class="container d-flex justify-content-center">
		<button type="button" class="btn btnPage" style="background-color: rgb(220,220,220);">1</button>
		<button type="button" class="btn btnPage">2</button>
		<button type="button" class="btn btnPage">Next</button>
	</div><br>

	<!-- SIDE NAV -->
	<div class="sidenav" id="mySidenav">
         <a href="#" id="SideNav_Stock" data-toggle="modal" data-target="#Stock_Modal"><img src="img/Stock.png"
         width="38" height="38" style="padding-bottom: 0px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px; padding-top: 10px;">&nbsp;Item Stock</b></a>
	</div>

	<!-- FILTER MODAL -->
	<div class="modal modalmodal" id="Filter_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
					<div class="text-center" id="Modal_T_ID" style="color: #4fbbb2; font-weight: 500; font-size: 24px; margin-top: -20px; margin-bottom: -20px;">#008902</div><br>
					<div class="Modal_Text">NAME: &nbsp;<span class="Modal_Text2" id="Modal_T_Type_Name"><!-- ajax --></span></div>
					<div class="Modal_Text">CATEGORY: &nbsp;<span class="Modal_Text2" id="Modal_T_Type_Tipe"><!-- ajax --></span></div>

					<div class="Modal_Text">SUB-CATEGORY: &nbsp;<span class="Modal_Text2" id="Modal_T_Type_JenisTipe"><!-- ajax --></span></div>
					<div class="Modal_Text row">
						QUANTITY: &nbsp;
						<span class="Modal_Text2" id="Modal_T_Type_Qty"><!-- ajax --></span> 

						<div class="mx-3" style="width: 3px; height: 20px; margin-top: 5px; background-color: #4fbbb2; border-radius: 10px; "></div> 

						SATUAN: &nbsp;
						<span class="Modal_Text2" id="Modal_T_Type_Unit"><!-- ajax --></span>

					</div>

					<div class="Modal_Text">DESCRIPTION: &nbsp;<span class="Modal_Text2" id="Modal_T_Type_Desc" style="font-size: 15px;"><!-- ajax --></span></div><br>

					<div class="Modal_Table_Container">

						<div class="text-center Modal_Table_Title">ITEM STOCK</div>

						<div id="Modal_Table" style="max-height: 330px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
										<th style="width: 15%;">ID_Stock</th>
										<th style="width: 20%;">Jumlah Stock</th>
										<th style="width: 20%">Jumlah Item</th>
										<th style="width: 20%">Total Item</th>
										<th style="width: 25%">Expired Date</th>
									</tr>
								</thead>

								<tbody class="text-center" id="tbody-filter-modal">
								</tbody>
							</table>
						</div>
					</div>


				</div>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- STOCK MODAL -->
	<div class="modal modalmodal" id="Stock_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>

					<div class="Modal_Table_Container" style="margin: -40px 0 0 -24px; width: 1300px; height: 650px;">

						<br><div class="text-center" style="font-size: 25px; color: white; font-weight: 500;">ITEM STOCK</div><br>

						<div class="d-flex justify-content-center"><input type="text" id="search_Stock" class="form-control" aria-label="Default" placeholder="Search" style="margin-top: -15px; margin-left: -10px; margin-bottom: 20px;"></div>

						<div id="Modal_Detail_Table" style="max-height: 500px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
										<th style="width: 15%;">ID_Item</th>
										<th style="width: 15%;">Nama Item</th>
										<th style="width: 15%">Jumlah Stock</th>
										<th style="width: 15%">Jumlah Item</th>
										<th style="width: 15%">Total Item</th>
										<th style="width: 25%">Expired Date</th>
									</tr>
								</thead>

								<tbody class="text-center" id="tbody-stock-modal">
									<tr>   
										<td>01</td>   
										<td>O+</td> 
										<td>20</td>  
									</tr>
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
					
					<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Add Item</div><br>
		
					<div class="modalText"> 
						Name:
						<input type="text" id="Form_Name" class="form-control" id="Form_Nama" placeholder="Name">
					</div>
					
					<div class="modalText">
						Qty:
						<input type="number" id="Form_Qty"class="form-control" id="Form_Address" name="harga" placeholder="Quantity">
					</div>

					<div class="modalText">
						Unit:
						<input type="text" id="Form_Unit" class="form-control" id="Form_Address" name="harga" placeholder="Unit">
					</div>

					<div class="modalText">
						Description:
						<input type="text" id="Form_Desc" class="form-control" id="Form_Address" name="harga" placeholder="Description">
					</div>

					<div class="row d-flex justify-content-center" style="margin-top: 20px; margin-bottom: 15px;">
						<button class="btns px-3 py-1" onclick="buttonMenu('Pra-Sarana')" onmouseover="hoverButton('Pra-Sarana')" onmouseleave="notHoverButton()" type="button">Pra-Sarana</button>
						<button class="btns px-3 py-1" onclick="buttonMenu('Sarana')" onmouseover="hoverButton('Sarana')" onmouseleave="notHoverButton()" type="button">Sarana</button>
						<button class="btns px-3 py-1" onclick="buttonMenu('Supply')" onmouseover="hoverButton('Supply')" onmouseleave="notHoverButton()" type="button">Supply</button>
					</div>

					<div class="dropdown d-flex justify-content-center">
					  	<button type="button" id="title-jenis-tipe" class="btn1 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">Sub-Category
					  	</button>
					 	<div class="dropdown-menu dd1 text-center">
					    	<a class="dropdown-item">Sub-Category</a>
					  	</div>
					</div>

					<div class="d-flex justify-content-center" style="margin-left: 80px; margin-bottom: 10px;">
						<input type="file" id="file" name="file" /> 
					</div>

					<div class="text-center">
						<a id="Add_Data" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Add Data</a>
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
					<a id="Delete_Data" class="btn mx-2" style="align-self: center; border-radius: 20px; font-weight: 600; background-color: #4fbbb2; color: white; height: 37px; width: 80px;" value="">Delete</a>
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
					
					<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Edit Item</div><br>
		
					<div class="modalText"> 
						Name:
						<input id="modal_name" type="text" class="form-control" id="Form_Nama" placeholder="Name">
					</div>
					
					<div class="modalText">
						Qty:
						<input id="modal_qty" type="number" class="form-control" id="Form_Address" name="harga" placeholder="Quantity">
					</div>

					<div class="modalText">
						Unit:
						<input id="modal_unit" type="text" class="form-control" id="Form_Address" name="harga" placeholder="Unit">
					</div>

					<div class="row d-flex justify-content-center" style="margin-top: 20px; margin-bottom: 15px;">
						<button class="btns px-3 py-1" onclick="buttonMenu('Pra-Sarana')" onmouseover="hoverButton('Pra-Sarana')" onmouseleave="notHoverButton()" type="button">Pra-Sarana</button>
						<button class="btns px-3 py-1" onclick="buttonMenu('Sarana')" onmouseover="hoverButton('Sarana')" onmouseleave="notHoverButton()" type="button">Sarana</button>
						<button class="btns px-3 py-1" onclick="buttonMenu('Supply')" onmouseover="hoverButton('Supply')" onmouseleave="notHoverButton()" type="button">Supply</button>
					</div>

					<div class="dropdown d-flex justify-content-center">
					  	<button id="modal_subcategory" type="button" class="btn2 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">Sub-Category
					  	</button>
					 	<div class="dropdown-menu dd2 text-center">
					    	<a class="dropdown-item">Sub-Category</a>
					  	</div>
					</div>

					<div class="d-flex justify-content-center" style="margin-left: 80px; margin-bottom: 10px;"><input type="file" id="file-edit" name="file-edit" /> 
					</div>

					<div class="text-center">
						<a id="Edit_Data" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" value="">Edit Data</a>
					</div>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- ADD / EDIT / DEL MODAL AFTER ADDING / EDITING / DELETING -->
	<div class="modal" id="Add_Edit_Delete_Modal_After" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<img src="img/succeed.png" style="width: 100px; height: 100px; display: block; margin-left: auto; margin-right: auto;">
	        		<div class="text-center" style="font-size: 25px; font-weight: bold; margin-top: 10px; margin-bottom: 10px;">SUCCEED</div>
	        		<div class="text-center" id="state-success" style="font-size: 14; margin-bottom: 15px;"></div>
					<div class="text-center">
					<a data-dismiss="modal" class="btn" style="align-self: center; border-radius: 20px; border-width: 2px; font-weight: 600; border-color: #4fbbb2; background-color: white; color: #4fbbb2; height: 42px; width: 80px;" >Okay</a>
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


<script type="text/javascript">
	$(document).ready(function(){
		//ADD ITEM
		$(document).on("click", "#Add_Data", function(){
			var name = document.getElementById("Form_Name").value;
			var qty = document.getElementById("Form_Qty").value;
			var unit = document.getElementById("Form_Unit").value;
			var desc = document.getElementById("Form_Desc").value;
			var nama_jenis = document.getElementById("title-jenis-tipe").innerHTML;

			var fd = new FormData();
			var files = $('#file')[0].files;
			
	        // Check file selected or not
	        if(files.length > 0 ){
	        	fd.append('file',files[0]);
				fd.append('name',name);
				fd.append('qty',qty);
				fd.append('unit',unit);
				fd.append('nama_jenis',nama_jenis);
				fd.append('desc',desc);

			$.ajax({
		    	url:"includes/add_item.php",
		        type:"POST",
		        data:fd,
				contentType: false,
				processData: false,
		      	success:function(result){
					$("#state-success").html("Succeed to Add <b>"+ name +"</b> Item");
					$("#Add_Modal").modal("hide");
		      		$("#Add_Edit_Delete_Modal_After").modal('show');
					getDataItem("","","master","");
			 	},
		      	error:function(xhr,textStatus,errorThrown){
	          		var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		        	alert(err);
		      	}
			});

			}else{
	           alert("Please select a file.");
	        }
		});


		//EDIT ITEM
		$(document).on("click", "#Edit_Data", function(){
			var name = document.getElementById("modal_name").value;
			var qty = document.getElementById("modal_qty").value;
			var unit = document.getElementById("modal_unit").value;
			var nama_jenis = document.getElementById("modal_subcategory").innerHTML;
			var id = document.getElementById("Edit_Data").getAttribute("value");
			

			var fd = new FormData();
			var files = $('#file-edit')[0].files;
			if(files.length > 0 ){ //GANTI FOTO
	        	fd.append('file',files[0]);
	        }

			fd.append('name',name);
			fd.append('qty',qty);
			fd.append('unit',unit);
			fd.append('id',id);
			fd.append('nama_jenis',nama_jenis);

				$.ajax({
			    	url:"includes/edit_item.php",
			        type:"POST",
			        data:fd,
					contentType: false,
					processData: false,
			      	success:function(result){
						$("#state-success").html("Succeed to Edit <b>"+ name +"</b> Item");
						$("#Edit_Modal").modal("hide");
						getDataItem("","","master","");
			      		$("#Add_Edit_Delete_Modal_After").modal('show');
				 	},
			      	error:function(xhr,textStatus,errorThrown){
		          		var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
			        	alert(err);
			      	}
				});
		});

		//DELETE ITEM
		$("#Delete_Data").click(function(){
			var id = document.getElementById("Delete_Data").getAttribute("value");

			$.ajax({
		    	url:"includes/delete_item.php",
		        type:"POST",
		        data:{idItem:id},
		      	dataType:'json',
		      	success:function(result){
					$("#state-success").html("Succeed to Delete <b>"+ name +" </b> Item");
					$("#Delete_Modal").modal("hide");
		      		$("#Add_Edit_Delete_Modal_After").modal('show');
					getDataItem("","","master","");
			 	},
		      	error:function(xhr,textStatus,errorThrown){
	          		var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		        	alert(err);
		      	}
			});
		});
		
	});
</script>