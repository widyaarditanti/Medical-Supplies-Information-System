<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'local_Header.php'; ?>
	<?php include 'css.php';
	if (!isset($_SESSION["halamanAktif"])){
		$_SESSION["halamanAktif"]=$_GET["halamanAktif"];
	}
	;
 
	?>

	<!-- CODING -->
    <script type="text/javascript">
	var halaman= <?php echo $_GET["halamanAktif"];?>;
	//alert(halaman);
	<?php if (!isset($_SESSION["halamanAktif"])){
		header("Refresh:0");
	}?>;
	var adminss=0;
	var next=" ";
			var idmut;
			var prev=" ";
	var dropmut1=0;
	var dropmut2=0;
		var searchtext=" ";
		var ajaxcall, button = [1, 0], filter="All", buttonActive = "All";
		var searchdetail=" ";
		var searchmutasi=" ";
		var count=0;
		$(".btn100:first-child").innerHTML="Filter By";
		//alert("wkkw");
		function search(){
			//alert("masuk");
    		var text = document.getElementById("search_Transaction").value;
    		var btns = document.getElementsByClassName("btnsss");
			var icon = button[0];
			$.ajax({
				url:"includes/filter_transaction.php",
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
						//search();
						document.getElementById("Icons").style.display="flex";
						document.getElementById("Tables").style.display="none";
					}
					if(category == 1){
						button[0] = 0;
						button[1] = 1;
						//search();
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
		}

		function deleteButton(parent){
			document.getElementById("delete_name").innerHTML = parent.children[6].innerHTML;
		}

		function filterButton(parent) {
		
			//one piece ep 356
			var nomor=parent.children[0].children[0].innerHTML;// nomer aneh
			var type=parent.children[0].children[1].innerHTML;// type
			var tanggal=parent.children[0].children[3].innerHTML;// tanggal
			var status=parent.children[0].children[4].innerHTML;//confirm on going wiaitng kosong lala
			var hc = parent.children[0].children[5].innerHTML;//nama HCnya
			var datas=parent.children[0].children[6].innerHTML;//trans id
			//alert(datas);
			
			
			if (status=" "){
				status="Done";
			}
			var stg="<div class='modal-dialog d-flex justify-content-center'>";
			stg+="<div class='modal-content' style='margin: auto; border: none;'>";
			stg+="<div class='modal-body'>";
			stg+="<div class='ml-2 mr-2 justify-content-center'>  ";
			stg+="<button type='button' class='close' data-dismiss='modal' style='outline: none;'>&times;</button><br>";
			stg+="<div class='text-center' id='Modal_T_ID' style='color: #4fbbb2; font-weight: 500; font-size: 24px; margin-top: -20px;'>"+nomor+"</div><br>";
			stg+="<div class='Modal_Date' id='Modal_T_Date'>"+tanggal+"</div>";
			stg+="<div class='Modal_Text'>TYPE: &nbsp;<span class='Modal_Text2' id='Modal_T_Type'>"+type+"</span></div>";
			stg+="<div class='Modal_Text'>HEALTH CENTER: &nbsp;<span class='Modal_Text2' id='Modal_T_Type'>"+hc+"</span></div>";
			stg+="<div class='Modal_Text'>STATUS: &nbsp;<span class='Modal_Text2' id='Modal_T_Type'>"+status+"</span></div>";
			/* var a=document.getElementById("hid1");
			var b=document.getElementById("hid2");
			var c=document.getElementById("hid3"); */
			//alert("ASK");
			if (type=="Request" || type=="Move"){
				$.ajax({
					url:"includes/filtercard.php",
					type:"POST",
					data:{adminss:adminss,datas:datas},
					dataType:'json',
					success:function(result){
						
						for(var i in result){
						var x= result[i];
						//alert(x.mutasi_id+x.prev_loc+x.next_loc);
						document.getElementById("Modal_T_Type1").innerHTML=x.mutasi_id;
						document.getElementById("Modal_T_Type2").innerHTML=x.prev_loc;
						document.getElementById("Modal_T_Type3").innerHTML=x.next_loc;
						}
						
					},
					error:function(xhr,textStatus,errorThrown){
						var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
						alert(err);
					}
				});

				
			}
			//alert(stg);
			var data=" ";		
			if (type=="Request" || type=="Move" ){
				stg+="<div class='Modal_Text'>ID MUTATION: &nbsp;<span class='Modal_Text2' id='Modal_T_Type1'></span></div>";
				stg+="<div class='Modal_Text row'>PREV LOCATION: &nbsp;";
				stg+="<span class='Modal_Text2' id='Modal_T_Type2'></span>";
				stg+="<div class='mx-3' style='width: 3px; height: 30px; background-color: #4fbbb2; border-radius: 10px; '></div>NEXT LOCATION: &nbsp;";
				stg+="<span class='Modal_Text2' id='Modal_T_Type3'></span>";
				stg+="</div><br>";
				
			}
				
			stg+="<div class='Modal_Table_Container'><div class='text-center Modal_Table_Title'>DETAIL TRANSACTION</div><div id='Modal_Table' style='max-height: 330px; overflow-y: auto;'><table class='container table table-striped table-borderless table-sm' style='font-size: 13px;'><thead><tr style='text-align: center;'><th >id_detail_transaksi</th><th >id_transaksi</th><th >stock</th><th >jumlah</th><th >aprroval</th><th >buy</th></tr></thead><tbody class='text-center' id='bodyDTK'></tbody></table></div></div></div></div></div></div> ";
			document.getElementById("Filter_Modal").innerHTML=stg;
			$.ajax({
						url: "includes/get_data_detail_transaction_central.php",
			            type: "POST",
			            dataType: "json",
			            data:{adminss:adminss,datas:datas},
			            success:function(res){
			            	console.log(res);
			                var data = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<data.length;i++){
			                    var x = data[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.id_detail_transaksi+"</td>";
			                    str+= "<td>"+x.id_transaksi+"</td>";
			                    str+= "<td class='namaDT'>"+x.nama+"</td>";
			                    str+= "<td>"+x.jumlah+"</td>";
			                    str+= "<td>"+x.approval+"</td>";
								str+= "<td>"+x.buy+"</td>";
			                    str+="</tr>";
			                }
						str+="</tbody>";
						//alert(str);
						document.getElementById("bodyDTK").innerHTML=str;
						
					
			            },
			            error: function(e){
			                alert("Error");
						}
						
			});
			var x = parent.children[0].children[0].innerHTML;
		}

		function categoryButton(x){
			if(x.innerHTML == "Category" || x.innerHTML == "Pra-Sarana" || x.innerHTML == "Sarana" || x.innerHTML == "Supplies"){
				x.parentElement.parentElement.children[1].children[0].innerHTML = "Sub-Category";
			}
			else{
				x.parentElement.parentElement.children[0].children[0].innerHTML = "Category";
			}
		}

    	$(document).ready(function(){
		
			 drop1=0;
			 drop2=0;
			
			 drop100=0;
			 data1=" ";
			 data2=" ";
			 data100=" ";
			 searchtext=" ";
					$.ajax({
						url: "includes/get_data_t_lokal.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,searchtext:searchtext,data100:data100,drop100:drop100,data1:data1,data2:data2,drop1:drop1,drop2:drop2},
			            success:function(res){
			            	//alert(res);
			                var data = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<data.length;i++){
			                    var x = data[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.trans_id+"</td>";
								str+= "<td>"+x.tanggal+"</td>";
								str+= "<td>"+x.status+"</td>";
			                    str+= "<td>"+x.namad+"</td>";
								str+= "<td>"+x.namas+"</td>";
			                    str+= "<td>"+x.namax+"</td>";
								str+= "<td>"+x.katas+"</td>";
								str+="</tr>";
								
							}
							
						str+="</tbody>";
						//alert(str);
						document.getElementById("bodyT").innerHTML=str;
					
			            },
			            error: function(e){
			                alert("Error asdss");
			            }
					});
					 data=" ";
					 drop1=0;
					 drop2=0;
					 data1=" ";
					 data2=" ";
					 searchtext=" ";
					//alert("search text= "+searchtext+" data1= "+data1+" data2= "+data2+" Drop1= "+ drop1+" Drop2="+drop2);
					$.ajax({
						url: "includes/get_data_transaksi_lokal_card.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,data100:data100,drop100:drop100,searchtext:searchtext,data1:data1,data2:data2,drop1:drop1,drop2:drop2},
			            success:function(res){      
						console.log("card = " + res);
						var data=res;
						var Gstring="";
						for(var i=0;i<data.length;i++){
								var x = data[i];
								var lol=x.status;
								var sb=lol.substring(0, 1);
								console.log(sb);
								var angka=x.trans_id;
								if (angka / 10 < 0){
									var kode= "00000"+ angka;
								}
								else if (angka / 10 > 0){
									var kode= "0000"+ angka;
								}
								else if (angka / 100 > 0){
									var kode= "000"+ angka;
								}
								var lapodijoin;
								if(x.kategori_transaksi==1){
									lapodijoin="Request";
								}
								else if(x.kategori_transaksi==2){
									lapodijoin="Move";
								}
								else{
									lapodijoin="Use";
								}
								
								Gstring+="<div class='iconn container d-flex justify-content-center' onclick='click()'><div class='data container-fluid my-auto'>";
			                    Gstring+= "<span class='Id_Transaction d-flex justify-content-center'>#"+sb+"_"+kode+"</span>";
								Gstring+= "<span class='Status_Transaction d-flex justify-content-center'>"+lapodijoin+"</span>";
								if(lapodijoin=="Request"){
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								Gstring+="<img src='img/Arrow.png' style='width: 35px; height: 20px;'>";
								Gstring+="&nbsp;&nbsp;&nbsp;";
								Gstring+= "<span class='To_HealthCenter'>"+x.namax+"</span>";
								}
								else{
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								
								}
							
								Gstring+="</div>";
								Gstring+= "<span class='Date_Transaction d-flex justify-content-center'>"+x.tanggal+"</span>";
								Gstring+="<span class='Confirm_Transaction d-flex justify-content-center'>"+x.status+"</span>";
								Gstring+="<a id='wkwk' style='display:none;'>"+x.nama+"</a>";
								Gstring+="<a id='wkwk123' style='display:none;'>"+x.trans_id+"</a>";
								Gstring+="</div>";
								Gstring+= "<button class='Filter_Transaction' data-toggle='modal' data-target='#Filter_Modal' onclick='filterButton(this.parentElement)' ></button>";
								Gstring+= "</div>";
								
								console.log(Gstring);
							}
						document.getElementById("Icons").innerHTML=Gstring;
			            },
			            error: function(e){
			                alert("Error asd");
			            }
					});
					
					var data99=55;//tandai
					$.ajax({
						url: "includes/get_data_mutasi_central.php",
			            type: "POST",
			            dataType: "json",
			            data: {data99:data99},
			            success:function(res){
			            	console.log(res);
			                var data = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<data.length;i++){
			                    var x = data[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.mutasi_id+"</td>";
			                    str+= "<td>"+x.tanggal+"</td>";
			                    str+= "<td>"+x.jumlah+"</td>";
			                    str+= "<td class='prev'>"+x.prev_loc+"</td>";
			                    str+= "<td class='next'>"+x.next_loc+"</td>";
								str+= "<td>"+x.stock_id+"</td>";
								str+= "<td>"+x.transaksi_id+"</td>";
								str+="</tr>";
								count=count+1;
			                }
						str+="</tbody>";
						//(str);
						document.getElementById("bodyM").innerHTML=str;
					
			            },
			            error: function(e){
			                alert("Error");
			            }
					});
					var datas=0;
					$.ajax({//beres
						url: "includes/get_data_detail_transaction_central.php",
			            type: "POST",
			            dataType: "json",
			            data:{adminss:adminss,datas:datas},
			            success:function(res){
			            	console.log(res);
			                var data = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<data.length;i++){
			                    var x = data[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.id_detail_transaksi+"</td>";
			                    str+= "<td>"+x.id_transaksi+"</td>";
			                    str+= "<td class='namaDT'>"+x.nama+"</td>";
			                    str+= "<td>"+x.jumlah+"</td>";
			                    str+= "<td>"+x.approval+"</td>";
								str+= "<td>"+x.buy+"</td>";
			                    str+="</tr>";
			                }
						str+="</tbody>";
						//alert(str);
						document.getElementById("bodyDt").innerHTML=str;
						
					
			            },
			            error: function(e){
			                alert("Error");
						}
						
					});

					//btn btn100 dropdown_btnss dropdown-toggle py-1 px-3
					//Jangan lupa ambil barang diciland jam 2 siang senin tgl 23
					
			$(".dropdown-menu.dd100 a").click(function(){
				////alert($(".btn100:first-child").text());
				
				$(".btn100:first-child").html($(this).text());
				//alert($(".btn100:first-child").text());
				if($(".btn100:first-child").text()=="Nama Admin"){
					drop100=1;
				}
				else if($(".btn100:first-child").text()=="Tanggal"){
					drop100=1;
				}
				else if($(".btn100:first-child").text()=="Filter By"){
					drop100=0;
				}
				data100=$(this).text();
				 data2=$(".btn2:first-child").text();
				data1=$(".btn1:first-child").text();
				//alert("data3="+data100+drop100);
				
			});
			$(".dropdown-menu.dd101 a").click(function(){
				
				
				$(".btn101:first-child").html($(this).text());
				//alert($(".btn101:first-child").html());
				if($(".btn101:first-child").text()=="Nextloc"){
					//alert($(".btn101:first-child").text());
					dropmut1=1;
					dropmut2=0;
				}
				else if($(".btn101:first-child").text()=="Prevloc"){
					//alert($(".btn101:first-child").text());
					dropmut2=1;
					dropmut1=0;
				}
				else if($(".btn101:first-child").text()=="Filter By"){
				
					dropmut2=0;
					dropmut1=0;
				}

				var value = document.getElementById("search_Mutasi").value;
				if(dropmut1==1 && dropmut2==0){
					//alert("asdsad1");
					$(".next").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				}
				else if (dropmut2==1 && dropmut1==0){
					//alert("asdsad2");
				$(".prev").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
	            }); 
				}
			
			});
			$(".dropdown-menu.dd1 a").click(function(){
				$(".btn1:first-child").html($(this).text());
				if($(".btn1:first-child").text()=="Type"){
					//alert("asd");
					drop1=0;
				}
				else{
					//alert("asdsk");
					drop1=1;
				}
				if($(".btn2:first-child").text()=="done" || $(".btn2:first-child").text()=="on going" || $(".btn2:first-child").text()=="denied" || $(".btn2:first-child").text()=="cancel" || $(".btn2:first-child").text()=="waiting"){
					 drop2=1;
				}
				else{
					data2="Status";
					 drop2=0;
				}
			  data1=$(this).text();
				  data2=$(".btn2:first-child").text();
			
				$.ajax({
					url: "includes/get_data_t_lokal.php",
					type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,searchtext:searchtext,data100:data100,data1:data1,data2:data2,drop1:drop1,drop2:drop2,drop100:drop100},
			            success:function(res){
							console.log(res);
			                var hasil = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<hasil.length;i++){
								var x = hasil[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.trans_id+"</td>";
								str+= "<td>"+x.tanggal+"</td>";
								str+= "<td>"+x.status+"</td>";
			                    str+= "<td>"+x.namad+"</td>";
								str+= "<td>"+x.namas+"</td>";
			                    str+= "<td>"+x.namax+"</td>";
								str+= "<td>"+x.katas+"</td>";
								str+="</tr>";

							
								
							}
							
							str+="</tbody>";
						////alert(str);
						document.getElementById("bodyT").innerHTML=str;
			            },
			            error: function(e){
							alert("Error");
			            }
					});
					$.ajax({
						url: "includes/get_data_transaksi_lokal_card.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,searchtext:searchtext,data100:data100,data1:data1,data2:data2,drop1:drop1,drop2:drop2,drop100:drop100},
			            success:function(res){      
							console.log("card 123= " + res);
							var data=res;
							var Gstring="";
							for(var i=0;i<data.length;i++){
								var x = data[i];
								var lol=x.status;
								var sb=lol.substring(0, 1);
								console.log(sb);
								var angka=x.trans_id;
								if (angka / 10 < 0){
									var kode= "00000"+ angka;
								}
								else if (angka / 10 > 0){
									var kode= "0000"+ angka;
								}
								else if (angka / 100 > 0){
									var kode= "000"+ angka;
								}
								var lapodijoin;
								if(x.kategori_transaksi==1){
									lapodijoin="Request";
								}
								else if(x.kategori_transaksi==2){
									lapodijoin="Move";
								}
								else{
									lapodijoin="Use";
								}
								
								Gstring+="<div class='iconn container d-flex justify-content-center' onclick='click()'><div class='data container-fluid my-auto'>";
			                    Gstring+= "<span class='Id_Transaction d-flex justify-content-center'>#"+sb+"_"+kode+"</span>";
								Gstring+= "<span class='Status_Transaction d-flex justify-content-center'>"+lapodijoin+"</span>";
								if(lapodijoin=="Request"){
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								Gstring+="<img src='img/Arrow.png' style='width: 35px; height: 20px;'>";
								Gstring+="&nbsp;&nbsp;&nbsp;";
								
								Gstring+= "<span class='To_HealthCenter'>"+"<?php echo $_SESSION["username"];?>"+"</span>";
								}
								else{
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								
								}
								
							
							Gstring+="</div>";
								Gstring+= "<span class='Date_Transaction d-flex justify-content-center'>"+x.tanggal+"</span>";
								Gstring+="<span class='Confirm_Transaction d-flex justify-content-center'>"+x.status+"</span>";
								Gstring+="<a id='wkwk' style='display:none;'>"+x.nama+"</a>";
								Gstring+="<a id='wkwk123' style='display:none;'>"+x.trans_id+"</a>";
								Gstring+="</div>";
								Gstring+= "<button class='Filter_Transaction' data-toggle='modal' data-target='#Filter_Modal' onclick='filterButton(this.parentElement)' ></button>";
								Gstring+= "</div>";
								
								console.log(Gstring);
							}
						document.getElementById("Icons").innerHTML=Gstring;
			            },
			            error: function(e){
			                alert("Error");
			            }
					});
				//alert("drop1="+drop1+" "+"drop2= "+drop2+" data1"+data1+" data2="+data2);
				
			});
			$(".dropdown-menu.dd2 a").click(function(){
				$(".btn2:first-child").html($(this).text());
				if($(".btn1:first-child").text()!="Type"){
					  drop1=0;
					  
				}
				else{
				 drop1=1;
				 //alert("wk");
				}
				if($(".btn2:first-child").text()=="done" || $(".btn2:first-child").text()=="on going" || $(".btn2:first-child").text()=="denied" || $(".btn2:first-child").text()=="cancel" || $(".btn2:first-child").text()=="waiting"){
					  drop2=1;
				}
				else{
					data2="Status";
					 drop2=0;
				}
				 data2=$(this).text();
				 data1=$(".btn1:first-child").text();
				
				//alert("data1= "+data1+" data2= "+data2+" Drop1= "+ drop1+" Drop2="+drop2);
					$.ajax({
						url: "includes/get_data_t_lokal.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,searchtext:searchtext,data100:data100,data1:data1,data2:data2,drop1:drop1,drop2:drop2,drop100:drop100},
			            success:function(res){
			            	console.log(res);
			                var hasil = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<hasil.length;i++){
			                    var x = hasil[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.trans_id+"</td>";
								str+= "<td>"+x.tanggal+"</td>";
								str+= "<td>"+x.status+"</td>";
								str+= "<td>"+x.namad+"</td>";
								str+= "<td>"+x.namas+"</td>";
			                    str+= "<td>"+x.namax+"</td>";
								str+= "<td>"+x.katas+"</td>";
								str+="</tr>";

								
							
								
							}
							
						str+="</tbody>";
						////alert(str);
						document.getElementById("bodyT").innerHTML=str;
						
			            },
			            error: function(e){
			                alert("Error asdasdasd");
			            }
					});
		
					$.ajax({
						url: "includes/get_data_transaksi_lokal_card.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,searchtext:searchtext,data100:data100,data1:data1,data2:data2,drop1:drop1,drop2:drop2,drop100:drop100},
			            success:function(res){      
						console.log("card = " + res);
						var data=res;
						var Gstring="";
						for(var i=0;i<data.length;i++){
								var x = data[i];
								var lol=x.status;
								var sb=lol.substring(0, 1);
								console.log(sb);
								var angka=x.trans_id;
								if (angka / 10 < 0){
									var kode= "00000"+ angka;
								}
								else if (angka / 10 > 0){
									var kode= "0000"+ angka;
								}
								else if (angka / 100 > 0){
									var kode= "000"+ angka;
								}
								var lapodijoin;
								if(x.kategori_transaksi==1){
									lapodijoin="Request";
								}
								else if(x.kategori_transaksi==2){
									lapodijoin="Move";
								}
								else{
									lapodijoin="Use";
								}
								
								Gstring+="<div class='iconn container d-flex justify-content-center' onclick='click()'><div class='data container-fluid my-auto'>";
			                    Gstring+= "<span class='Id_Transaction d-flex justify-content-center'>#"+sb+"_"+kode+"</span>";
								Gstring+= "<span class='Status_Transaction d-flex justify-content-center'>"+lapodijoin+"</span>";
								if(lapodijoin=="Request"){
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								Gstring+="<img src='img/Arrow.png' style='width: 35px; height: 20px;'>";
								Gstring+="&nbsp;&nbsp;&nbsp;";
								
								Gstring+= "<span class='To_HealthCenter'>"+"<?php echo $_SESSION["username"];?>"+"</span>";
								}
								else{
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								
								}
								
							
								Gstring+="</div>";
								Gstring+= "<span class='Date_Transaction d-flex justify-content-center'>"+x.tanggal+"</span>";
								Gstring+="<span class='Confirm_Transaction d-flex justify-content-center'>"+x.status+"</span>";
								Gstring+="<a id='wkwk' style='display:none;'>"+x.nama+"</a>";
								Gstring+="<a id='wkwk123' style='display:none;'>"+x.trans_id+"</a>";
								Gstring+="</div>";
								Gstring+= "<button class='Filter_Transaction' data-toggle='modal' data-target='#Filter_Modal' onclick='filterButton(this.parentElement)' ></button>";
								Gstring+= "</div>";
								
							//console.log(Gstring);
							}
						document.getElementById("Icons").innerHTML=Gstring;
			            },
			            error: function(e){
			                alert("Error");
			            }
					});
					
					
				});
				$("#search_Transaction").on("keyup", function() {
					 searchtext = $(this).val().toLowerCase();
					 //alert("data100="+data100+" drop100="+drop100+" search text="+searchtext+" data1= "+data1+" data2= "+data2+" Drop1= "+ drop1+" Drop2="+drop2);

					
						$.ajax({
						url: "includes/get_data_t_lokal.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,data100:data100,drop100:drop100,searchtext:searchtext,data1:data1,data2:data2,drop1:drop1,drop2:drop2},
			            success:function(res){
			            	console.log(res);
			                var hasil = res;
			                var str = "<tbody class='text-center' id='body'>";
			                for(var i=0;i<hasil.length;i++){
			                    var x = hasil[i];
			                    str+= "<tr>";
			                    str+= "<td>"+x.trans_id+"</td>";
								str+= "<td>"+x.tanggal+"</td>";
								str+= "<td>"+x.status+"</td>";
								str+= "<td>"+x.namad+"</td>";
								str+= "<td>"+x.namas+"</td>";
			                    str+= "<td>"+x.namax+"</td>";
								str+= "<td>"+x.katas+"</td>";
								str+="</tr>";
								
							}
							
						str+="</tbody>";
						//alert(str);
						document.getElementById("bodyT").innerHTML=str;
						
		
						
			            },
			            error: function(xhr,textStatus,errorThrown){
			                var err = "ERROR : server error <br>"+xhr+"<br>"+textStatus+"<br>"+errorThrown;
					            alert(err);
			            }
						});
					$.ajax({
						url: "includes/get_data_transaksi_lokal_card.php",
			            type: "POST",
			            dataType: "json",
			            data: {halaman:halaman,adminss:adminss,data100:data100,drop100:drop100,searchtext:searchtext,data1:data1,data2:data2,drop1:drop1,drop2:drop2},
			            success:function(res){      
						console.log("card = " + res);
						var data=res;
						var Gstring="";
						for(var i=0;i<data.length;i++){
								var x = data[i];
								var lol=x.status;
								var sb=lol.substring(0, 1);
								console.log(sb);
								var angka=x.trans_id;
								if (angka / 10 < 0){
									var kode= "00000"+ angka;
								}
								else if (angka / 10 > 0){
									var kode= "0000"+ angka;
								}
								else if (angka / 100 > 0){
									var kode= "000"+ angka;
								}
								var lapodijoin;
								if(x.kategori_transaksi==1){
									lapodijoin="Request";
								}
								else if(x.kategori_transaksi==2){
									lapodijoin="Move";
								}
								else{
									lapodijoin="Use";
								}
								
								Gstring+="<div class='iconn container d-flex justify-content-center' onclick='click()'><div class='data container-fluid my-auto'>";
			                    Gstring+= "<span class='Id_Transaction d-flex justify-content-center'>#"+sb+"_"+kode+"</span>";
								Gstring+= "<span class='Status_Transaction d-flex justify-content-center'>"+lapodijoin+"</span>";
								if(lapodijoin=="Request"){
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								Gstring+="<img src='img/Arrow.png' style='width: 35px; height: 20px;'>";
								Gstring+="&nbsp;&nbsp;&nbsp;";
								
								Gstring+= "<span class='To_HealthCenter'>"+"<?php echo $_SESSION["username"];?>"+"</span>";
								}
								else{
								Gstring+="<div class='butonnn d-flex justify-content-center row' style=' width: 340px; margin-left: -30px; padding-left: 20px; padding-right: 20px;>'";
								Gstring+="<span class='From_HealthCenter'>"+ x.nama+"</span>";
								Gstring+= "(<span class='From_Admin'>"+x.username+"</span>)";
								Gstring+="&nbsp;&nbsp;";
								
								}
							
							Gstring+="</div>";
								Gstring+= "<span class='Date_Transaction d-flex justify-content-center'>"+x.tanggal+"</span>";
								Gstring+="<span class='Confirm_Transaction d-flex justify-content-center'>"+x.status+"</span>";
								Gstring+="<a id='wkwk' style='display:none;'>"+x.nama+"</a>";
								Gstring+="<a id='wkwk123' style='display:none;'>"+x.trans_id+"</a>";
								Gstring+="</div>";
								Gstring+= "<button class='Filter_Transaction' data-toggle='modal' data-target='#Filter_Modal' onclick='filterButton(this.parentElement)' ></button>";
								Gstring+= "</div>";
								
							//console.log(Gstring);
							}
						document.getElementById("Icons").innerHTML=Gstring;
						
			            },
			            error: function(e){
			                alert("Error card");
			            }
					});
					<?php
					if (!isset($_SESSION["jumlahHalaman"])){
						header("Refresh:0");
						}
					?>
			});
		
			
			$(document).on("keyup", "#search_Detail", function(){
				var value = $(this).val().toLowerCase();
				//alert("asmdaskmdas");
				$(".namaDT").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
	            });
			});

			$(document).on("keyup", "#search_Mutasi", function(){
				//alert("asdsad");
				var value = $(this).val().toLowerCase();
				if(dropmut1==1 && dropmut2==0){
					//alert("asdsad1");
					$(".next").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				}
				else if (dropmut2==1 && dropmut1==0){
					//alert("asdsad2");
				$(".prev").filter(function() {
	                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
	            }); 
				}
					
					
				
			});
			function click(){
				//alert("wk");
			}
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;">History Transaction </h3> 
	</div>

	<div class="d-flex justify-content-center" style="margin-left: -150px;">
		<div class="dropdown d-flex justify-content-center">
			<button type="button" class="btn btn100 dropdown_btnss dropdown-toggle py-1 px-3" data-toggle="dropdown">Filter By</button>
			<div id="dd-jenis-search" class="dropdown-menu dd100 text-center">
			
				<a class="dropdown-item">Tanggal</a>
			<a class="dropdown-item">Nama Admin</a>
			</div>
	</div>
	<input type="text" id="search_Transaction"class="form-control" aria-label="Default" placeholder="Search" style="margin-bottom: 5px;">
	 
	</div>

	<div class="row d-flex justify-content-center">
		<button class="btnsss d-flex justify-content-center" type="button" onclick="buttonMenu(0)" onmouseover="hoverButton(0)" onmouseleave="notHoverButton()" type="button" value="Add" style="background-color: #e5e5e5;"><img src="img/Icon.png"></button>

		<button class="btnsss d-flex justify-content-center" onclick="buttonMenu(1)" onmouseover="hoverButton(1)" onmouseleave="notHoverButton()" type="button" value="Edit"><img src="img/List.png" style="margin-left: 2px;"></button>
	</div>

	<!-- FILTER -->
	<div class="row d-flex justify-content-center" style="margin-top: -10px;">
		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" class="btn btn1 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Type
		  	</button>
		 	<div id="dd1" class="dropdown-menu dd1 text-center">
		    	<a class="dropdown-item">Type</a>
		    	<a class="dropdown-item">Request</a>
		    	<a class="dropdown-item">Use</a>
		    	<a class="dropdown-item">Move</a>
		  	</div>
		</div>

		<div class="dropdown d-flex justify-content-center">
		  	<button type="button" class="btn btn2 dropdown_btns dropdown-toggle px-3 py-1" data-toggle="dropdown">Status
		  	</button>
		 	<div id="dd2"class="dropdown-menu dd2 text-center">
		    	<a class="dropdown-item">Status</a>
		    	<a class="dropdown-item">done</a>
		    	<a class="dropdown-item">on going</a>
				<a class="dropdown-item">waiting</a>
		  	</div>
		</div>
	</div>

	<!-- LIST DATA -->
	<div class="container-fluid row justify-content-center" id="Icons" style="margin-left: 0px;">
	
	</div>

	<!-- TABLES indomaret-->
	<div id="Tables" style="display: none;">
		<table id="tabel" class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
			<thead>
				<tr style="text-align: center;">
					<th >Trans_ID</th>
					<th >Tanggal</th>
					<th >status</th>
					<th >admin_id</th>
					<th >pk_penerima</th>
					
					<th >pk_penyedia</th>
					<th >kategori_transaksi</th>	
				</tr>
			</thead>

			<tbody class="text-center" id="bodyT">
		
			</tbody>
		</table>
	</div>

	<!-- PAGES -->
	<br><div class="container d-flex justify-content-center">
		<?php if($_GET['halamanAktif']>1):?>
		<a href="?halamanAktif=<?=$_GET['halamanAktif']-1;?>" type="button" class="btn btnPage">Prev</a>
		<?php endif; ?>
		
		<?php 
		$halamanAktif=$_GET["halamanAktif"];;
		if (!isset($_SESSION["jumlahHalaman"])){
			header("Refresh:0");
		}
		
		for ($i = 1;$i<=$_SESSION['jumlahHalaman'];$i++):?>
			<?php if($i == $halamanAktif):?>
			<a href="?halamanAktif=<?= $i;?>" type="button" class="btn btnPage" style="background-color: rgb(220,220,220);"><?= $i;?></a>
			
			<?php else:?>
			<a href="?halamanAktif=<?= $i;?>" type="button" class="btn btnPage"><?= $i;?></a>
		
			<?php endif;?>
		<?php endfor;?>
				
		<?php if($_GET['halamanAktif']<$_SESSION['jumlahHalaman']):?>
		<a href="?halamanAktif=<?=$_GET['halamanAktif']+1;?>" type="button" class="btn btnPage">Next</a>
		<?php endif; ?>
	</div>
	
	<br>

	<!-- SIDE NAV -->
	<div class="sidenav" id="mySidenav">
         <a href="#" id="SideNav_Mutasi" data-toggle="modal" data-target="#Mutation_Modal"><img src="img/Mutation.png"
         width="36" height="36" style="padding-bottom: 0px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px; padding-top: 10px;">&nbsp;Mutation</b></a>

         <a href="#" id="SideNav_Detail" data-toggle="modal" data-target="#Detail_Modal"><img src="img/Detail.png"
         width="38" height="38" style="padding-bottom: 0px;"> &nbsp;&nbsp;&nbsp;<b style="color: white; font-size: 19px; padding-top: 10px;">&nbsp;Detail Transaction</b></a>
	</div>

	<!-- FILTER MODAL -->
	<div class="modal modalmodal" id="Filter_Modal" role="dialog">
	    <!-- <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>
					
					<div class="text-center" id="Modal_T_ID" style="color: #4fbbb2; font-weight: 500; font-size: 24px; margin-top: -20px;">#R_008902</div><br>
					<div class="Modal_Date" id="Modal_T_Date">2 October 2020</div>
					<div class="Modal_Text">TYPE: &nbsp;<span class="Modal_Text2" id="Modal_T_Type">Request</span></div>
					<div class="Modal_Text">HEALTH CENTER: &nbsp;<span class="Modal_Text2" id="Modal_T_Type">Siloam</span></div>
					<div class="Modal_Text">STATUS: &nbsp;<span class="Modal_Text2" id="Modal_T_Type">Done</span></div>

					<div class="Modal_Text">ID MUTATION: &nbsp;<span class="Modal_Text2" id="Modal_T_Type">#000897</span></div>
					<div class="Modal_Text row">
						PREV LOCATION: &nbsp;
						<span class="Modal_Text2" id="Modal_T_Type">#WH_00021</span> 

						<div class="mx-3" style="width: 3px; height: 30px; background-color: #4fbbb2; border-radius: 10px; "></div> 

						NEXT LOCATION: &nbsp;
						<span class="Modal_Text2" id="Modal_T_Type">#WH_00032</span>

					</div><br>

					<div class="Modal_Table_Container">

						<div class="text-center Modal_Table_Title">DETAIL TRANSACTION</div>

						<div id="Modal_Table" style="max-height: 330px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
									<th >No</th>
										<th >id_transaksi</th>
										<th >nama</th>
										<th >jumlah</th><th >aprroval</th><th >batch</th>
									</tr>
								</thead>

								<tbody class="text-center" id="bodyDTK">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
	        </div>
	      </div>
	      
	    </div> -->
	</div>

	<!-- DETAIL MODAL -->
	<div class="modal modalmodal" id="Detail_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>

					<div class="Modal_Table_Container" style="margin: -40px 0 0 -24px; width: 1300px; height: 650px;">

						<br><div class="text-center" style="font-size: 25px; color: white; font-weight: 500;">DETAIL TRANSACTION</div><br>

						<div class="d-flex justify-content-center"><input type="text" id="search_Detail" class="form-control" aria-label="Default" placeholder="Search" style="margin-top: -15px; margin-left: -10px; margin-bottom: 20px;"></div>

						<div id="Modal_Detail_Table" style="max-height: 500px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
										<th >ID_detail_transaksi</th>
										<th >id_transaksi</th>
										<th >id_stock</th>
										<th >jumlah</th>
										<th >aprroval</th>
										<th>Buy</th>
									</tr>
								</thead>

								<tbody class="text-center" id="bodyDt">
									
								</tbody>
							</table>
						</div>
					</div>


				</div>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- MUTATION MODAL -->
	<div class="modal modalmodal" id="Mutation_Modal" role="dialog">
	    <div class="modal-dialog d-flex justify-content-center">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<div class="ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button><br>

					<div class="Modal_Table_Container" style="margin: -40px 0 0 -24px; width: 1300px; height: 650px;">
						
						<br><div class="text-center" style="font-size: 25px; color: white; font-weight: 500;">MUTATION TRANSACTION</div><br>

						<div class="d-flex justify-content-center"><input type="text" id="search_Mutasi" class="form-control" aria-label="Default" placeholder="Search" style="margin-top: -15px; margin-left: -10px; margin-bottom: 20px;">
						
						</div>
						<div class="dropdown d-flex justify-content-center">
			<button type="button" class="btn btn101 dropdown_btnss dropdown-toggle py-1 px-3" data-toggle="dropdown">Filter By</button>
			<div id="dd-jenis-search" class="dropdown-menu dd101 text-center">
			
				<a class="dropdown-item">Prevloc</a>
			<a class="dropdown-item">Nextloc</a>
			</div>
	</div>
						<div id="Modal_Mutation_Table" style="max-height: 500px; overflow-y: auto;">
							<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
								<thead>
									<tr style="text-align: center;">
										<th>mutasi_id</th>
										<th>tanggal</th>
										<th>jumlah</th>
										<th>prev_loc</th>
										<th>next_loc</th>
										<th>stock_id</th>
										<th>transaksi_id</th>
									</tr>
								</thead>

								<tbody class="text-center" id="bodyM">
									
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