<?php
include("../../../assets/db_connect.php");
$idr=$_POST['rowid'];
$utt=$connect->query("SELECT * FROM pemetaan WHERE id_pemetaan='$idr'")->fetch_assoc();
$mpid=$utt['mapel'];
?>
						<div class="modal-body">