<?php 

require_once '../../../assets/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$peta=$_GET['peta'];
$mpid=$_GET['mp'];
$output = array('data' => array());

$sql = "select * from pemetaan where kelas='$kelas' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' group by tema order by tema asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$ntema = $s['tema'];
	$sql1 = "select * from pemetaan where kelas='$kelas' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' and tema='$ntema' order by nama_peta asc";
	$query1 = $connect->query($sql1);
	$namapeta="<table>";
	while($k=$query1->fetch_assoc()) {
		$ho=$k['nama_peta'];
		$ids=$k['id_pemetaan'];
		$actionButton = '
		<ul class="pagination pg-primary">
			<li class="page-item"><button data-target="#editKD" class="btn btn-icon btn-link btn-xs" type="button" id="'.$ids.'" data-toggle="modal" data-id="'.$ids.'"><i class="fas fa-edit"></i></button></li>
		<li class="page-item"><button class="btn btn-icon btn-link btn-xs" type="button" data-toggle="modal" data-target="#removeKDModal" onclick="removeKD(\''.$k['id_pemetaan'].'\')"><i class="fas fa-trash"></i></button></li></ul>
		';
		$sqlp = "select * from kd where kelas='$kelas' and aspek='$peta' and mapel='$mpid' and kd='$ho'";
		$queryp = $connect->query($sqlp);
		$ada=$queryp->num_rows;
		if($ada>0){
		$qq=$queryp->fetch_assoc();
		$namapeta.="<tr><td><span class='badge bg-yellow'>".$ho."</span></td><td>".$actionButton."</td></tr>";
		};
	};
	$namapeta.="</table>";
	$output['data'][] = array(
		$s['tema'],
		$namapeta
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);