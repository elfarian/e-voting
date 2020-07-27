<?php  
	//Tampil Data
	function tampil_data(){
		global $link;

		$query  = "SELECT data.*,waktu_pilih.waktu FROM data LEFT JOIN waktu_pilih ON data.nama=waktu_pilih.id_data";
		$result = mysqli_query($link, $query) or die(mysqli_error());

		return $result;	
	} 

	//Delete Data
	function del_data(){
		$query = "DELETE FROM data";
		return run($query);
	}
	function del_semua_waktu_voting(){
		$query = "DELETE FROM waktu_pilih";
		return run($query);
	}
	function del_semua_user_logout(){
		$query = "DELETE FROM user_logout";
		return run($query);
	}

	function del_hasil(){
		$query = "UPDATE calon SET hasil='0'";
		return run($query);
	}

	//Tampil waktu
	function tampil_waktu(){
		global $link;

		$query  = "SELECT * FROM time_voting";
		$result = mysqli_query($link, $query) or die(mysqli_error());

		return $result;	
	} 

	//ubah waktu
	function ubah_waktu($dari,$sampai,$status){
		global $link;

		$dari		= escape($dari);
		$sampai		= escape($sampai);
		$status		= escape($status);
		
		$query  = "UPDATE time_voting SET dari='$dari', sampai='$sampai', status='$status'";
		$result = mysqli_query($link, $query) or die(mysqli_error());

		return run($query);
	} 

	function tampil_user_logout(){
		global $link;

		$query  = "SELECT user_logout.*,data.nis,data.nama2 FROM user_logout INNER JOIN data ON data.nama=user_logout.id_data";
		$result = mysqli_query($link, $query) or die(mysqli_error());

		return $result;	
	} 
?>