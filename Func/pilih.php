<?php  

	//Login
	function Login_user($user, $pass){
		global $link;

		$query = "SELECT * FROM data WHERE nama='$user' && nis='$pass' && status='1'";
		if($result = mysqli_query($link, $query)){
			if(mysqli_num_rows($result) != 0) return true;
			else return false;
		}
	}

	function no_surat(){
		global $link;

		$query = "SELECT no FROM no_surat WHERE id_data IS NULL ORDER BY RAND() LIMIT 1";
		$result = mysqli_query($link, $query);

		if(mysqli_num_rows($result) != 0) 
		{
			while($data=mysqli_fetch_assoc($result)){
			$no_surat=$data['no']; 
			} return $no_surat; 
		}
			else return false;
	}

	//cek_no_surat
	function update_surat($user,$no_surat){
		global $link;

		$query = "UPDATE no_surat SET id_data='$user' WHERE no='$no_surat'";
		
		$result = mysqli_query($link, $query);
		
		return $result;
	}

	//ambil ip
	function IPnya() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP Tidak Dikenali';
 
    return $ipaddress;
	}

	//cek_ip
	function cek_ip_user($user,$ip_user){
		global $link;

		$query = "SELECT * FROM cek_ip WHERE ip_data='$ip_user'";

		$result = mysqli_query($link, $query);

		if(mysqli_num_rows($result) != 0) 
		{
			while($data=mysqli_fetch_assoc($result)){
			$id=$data['id_data']; 
			} 
				if( $user == $id) {
					return true;
				} else {
					return false;
				}

		}
			else {

				return true;

			}
	}

	//tambah_ip
	function add_ip_user($user,$ip_user){
		global $link;

		$query = "INSERT INTO cek_ip (id_data,ip_data) VALUES ('$user','$ip_user')";

		$result = mysqli_query($link, $query);

		return $result;
	}

	//cekwaktu
	function cek_waktu_login(){
		global $link;
		$query="SELECT * FROM time_voting";
		$result = mysqli_query($link, $query);
		date_default_timezone_set('Asia/Jakarta');
		$tgl_skrg= date('Y-m-d H:i:s');
		while($data=mysqli_fetch_assoc($result)){
			$waktu_dari=$data['dari'];
			$waktu_sampai=$data['sampai'];
			$waktu_status=$data['status'];
		}
		if($tgl_skrg > $waktu_dari AND $tgl_skrg < $waktu_sampai AND $waktu_status=="ON") return true; else return false;
	}

	function tampil($sesi){
		global $link;
		
		$query = "SELECT nama FROM data WHERE nama='$sesi'";
		$result = mysqli_query($link, $query);
		if(mysqli_num_rows($result) >0 ) echo mysqli_fetch_object($result)->nama;
		else return false;
	}

	//Pilih
	function tampilnama($id){
		global $link;

		$query  = "SELECT nama, hasil FROM calon WHERE id='$id'";
		$result = mysqli_query($link, $query) or die(mysqli_error());

		return $result;

	}

	function tampil_taksah(){
		global $link;

		$query  = "SELECT jumlah_tak_sah FROM suara_tak_sah";
		$result = mysqli_query($link, $query) or die(mysqli_error());

		return $result;

	}

	function pilih($sesi, $tambah, $id){
		$sesi		= escape($sesi);
		$tambah		= escape($tambah);
		$id			= escape($id);

		global $link;
		date_default_timezone_set('Asia/Jakarta');
		$tgl_skrg= date('Y-m-d H:i:s');
		$query = "UPDATE data SET status='0' WHERE nama='$sesi';";
		$query .= "UPDATE calon SET hasil='$tambah' WHERE id='$id';";
		$query .= "INSERT INTO waktu_pilih (id_data,waktu) VALUES ('$sesi','$tgl_skrg')";
		
		$result = mysqli_multi_query($link, $query) or die(mysqli_error());

		return $result;
	}

	function pilih_gagal($sesi, $tambah){
		$sesi		= escape($sesi);
		$tambah		= escape($tambah);

		global $link;
		date_default_timezone_set('Asia/Jakarta');
		$tgl_skrg= date('Y-m-d H:i:s');
		$query = "UPDATE data SET status='0' WHERE nama='$sesi';";
		$query .= "UPDATE suara_tak_sah SET jumlah_tak_sah='$tambah';";
		$query .= "INSERT INTO waktu_pilih (id_data,waktu) VALUES ('$sesi','$tgl_skrg')";
		
		$result = mysqli_multi_query($link, $query) or die(mysqli_error());

		return $result;
	}

	//randomPassword
	function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
	}

	//logout ilegal
	function logout_nakal($sesi, $pass_baru){
		$sesi 		= escape($sesi);
		$pass_baru 	= escape($pass_baru);

		global $link;
		date_default_timezone_set('Asia/Jakarta');
		$tgl_skrg= date('Y-m-d H:i:s');
		
		$query = "UPDATE data SET nis='$pass_baru' WHERE nama='$sesi';";
		$query .= "INSERT INTO user_logout (id_data,waktu) VALUES ('$sesi','$tgl_skrg')";

		$result = mysqli_multi_query($link, $query) or die(mysqli_error());

		return $result;
	}

	//Run query
	function run($query){
		global $link;

		if(mysqli_query($link, $query)) return true;
		else return false;
	}
?>