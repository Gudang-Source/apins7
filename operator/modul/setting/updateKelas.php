<?php 

require_once '../../../assets/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$rombel=$connect->real_escape_string($_POST['rombel']);
		$sql = "UPDATE rombel SET nama_rombel='$rombel', kurikulum='$kurikulum', tapel='$tapel', wali_kelas='$wali', pendamping='$gp', pai='$pai', penjas='$penjas', inggris='$inggris' WHERE id_rombel='$idr'";
	if($query === TRUE) {			
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}