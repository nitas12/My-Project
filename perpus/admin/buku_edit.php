<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data Buku</title>
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
           $kd = $_GET['kd'];
			$sql = mysqli_query($koneksi, "SELECT * FROM tbl_buku WHERE id='$kd'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: buku.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
            
            <center><div class="panel panel-warning" style="width: 70%;">
                        <div class="panel-heading">

                        <h3 class="panel-title"><i class="icon-user"></i>Update Data BUKU</h3> </div>
                        <div class="panel-body">

                         <form name="form1" id="form1" class="form-horizontal row-fluid" action="?page=buku_update" method="POST" >
										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Id</label>
											<div class="controls">
												<input type="text" name="id" id="id" value="<?php echo $row['id']; ?>" placeholder="Tidak perlu di isi" class="form-control span8 tip" readonly="readonly">
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Judul Buku</label>
											<div class="controls">
												<input type="text" name="judul" id="judul" value="<?php echo $row['judul']; ?>" placeholder="Judul Buku" class="form-control span8 tip" required>
											</div>
										</div>

										<div  align="left" class="control-group">
											<label class="control-label" for="basicinput">Pengarang</label>
											<div class="controls">
												<input type="text" name="pengarang" id="pengarang" value="<?php echo $row['pengarang']; ?>" placeholder="Nama Pengarang" class="form-control span8 tip" required>
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Penerbit</label>
											<div class="controls">
												<input name="penerbit" id="penerbit" value="<?php echo $row['penerbit']; ?>" class="form-control span8 tip" type="text" placeholder="Nama Penerbit" required />
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">ISBN</label>
											<div class="controls">
												<input name="isbn" id="isbn" value="<?php echo $row['isbn']; ?>" class="form-control span8 tip" type="text" placeholder="ISBN Buku" required />
											</div>
										</div>
                                        
                                        <div align="left" class="control-group">
											<label class="control-label" for="basicinput">Jumlah Buku</label>
											<div class="controls">
												<input name="jumlah_buku" id="jumlah_buku" value="<?php echo $row['jumlah_buku']; ?>" class=" form-control span8 tip" type="text" placeholder="Stok Buku" required />
											</div>
										</div>

										<div align="left" class="control-group">
											<label class="control-label" for="basicinput">Lokasi</label>
											<div class="controls">
												<input name="lokasi" id="lokasi" value="<?php echo $row['lokasi']; ?>" class=" form-control span8 tip" type="text" placeholder="Rak" required />
											</div>
										</div>
<br
										<div class="control-group">
											<div class="controls">
												<input type="submit" name="update" id="update" value="Update" class="btn btn-sm btn-primary"/>
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
              <center> <b class="copyright"><a href=""> USBI DEWI SARTIKA</a> by kelompok 4 kelas 12.4D.31 </b></center>
            </div>
        </div>
        <script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	
    </script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
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
