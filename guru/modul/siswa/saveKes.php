<?php
include_once("../../../assets/db.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$nilai=strip_tags($_REQUEST['value']);
$kolom=$_REQUEST['column'];
$cek="select * from data_kesehatan where peserta_didik_id='$idp' AND smt='$smt' AND tapel='$tapel'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['id'];
	$sql = "UPDATE data_kesehatan SET $kolom='$nilai' WHERE id='$idn'";
}else{
	if($kolom=='tinggi'){
		$sql = "INSERT INTO data_kesehatan VALUES('','$idp','$smt','$tapel','$nilai','','','','','')";
	}elseif($kolom=='berat'){
		$sql = "INSERT INTO data_kesehatan VALUES('','$idp','$smt','$tapel','','$nilai','','','','')";
	}elseif($kolom=='pendengaran'){
		$sql = "INSERT INTO data_kesehatan VALUES('','$idp','$smt','$tapel','','','$nilai','','','')";
	}elseif($kolom=='penglihatan'){
		$sql = "INSERT INTO data_kesehatan VALUES('','$idp','$smt','$tapel','','','','$nilai','','')";
	}elseif($kolom=='gigi'){
		$sql = "INSERT INTO data_kesehatan VALUES('','$idp','$smt','$tapel','','','','','$nilai','')";
	}else{
		$sql = "INSERT INTO data_kesehatan VALUES('','$idp','$smt','$tapel','','','','','','$nilai')";
	}
	
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>