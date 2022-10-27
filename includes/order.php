<?php 
    include "connect.php";
 //widd wid aku mau nge restart sessionya 
	$id_item=$_POST['id_item'];
	/* $id_item=5;
	$jenisitem="Su"; */
    $jenisitem=$_POST['jenisitem'];
    /* 

    $sql= mysqli_query($con,"SELECT satuan FROM stock where stock.item_id=1"); */
        
	/* if($sql){
		$row_user = mysqli_fetch_array($sql);

		echo $row_user['satuan'];
	}else{
		echo 0;
    } */
/*     
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
		} */
		if ($jenisitem == "Sarana"){

			$sql = mysqli_query($con,"SELECT satuan FROM item where id_item=$id_item");
	 
		}
		else{

			$sql = mysqli_query($con,"SELECT satuan FROM stock where id_item=$id_item");
			
		}
		
		
        $rows = mysqli_fetch_row($sql);
		$highest_stock = $rows[0];
		

    echo $rows[0];
 
?>