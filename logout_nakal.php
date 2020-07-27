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

$sesi = $_SESSION['user'];
$pass_baru = randomPassword();
if(logout_nakal($sesi, $pass_baru))
{
	?><script>
			swal({title: "Anda Telah Logout!",text: "Silahkan kembali mengantri pada TPU untuk mengambil password baru  ", timer:10000 ,type:"warning"}, 
			function(){window.location='logout.php';});
	</script> <?
}
else{}

?>
</body>
</html>