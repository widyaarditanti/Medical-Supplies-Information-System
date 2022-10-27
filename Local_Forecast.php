<!DOCTYPE html>
<html>
<head>
	<?php include 'Header.php'; ?>
	<?php include 'Local_Header.php'; ?>
	<?php include 'css.php'; ?>
	<?php include 'includes/connect.php'; ?>

	<!-- CODING -->
    <script type="text/javascript">
		var cari = 2, filter = "Central Health Center";

    	function search()
    	{
    		var text = document.getElementById("search").value;
    		$.ajax({
				url:"includes/ajaxforecast.php",
				type:"POST",
				data :{
					search:text,
					kat:false,
				},
				success:function(show){
					// alert(show);
					$('#table').html(show);					
				}
			});
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
			});
			
			var text = document.getElementById("search").value;
    		$.ajax({
				url:"includes/ajaxforecast.php",
				type:"POST",
				data :{
					search:text,
					kat:false
				},
				success:function(show){
					// alert(show);
					$('#table').html(show);					
				}
			});
		});
	</script>
</head>
<body>
	<!-- BODY -->
	<div class="row">
		<h3 style="margin: auto; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 10px;"> Item Forecasting </h3> 
	</div>
	<div class="d-flex justify-content-center"><input type="text" id="search"class="form-control" aria-label="Default" placeholder="Search"  onkeyup="search()"></div>
	<br>
	<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;" id="table">
		</tobdy>
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