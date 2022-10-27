<?php 
	include_once "connect.php";
	
	if(isset($_POST['idItem'])){

		$id = $_POST['idItem'];
		
		$sql = "DELETE FROM item WHERE id_item = ?";
		$stmt = mysqli_stmt_init($con);

		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);

			echo 1;
		}
		else {
			echo 0;
		}
	}

?>