
             <?php
  include '../conn.php';


			if(isset($_POST['pinjam'])){
				$idtrx		= $_POST['idtrx'];
				$id = $_POST['id'];
				$judul		   = $_POST['judul'];
				$nis	= $_POST['nis'];
				$tgl_pinjam	=	$_POST['tgl_pinjam'];
				$tgl_kembali	=	$_POST['tgl_kembali'];
				$jmlpinjam	=	$_POST['jmlpinjam'];
				$jumlah_buku = $_POST['jumlah_buku'];
                
				
				$cek = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE idtrx=$'idtrx'");
				if(mysqli_num_rows($cek) == 0){



	$sql = mysqli_query($koneksi, "INSERT INTO peminjaman(idtrx, id, judul, nis, tgl_pinjam, tgl_kembali, jmlpinjam)
															VALUES('$idtrx', '$id', '$judul', '$nis','$tgl_pinjam','$tgl_kembali', '$jmlpinjam')") or die(mysqli_error());

$squ = mysqli_query($koneksi, "UPDATE tbl_buku SET jumlah_buku=(jumlah_buku-('$jmlpinjam')) WHERE id='$id'") or die(mysqli_error());
	if($sql && $squ){
							echo '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Transaksi Peminjaman Berhasil Dilakukan.</div>' ;


						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Gagal Di simpan !</div>';
						}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIS  Sudah Ada..!</div>';
				}
			}
			?>

						<center><b style="color: white;">Anda Akan Kembali ke Halaman Sebelumnya</b>
<div style="background-color: white; border-radius: 10px; width: 30px; background-repeat: no-repeat;" id="waktu"></div>
<script type="text/javascript" src="trans_guru/js/count.js"></script>
<script type="text/javascript" src="trans_guru/js/jquery-1.11.3.min.js"></script>