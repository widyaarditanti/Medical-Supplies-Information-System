<?php 
	include "connect.php";
	
	//refresh data admin berdasarkan search maupun kategori
	if(isset($_POST['search'])){	
		$nama=$_POST['search'];
		$kategori = $_POST['kategori']; 

        $katid = 0;
        if($_POST['kategori'] == 'Master') $katid = 1; 
        else if($_POST['kategori'] == 'Central') $katid = 3;
        else if($_POST['kategori'] == 'Local') $katid = 2;
        //kategoti
		if($_POST['kategori'] == 'All'){
			if($nama != ''){
				$sql = "select * from admin where username like '%".$nama."%'";
				$pk = mysqli_query($con, $sql);
				// echo "search all cat";
			}
			else
			{
				$sql = "select * from admin";
				$pk = mysqli_query($con, $sql);
				// echo "no search all cat";
			}
		}
		else 
		{
			if($nama != ''){
				$sql = "select * from admin where kategori_id = ".$katid." and username like '%".$nama."%'";
				$pk = mysqli_query($con, $sql);
				// echo "search with cat";
			}
			else
			{
				// echo "no search with cat";
				$sql = "select * from admin where kategori_id = ".$katid;
				$pk = mysqli_query($con, $sql);
			}
		}


		//show
		if($_POST['icon'] == 1){
			while($row = mysqli_fetch_array($pk)){ 
                if($row['kategori_id'] == 1) $adm = 'Master';
                else if($row['kategori_id'] == 2) $adm = 'Local';
                else $adm = 'Central';
                
				echo '<div class="iconn container d-flex justify-content-center">
					<img class="Image_Admin" src="img/Admins/'.$row['image'].'">
					<div class="data container-fluid" style="margin-left: -3px;">
			        	<span class="Admin_Type">'.$adm.'</span>
						<button class="delete_but" onclick="deleteButton(this.parentElement, '.$row['admin_id'].')" data-toggle="modal" data-target="#Delete_Modal" type="button" value="Delete" style="display: none; outline: none;"><img src="img/delete2.png" style="width: 22px; height: 22px;"></button>
						<br>
						<span class="Username_Admin">'.$row["username"].'</span><br>
	        			<span class="Email_Admin">'.$row["email"].'</span><br>
			        	<span class="Telepon_Admin">+'.$row["no_telp"].'</span><br>';
                        
                        $sqls = "select * from pusat_kesehatan where pk_id = ".$row['pk_id'];
							$pks = mysqli_query($con, $sqls);
							$rows = mysqli_fetch_assoc($pks);
                            $pkname =  $rows['nama'];
                        
                echo '<span class="HealthCenter">'.$pkname.'</span>
		        		<button class="edit_but" onclick="editButton(this.parentElement, '.$row['admin_id'].')" data-toggle="modal" data-target="#Edit_Modal" type="button" value="Edit" style="display: none; outline: none;"><img src="img/edit.png" style="width: 18px; height: 18px; margin-left: 2px;"></button>
			        </div>
				</div>';		
			}
		}
		else 
		{
			echo '<table class="container table table-striped table-borderless table-sm" style="font-size: 13px;">
				<thead>
					<tr style="text-align: center;">
						<th style="width: 15%;">Admin</th>
						<th style="width: 15%;">Username</th>
						<th style="width: 15%">Email</th>
						<th style="width: 15%">Number</th>
						<th style="width: 15%">Health Center</th>
					</tr>
				</thead>

				<tbody class="text-center" id="body">';
					//nama
					while($row = mysqli_fetch_array($pk)){ 
                        if($row['kategori_id'] == 1) $adm = 'Master';
                        else if($row['kategori_id'] == 2) $adm = 'Local';
                        else $adm = 'Central';
                        
                        echo "<tr>"; 
							$sqls = "select * from pusat_kesehatan where pk_id = ".$row['pk_id'];
							$pks = mysqli_query($con, $sqls);
							$rows = mysqli_fetch_assoc($pks);
                            $pkname =  $rows['nama'];
								echo "<td>".$adm."</td>";
								echo "<td>".$row['username']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>+".$row['no_telp']."</td>";
								echo "<td>".$pkname."</td>";
						echo "</tr>";
					}
				echo "</tbody>
			</table>";
		}
	}

	//menambah admin
	if(isset($_POST['add']))
	{
		$filename = $_FILES['file']['name'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$nomer = $_POST['nomer'];
		$kategori = $_POST['kategori'];
		
		if($_POST['kategori'] == 'Master') $katid = 1; 
        else if($_POST['kategori'] == 'Central') $katid = 3;
        else if($_POST['kategori'] == 'Local') $katid = 2;
		
		// echo $kategori;
		// echo $nama;
		// echo $email;
		// echo $nomer;
		// echo $filename;

		$sql = "INSERT INTO admin (username, email, no_telp, image, kategori_id, pk_id) values ('".$nama."','".$email."',".$nomer.", '".$filename."', ".$katid.", ".$katid." )";
		$cek = $con->query($sql);
		if(!$cek){
			mysqli_error($con);
		}

		/* Location */
		$location = "../img/Admins/".$filename;
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

	//mengedit admin
	if(isset($_POST['edit']))
	{
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$nomer = $_POST['nomer'];
		$kategori = $_POST['kategori'];

		
		if($_POST['kategori'] == 'Master') $katid = 1; 
        else if($_POST['kategori'] == 'Central') $katid = 3;
        else if($_POST['kategori'] == 'Local') $katid = 2;
		// echo $kategori;
		// echo $nama;
		// echo $alamat;
		// echo $id;
	
		// echo $_POST['id']; 
		if($_POST['adafile'] == 'true')
		{
			echo"ada";
			$filename = $_FILES['file']['name'];
			$sql = "UPDATE admin SET no_telp = '".$nomer."', username = '".$nama."', email = '".$email."', image = '".$filename."',kategori_id = ".$katid.", pk_id = ".$katid." where admin_id =".$id;
			$cek = $con->query($sql);
			if(!$cek){
				mysqli_error($con);
			}

			/* Location */
			$location = "../img/Admins/".$filename;
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
		else{
			echo "ga ".$id;
			$sql = "UPDATE admin SET no_telp = '".$nomer."', username = '".$nama."', email = '".$email."', kategori_id = ".$katid.", pk_id = ".$katid." where admin_id =".$id;
			$cek = $con->query($sql);
			if(!$cek){
				mysqli_error($con);
			}
		}
	}

	//menghapus admin
	if(isset($_POST['delete']))
	{
		$id = $_POST['id'];
		// echo $id;
		$sql = "delete from admin where admin_id = ".$id;
		$cek = $con->query($sql);
		if(!$cek){
			mysqli_error($con);
		}
	}
?>