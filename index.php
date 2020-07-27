<?php require_once 'Template/head.php';
if(isset($_SESSION['user'])){
	header('Location: pilih.php');
}else{
?>


<div class="container">
	<div id="row" class="row">
		<div class="col-md-3 col-sm-6">
		<img id="kpo" src="Assets/img/kpu.png" class="m-1 img-responsive" alt="Komisi Pemilihan OSIS" style="max-width: 230px;">
		</div>
		<div class="col-md-3 col-sm-6">
			<p id="cara" class="pull-left">
				<b id="txt"><u>Cara Memilih :</u></b><br>
				Masukan ID dan Password yang sudah ditentukan oleh KPPS untuk melakukan pemilihan Ketua Hima Telkom PENS 2020,
				pilih Calon Ketua Hima Telkom PENS 2020 dengan menekan tombol PILIH.
			</p>
		</div>
		<div class="col-md-6 col-sm-12">
			<h1>Suksesi Hima Telkom PENS 2020</h1><h1 id="h2">Pemilihan Ketua Hima Telkom PENS 2020
			<br>POLITEKNIK ELEKTRONIKA 
			<br>NEGERI SURABAYA</h1>
			<center>
				<div id="default" class="panel panel-default">
					<div class="panel-body">
						<form action="" method="post" onsubmit="">
							<div class="form-group">
								<label for="username">ID</label>
								<input type="text" name="username" class="form-control" autocomplete="off" placeholder="ID" autofocus>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password">
							</div>
							<div class="form-group">

								<div class="g-recaptcha mb-2" data-sitekey="6LfZHrIZAAAAAAwDtJ55J2jvHNJrduOyj6-s2TG7"></div>
								
							</div>

							<input type="submit" id="primary" name="login" class="btn btn-primary mt-2" value="Login" 

							>
						</form>
					</div>
				</div>
			</center>
		</div>
	</div>
</div>

<?php } require_once 'Template/foot.php'; ?>
