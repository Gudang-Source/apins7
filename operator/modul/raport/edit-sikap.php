<?php
include("../../../assets/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM deskripsi_k13 WHERE id_raport='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
$idsis=$utt['id_pd'];
$nsiswa=mysqli_fetch_array(mysqli_query($koneksi,"select * from siswa where peserta_didik_id='$idsis'"));
?>
						<div class="modal-body">
							<div class="form-group form-group-default">
						</div>