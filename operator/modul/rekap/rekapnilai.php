<?php 

require_once '../../../assets/db_connect.php';
$tapel=$_GET['tapel'];
$kelas=$_GET['kelas'];
$ab=substr($kelas, 0, 1);
$smt=$_GET['smt'];
$jns=$_GET['jns'];
$output = array('data' => array());
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
//$hasil=$query->num_rows;
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$ada1=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='$jns'")->num_rows;
	$ada2=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='$jns'")->num_rows;
	
	$nrh=$connect->query("select avg(nilai) as rerata from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='$jns'")->fetch_assoc();
	$nrt=$connect->query("select sum(nilai) as rerata from raport_k13 where id_pd='$idp'  and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='$jns'")->fetch_assoc();
	//$rnk=$connect->query("select *,sum(nilai) as jumlah,( select find_in_set( jumlah,( select group_concat(distinct jumlah order by jumlah DESC separator ',') from raport))) as rangking from raport where id_pd='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
	//$qrap="";
	
		$output['data'][] = array(
			$s['nama'],
			$nilai1,$nilai2,$nilai3,$nilai4,$nilai5,$nilai6,$nilai7,$nilai8,$nilai9,$nilai10,$nilai11,
			number_format($nrt['rerata'],2),
			number_format($nrh['rerata'],2)
		);
	};

// database connection close
$connect->close();

echo json_encode($output);