<?php
	include_once 'connect.php';


		$sql= "SELECT * FROM pusat_kesehatan";

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
	
?>