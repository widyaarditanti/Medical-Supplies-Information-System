<!DOCTYPE html>
<html>
<head>
	<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION["username"])) header("Location: home.php");
	?>
	<script type="text/javascript">
		var idpk_accept = 0;

		function getMailRequest(){
			$.ajax({
	          url:"includes/get_mail_request_transaction.php",
	          type:"POST",
			  dataType:'json',
			  data:0,
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					str += "<div class='container Mail' onclick='getDataConfirmationModal(this)' data-toggle='modal' data-target='#Confirmation_Modal' data-dismiss='modal'>";
					str += "<span class='Id_Request' value='"+d.trans_id+"'>#R_0000"+d.trans_id+"</span>";
					str += "<span class='Date_Request' style='margin-top:0px'>"+d.tanggal+"</span><br><br>";
					str += "From: <span class='HealthCenter_Request' value='"+d.pk_id+"'>"+d.nama_pk+"</span><br>";
					str += "Item: <span class='Item_Request'>"+d.nama_item+"</span>&nbsp;<span class='Info_Request'><b>["+d.jumlah_item+" "+d.satuan_item+"]</b></span><br>";
					str += "Qty: <span class='Qty_Request'>"+d.jumlah_trs+"</span>";
					str += "</div>";
				}
				$("#Mail_Transaction_Central").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function acceptbasket(){
			$.ajax({
				url:"includes/ajaxhc.php",
				type:"POST",
				data :{
					acceptbasket:true
				},
				success:function(show){
					alert(show);
				}
			});
			$('#Basket_Modal').modal('hide');
		}

		function basket(){
			$.ajax({
				url:"includes/ajaxhc.php",
				type:"POST",
				data :{
					basket:true
				},
				success:function(show){
					$('#basket-modal-body').html(show);
				}
			});
			$('#Basket_Modal').modal('show');
		}
		
		function getBasket(){
			$.ajax({
	          url:"includes/get_data_basket.php",
	          type:"POST",
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					str+="<tr>";   
					str+="<td>"+d.nama_item+"</td>";   
					str+="<td>"+d.jumlah_item+" "+d.satuan_item+"</td>";   
					str+="<td>"+d.jumlah+" "+d.satuan_stock+"</td>";   
					str+="<td>"+d.trans_id+"</td>";   
					str+="<td>"+d.nama_pk+"</td>";   
					str+="</tr>";
				}
				$("#tbody-basket").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function getDataConfirmationModal(element){
			detail_approved = [];
			var id = element.children[0].getAttribute("value");
			var id_converted = element.children[0].innerHTML;
			var id_pk = element.children[4].getAttribute("value");

			dt = new Date();
			dt = dt.getDate() + " " + dt.toLocaleString('default', { month: 'long' }) + " " + dt.getFullYear();
			document.getElementById("Confirm_Id").innerHTML = id_converted;
			document.getElementById("Confirm_Date").innerHTML = dt;
			var type = "";
			var HC ="";
			var WH = "";
			
			//NAMPILIN DETAIL REQUEST
			$.ajax({
	          url:"includes/get_detail_req.php",
	          type:"POST",
	          data:{
	          	id_trans:id
	          },
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					HC = d.nama_pk;
					type = d.tipe_transaksi;
					WH = d.nama_gudang;
					str += '<tr>'; 
					str+='<td value="'+d.id_detail_transaksi+'">'+d.nama_item+'</td>';   
					str+='<td>'+d.jumlah_item+' '+d.satuan_item+'</td>';
					str+='<td>'+d.jumlah_trs+' '+d.satuan_stock+'</td>';
					str+='<td><button class="approval_Button" onclick="detailApproved(this)" value="">Approve</button></td>';  
					str+='</tr>';
				}
				$("#tbody-order-list").html(str);
				document.getElementById("Modal_T_HC").innerHTML = HC;
				document.getElementById("Modal_T_WH").innerHTML = WH;
				document.getElementById("Modal_T_Type").innerHTML = type;
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function getHC(){
			//GET DATA HEALTH CENTER
			$.ajax({
	          url:"includes/get_data_filter_HC_item.php",
	          type:"POST",
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					if(i == 0){
						$("#title-dd5").html(d.nama);
						document.getElementById("title-dd5").setAttribute("value",d.pk_id);
					}		

					if(d.nama != "Ibu dan Anak"){
						str += "<a class='dropdown-item' value='"+d.pk_id+"'>"+d.nama+"</a>";
					}
				}
				
				$(".dd5").append(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function getWarehouse(id_pk){
			//DROPDOWN WAREHOUSE
			$.ajax({
	          url:"includes/get_data_warehouse_item_local.php",
	          type:"POST",
	          data:{
	          	idpk:id_pk
	          },
	          dataType:'json',
	          success:function(result){
				var str = "";
				var first="";
				var countChecking = 0;
				for(var i in result){
					var d = result[i];
					countChecking = 1;
					if(i==0){
						first = d.nama;
						$("#title-dd6").html(d.nama);
					}
					str+='<a class="dropdown-item">'+d.nama+'</a>';
				}
				if(countChecking == 0){ //Tandanya HC ga puya gudang
					$("#title-dd6").html("-");	
				}
				$(".dd6").html(str);

				//BUAT UPDATE WAREHOUSE STOCK
				// alert(first); 
				var nama_gudang = first;
				if(nama_gudang != "-"){ //Artinya HC nya punya gudang
					getDataItemWarehouse(nama_gudang);			
				}
				else{ //HCnya ga pny gudang, brarti ga pny stock
					$("#tbody-warehouse").html("");
				}	
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function getDataItemWarehouse(nama_gudang){
			//STOK GUDANG
			$.ajax({
	          url:"includes/get_data_item_filter_gudang.php",
	          type:"POST",
	          data:{
				  nama_gudang:nama_gudang				  
	          },
	          dataType:'json',
	          success:function(result){
				var str = "";
				for(var i in result){
					var d = result[i];
					if(d.jumlah_stock !=0){
						if(i==0){

						}
						str += '<tr>'; 
						str+='<td>'+d.nama_item+'</td>';   
						str+='<td>'+d.jumlah_item+' '+d.satuan_item+'</td>';
						str+='<td>'+d.jumlah_stock+' '+d.satuan_stock+'</td>';
						str+='<td>'+d.exp_date+'</td>';
						str+='</tr>';
					}
				}
				$("#tbody-warehouse").html(str);
			 },
	          error:function(xhr,textStatus,errorThrown){
	            var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
	            alert(err);
	          }
			});
		}

		function detailApproved(element){
			element.innerHTML = "APPROVED"; //BRARTI DI APPROVED
			var id = element.parentElement.parentElement.children[0].getAttribute("value");

			//declare array buat siapa aja yg di approve
			detail_approved.push(id);
			// for(var a in detail_approved){
			//  	alert(detail_approved[a]);
			// }
		}

		//KALAU PENCET ACCEPT
		function sendToBasket(){
			var succeed = 1;
			var isAccept = 'yes';
			var penyumbang = "";
			if($("#dd-provider").text() == "Central Health Center"){
				penyumbang = 2;
			}
			else if ($("#dd-provider").text() == "Local Health Center"){
				penyumbang = idpk_accept;
			}
			else if($("#dd-provider").text() == "Pre-Order"){
				penyumbang = 0;
			}

			for(var i in detail_approved){
				var id = detail_approved[i];
				// alert("idacc="+id+"pen="+penyumbang);
				$.ajax({
					url:"includes/response_detail_mail_req.php",
					type:"POST",
					data:{
						id_dt:id,
						isAcc:isAccept,
						idPenyumbang:penyumbang
					},
					dataType:'json',
					success:function(result){
						succeed = 1;
					},
					error:function(xhr,textStatus,errorThrown){
						succeed = 0;
					}
				});
				checkingTransaksiStatus(id);
			}

			if(succeed == 1){
				$("#state-success").html("You are succeed to update the mail requests!");
				$("#Succeed_Modal").modal('show');
				$("#Confirmation_Modal").modal('hide');
			}
		}

		//KALAU PENCET DENY
		function denyReq(){
			var isAccept = 'no';
			var succeed = 1;
			var idP="";

			for(var i in detail_approved){
				var id = detail_approved[i];
				// alert("iddeny="+id);
				$.ajax({
					url:"includes/response_detail_mail_req.php",
					type:"POST",
					data:{
						id_dt:id,
						isAcc:isAccept,
						idPenyumbang:idP
					},
					dataType:'json',
					success:function(result){
						succeed = 1;
					},
					error:function(xhr,textStatus,errorThrown){
						succeed = 0;
					}
				});
				checkingTransaksiStatus(id);
			}

			if(succeed == 1){
				$("#state-success").html("You are succeed to update the mail requests!");
				$("#Confirmation_Modal").modal('hide');
				$("#Succeed_Modal").modal('show');
			}
		}

		function checkingTransaksiStatus(id_dt){
			// alert(id_dt);
			$.ajax({
					url:"includes/check_trans_status.php",
					type:"POST",
					data:{
						id:id_dt
					},
					success:function(result){
						succeed = 1;
					},
					error:function(xhr,textStatus,errorThrown){
						var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
						alert(err);
					}
				});
		}

		function Notif_Button(){
			document.getElementById('Confirmation_Modal').close();
		}
		function logout(){
		
		} 

    	$(document).ready(function(){
			//OTOMATIS NGUBAH DATA WAREHOUSE JADI GUDANG CENTRAL
			getDataItemWarehouse("Kertamanu");

			$(".dropdown-menu.dd4 a").click(function(){
				$(".btn4:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd5 a").click(function(){
				$(".btn5:first-child").html($(this).text());
			});
			$(".dropdown-menu.dd6 a").click(function(){
				$(".btn6:first-child").html($(this).text());
			});


			$(".dropdown-menu.dd4 a").click(function(){
				$(".btn4:first-child").html($(this).text());

				$("#HC_Hide").css('display', 'none');
				$("#SH_Hide").css('display', 'none');
				$("#Stock_Hide").css('display', 'none');

				if($(this).text() == "Local Health Center"){ 
					$("#HC_Hide").css('display', 'inline');
					$("#SH_Hide").css('display', 'inline');
					$("#Stock_Hide").css('display', 'inline');
				}
				else if($(this).text() == "Central Health Center"){
					$("#SH_Hide").css('display', 'inline');
					$("#Stock_Hide").css('display', 'inline');
				}
			});

			
			//DROPDOWN provider CHANGES
			$(document).on("click", "#detail-dd-provider a", function(){
				var idHC=1; //untuk dd local health
				var nama_gudang = "Tarunajaya"; //untuk dd local health
				var title = document.getElementById("dd-provider").innerHTML;

				if(title == "Central Health Center"){
					$("#title-dd6").html("Kertamanu");
					getDataItemWarehouse("Kertamanu");
					$(".dropdown-menu.dd5").html("<a class='dropdown-item'>Kertamanu</a>");
				}
				else if(title =="Local Health Center"){
					getHC();
					if(document.getElementById("title-dd5").getAttribute("value") !=""){ //krn saat pertama kli buka dan load fungsi ini, value nya kebaca ""
						idHC = document.getElementById("title-dd5").getAttribute("value");
					}
					idpk_accept = idHC;
					getWarehouse(idHC);	

					if(document.getElementById("title-dd6").innerHTML =="Kertamanu"){ //krn saat pertama kli click Local Health Center, sblmnya itu isi dd nya "Kertamanu" (Gudangnya Central)
						nama_gudang = "Tarunajaya"; //gudangnya siloam, RS yg pertama muncul
					}
					else{
						nama_gudang = $("#title-dd6").text();
					}
					getDataItemWarehouse(nama_gudang);
				}
				else if(title=="Pre-Order"){
					var idHC = "NULL";
					$("tbody-warehouse").html("");
				}			
			});

			//DROPDOWN HC CHANGES
			$(document).on("click", ".dropdown-menu.dd5 a", function(){
				var asd = $(this).text();
				var idpk = this.getAttribute("value");
				idpk_accept = idpk;

				$("#title-dd5").html(asd);
				getWarehouse(idpk);
			});

			$(document).on("click", ".dropdown-menu.dd5 a", function(){
			//BELOM BENER, MASIH PAKE NAMA GUDANG SBLMNYA
				// var nama_gudang = $("#title-dd6").text();
				// alert(nama_gudang); 
				// if(nama_gudang != "-"){ //Artinya HC nya punya gudang
				// 	getDataItemWarehouse(nama_gudang);			
				// }
				// else{ //HCnya ga pny gudang, brarti ga pny stock
				// 	$("#tbody-warehouse").html("");
				// }	
			});

			//DROPDOWN GUDANG CHANGES
			$(document).on("click", ".dropdown-menu.dd6 a", function(){
				var asd = $(this).text();
				$("#title-dd6").html(asd);
				getDataItemWarehouse(asd);
			});
		});
	</script>
</head>
<body>
	<!-- HEADER -->
	<nav class="navbar navbar-light container-fluid navbar-expand-md navbar-center" style="height: 65px;  font-size: 15px; font-weight:bold; background-color: white;">
		<!-- LOGO -->
	    <a class="navbar-brand" href="Home.php"><img src="img/Logo.png" width=60" height="50" style="margin-left: 0px; margin-right: 5px;"></a>

	    <!-- TITLE -->
	    <div class="text-center" style="margin-right: 50px;">
	    	<span class="row" style="color: #4fbbb2; font-size: 24px; margin-bottom: -6px;">MEDICAL SUPPLIES</span>
	    	<span style="color: #4fbbb2; font-size: 14px;">Admin Central</span>
	    </div>

	    <!-- MENU -->
	    <button class="navbar-toggler justify-content-end ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    	<span class="navbar-toggler-icon "></span>
	    </button>
    	<div class="collapse navbar-collapse" style="background-color: white; height: 10px; margin-bottom: 5px;" id="collapsibleNavbar">
      		<ul class="nav navbar-nav" >
		        <li class="nav-item"><a href="Central_HealthCenter.php" style="color: #4fbbb2;">Health Center</a></li>
		        <li class="nav-item"><a href="Central_Item.php" style="color: #4fbbb2;">Item</a></li>
		        <li class="nav-item"><a href="Central_Transaction.php?halamanAktif=1" style="color: #4fbbb2;">Transaction</a></li>
		        <li class="nav-item"><a href="Central_Forecast.php" style="color: #4fbbb2;">Forecast</a></li>
		        <li class="nav-item" style="margin-bottom: -14px;">
		        	<button class="Mail_Button" onclick="getMailRequest()" type="button" data-toggle="modal" data-target="#Mail_Modal" style="background-color: white; border-radius: 5px;  border:none; outline: none;"><img src="img/mail.png" style="width: 22px; height: 22px; margin-bottom: 2px;"></button>
		        	<div id="Notification" style=""></div>
		        </li>
		        <li class="nav-item" style="margin-bottom: -14px;">
		        	<button class="Basket_Button" type="button" onclick="basket()" style="background-color: white; border-radius: 5px;  border:none; outline: none; margin-left: -20px;"><img src="img/basket.png" style="width: 25px; height: 25px; margin-bottom: 2px;"></button>
		        	<div id="Notification" style="margin-left: -18px;"></div>
		        </li>
      		</ul>
      		<ul class="nav navbar-nav justify-content-end ml-auto" style="float: right;">
      			<span style="color: #4fbbb2; font-size: 18px; margin-top: 18px; margin-right: 10px; font-weight: normal;">Hi, <span id="AdminName"><?php echo $_SESSION['username'];?></span></span>
		        <li class="nav-item"><a style="color: #4fbbb2; line-height: 200%; font-size: 30px;" href="logout.php"><img src="img/logout.png" style="width: 25px; height: 25px;"></a></li>
     		 </ul>
    	</div>
	</nav>
	<br><br><br>

	<!-- BASKET MODAL -->
	<div class="modal modalmodal" id="Basket_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	        	<div class="ml-2 mr-2 justify-content-center" id="basket-modal-body">  

				</div>

	        </div>
	      </div>
	      
	    </div>
	</div>
	</div>

	<!-- MAIL MODAL -->
	<div class="modal" id="Mail_Modal" role="dialog">
	    <div class="modal-dialog" style="border-radius: 30px;">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>

					<div class="modalTitle Title_modal" id="Transaction_HealthCenter" style="margin-bottom: 10px; margin-top: -20px;">Request Notification</div>

					<!-- MAIL LIST -->
					<div class="row" id="Mail_Transaction_Central" style="border-bottom: 2px solid #e5e5e5;">
						<!-- <a class="container-fluid Mail" data-toggle="modal" data-target="#Confirmation_Modal" data-dismiss="modal">
							<span class="Id_Request">#R_000042</span>
							<span class="Date_Request">2 October 2020</span><br>
							From: <span class="HealthCenter_Request">Siloam</span><br>
							Item: <span class="Item_Request">Paramex</span><span class="Info_Request">20 mg</span><br>
							Qty: <span class="Qty_Request">200</span>
						</a>
						<a class="container-fluid Mail" data-toggle="modal" data-target="#Confirmation_Modal" data-dismiss="modal">
							<span class="Id_Request">#R_000042</span>
							<span class="Date_Request">2 October 2020</span><br>
							From: <span class="HealthCenter_Request">Siloam</span><br>
							Item: <span class="Item_Request">Paramex</span><span class="Info_Request">20 mg</span><br>
							Qty: <span class="Qty_Request">200</span>
						</a>
						<div class="container-fluid Mail">
							<span class="Id_Request">#R_000042</span>
							<span class="Date_Request">2 October 2020</span>
							<img class="Notif_Request" src="img/green.png"><br>
							From: <span class="HealthCenter_Request">Siloam</span><br>
							Item: <span class="Item_Request">Paramex</span><span class="Info_Request">20 mg</span><br>
							Qty: <span class="Qty_Request">200</span>
						</div>
						-->
					</div>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- CONFIRMATION MODAL -->
	<div class="modal modalmodal tes" id="Confirmation_Modal" role="dialog" style="top: 8%;">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none; height: 700px;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
					<div class="modalTitle Title_modal" id="Confirm_Id">#R_0092839</div>
					<div id="Confirm_Date" style="line-height:20px">2 October 2020</div>

					<div class="row">
						<div class="tes">
							<br>
							<div class="Modal_Text">TYPE: &nbsp;<span class="Modal_Text2" id="Modal_T_Type">Request</span></div>
							<div class="Modal_Text">HEALTH CENTER: &nbsp;<span class="Modal_Text2" id="Modal_T_HC">Siloam</span></div>

							<div class="Modal_Text row">REQUESTER WAREHOUSE: &nbsp;<span class="Modal_Text2" id="Modal_T_WH">#WH_00021</span></div><br>

							<div class="Modal_Table_Container">

								<div class="text-center Modal_Table_Title">ORDER-LIST</div>

								<div id="Modal_Table" style="width: 500px; max-height: 330px; overflow-y: auto;">
									<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
										<thead>
											<tr style="text-align: center;">
												<th style="width: 25%;">Item</th>
												<th style="width: 15%">Informasi Item</th>
												<th style="width: 15%">Qty Order</th>
												<th style="width: 15%">Approval</th>
											</tr>
										</thead>

										<tbody class="text-center" id="tbody-order-list">
											<!-- <tr>   
												<td>Paramex</td>   
												<td>20 mg</td> 
												<td>150</td> 
												<td><button class="approval_Button">Approve</button></td>  
											</tr>
											<tr>   
												<td>Panadol</td>   
												<td>20 mg</td> 
												<td>80</td> 
												<td><button class="approval_Button">Approve</button></td>  
											</tr>
											<tr>   
												<td>O+</td>   
												<td>500 ml</td> 
												<td>10</td> 
												<td><button class="approval_Button">Approve</button></td>  
											</tr>
											<tr>   
												<td>B-</td>   
												<td>500 ml</td> 
												<td>8</td> 
												<td><button class="approval_Button">Approve</button></td>  
											</tr> -->
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="tes">
							<div class="modalText" style=" font-size: 18px; font-weight: 700px; margin-bottom: 3px; margin-top: -10px;"> How will you provide?</div>

							<div class="modalText" style="">
								<div class="dropdown d-flex justify-content-center">
								  	<button type="button" id="dd-provider" class="btn4 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none; width: 250px;">Central Health Center</button>
								 	<div class="dropdown-menu dd4 text-center" id="detail-dd-provider" style="margin-left: 0px; width: 250px;">
								    	<a class="dropdown-item">Central Health Center</a>
								    	<a class="dropdown-item">Local Health Center</a>
								    	<a class="dropdown-item">Pre-Order</a>
							  		</div>
								</div>
							</div>

							<div class="row justify-content-center">
								<div class="modalText" id="HC_Hide" style="display: none;">
									<span class="d-flex justify-content-center" style="text-align: center;"> Health Center:</span>
									<div class="dropdown d-flex justify-content-center">
									  	<button type="button" id="title-dd5" value="" class="btn5 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;"></button>
									 	<div class="dropdown-menu dd5 text-center">
									    	<!-- <a class="dropdown-item">Siloam</a>
									    	<a class="dropdown-item">Kasih Ibu</a>
									    	<a class="dropdown-item">Generate</a>
									    	<a class="dropdown-item">Dari Tabel</a>
									    	<a class="dropdown-item">Health Center</a> -->
								  		</div>
									</div>
								</div>

								<div class="modalText" id="SH_Hide">
									<span class="d-flex justify-content-center" style="text-align: center;"> Ware House:</span>
									<div class="dropdown d-flex justify-content-center">
									  	<button type="button" id="title-dd6" value="" class="btn6 border dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown" style="font-weight: 500; margin-bottom: 10px; margin-top: -0px; box-shadow: none;">Kertamanu</button>
										<div class="dropdown-menu dd6 text-center">
									    	<a class="dropdown-item">Kertamanu</a>
									    	<!--<a class="dropdown-item">Kasih Ibu</a>
									    	<a class="dropdown-item">Generate</a>
									    	<a class="dropdown-item">Dari Tabel</a>
									    	<a class="dropdown-item">Health Center</a> -->
								  		</div>
									</div>
								</div>
							</div>

							<div class="Modal_Table_Container">

								<div class="text-center Modal_Table_Title">WAREHOUSE STOCK</div>

								<div id="Modal_Table" style="width: 500px; max-height: 330px; overflow-y: auto;">
									<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
										<thead>
											<tr style="text-align: center;">
												<th style="width: 25%;">Item</th>
												<th style="width: 25%">Info</th>
												<th style="width: 25%">Qty</th>
												<th style="width: 25%">Exp Date</th>
											</tr>
										</thead>

										<tbody class="text-center" id="tbody-warehouse">
											<!-- <tr>   
												<td>Paramex</td>   
												<td>20 mg</td> 
												<td>200</td> 
												<td>Yes</td>  
											</tr>
											<tr>   
												<td>Panadol</td>   
												<td>20 mg</td> 
												<td>50</td> 
												<td>No</td>  
											</tr>
											<tr>   
												<td>O+</td>   
												<td>500 ml</td> 
												<td>10</td> 
												<td>Yes</td>  
											</tr>
											<tr>   
												<td>B-</td>   
												<td>500 ml</td> 
												<td>5</td> 
												<td>No</td>  
											</tr> -->
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>


					<div class="text-center" style="margin-top: 15px;">
						<button class="Buttonn" style="background-color: red;" onclick='denyReq()'>Deny</button>
						<button class="Buttonn" style="background-color: #4fbbb2;" onclick='sendToBasket()'>Accept</button>
					</div>
				</div>

	        </div>
	      </div>
	      
	    </div>
	</div>
	
	<div class="modal" id="Succeed_Modal" role="dialog">
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
		.approval_Button{
			color: #4fbbb2;
			font-size: 14px;
			font-weight: 500;

			margin-top: -9px;
			background-color: transparent;
			border: none;
		}
		.approval_Button:hover{
			color: black;
		}
		.Mail:hover{
			text-decoration: none;
		}

		.Buttonn{
			align-self: center; 
			border-radius: 20px;
			color: white; 
			height: 38px; 
			width: 100px;
			border: none;
			margin-right: 5px; 
			font-weight: 500;
		}

		.tes{
			line-height:25px;
		}
	</style>
</body>

</html>