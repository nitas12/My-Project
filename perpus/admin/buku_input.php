<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Input Data Buku</title>
        <!-- css table datatables/dataTables -->
	    <link rel="stylesheet" href="datatables/dataTables.bootstrap.css"/>
 
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
               
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    </head>
    <body>
       

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <?php
			if(isset($_POST['input'])){
				$id	       = $_POST['id'];
				$judul		   = $_POST['judul'];
				$pengarang  = $_POST['pengarang'];
				$penerbit = $_POST['penerbit'];
				$isbn        = $_POST['isbn'];
                $jumlah_buku        = $_POST['jumlah_buku'];
                $lokasi        = $_POST['lokasi'];
                
				
				$cek = mysqli_query($koneksi, "SELECT * FROM tbl_buku WHERE id='$id'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($koneksi, "INSERT INTO tbl_buku(id, judul, pengarang, penerbit, isbn, jumlah_buku, lokasi)
															VALUES('$id','$judul', '$pengarang', '$penerbit', '$isbn', '$jumlah_buku', '$lokasi')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Berhasil Di Simpan.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Gagal Di simpan !</div>';
						}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIM Sudah Ada..!</div>';
				}
			}
			?>
            
            <center><div class="panel panel-info" style="width: 500px;">
                        <div class="panel-heading">

                        <h3 class="panel-title"><i class="icon-user"></i>Input Data BUKU</h3> 
                        </div>
                        <div class="panel-body">
                         <form name="form1" id="form1" class="form-horizontal row-fluid" action="?page=buku_input" method="POST" >
										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">ID</label>
											<div class="controls">
												<input type="text" name="id" id="id" placeholder="Tidak perlu di isi" class="form-control span8 tip" readonly="readonly">
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Judul</label>
											<div class="controls">
												<input type="text" name="judul" id="judul" placeholder="Judul Buku" class="form-control span8 tip" required>
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Pengarang</label>
											<div class="controls">
												<input type="text" name="pengarang" id="pengarang" placeholder="Nama Pengarang" class="form-control span8 tip" required>
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Penerbit</label>
											<div class="controls">
												<input name="penerbit" id="penerbit" class="form-control span8 tip" type="text" placeholder="Penerbit" required />
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">ISBN</label>
											<div class="controls">
												<input name="isbn" id="isbn" class=" form-control span8 tip" type="text" placeholder="ISBN Buku" required />
											</div>
										</div>
                                        
                                        <div align="left" class="control-group">
											<label class="control-label" for="basicinput">Jumlah Buku</label>
											<div class="controls">
												<input name="jumlah_buku" id="jumlah_buku" class=" form-control span8 tip" type="text" placeholder="Stok Buku" required />
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Lokasi</label>
											<div class="controls">
												<input name="lokasi" id="lokasi" class=" form-control span8 tip" type="text" placeholder="Lokasi Buku" required />
											</div>
										</div>
<br
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Simpan</button>
                                               <a href="?page=buku" class="btn btn-sm btn-danger">Kembali</a>
											</div>
										</div>
									</form>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        
        <!--/.wrapper--><br />
        <div class="footer span-12">
            <div class="container">
              <center> <b class="copyright"><a href=""> UBSI DEWI SARTIKA</a> by kelompok 4 kelas 12.4D.31 </b></center>
            </div>
        </div>
        <script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	
    </script>
        
        <script src="datatables/jquery.dataTables.js"></script>
        <script src="datatables/dataTables.bootstrap.js"></script>
        <script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"ajax-data-buku.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
        </script>
      
    </body>
