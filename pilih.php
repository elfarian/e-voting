<?php require_once 'Template/head.php';

if(!isset($_SESSION['user'])){
	header('Location: index.php');
}else{

$calon = tampil_calon();
$no    = 1

?>

	<script type="text/javascript">
var waktu = 300;
setInterval(function() {
waktu--;
if(waktu < 0) {
window.location = 'logout_nakal.php';
}else{
document.getElementById("countdown").innerHTML = waktu + " detik";
}
}, 1000);
</script>



<div class="container">
<h1 id="h2">Pemilihan Ketua Hima Telkom PENS <?=date('Y'); ?>
		<br>
		<span id="countdown"></span>
		
</h1>
	<div id="rowrow" class="row">
		<form onsubmit="return confirm('Apakah anda telah yakin?');" action="proses.php" method="post" accept-charset="utf-8">
	<?php  foreach($calon as $row):
		$foto = str_replace("../", "", $row['foto']);
	?>
		<div class="col-md-4 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<center>
					<div class="panel-body">
						<img src="<?=$foto; ?>" class="img-responsive" alt="" style="width: 100px;">
						<b><?php echo $no++.". ".$row['nama']; ?></b><p class="text-mutted"><?=$row['organisasi'];?></p>
					</div>
					<div class="panel-footer">
						<a data-toggle="modal" href="#detail<?=$row['id'];?>" class="btn btn-info btn-sm">
					<span class="glyphicon glyphicon-info-sign"></span> Visi & Misi
					</a>
					<br>
						<input type="checkbox" class="form-radio" id="pilihan" name="rd[]" value="<?=$row['id']?>">
							coblos
					<br>
					<br>
					</div>
				</center>
			</div>	
		</div>
		<?php endforeach; ?>
	</div><!--/.row-->

<div class="row">
<div class="col-md-3 col-sm-3 col-xs-12 mx-auto">

<p style="color: white;">TELKOM-<?php echo $_SESSION['no']; ?></p>
<p style="color: white;">* Catat kode surat suara diatas dan kirimkan saat registrasi keabsahan</p>

</div>	
<div class="col-md-12 col-sm-12 col-xs-12 mx-auto">
		<input type="submit" id="primary" name="pilih" class="btn btn-primary" value="pilih">
</div>	
</div>	
		</form>

</div>	

<?php foreach($calon as $row): ?>
	<!-- Visi dan Misi -->
	<div class="modal fade" id="detail<?=$row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Visi dan Misi</h4>
	      </div>
	      <div class="modal-body">
      		<table>
  			<tr>
  				<td>Nama</td>
  				<td>&nbsp;</td>
  				<td>:</td>
  				<td>&nbsp;</td>
  				<td><?=$row['nama']; ?></td>
  			</tr>
  			<tr>
  				<td>Kelas</td>
  				<td>&nbsp;</td>
  				<td>:</td>
  				<td>&nbsp;</td>
  				<td><?=$row['kelas']; ?></td>
  			</tr>
  			<tr>
  				<td>NRP</td>
  				<td>&nbsp;</td>
  				<td>:</td>
  				<td>&nbsp;</td>
  				<td><?=$row['organisasi']; ?></td>
  			</tr>
  		</table><br>
	        <b>VISI :</b>
	        	<div><?=$row['visi']; ?></div>
	        <b>MISI :</b>
	        	<div><?=$row['misi']; ?></div>
	      </div>
	    </div>
	  </div>
	</div><br>
<?php endforeach; ?>
<?php } require_once 'Template/foot.php'; ?>
