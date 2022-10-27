<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Local_Header.php'; ?>
	<?php include 'css.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">
	var strt=" ";
	var tablecount=0;
	var idgud;
    	var dt, HealthCenterName;
    	var ajaxcall, button = [0, 1, 0], filter="All", buttonActive = "All";
    	var Item=[], Qty=[], Info=[], Unit=[], counter=0;
		var move=0;
		window.onload = function(){
			getDataItem("","","master","");
			getDataFilterSubCategory();
			getDataFilterCategory();
			
		}
		function proceed(jenis,gud){
			var item=new Array();
			var qty=new Array();
			var iditem=new Array();
			
			var satuan=new Array();
			//alert(jenis+" "+gud);
			//console.log(document.getElementById("transaksi").rows[0].cells[0]);
			//console.log(document.getElementById("transaksi").rows[0].cells[1]);
			for(var i = 0; i < tablecount; i++){
			item.push(document.getElementById("transaksi").rows[i].cells[0].innerHTML);
			qty.push(document.getElementById("transaksi").rows[i].cells[2].innerHTML);
			iditem.push(document.getElementById("transaksi").rows[i].cells[4].innerHTML);
			satuan.push(document.getElementById("transaksi").rows[i].cells[3].innerHTML);
			}
			// alert(satuan);
			//console.log(iditem);
			if(jenis=="Use"){
			var status=" ";
			var ktrans=3;
			$.ajax({
	          url:"includes/usebarang.php",
	          type:"POST",
	          dataType:'text',
			  data:{item:item,idgud:idgud,qty:qty,status:status,ktrans:ktrans,jenis:jenis},
	          success:function(result){
				alert(result);
			/* 	$("#state-success").html("Succeed to add your use transaction!");
				$("#Succeed_Modal").modal('show'); */
				var lol =" ";
				location.reload();
			/* 	for(var i = 0; i < tablecount; i++){
			
					document.getElementById("transaksi").deleteRow(i);
					
				} 
				tablecount=0; */

				
			 },
	          error:function(xhr,textStatus,errorThrown){
				  
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
			}
			else if(jenis=="Request"){
				//marks
				// alert("pls bisa");
			
				var status="waiting";
				var ktrans=1;
				
			// alert(idgud+" "+ktrans+" "+status+" "+jenis+" "+qty+" "+item+" "+satuan+" ");
			$.ajax({
	          url:"includes/requestbarang.php",
	          type:"POST",
	          dataType:'text',
			  data:{iditem:iditem,idgud:idgud,status:status,ktrans:ktrans,jenis:jenis,qty:qty,item:item,satuan:satuan},
	          success:function(result){
				 alert(result);
				location.reload();
				/* $("#state-success").html("Succeed to add your request transaction!");
				$("#Succeed_Modal").modal('show'); */
			 },
	          error:function(xhr,textStatus,errorThrown){
				  
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
			}
			else if(jenis=="Move" && move==1){
				// jam 9 kerja IMK, baru csgo
			// alert("le");
			var status="Waiting";
			var ktrans=2;
			var dari=document.getElementById("wow").innerHTML;
			var tujuan=document.getElementById("wiw").innerHTML;
			 	$.ajax({
	          url:"includes/movebarang.php",
	          type:"POST",
	          dataType:'text',
			  data:{satuan:satuan,jenis:jenis,status:status,ktrans:ktrans,item:item,qty:qty,iditem:iditem,jenis:jenis,dari:dari,tujuan:tujuan},
	          success:function(result){
				  alert(result);
				location.reload();
				/* $("#state-success").html("Succeed to add your move transaction!");
				$("#Succeed_Modal").modal('show'); */
			 },
	          error:function(xhr,textStatus,errorThrown){
				  
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			}); 
			}  
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
				
				$(".dd4").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
	    }
		function siap(){
			//alert("a");
			var stringG="";
			var stringH="";
			var data=" ";
				//warehouse dropdown
				$.ajax({
				type:'POST',
				url: 'includes/dropdowngudang.php',
			    dataType: 'json',
				data:data,
				success: function(result){//satuan
				//alert(result);	
				var co=0;
				for(var i in result){
					var d = result[i];
					idgud=d.gudang_id;
					stringG+="<a id='op' class='dropdown-item wow' onclick='wow("+co+")'>"+d.nama+"</a>";
					stringH+="<a id='op' class='dropdown-item wiw' onclick='wiw("+co+")'>"+d.nama+"</a>";
					co=co+1;
					}
				//	alert(stringG);
					if(co>1){
					move=1;	
					//alert(">1");
					var str="<a class='dropdown-item jenis' onclick='wew(0)'>Use</a><a class='dropdown-item jenis' onclick='wew(1)'>Request</a><a class='dropdown-item jenis' onclick='wew(2)'>Move</a>";
					
					$("#modalbaru").html(stringH); 
					}
					else{
						
				//	alert("0");
					var str="<a class='dropdown-item jenis' onclick='wew(0)'>Use</a><a class='dropdown-item jenis' onclick='wew(1)'>Request</a>";
					}
					//alert(str);
					$("#jenis").html(str); 
					$("#gudang").html(stringG); 
				//
				},
				error:function(xhr,textStatus,errorThrown){
			        var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
			        alert(err);
				}
				
			});
		}
		function wew(x){
			if(x==2){
				//alert("asd");
				document.getElementById("To_Gudang").style.display="block";
			}
			else{

				document.getElementById("To_Gudang").style.display="none";
			}
			document.getElementById("jen").innerHTML=document.getElementsByClassName("dropdown-item jenis")[x].innerHTML;
		}

		function wiw(x){
		document.getElementById("wiw").innerHTML=document.getElementsByClassName("dropdown-item wiw")[x].innerHTML;
		}

		function wow(x){
			document.getElementById("wow").innerHTML=document.getElementsByClassName("dropdown-item wow")[x].innerHTML;
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

		function getDataItem(namacategory, catorsub,admin,HC){
			var cat = namacategory;

			$.ajax({
				type:'POST',
				url: 'includes/get_all_data_item.php',
			    dataType: 'json',
				data:{cat:cat, catorsub:catorsub,admin:admin,HC:HC},
				success: function(result){
					var str_list ="";
						for(var i in result){
						var d = result[i];
						if(d.nama_tipe!="Prasarana"){
						str_list += '<div class="iconn container d-flex justify-content-center" onclick="click()">';
						str_list += '<img class="Image_Item" src="img/Items/'+d.image_item+'">';
						str_list += '<div class="data container-fluid" style="margin-left: -3px;">';
						str_list += '<span class="Category_Item">'+d.nama_tipe+'</span>&nbsp;<b>[</b><span class="SubCategory_Item">'+d.nama_jenis_tipe+'</span><b>]</b>';
						str_list += '<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button><br>';
						str_list += '<span class="Name_Item" value="'+d.id_item+'">'+d.nama_item+'</span><br>';
						str_list += '<span class="Qty_Item">'+d.jumlah_item+'</span>&nbsp;<span class="Unit_Item">'+d.satuan_item+'</span><br>';
						str_list += '<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>';
						str_list += "<a hidden>"+d.deskripsi+"</a>";
						str_list += "<a hidden>"+d.id_item+"</a>";
						str_list += '</div>';
						str_list += '<button class="Order_Item" onmouseover="hoverButton(3, this)" onmouseleave="notHoverButton(this)" onclick="OrderButton(this.parentElement)" >+</button>';
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

		}
		function buttonMenu(category){
			// refreshData("", category);
			if(category == 1 || category == 2){
				if(button[category] == 0){
					if(category == 1){
						button[1] = 1;
						button[2] = 0;


						document.getElementById("Icons").style.display="flex";
						document.getElementById("Tables").style.display="none";
					}
					if(category == 2){
						button[1] = 0;
						button[2] = 1;

						document.getElementById("Icons").style.display="none";
						document.getElementById("Tables").style.display="inline";
					}
				}
			}
			else if(category == 0){
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
		}

		function hoverButton(category, bttn = null){
			if(category == 0 || category == 1 || category == 2){
				var btns = document.getElementsByClassName("btnsss");
				if(button[category] == 0) btns[category].style.backgroundColor="#e5e5e5";
			}
			else if(category == 3){
				bttn.style.opacity = "0.6";
			}
		}

		function notHoverButton(bttn = null){
			if(bttn != null){
				bttn.style.opacity = "0";
			}
			else{
				var btns = document.getElementsByClassName("btnsss");

				if(button[0] == 0) btns[0].style.backgroundColor="white";
				if(button[1] == 0) btns[1].style.backgroundColor="white";
				if(button[2] == 0) btns[2].style.backgroundColor="white";

			}
		} 

		function TableReload(){
			var body = document.getElementById("transaksi");
			var str="";
			for(var i = 0; i < counter; i++){
				str += "<tr>   <td>" + Item[i] + "</td>   <td>" + Info[i] +"</td> <td> <input class='qty_Order' type='number' oninput='qty_Changes(this)' placeholder='0' value='" + Qty[i] +"' style='background-color: transparent;'></td> <td>" + Unit[i] +"</td> <td> <button class='delete_but' onclick='deleteButton(this.parentElement)' type='button' style='outline: none; margin-right: 10px;'><img src='img/delete2.png' style='width: 20px; height: 20px;'></button></td></tr>";
			}
			body.innerHTML = str;
		}

		function OrderButton(x){
			//	("asd");
			//console.log(x.children[1].children[0]);
			var id_item=x.children[1].children[13].innerHTML;
			// alert(id_item);
			var desc=x.children[1].children[12].innerHTML;//nama
			var nama=x.children[1].children[6].innerHTML;
			//var nama=x.children[1].children[6].innerHTML;
			var satuan="";
			var exist = 0;
			var jenisitem=x.children[1].children[0].innerHTML;
			// alert(jenisitem);
			//alert(nama);
			$.ajax({
				type:'POST',
				url: 'includes/order.php',
			    dataType: 'text',
				data:{id_item:id_item,jenisitem:jenisitem},
				success: function(result){//satuan
				// alert("buah :"+result);
				satuan=result;//result
					
				for(var i = 0; i < tablecount; i++){
					//console.log(document.getElementById("transaksi").rows[0].cells[2].innerHTML);
					if(document.getElementById("transaksi").rows[0].cells[i].innerHTML == nama){
						exist = 1;
						var hasil=parseInt(document.getElementById("transaksi").rows[i].cells[2].innerHTML)+1;
						document.getElementById("transaksi").rows[i].cells[2].innerHTML=hasil;
					}
					
				}
				if(exist==0){
				//alert("ext= "+tablecount);
				strt+="<tr>";
				strt+="<td>"+nama+"</td>";
				strt+="<td>"+desc+"</td>";
				strt+="<td>"+"1"+"</td>";
				strt+="<td>"+satuan+"</td>";
				strt+="<td classs='iditem' style='display:none;'>"+id_item+"</td>";

				strt+="</tr>";
				//alert(strt);
				document.getElementById("transaksi").innerHTML=strt;
				tablecount++;
				counter=1;
				}
			
				
				},
				error:function(xhr,textStatus,errorThrown){
			        var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
			        alert(err);
				}
				
			});
			/* 
		

			for(var i = 0; i < counter; i++){
				if(Item[i] == Nama){
					exist = 1;
					alert("[" + Nama + "] has already been on the Transaction");
				}
			}

			if(exist == 0){
				Item[counter] = nama;
				Info[counter] = desc;
				Unit[counter] = ;
				counter++;

				TableReload();
			} */

		}

		function qty_Changes(x){
			for(var i = 0; i < counter; i++){
				if(Item[i] == x.parentElement.parentElement.children[0].innerHTML){
					Qty[i] = x.value - 0;
				}
			}
		}

		function deleteButton(x){
			var pos;
			for(var i = 0; i < counter; i++){
				if(Item[i] == x.parentElement.children[0].innerHTML){
					pos = i;
				}
			}

			for(var i = pos; i < counter-1; i++){
				Item[i] = Item[i+1];
				Info[i] = Info[i+1];
				Unit[i] = Unit[i+1];
				Qty[i] = Qty[i+1];
			}
			counter--;
			TableReload();
		}
	
    	$(document).ready(function(){
			$.ajax({
				url:"includes/ajaxforecast.php",
				type:"POST",
				data :{
					update:true
				},
				success:function(show){
					// alert(show);			
				}
				//oh oke mantap langsung ku coba
			});
    		//HealthCenterName = "Siloam";
    		dt = new Date();
			dt = dt.getDate() + " " + dt.toLocaleString('default', { month: 'long' }) + " " + dt.getFullYear();

			//$("#Transaction_HealthCenter").html(HealthCenterName);
			$("#Transaction_Date").html(dt);

			$(".dropdown-menu.dd0 a").click(function(){
				$(".btn0:first-child").html($(this).text());
				
				
				// alert("ini 0");
			});
			$(".dropdown-menu.dd4 a").click(function(){
				$(".btn4:first-child").html($(this).text());
				// alert("ini 4");
			});
			$(".dropdown-menu.dd1 a").click(function(){
				$(".btn1:first-child").html($(this).text());
				
			// alert("ini 1");

				if($(this).text() == "Move"){
					$("#To_Gudang").css('display', 'inline');
					$(".Form_Move_Status").css('display', 'inline');
				}
				else{
					$("#To_Gudang").css('display', 'none');
					$(".Form_Move_Status").css('display', 'none');
				}
			});
			
			$(".dropdown-menu.dd2 a").click(function(){
				// alert("ini 2");
				// alert($(this).text());
				$(".btn2:first-child").html($(this).text());
				
			});
			$(".dropdown-menu.dd3 a").click(function(){
				$(".btn3:first-child").html($(this).text());
				
				// alert("ini 3");
			});


			$("#SideNav_Proceed").click(function(){
				if(counter == 0){
					alert("You haven't chosen the Item yet!");
					$("#Proceed_Modal").modal('toggle');
				}
			});

			var Detail_Unhidden=0;
			$("#SideNav_Detail").click(function(){
				if(Detail_Unhidden == 0){
					$("#Detail").animate({
						bottom: "-10px"
					});
					Detail_Unhidden=1;
				}
				else{
					$("#Detail").animate({
						bottom: "-350px"
					});
					Detail_Unhidden=0;
				}
			});

			$("#search_Item").on("keyup", function() {
	            var value = $(this).val().toLowerCase();
	            var catorsub ="";
	            var value_category = "";
	            if($("#title-dd4").text() !="Category"){
	            	catorsub = 1;
	            	value_category = $("#title-dd4").text();
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

						if(d.nama_tipe!="Prasarana"){
						str_list += '<div class="iconn container d-flex justify-content-center" onclick="click()">';
						str_list += '<img class="Image_Item" src="img/Items/'+d.image_item+'">';
						str_list += '<div class="data container-fluid" style="margin-left: -3px;">';
						str_list += '<span class="Category_Item">'+d.nama_tipe+'</span>&nbsp;<b>[</b><span class="SubCategory_Item">'+d.nama_jenis_tipe+'</span><b>]</b>';
						str_list += '<button class="delete_but" onclick="deleteButton(this.parentElement)" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button><br>';
						str_list += '<span class="Name_Item" value="'+d.id_item+'">'+d.nama_item+'</span><br>';
						str_list += '<span class="Qty_Item">'+d.jumlah_item+'</span>&nbsp;<span class="Unit_Item">'+d.satuan_item+'</span><br>';
						str_list += '<button class="edit_but" onclick="editButton(this.parentElement)" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>';
						str_list += "<a hidden>"+d.deskripsi+"</a>";
						str_list += "<a hidden>"+d.id_item+"</a>";
						str_list += '</div>';
						str_list += '<button class="Order_Item" onmouseover="hoverButton(3, this)" onmouseleave="notHoverButton(this)" onclick="OrderButton(this.parentElement)" >+</button>';
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
			});
			$(document).on("click", ".dropdown-menu.dd4 a", function(){
				var category = $(this).text();
				if(category == "Category"){
					getDataItem("","","master","");
					getDataFilterSubCategory();
					$("#title-dd4").html(category);
					$("#title-dd0").html("Sub-Category");
				}
				else{
					getDataItem(category,1,"master","");
					$("#title-dd4").html(category);

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

		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Transaction </h3> 
	</div>
	<div class="d-flex justify-content-center" style="margin-left: 35px; margin-bottom: 10px;">
		<input type="text" id="search_Item"class="form-control" aria-label="Default" placeholder="Search">
		<button class="btnsss Add_Button d-flex justify-content-center" onclick="buttonMenu(0)" type="button" onmouseover="hoverButton(0)" onmouseleave="notHoverButton()" type="button" value="Add" style="border-radius: 20px; margin-left: 5px; margin-top: 0.8px;"><img src="img/Eye.png"></button>
	</div>

	<!-- FILTER -->
	<div class="row d-flex justify-content-center">
		
	</div>

	<div class="row d-flex justify-content-center">
		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" id="title-dd4" class="btn btn4 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Category</button>
		 	<div class="dropdown-menu dd4 text-center">
		    	<!-- <a class="dropdown-item">Category</a>
		    	<a class="dropdown-item">Sarana</a>
		    	<a class="dropdown-item">Pra-Sarana</a>
		    	<a class="dropdown-item">Supplies</a> -->
		  	</div>
		</div>

		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" id="title-dd0" class="btn btn0 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Sub-Category</button>
		 	<div class="dropdown-menu dd0 text-center">
		    	<!-- <a class="dropdown-item">Sub-Category</a>
		    	<a class="dropdown-item">Medicine</a>
		    	<a class="dropdown-item">Equipment</a>
		    	<a class="dropdown-item">Blood</a>
		    	<a class="dropdown-item">Ruangan</a>
		    	<a class="dropdown-item">Meja</a>
		    	<a class="dropdown-item">Kursi</a> -->
		  	</div>
		</div>
	</div>

	<!-- LIST DATA -->
	<div class="container-fluid row justify-content-center" id="Icons" style="margin-left: 0px;">
	</div>

	<!-- PAGES -->
	<br>
	<div class="container d-flex justify-content-center">
		<button type="button" class="btn btnPage">Prev</button>
		<button type="button" class="btn btnPage" style="background-color: rgb(220,220,220);">1</button>
		<button type="button" class="btn btnPage">2</button>
		<button type="button" class="btn btnPage">3</button>
		<button type="button" class="btn btnPage">Next</button>
	</div>
	<br>


	<!-- HIDDEN TABLE -->
	<div class="d-flex justify-content-center">
		<div class="container" id="Detail">
			<h3 style="text-align: center; font-weight: bold; color: white;"> Detail Transaction </h3>

			<table class="table table-striped table-borderless table-sm" style="font-size: 13px;">
				<thead>
					<tr style="text-align: center;">
						<th style="width: 60%;">Item</th>
						<th style="width: 20%;">Info</th>
						<th style="width: 10%;">Qty</th>
						<th style="width: 10%;">Unit</th>

					</tr>
				</thead>

				<tbody class="text-center" id="transaksi">
					<tr>   
						<td>-</td>   
						<td>-</td> 
						<td>-</td> 
						<td>-</td>   
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- SIDE NAV -->
	<div class="sidenav" id="mySidenav">
         <a href="#" id="SideNav_Detail"><img src="img/Detail.png"
         width="38" height="38" style="padding-bottom: 0px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px; padding-top: 10px;">&nbsp;Detail Transaction</b></a>

         <a href="#" id="SideNav_Proceed" data-toggle="modal" data-target="#Proceed_Modal" onclick="siap()"><img src="img/play.png"
         width="38" height="38" style="padding-bottom: 0px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px; padding-top: 10px;">&nbsp;Proceed</b></a>
	</div>



	<!-- PROCEED MODAL -->
	<div class="modal" id="Proceed_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>

					<div class="modalTitle" id="Transaction_HealthCenter"><?php echo $_SESSION['nama'];?></div>
					<div class="" id="Transaction_Date"></div>

					<div class="modalText"> 
						Jenis Pemakaian:
						<div class="dropdown d-flex justify-content-center">
						  	<button id="jen" type="button"  class="btn1 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">-
						  	</button>
						 	<div id="jenis" class="dropdown-menu dd1 text-center">
						    	<!-- <a class="dropdown-item">Use</a>
						    	<a class="dropdown-item">Request</a>
						    	<a class="dropdown-item">Move</a> -->
					  		</div>
						</div>
					</div>

					<div class="modalText">
						<span class="Form_Move_Status" style="display: none;"><b>From</b> </span>
						Ware House:
						<div class="dropdown d-flex justify-content-center">
						  	<button id="wow" type="button" class="btn2 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">-
						  	</button>
						 	<div id="gudang" class="dropdown-menu dd2 text-center">
							 
					  		</div>
						</div>
					</div>
					
					<div class="modalText" id="To_Gudang" style="display: none;">
						<span class="Form_Move_Status d-flex justify-content-center"><b>To</b> Ware House:</span>
						<div class="dropdown d-flex justify-content-center">
						  	<button id="wiw" type="button" class="btn3 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">-
						  	</button>
						 	<div id="modalbaru" class="dropdown-menu dd3 text-center">
						    
					  		</div>
						</div>
					</div> 
					</div>

					<div class="text-center" style="margin-top: -20px">
						<a onclick="proceed(document.getElementById('jen').innerHTML,document.getElementById('wow').innerHTML)" class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 37px; width: 100px;" >Proceed</a>
					</div>
					<br>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- SUCCEED MODAL -->
	<div class="modal" id="Succeed_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<img src="img/succeed.png" style="width: 100px; height: 100px; display: block; margin-left: auto; margin-right: auto;">
	        		<div class="text-center" style="font-size: 25px; font-weight: bold; margin-top: 10px; margin-bottom: 10px;">SUCEED</div>
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