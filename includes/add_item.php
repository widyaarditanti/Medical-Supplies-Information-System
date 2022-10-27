<?php
	include_once "connect.php";

		$filename = $_FILES['file']['name'];
		$nama = $_POST['name'];
		$jumlah = $_POST['qty'];
		$satuan = $_POST['unit'];
		$desc = $_POST['desc'];
		$nama_jenis = $_POST['nama_jenis'];

			//CARI ID JENIS TIPE
			$sql = "SELECT id_jenis_tipe FROM jenis_tipe WHERE nama=?";
			$stmt = mysqli_stmt_init($con);
			if(mysqli_stmt_prepare($stmt,$sql)){
				mysqli_stmt_bind_param($stmt,"s",$nama_jenis);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				if($row = mysqli_fetch_assoc($result)){
                    $id_tipe = $row['id_jenis_tipe'];
                    
					//MASUKKAN KE DB
					$sql = "INSERT INTO item(nama,jumlah,satuan,deskripsi,image,id_jenis_tipe) VALUES (?,?,?,?,?,?)";
					$stmt = mysqli_stmt_init($con);

					if(mysqli_stmt_prepare($stmt,$sql)){

						mysqli_stmt_bind_param($stmt,"sisssi",$nama,$jumlah,$satuan,$desc,$filename,$id_tipe);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);

						echo 1;
					}
					else{
						echo 0;
					}
				}
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
	
?>