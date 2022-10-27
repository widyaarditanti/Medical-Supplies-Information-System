<?php
	include_once 'connect.php';
	
	$tipe = $_POST['tipe'];

	if($tipe == ""){
		$sql= "SELECT * FROM jenis_tipe";
	
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
		$sql= "SELECT j.nama FROM jenis_tipe j JOIN tipe t 
				ON t.id_tipe = j.id_tipe 
				WHERE t.nama = ?";

		 $stmt = mysqli_stmt_init($con);

		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_bind_param($stmt, "s", $tipe);
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