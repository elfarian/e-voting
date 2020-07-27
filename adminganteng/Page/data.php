<?php
if ( isset($_POST["import"]) ) {
$storagename = $_FILES["file"]["name"];
$lokasi=$_FILES["file"]["tmp_name"];
$n=move_uploaded_file($_FILES["file"]["tmp_name"],$storagename);
if($n){
header("location:?p=import&fn=$storagename");

}else{
header("location:?p=data&msg=nosend");

}

}

$data = tampil_data();
$waktu = tampil_waktu();
$user_logout = tampil_user_logout();

if(isset($_POST["edit"])) {
	if(!empty($_POST["dari"])){
		if(!empty($_POST["dari"])){
			if(ubah_waktu($_POST["dari"],$_POST["sampai"],$_POST["status"])){
			?><script>window.location='?p=data';</script><?php
			} else {
			?><script>swal('Gagal mengedit waktu');</script><?php
			}
		}else
		{
		?><script>swal('Waktu tidak boleh kosong');</script><?php
		}
	}
	else
	{
	?><script>swal('Waktu tidak boleh kosong');</script><?php
	}
}

?>
<title>Data Pemilih | Suksesi Hima Telkom PENS 2020</title>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Data Pemilih</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Waktu Pemilihan</h2>
				<form class="form-inline" method="post">
					<?php foreach($waktu as $waktu): ?>
					<h5>Data saat ini : <?= $waktu['dari'];?> sampai <?= $waktu['sampai'];?> ,dan status=<?= $waktu['status'];?></h5>
				<?php endforeach; ?>
			  	<div class="form-group mb-2">
			  		Dari
			    <input type="datetime-local"class="form-control-plaintext" name="dari">
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
			    Sampai
			    <input type="datetime-local" class="form-control-plaintext" name="sampai">
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
			    Status
			    <select class="form-control" name="status">
      					<option value="ON">ON</option>
      					<option value="OFF">OFF</option>
    			</select>
			  </div>
			  <button type="submit" name="edit" class="btn btn-primary mb-2">Ubah Waktu</button>
			</form>
			</div>


			<div class="col-lg-12">
				<h2 class="page-header">Data Pemilih</h2>
				<?php
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               if($_GET['msg']=='send')
			      {
					//jika impor berhasil
			         echo '<div class="alert alert-success  alert-dismissable" id="alert">
			         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
			         </button>1 Data berhasil di Import</div>';
			    	} else  if($_GET['msg']=='nosend')
			      {
					//jika impor berhasil
			         echo '<div class="alert alert-danger alert-dismissable" id="alert">
			         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
			         </button>Gagal upload File !</div>';
			    	}
			    ?>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Data Pemilih&nbsp;&nbsp;
						<a class="btn btn-sm btn-primary" data-toggle="collapse" href="#import" aria-expanded="false" aria-controls="collapseExample">
						<span class="glyphicon glyphicon-upload"></span>
						Import Data
						</a>&nbsp;&nbsp;

						<a onclick="del();" href="#" class="btn btn-sm btn-danger pull-right">
						<span class="glyphicon glyphicon-trash"></span>
						Hapus Semua Data
						</a>&nbsp;&nbsp;

						<a data-toggle="modal" href="#yanglogout" class="btn mx-1 btn-sm btn-warning pull-right">
						<span class="glyphicon glyphicon-trash"></span>
						Liat Password baru data
						</a>&nbsp;&nbsp;
					</div>
					<div class="panel-body">
						<div class="collapse" id="import">
						<div class="well">
						<?php  
							if($_GET['msg']=='')
						      {
								//jika impor berhasil
						         echo '<div class="alert alert-info alert-dismissable" id="alert">
						         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
						         </button>file Excel XLS/XLSX yang diijinkan !</div>';
						    	}
						?>
							<form action="" method="post" enctype="multipart/form-data">
								<a href="Format/Data-Pemilih.xlsx" class="btn btn-default"><span class="glyphicon glyphicon-download"></span>
								Download Format</a><br><br>
								<input type="file" name="file" id="file" style="width: 30%;" class="pull-left form-control">&nbsp;
								<button type="submit" class="btn btn-primary" name="import">
									<span class="glyphicon glyphicon-upload"></span> Import
								</button>
							</form>
						</div>
					</div>
						<table id="tabel" class="table table-bordered table-striped" cellspacing="0" width="100%">
							<thead style="background: #88c9fb;">
								<tr>
									<th>ID</th>
									<th>PASSWORD</th>
									<th>NAMA LENGKAP</th>
									<th>KELAS</th>
									<th>JK</th>
									<th>STATUS</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($data as $row): ?>
								<tr>
									<td><?= $row['nama'] ?></td>
									<td><?= $row['nis'] ?></td>
									<td><?= $row['nama2'] ?></td>
									<td><?= $row['kelas'] ?></td>
									<td><?= $row['jk'] ?></td>
									<td>
									<?php 
										if($row['status'] == 1) 
										echo "<span class='label label-danger'>Belum Memilih</span></span>";
										// Belum Memilih <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
										else echo "<span class='label label-success'>Sudah Memilih</span>";
										// Sudah Memilih <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>

										if($row['waktu'] != NULL){
										echo "<span class='label label-primary'>".$row['waktu']."</span>";	
										} 
									?> 	
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->

	</div>


	<div class="modal fade" id="yanglogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">User Logout</h4>
	      </div>
	      <div class="modal-body">
      		<table class="table table-striped" border="1">
  			<tr>
  				<td>NRP</td>
  				<td>NAMA</td>
  				<td>PASSWORD BARU</td>
  				<td>Waktu LOGOUT</td>
  				
  			</tr>
  			<?php foreach($user_logout as $dataq): ?>
  			<tr>
  				<td><?= $dataq['id_data'] ?></td>
  				<td><?= $dataq['nama2'] ?></td>
  				<td><?= $dataq['nis'] ?></td>
  				<td><?= $dataq['waktu'] ?></td>
  				
  			</tr>
  			<?php endforeach; ?>
  			
	        	
	      </div>
	    </div>
	  </div>
	</div>