<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'
	;
	
	ob_start();
	session_start(); ?>

	<!-- CODING -->
	<script type="text/javascript">
	var tipe="";
		function logon(){
			if(tipe=="Master"){
				tipe=1;
			}
			else if(tipe=="Local"){
				tipe=2;
			}
			else if(tipe=="Central"){
				tipe=3;
			}
			var username=document.getElementById('Form_Nama').value;
			var password=document.getElementById('Form_Address').value;
			// alert(tipe);
				$.ajax({
						url: "includes/get_admin.php",
			            type: "POST",
			            dataType: "text",
			            data: {
								username: username,
								password: password,
								tipe:tipe
							},
			            success:function(res){
							if (res==1){
								if(tipe=="1"){
									
								window.location.replace("Master_Admin.php");
								}
								else if(tipe=="2"){
								window.location.replace("Local_Item.php");
								}
								else if(tipe=="3"){
								window.location.replace("Central_HealthCenter.php");
								}
							}
							else if(res==0){
								$("#state-warning").html("Wrong Username or Password");
					      		$("#ErrorHandling_Modal").modal('show');
							}
			               
					
			            },
			            error: function(e){
			                alert("Error");
			            }
					});
		


		}
		function LogIn(x){
			tipe=x;
			
		} 
	</script>
</head>
<body>
	<!-- HEADER -->
	<nav class="navbar navbar-light container-fluid navbar-expand-md fixed-top d-flex justify-content-center" style="height: 65px;  font-size: 16px; font-weight:bold; background-color: white;">
	    <a class="navbar-brand" href="Home.php"><img src="img/Logo.png" width="60" height="50"></a>
	    <span style="color: #4fbbb2; font-size: 30px;">MEDICAL SUPPLIES</span>
	</nav><br><br>

	<!-- BODY -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="background-color: #4fbbb2;">
	  	<!-- Indicators -->
	 	<ul class="carousel-indicators">
	    	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
	  	</ul>

	  <!-- Wrapper for slides -->
	  	<div class="carousel-inner">
		    <div class="carousel-item active">
		      	<img class="d-block img-fluid" src="img/Carousel1.png" style="width: 1800px;">
		    </div>

		    <div class="carousel-item">
		      	<img class="d-block img-fluid" src="img/Carousel2.png" style="width: 1800px;">
		    </div>

		    <div class="carousel-item">
		      	<img class="d-block img-fluid" src="img/Carousel3.png" style="width: 1800px;">
		    </div>
	 	 </div>

	  	<!-- Left and right controls -->
	  	<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
	    	<span class="carousel-control-prev-icon"></span>
	  	</a>
	  	<a class="carousel-control-next" href="#myCarousel" data-slide="next">
	    	<span class="carousel-control-next-icon"></span>
	  	</a>

	</div><br>

	<div class="container text-center" style="background-color: #4fbbb2; color: white;">
		<h4>Welcome To Medical Supplies</h4>
		<h6>Please Log In into your Administrator Account.</h6>

		<button type="button" onclick="LogIn('Master')" data-toggle="modal" data-target="#Modal" class="btn">Admin Master</button>
	    <button type="button" onclick="LogIn('Local')" data-toggle="modal" data-target="#Modal" class="btn">Admin Local</button>
	    <button type="button" onclick="LogIn('Central')" data-toggle="modal" data-target="#Modal" class="btn">Admin Central</button>
	</div>

	<!-- MODAL -->
	<div class="modal" id="Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<button type="button" class="close" data-dismiss="modal">&times;</button><br>
					
					<div class="modalText"> 
						Username:
						<input type="text" class="form-control" id="Form_Nama" placeholder="Name">
					</div>
					<br>
					
					<div class="modalText">
						Password:
						<input type="Password" class="form-control" id="Form_Address" name="harga" placeholder="Address">
					</div>
					<div class="text-center" id="LogInButton">
						<div class="btn" style="align-self: center; border-radius: 20px; background-color: #4fbbb2; color: white; height: 42px; width: 100px;" onclick="logon()">Log In</a>
					</div>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<!-- ERROR HANDLING MODAL -->
	<div class="modal" id="ErrorHandling_Modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content" style="margin: auto; border: none;">
	        <div class="modal-body">
	           
	        	<form class="form-group ml-2 mr-2 justify-content-center">  
	        		<img src="img/exclamation.png" style="width: 100px; height: 100px; display: block; margin-left: auto; margin-right: auto;">
	        		<div class="text-center" style="font-size: 25px; font-weight: bold; margin-top: 10px; margin-bottom: 10px;">Warning !</div>
	        		<div class="text-center" id="state-warning" style="font-size: 14; margin-bottom: 15px;"></div>
					<div class="text-center">
					<a data-dismiss="modal" class="btn" style="align-self: center; border-radius: 20px; border-width: 2px; font-weight: 600; border-color: #4fbbb2; background-color: white; color: #4fbbb2; height: 42px; width: 80px;" >Okay</a>
					</div>
				</form>

	        </div>
	      </div>
	      
	    </div>
	</div>

	<style type="text/css">
		html body{
			background-color: #4fbbb2;
		}
		.btn {
			border-radius: 20px; 
			background-color: white; 
			color: #4fbbb2;
			font-style: bold;
			margin-top: 15px;
			margin-right: 10px;
			margin-left: 10px;
		}
		.modal-content{
			border-radius: 30px;
		}
		.modal{
			top: 20%;
		}
		.modalText {
			align-content: center;
			text-align: center;
			color: #4fbbb2;
			font-size: 16px;
		}
		.modalText>input{
			color: #4fbbb2;
			border-radius: 20px;
			width: 400px;
			text-align: center;
			margin-left: 25px;
		}
		input:focus{

			outline: none;
		}
	</style>
</body>

</html>