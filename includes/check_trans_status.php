<?php
	include_once 'connect.php';
  
    $id_dt = $_POST['id'];
	$status = "Waiting";
	$statusYes = 0;
	$statusDenied = 0;
	$statusNo = 0;

	// echo $status;

    $sql= "SELECT id_transaksi FROM transaksi t JOIN detail_transaksi dt ON dt.id_transaksi = t.trans_id WHERE id_detail_transaksi = ?";

		$stmt = mysqli_stmt_init($con);
		if(mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt, "i", $id_dt);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if($row = mysqli_fetch_assoc($result)){
				$id_trans = $row['id_transaksi'];
			}

			$sql="SELECT id_detail_transaksi, approval FROM detail_transaksi WHERE id_transaksi = ?";
			$stmt = mysqli_stmt_init($con);
			
			$stmt = mysqli_stmt_init($con);
			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt, "i", $id_trans);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				
				while($row = mysqli_fetch_assoc($result)) {

					if($row['approval'] == "yes"){
						$statusYes = 1;
					}
					if($row['approval'] == "denied"){
						$statusDenied = 1;
					}
					if($row['approval'] == "no"){
						$statusNo = 1;
					}
					echo $row['approval'];
				}
				// echo $statusYes;
                // echo $statusNo;
                
				if($statusYes == 1){
					$status = "on going";
				}
				else if($statusNo == 1 && $statusYes == 0 && $statusDenied == 0 ){
					$status = "waiting";
				}
				else if($statusDenied == 1 && $statusYes == 1){
					$status = "on going";
				}
				else if($statusDenied == 1 && $statusNo == 1){
					$status = "waiting";
				}
				else if($statusDenied == 1 && $statusYes == 0 && $statusNo == 0){
					$status = "cancel";
				}
				// echo $status;

				$sql = "UPDATE transaksi SET status = ? WHERE trans_id = ?";
				$stmt = mysqli_stmt_init($con);
				if(mysqli_stmt_prepare($stmt,$sql)){
					mysqli_stmt_bind_param($stmt, "si",$status, $id_trans);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					echo 1;
				}
				else{
					echo "FAILED TO INSERT DATA";
				}

			}
			else{
				echo "FAILED TO GET DATA";
			}
		}
		else{
			echo "FAILED TO GET DATA";
		}
?> 