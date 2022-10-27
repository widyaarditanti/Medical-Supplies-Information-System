<?php
	include_once "connect.php";

		$nama = $_POST['name'];
		$jumlah = $_POST['qty'];
		$satuan = $_POST['unit'];
		$id = $_POST['id'];
		$nama_jenis = $_POST['nama_jenis'];

		$filename="";
		if(isset($_FILES['file']['name'])){
			$filename = $_FILES['file']['name'];
		}

		$sql = "SELECT id_jenis_tipe FROM jenis_tipe WHERE nama=?";
		$stmt = mysqli_stmt_init($con);
		if(mysqli_stmt_prepare($stmt,$sql)){
			mysqli_stmt_bind_param($stmt,"s",$nama_jenis);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if($row = mysqli_fetch_assoc($result)){
	            $id_jenis = $row['id_jenis_tipe'];
	        }
	    }

		if($filename == "")
		{
			$sql = "UPDATE item SET nama = ?, jumlah=?,satuan =?,id_jenis_tipe=? WHERE id_item=?";
			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt,"sisii",$nama,$jumlah,$satuan,$id_jenis,$id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);

				echo 1;
			}
			else{
				echo 0;
			}
		}
		else{
			$sql = "UPDATE item SET nama = ?, jumlah=?,satuan =?,image=?,id_jenis_tipe=? WHERE id_item=?";
			$stmt = mysqli_stmt_init($con);

			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt,"sissii",$nama,$jumlah,$satuan,$filename,$id_jenis,$id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);

				echo 1;
			}
			else{
				echo 0;
			}

			/* Location */
		   $location = "../img/Items/".$filename;
		   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		   $imageFileType = strtolower($imageFileType);

		   /* Valid extensions */
		   $valid_extensions = array("jpg","jpeg","png");

		   $response = 0;
		   /* Check file extension */
		   if(in_array(strtolower($imageFileType), $valid_extensions)) {
		      /* Upload file */
		      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		         $response = $location;
		      }
		    }

		}
?>