<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="Assets/css/sweetalert.css">
	<script src="Assets/js/sweetalert.min.js"></script>
</head>
<body>
	<?php  
	require_once 'Core/init.php';
	global $link; 

	if(!empty($_POST['rd'])){
			if(count($_POST['rd']) == 1) 
			{
				foreach($_POST['rd'] as $rd){
						$id = $rd;
					}
				$calon = tampilnama($id);
				$row = mysqli_fetch_assoc($calon);
				$tambah = ($row['hasil']) + 1;
				$sesi = $_SESSION['user'];
				$memilih = pilih($sesi, $tambah, $id);
				
			}
			else 
			{
			$cek = tampil_taksah();
			$row = mysqli_fetch_assoc($cek);
			$tambah = ($row['jumlah_tak_sah']) + 1;
			$sesi = $_SESSION['user'];
			$memilih = pilih_gagal($sesi, $tambah);
			}

	} else
	{
			$cek = tampil_taksah();
			$row = mysqli_fetch_assoc($cek);
			$tambah = ($row['jumlah_tak_sah']) + 1;
			$sesi = $_SESSION['user'];
			$memilih = pilih_gagal($sesi, $tambah);
	}

	if ($memilih == TRUE){ 
		
		?><script>
			swal({title: "Terima Kasih Telah Menggunakan Hak Pilih Anda!",text: "Suara Anda Turut Menentukan Masa Depan Hima Telkom PENS 2020/2021", timer:5000 ,type:"success"}, 
			function(){window.location='logout.php';});
		</script><?php
	}

		
	?>	
</body>
</html>
