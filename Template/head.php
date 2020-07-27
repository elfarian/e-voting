<?php require_once 'Core/init.php'; 
if(!cek_waktu_login()){
	header("Location: http://www.google.com/");
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SUKSESI HIMA TELKOM PENS PENS 2020</title>
	<link rel="stylesheet" href="Assets/css/bootstrap.min.css">
	<link rel="shortcut icon" href="Assets/img/icon.png">
	<link rel="stylesheet" href="Assets/css/index.css">
	<link rel="stylesheet" href="Assets/css/sweetalert.css">
	<script src="Assets/js/sweetalert.min.js"></script>

	<script src='https://www.google.com/recaptcha/api.js'></script>


</head>
<body>
<?php
error_reporting(E_ALL ^ E_NOTICE);

if(isset($_POST['login'])){
	$user = trim($_POST['username']);
	$pass = trim($_POST['password']);
	$user = escape($user);
	$pass = escape($pass);
	$secret_key = "6LfZHrIZAAAAAOvQenxXQHGmbuU8F9v732zBv34Z";

error_reporting(E_ALL ^ E_DEPRECATED);

	$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
	$response = json_decode($verify);

	if(!empty($user) && !empty($pass) && !empty($_POST['g-recaptcha-response']))
	{
		if($response->success){

		if(Login_user($user, $pass))
		{
			if(cek_waktu_login()){
					

					if(no_surat()){

						$_SESSION['no']=no_surat();
						$no_surat=$_SESSION['no'];

						if(update_surat($user, $no_surat)){

								$ip_user=IPnya();

								if(cek_ip_user($user,$ip_user)) {

										if(add_ip_user($user,$ip_user)){

											$_SESSION['user'] = $user;
											header("Location: pilih.php");

											$nis = $_POST['id'];

											error_reporting(E_ALL ^ E_DEPRECATED);
											$detail = mysql_query("SELECT * FROM data where nis='$nis'");
					
											$ss = mysql_query($detail);


										}
										else {
											?><script>swal("Oops...", "GAGAl LOGIN");</script><?php
										}


								} else {
									?><script>swal("waduh","1 Perangkat hanya boleh meloginkan 1 akun... Perangkat ini telah meloginkan akun lainnya","error");</script><?php
								}

						}else {
							?><script>swal("Oops...", "GAGAl LOGIN");</script><?php
						}


					} else {
						?><script>swal("Oops...", "Kehabisan Surat Suara, silahkan kontak KPU","error");</script><?php
					}


			}else{
				?><script>swal("Oops...", "Anda login di waktu yang salah","error");</script><?php
			}
			
		}else{
			?><script>swal("Oops...", "Username atau Password salah/tidak terdaftar/sudah memilih", "error");</script><?php
		}

		} else {
			?><script>swal("Oops...","Captcha tidak valid", "error");</script><?php
		}

	}else{
		?><script>swal("Oops...", "Form tidak boleh kosong", "error");</script><?php
	}
}


?>
<nav id="nav" class="navbar navbar-default fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img style="height: 60px; width:250px" alt="Brand" src="Assets/img/si.png">
      </a>
    </div>

    <div class="collapse navbar-collapse" id="navb">
	    <ul class="nav navbar-nav navbar-right">
	    	<li>
	    		<img style="height: 100%;" src="Assets/img/user_.png">
	    	</li>
	    	<li><br>

		        <b id="txt" style="padding-top-top: 8px; color: #3c78b5;">Selamat Datang</b><br>
		        <i><?php if(isset($_SESSION['user'])){
							$sesi = $_SESSION['user'];
							tampil($sesi);
		        }
					?>
					
					
					<?php
error_reporting(E_ALL ^ E_NOTICE);
					echo $s['nama2'] ?>
				</i>
	        </li>
		</ul>
  </div>
</nav>
