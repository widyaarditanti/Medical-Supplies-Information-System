<?php
	include_once 'connect.php';

	$pk_id = $_POST['idpk'];

	if($pk_id == 0){
		//ADMIN CENTRAL
		$sql= "SELECT * FROM gudang";
		$stmt = mysqli_stmt_init($con);

		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			$arr=[];
			while($row = mysqli_fetch_assoc($result)) {
				array_push($arr,$row);
			}
			echo json_encode($arr);
		}
		else{
			echo "FAILED TO GET DATA";
		}
	}
	else{
		//ADMIN LOCAL
		$sql= "SELECT * FROM gudang WHERE pk_id = ?";
		$stmt = mysqli_stmt_init($con);

		if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "i", $pk_id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			$arr=[];
			while($row = mysqli_fetch_assoc($result)) {
				array_push($arr,$row);
			}
			echo json_encode($arr);
		}
		else{
			echo "FAILED TO GET DATA";
		}
	}
?>