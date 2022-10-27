<!DOCTYPE html>
<html>
<head>
<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION["username"])) header("Location: home.php");
	?>
</head>
<body>
	<!-- HEADER -->
	<nav class="navbar navbar-light container-fluid navbar-expand-md navbar-center" style="height: 65px;  font-size: 15px; font-weight:bold; background-color: white;">
		<!-- LOGO -->
	    <a class="navbar-brand" href="Home.php"><img src="img/Logo.png" width=60" height="50" style="margin-left: 0px; margin-right: 5px;"></a>

	    <!-- TITLE -->
	    <div class="text-center" style="margin-right: 50px;">
	    	<span class="row" style="color: #4fbbb2; font-size: 24px; margin-bottom: -6px;">MEDICAL SUPPLIES</span>
	    	<span style="color: #4fbbb2; font-size: 14px;">Admin Master</span>
	    </div>

	    <!-- MENU -->
	    <button class="navbar-toggler justify-content-end ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    	<span class="navbar-toggler-icon "></span>
	    </button>
    	<div class="collapse navbar-collapse" style="background-color: white; height: 10px; margin-bottom: 5px;" id="collapsibleNavbar">
      		<ul class="nav navbar-nav" >
		        <li class="nav-item"><a href="Master_Admin.php" style="color: #4fbbb2;" >Admin</a></li>
		        <li class="nav-item"><a href="Master_HealthCenter.php" style="color: #4fbbb2;">Health Center</a></li>
		        <li class="nav-item"><a href="Master_Item.php?halamanAktif=1" style="color: #4fbbb2;">Item</a></li>
		        <li class="nav-item"><a href="Master_Transaction.php?halamanAktif=1" style="color: #4fbbb2;">Transaction</a></li>
      		</ul>
      		<ul class="nav navbar-nav justify-content-end ml-auto" style="float: right;">
      			<span style="color: #4fbbb2; font-size: 18px; margin-top: 18px; margin-right: 10px; font-weight: normal;">Hi, <span id="AdminName"><?php echo $_SESSION['username']?></span></span>
		        <li class="nav-item"><a href="Home.php" style="color: #4fbbb2; line-height: 200%; font-size: 30px;"><img src="img/logout.png" style="width: 25px; height: 25px;"></a></li>
     		 </ul>
    	</div>
	</nav>
	<br><br><br>
</body>

</html>