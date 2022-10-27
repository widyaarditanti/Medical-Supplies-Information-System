<?php
	include_once 'connect.php';
    $id_dt = $_POST['id_dt'];
    // $id_dt =32;
    $isAcc = $_POST['isAcc'];
    // $isAcc = 'yes';
    $idPenyumbang = $_POST["idPenyumbang"];
    // $idPenyumbang = 2;
    
    if($isAcc == 'yes'){
		$sql= "UPDATE detail_transaksi SET approval = 'yes' WHERE id_detail_transaksi = ?";

		$stmt = mysqli_stmt_init($con);
		if(mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt, "i", $id_dt);
			mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $sql= "SELECT id_transaksi FROM transaksi t JOIN detail_transaksi dt ON dt.id_transaksi = t.trans_id WHERE id_detail_transaksi = ?";
            $stmt = mysqli_stmt_init($con);
            if(mysqli_stmt_prepare($stmt,$sql)){
                mysqli_stmt_bind_param($stmt, "i", $id_dt);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if($row = mysqli_fetch_assoc($result)){
                    $id_trans = $row['id_transaksi'];
                    
                    //update pk penyumbang
                    $sql= "UPDATE transaksi SET pk_penyumbang = ? WHERE trans_id = ?";

                    $stmt = mysqli_stmt_init($con);
                    if(mysqli_stmt_prepare($stmt,$sql)){
                        mysqli_stmt_bind_param($stmt, "ii", $idPenyumbang, $id_trans);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        echo 1;
                    }
                    else{
                        echo "FAILED TO GET DATA";
                    }
                }
            } 

			echo 1;
		}
		else{
			echo "FAILED TO GET DATA";
		}
	}
    else{
           $sql= "UPDATE detail_transaksi SET approval = 'denied' WHERE id_detail_transaksi = ?";

                $stmt = mysqli_stmt_init($con);
                if(mysqli_stmt_prepare($stmt,$sql)){
                    mysqli_stmt_bind_param($stmt, "i", $id_dt);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    echo 1;
                }
                else{
                    echo "FAILED TO GET DATA";
                }
	}
?>