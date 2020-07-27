<?php
	if(del_tak_sah()){
		?><script>
		swal({title: "Sukses!",text: "Suara tak sah berhasil dihapus",type:"success"}, function(){window.location='?p=calon';});
		</script><?php
	}else{
		?><script>
		swal({title: "Oops...",text: "Ada masalah saaat menghapus data",type:"error"}, 
		function(){window.location='?p=calon';});
		</script><?php
	}
?>