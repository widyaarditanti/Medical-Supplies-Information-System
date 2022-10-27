<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Local_Header.php'; ?>
	<?php include 'css.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">
    	var admin_id = <?php echo $_SESSION['admin_id']?>;
		var idpk = <?php echo $_SESSION['pk_id']?>;

    	var ajaxcall, button = [0, 0, 0, 0, 1, 0], filter="All", filterGudang = "All", buttonActive = "All";

    	function buttonMenu(category){
			// refreshData("", category);
			if(category == 0 || category == 1 || category == 2){
				var btns;
				if(category == 1) btns= document.getElementsByClassName("edit_but");
				if(category == 2) btns= document.getElementsByClassName("delete_but");
				
				for(var i = 0; i < btns.length; i++){
					if(btns[i].style.display == "none") btns[i].style.display="inline";
					else btns[i].style.display="none";
				}

				if(button[category] == 0) button[category] = 1;
				else {
					button[category] = 0;
					btns[category].style.backgroundColor="white";
				}
			}
			else if(category == 3){
				var btns = document.getElementsByClassName("Total_Item");
				for(var i = 0; i < btns.length; i++){
					if(btns[i].innerHTML == 0){
						if(btns[i].parentElement.parentElement.style.display == "none") btns[i].parentElement.parentElement.style.display = "inline";
						else btns[i].parentElement.parentElement.style.setProperty("display", "none", "important");
					}
				}

				if(button[category] == 0) button[category] = 1;
				else {
					button[category] = 0;
					btns.parentElement.parentElement.style.backgroundColor="white";
				}
			}

			else if(category == 4 || category == 5){
				if(button[category] == 0){
					if(category == 4){
						button[4] = 1;
						button[5] = 0;

						document.getElementById("Icons").style.display="flex";
						document.getElementById("Tables").style.display="none";
					}
					if(category == 5){
						button[4] = 0;
						button[5] = 1;

						document.getElementById("Icons").style.display="none";
						document.getElementById("Tables").style.display="inline";
					}
				}
			}
		}

		function hoverButton(category){
			if(category == 0 || category == 1 || category == 2 || category == 3 || category == 4 || category == 5){
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
			if(button[5] == 0) btns[5].style.backgroundColor="white";
		} 

		function editButton(parent){
			document.getElementById("Modal_Name").value = parent.children[4].innerHTML;
			document.getElementById("Modal_Address").value = parent.children[6].innerHTML;
			document.getElementById("Modal_Telephone").value = parent.children[8].innerHTML;
			var x = parent.children[1].innerHTML;
			document.getElementById("Edit_Data").setAttribute("value",x);
		}

		function deleteButton(parent){
			document.getElementById("delete_name").innerHTML = parent.children[4].innerHTML;
			var x = parent.children[1].innerHTML;
			document.getElementById("Delete_Data").setAttribute("value",x);
		}

		function filterButton(parent) {
			var name = parent.children[1].children[5].innerHTML;
			var jenis_tipe = parent.children[1].children[2].innerHTML;
			var tipe = parent.children[1].children[0].innerHTML;
			var qty = parent.children[1].children[7].innerHTML;
			var unit = parent.children[1].children[8].innerHTML;
			var desc = parent.children[1].children[7].getAttribute("value");
			var id = parent.children[1].children[5].getAttribute("value");

			document.getElementById("Modal_T_Type_Name").innerHTML = name;
			document.getElementById("Modal_T_Type_JenisTipe").innerHTML = jenis_tipe;
			document.getElementById("Modal_T_Type_Tipe").innerHTML = tipe;
			document.getElementById("Modal_T_Type_Qty").innerHTML = qty;
			document.getElementById("Modal_T_Type_Unit").innerHTML = unit;
			document.getElementById("Modal_T_Type_Desc").innerHTML = desc;
			document.getElementById("Modal_T_ID").innerHTML = "#000"+id;

			//ITEM STOCK
			// var admin = "local";
			$.ajax({
	          url:"includes/get_filter_stock_item.php",
	          type:"POST",
	          data:{admin:admin_id, iditem:id,pk_id:idpk},
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					if(d.jumlah_stock != 0){ //KARENA PRE ORDER DI SET STOCK-NYA 0
						str += "<tr>";   
						str +="<td>"+d.id_stock+"</td>"; 
						str +="<td>"+d.nama_gudang+"</td>"; 
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

		function filterButtonGudang(parent) {
			var x = parent.children[0].children[1].innerHTML;
		}

		function GetDataWarehouse(idpk){
			//GET ALL DATA FOR WAREHOUSE
			$.ajax({
	          url:"includes/get_data_warehouse_item_local.php",
	          type:"POST",
	          data:{idpk:idpk},
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					str += '<div class="iconnnn container d-flex justify-content-center" onclick="click()">';
					str += '<div class="data container-fluid" style="margin-left: -3px; margin-bottom: 10px;">';
					str += '<b>#G000</b><span class="Id_StockHouse">'+d.gudang_id+'</span>';
					str += '<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>';
					str += '<br>';
					str += '<span class="Name_StockHouse">'+d.nama+'</span><br>';
					str += '<span class="Address_StockHouse">'+d.alamat+'</span><br>';
					str += '<span class="Telephone_StockHouse">'+d.no_telp+'</span>';
					str += '<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>';
					str += '</div>';
					str += '<button class="Filter_Item" onclick="filterButtonGudang(this.parentElement)" ></button>';
					str += '</div>';
				}
				$("#gudang-card").html(str);
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
				data:{cat:cat, catorsub:catorsub,admin:admin_id,HC:idpk},
				success: function(result){
					var str = "";
					var str_list ="";
					for(var i in result){
						var d = result[i];
						if(d.jumlah_stock != 0){

							str += "<tr>";   
							str +="<td>"+d.id_item+"</td>"; 
							str +="<td class='Name_Item_Table'>"+d.nama_item+"</td>"; 
							str +="<td>"+d.jumlah_item+" "+d.satuan_item+"</td>"; 
							str +="<td>"+d.jumlah_stock+" "+d.satuan_stock+"</td>";  
							str +="<td>"+d.deskripsi+"</td>"; 
							str += "</tr>";

							str_list += "<div class='iconn container d-flex justify-content-center' onclick='click()'> <img class='Image_Item' src='img/Items/"+d.image_item+"'>";
							str_list += "<div class='data container-fluid' style='margin-left: -3px;'> <span class='Category_Item'>"+d.nama_tipe+"</span>&nbsp;<b>[</b><span class='SubCategory_Item'>"+d.nama_jenis_tipe+"</span><b>]</b><br>";
							str_list += "<span class='Name_Item' value='"+d.id_item+"'>"+d.nama_item+"</span>";
							str_list += "<br><span class='Qty_Item' value='"+d.deskripsi+"'>"+d.jumlah_item+"</span>&nbsp;<span class='Unit_Item'>"+ d.satuan_item +"</span><br>";

							if(d.forecast_day >= 8 ){ //Aman
								str_list+="<b style='font-size: 15px;'>Total:</b>&nbsp;<span class='Total_Item'>"+d.jumlah_stock+"</span>&nbsp;<span class='Stock_Unit'>"+d.satuan_stock+"</span>";
							}
							else if(d.forecast_day <= 7 && d.forecast_day >= 3){ //Kuning
								str_list += "<b style='font-size: 15px;'>Total:</b>&nbsp;<span class='Total_Item' style='color: #FFD400;'>"+d.jumlah_stock+"</span>&nbsp;<span class='Stock_Unit' style='color: #FFD400;'>"+d.satuan_stock+"</span><img style='height: 20px; widows: 20px; margin-left: 8px; margin-bottom: 3px;' src='img/Warning1.png'>";
							}
							else if(d.forecast_day < 3){ //Merah
								str_list += "<b style='font-size: 15px;'>Total:</b>&nbsp;<span class='Total_Item' style='color: red;'>"+d.jumlah_stock+"</span>&nbsp;<span class='Stock_Unit' style='color: red;'>"+d.satuan_stock+"</span><img style='height: 20px; widows: 20px; margin-left: 8px; margin-bottom: 3px;' src='img/Warning2.png'>";
							}

							str_list += "</div> <button class='Filter_Item' data-toggle='modal' data-target='#Filter_Modal' onclick='filterButton(this.parentElement)' ></button>";
							str_list += "</div>";
						}						
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
			// alert(admin_id+" "+idpk);
			// var admin = "local";
			$.ajax({
	          url:"includes/get_stock_item.php",
	          type:"POST",
	          data:{admin:admin_id,pk_id:idpk},
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					if(d.jumlah_stock != 0){ //KARENA PRE ORDER DI SET STOCK-NYA 0
						str += "<tr>";
						str +="<td>"+d.id_item+"</td>"; 
						str +="<td>"+d.nama_item+"</td>"; 
						str +="<td>"+d.jumlah_stock+" "+d.satuan_stock+"</td>"; 
						str +="<td>"+d.jumlah_item+" "+d.satuan_item+"</td>"; 
						str +="<td>"+parseInt(d.jumlah_item)*parseInt(d.jumlah_stock)+" "+d.satuan_item+"</td>"; 
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
				
				$(".dd1").html(str);
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
				$(".dd7").html(str);
			  },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
	    }

		window.onload = function(){
			// var idpk = 1; //harusnya dari session, sementara gini dlu
			GetDataWarehouse(idpk);
			// getDataItem("","","local","");
			getDataItem("","",admin_id,"");
			getDataFilterSubCategory();
			getDataFilterCategory();
			getStockItem();
		}

    	$(document).ready(function(){
			$(".dropdown-menu.dd1 a").click(function(){
				$(".btn1:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd2 a").click(function(){
				$(".btn2:first-child").html($(this).text());
			});

			$("#SideNav_StockHouse").click(function(){
				$("#Gudang").toggle(700);
			})

			//FILTER SEARCH
			$("#search_Item").on("keyup", function() {
	            var value = $(this).val().toLowerCase();
	            var catorsub ="";
	            var value_category = "";
	            if($("#title-dd1").text() !="Category"){
	            	catorsub = 1;
	            	value_category = $("#title-dd1").text();
	            }
	            if($("#title-dd2").text() !="Sub-Category"){
	            	catorsub = 0;
	            	value_category = $("#title-dd2").text();
	            }

	            //FILTER LIST
				// var admin = "local";
				// alert("ad:"+admin+" item:"+value+" catorsub:"+catorsub+" valuecat:"+value_category+" idpk:"+idpk);
	            $.ajax({
		          url:"includes/get_filter_search_item.php",
		          type:"POST",
		          data:{admin:admin_id, 
		          	nama_item:value,
		          	categoryorsub:catorsub,
		          	valuecat:value_category,
		          	HC:idpk
		          },
		          dataType:'json',
		          success:function(result){
					var str_list = "";
					for(var i in result){
						var d = result[i];
						if(d.jumlah_stock != 0){

							str_list += "<div class='iconn container d-flex justify-content-center' onclick='click()'> <img class='Image_Item' src='img/Items/"+d.image_item+"'>";
							str_list += "<div class='data container-fluid' style='margin-left: -3px;'> <span class='Category_Item'>"+d.nama_tipe+"</span>&nbsp;<b>[</b><span class='SubCategory_Item'>"+d.nama_jenis_tipe+"</span><b>]</b><br>";
							str_list += "<span class='Name_Item' value='"+d.id_item+"'>"+d.nama_item+"</span>";
							str_list += "<br><span class='Qty_Item' value='"+d.deskripsi+"'>"+d.jumlah_item+"</span>&nbsp;<span class='Unit_Item'>"+ d.satuan_item +"</span><br>";

							if(d.forecast_day >=8 ){ //Aman
								str_list+="<b style='font-size: 15px;'>Total:</b>&nbsp;<span class='Total_Item'>"+d.jumlah_stock+"</span>&nbsp;<span class='Stock_Unit'>"+d.satuan_stock+"</span>";
							}
							else if(d.forecast_day <= 7 && d.forecast_day >= 3){ //Kuning
								str_list += "<b style='font-size: 15px;'>Total:</b>&nbsp;<span class='Total_Item' style='color: #FFD400;'>"+d.jumlah_stock+"</span>&nbsp;<span class='Stock_Unit' style='color: #FFD400;'>"+d.satuan_stock+"</span><img style='height: 20px; widows: 20px; margin-left: 8px; margin-bottom: 3px;' src='img/Warning1.png'>";
							}
							else if(d.forecast_day < 3){ //Merah
								str_list += "<b style='font-size: 15px;'>Total:</b>&nbsp;<span class='Total_Item' style='color: red;'>"+d.jumlah_stock+"</span>&nbsp;<span class='Stock_Unit' style='color: red;'>"+d.satuan_stock+"</span><img style='height: 20px; widows: 20px; margin-left: 8px; margin-bottom: 3px;' src='img/Warning2.png'>";
							}

							str_list += "</div> <button class='Filter_Item' data-toggle='modal' data-target='#Filter_Modal' onclick='filterButton(this.parentElement)' ></button>";
							str_list += "</div>";
						}
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
			$(document).on("click", ".dropdown-menu.dd1 a", function(){
				var category = $(this).text();

				if(category == "Category"){
					getDataItem("","",admin_id,"");
					// getDataItem("","","local","");
					getDataFilterSubCategory();
					$("#title-dd1").html(category);
					$("#title-dd2").html("Sub-Category");
				}
				else{
					getDataItem(category,1,admin_id,"");
					// getDataItem(category,1,"local","");
					$("#title-dd1").html(category);

					//DD2 IKUT GANTI
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
						$("#title-dd2").html("Sub-Category");
						$(".dd2").html(str);
					  },
			          error:function(xhr,textStatus,errorThrown){
			            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
			            alert(err);
			          }
					});
				}

			});
			
			$(document).on("click", ".dropdown-menu.dd2 a", function(){
				var subcategory = $(this).text();
				// getDataItem(subcategory,0,"local","");
				getDataItem(subcategory,0,admin_id,"");
				$("#title-dd2").html(subcategory);
			});
			
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div id="Gudang" style="margin-bottom: 10px; display: none;">
		<div class="row">
			<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Ware House </h3> 
		</div>
		<!-- ADD, EDIT, DELETE, FILTER -->
		<div class="row d-flex justify-content-center" style="margin-left: -16px;">
			<button class="btnsss Add_Button d-flex justify-content-center" type="button" data-toggle="modal" data-target="#Add_Modal" onmouseover="hoverButton(0)" onmouseleave="notHoverButton()" type="button" value="Add"><img src="img/add.png"></button>

			<button class="btnsss Edit_Button d-flex justify-content-center" onclick="buttonMenu(1)" onmouseover="hoverButton(1)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/edit.png" style="margin-left: 2px;"></button>

			<button class="btnsss Delete_Button d-flex justify-content-center" onclick="buttonMenu(2)" onmouseover="hoverButton(2)" onmouseleave="notHoverButton()" type="button" value="Delete"><img src="img/delete.png" style="width: 14px; height: 14px; margin-top: 7.5px;"></button>
		</div>

		<div class="container-fluid row d-flex justify-content-center" id="gudang-card" style="margin-left: 0px;">
			<div class="iconnnn container d-flex justify-content-center" onclick="click()">
				<div class="data container-fluid" style="margin-left: -3px; margin-bottom: 10px;">
					<b>#</b><span class="Id_StockHouse">0012</span>
					<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
					<br>
					<span class="Name_StockHouse">Gudang Timur Siloam</span><br>
					<span class="Address_StockHouse">Jl. Royal Residence B1 no 60</span><br>
					<span class="Telephone_StockHouse">031098273</span>
					<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
				</div>
				<button class="Filter_Item" onclick="filterButtonGudang(this.parentElement)" ></button>
			</div>
			<div class="iconnnn container d-flex justify-content-center" onclick="click()">
				<div class="data container-fluid" style="margin-left: -3px; margin-bottom: 10px;">
					<b>#</b><span class="Id_StockHouse">0013</span>
					<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
					<br>
					<span class="Name_StockHouse">Gudang Barat Siloam</span><br>
					<span class="Address_StockHouse">Jl. Gubeng 70</span><br>
					<span class="Telephone_StockHouse">031087273</span>
					<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
				</div>
				<button class="Filter_Item" onclick="filterButtonGudang(this.parentElement)"></button>
			</div>
		</div>
	</div>
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Stock Item </h3> 
	</div>
	<div class="d-flex justify-content-center" style="margin-left: 35px;">
		<input type="text" id="search_Item"class="form-control" aria-label="Default" placeholder="Search">
		<!-- <button class="btnsss Eye_Button d-flex justify-content-center" onclick="buttonMenu(3)" type="button" onmouseover="hoverButton(3)" onmouseleave="notHoverButton()" type="button" style="border-radius: 20px; margin-left: 5px; margin-top: 0.8px;"><img src="img/Eye.png"></button> -->
	</div>

	<!-- FILTER -->
	<div class="row d-flex justify-content-center">
		<button class="btnsss d-flex justify-content-center" type="button" onclick="buttonMenu(4)" onmouseover="hoverButton(4)" onmouseleave="notHoverButton()" type="button" value="Add" style="background-color: #e5e5e5;"><img src="img/Icon.png"></button>

		<button class="btnsss d-flex justify-content-center" onclick="buttonMenu(5)" onmouseover="hoverButton(5)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/List.png" style="margin-left: 2px;"></button>
	</div>

	<div class="row d-flex justify-content-center">
		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" id="title-dd1" class="btn btn1 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Category</button>
		 	<div class="dropdown-menu dd1 text-center">
		    	 <a class="dropdown-item">Category</a>
		  	</div>
		</div>

		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" id="title-dd2" class="btn btn2 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Sub-Category</button>
		 	<div class="dropdown-menu dd2 text-center">
		    	<a class="dropdown-item">Sub-Category</a>
		  	</div>
		</div>
	</div>

	<!-- LIST DATA -->
	<div class="container-fluid row justify-content-center" Id="Icons" style="margin-left: 0px;">
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
			</tbody>
		</table>
	</div>

	<br>

	<!-- PAGES -->
	<div class="container d-flex justify-content-center">
		<button type="button" class="btn btnPage" style="background-color: rgb(220,220,220);">1</button>
	</div><br>

	<!-- SIDE NAV -->
	<div class="sidenav" id="mySidenav">
         <a href="#" id="SideNav_Stock" data-toggle="modal" data-target="#Stock_Modal"><img src="img/Stock.png"
         width="38" height="38" style="padding-bottom: 0px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px; padding-top: 10px;">&nbsp;Item Stock</b></a>
         <a href="#" id="SideNav_StockHouse"><img src="img/Stock_House.png"
         width="44" height="44" style="padding-bottom: 5px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px;">&nbsp;Ware House</b></a>
	</div>


	<!-- FILTER MODAL -->
	<div class="modal modalmodal" id="Filter_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
					<div class="text-center" id="Modal_T_ID" style="color: #4fbbb2; font-weight: 500; font-size: 24px; margin-top: -20px; margin-bottom: -20px;"><!-- ajax --></div><br>
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
										<th style="width: 10%;">ID_Stock</th>
										<th style="width: 20%;">Warehouse</th>
										<th style="width: 15%;">Jumlah Stock</th>
										<th style="width: 15%">Jumlah Item</th>
										<th style="width: 20%">Total Item</th>
										<th style="width: 20%">Expired Date</th>
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
										<th style="width: 10%;">ID_Item</th>
										<th style="width: 20%;">Nama Item</th>
										<th style="width: 15%;">Jumlah Stock</th>
										<th style="width: 15%">Jumlah Item</th>
										<th style="width: 15%">Total Item</th>
										<th style="width: 20%">Expired Date</th>
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

	        		<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Add Ware House</div><br>
					
					<div class="modalText"> 
						Name:
						<input type="text" class="form-control" id="Form_Name" placeholder="Name">
					</div>

					<div class="modalText"> 
						Address:
						<input type="text" class="form-control" id="Form_Address" placeholder="Address">
					</div>

					<div class="modalText">
						Telephone:
						<input type="number" class="form-control" id="Form_Telephone" placeholder="Telephone Number">
					</div>

					<div class="text-center">
						<!-- <a href="Master_Admin.php" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Add Data</a> -->
						<a type='submit' name='add_warehouse' id="Add_Data" class='btn' style='align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;'>Add Data</a>
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
					<a data-dismiss="modal" class="btn" style="align-self: center; border-radius: 20px; border-width: 2px; font-weight: 600; border-color: #4fbbb2; background-color: white; color: #4fbbb2; height: 42px; width: 80px;" >Cancel</a>
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

					<div class="text-center" style="color: #4fbbb2; font-weight: 500; font-size: 24px;">Edit Ware House</div><br>

					<div class="modalText"> 
						Name:
						<input type="text" class="form-control" id="Modal_Name" placeholder="Name">
					</div>

					<div class="modalText">
						Address:
						<input type="text" class="form-control" id="Modal_Address" placeholder="Address">
					</div>

					<div class="modalText">
						Telephone:
						<input type="number" class="form-control" id="Modal_Telephone" placeholder="Telephone">
					</div>

					<div class="text-center">
						<a class="btn" id="Edit_Data" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" value="">Edit Data</a>
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

</body>
</html>

<script type="text/javascript">
	var idpk = <?php echo $_SESSION['pk_id']?>;

	$(document).ready(function(){
		//ADD WAREHOUSE
		$(document).on("click", "#Add_Data", function(){
			var name = document.getElementById("Form_Name").value;
			var add = document.getElementById("Form_Address").value;
			var telp = document.getElementById("Form_Telephone").value;

			$.ajax({
		    	url:"includes/add_warehouse.php",
		        type:"POST",
		        data:{
		        	name:name,
		        	add:add,
		        	telp:telp,
					idpk:idpk
		        },
		      	dataType:'json',
		      	success:function(result){
					$("#state-success").html("Succeed to Add <b>"+ name +"</b> Warehouse");
					$("#Add_Modal").modal("hide");
		      		$("#Add_Edit_Delete_Modal_After").modal('show');

					GetDataWarehouse(idpk);
			 	},
		      	error:function(xhr,textStatus,errorThrown){
	          		var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		        	alert(err);
		      	}
			});

		});


		//EDIT WAREHOUSE
		$(document).on("click", "#Edit_Data", function(){
			var name = document.getElementById("Modal_Name").value;
			var add = document.getElementById("Modal_Address").value;
			var telp = document.getElementById("Modal_Telephone").value;
			var id = document.getElementById("Edit_Data").getAttribute("value");
			// var id = document.getElementById("Edit_Data").getAttributeNode("value").value;

			$.ajax({
		    	url:"includes/edit_warehouse.php",
		        type:"POST",
		        data:{
		        	name:name,
		        	add:add,
		        	telp:telp,
		        	id:id
		        },
		      	dataType:'json',
		      	success:function(result){
					$("#state-success").html("Succeed to Edit <b>"+ name +"</b> Warehouse");
					$("#Edit_Modal").modal("hide");
		      		$("#Add_Edit_Delete_Modal_After").modal('show');
					GetDataWarehouse(idpk);
			 	},
		      	error:function(xhr,textStatus,errorThrown){
	          		var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		        	alert(err);
		      	}
			});
		});

		//DELETE WAREHOUSE
		$("#Delete_Data").click(function(){
			var id = document.getElementById("Delete_Data").getAttribute("value");
			// var id = document.getElementById("Delete_Data").getAttributeNode("value").value;

			$.ajax({
		    	url:"includes/delete_warehouse.php",
		        type:"POST",
		        data:{idGudang:id},
		      	dataType:'json',
		      	success:function(result){
					$("#state-success").html("Succeed to Delete <b>"+ name +" </b> Warehouse");
					$("#Delete_Modal").modal("hide");
		      		$("#Add_Edit_Delete_Modal_After").modal('show');
					GetDataWarehouse(idpk);
			 	},
		      	error:function(xhr,textStatus,errorThrown){
	          		var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
		        	alert(err);
		      	}
			});
		});
		
	});
</script>