<?php
/* Database connection start */
$servername = "localhost";
$username = "epiz_23691749";
$password = "AOYI64qPk";
$dbname = "epiz_23691749_epiz_23691749_perpusdws";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'idtrx',
	1 => 'id',
    2 => 'judul', 
	3 => 'nis',
	4 => 'nama',
	5 => 'kelas',
	6 => 'tgl_pinjam',
	7 => 'tgl_kembali',
	8 => 'jmlpinjam', 
);

// getting total number records without any search
$sql = "SELECT  peminjaman.idtrx, peminjaman.id, peminjaman.judul,siswa.nis, siswa.nama, siswa.kelas,  peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.jmlpinjam FROM siswa, peminjaman WHERE siswa.nis=peminjaman.nis";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT  peminjaman.idtrx, peminjaman.id, peminjaman.judul,siswa.nis, siswa.nama, siswa.kelas,  peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.jmlpinjam FROM siswa, peminjaman WHERE siswa.nis=peminjaman.nis";
	$sql.=" OR idtrx LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR judul LIKE '%".$requestData['search']['value']."%' ";

    $sql.=" OR nama LIKE '%".$requestData['search']['value']."%' ";

    $sql.=" OR kelas LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR nama LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR jmlpinjam LIKE '%".$requestData['search']['value']."%' ";

	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT  peminjaman.idtrx, peminjaman.id, peminjaman.judul,siswa.nis, siswa.nama, siswa.kelas,  peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.jmlpinjam FROM siswa, peminjaman WHERE siswa.nis=peminjaman.nis";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["idtrx"];
	$nestedData[] = $row["id"];
    $nestedData[] = $row["judul"];
	$nestedData[] = $row["nis"];
	$nestedData[] = $row["nama"];
	$nestedData[] = $row["kelas"];
	$nestedData[] = $row["tgl_pinjam"];
		$nestedData[] = $row["tgl_kembali"];
	$nestedData[] = $row["jmlpinjam"];

    $nestedData[] = '<td><center>
                     <a href="?page=kembalikan_proses&idtrx='.$row['idtrx'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-warning"> <i class="menu-icon icon-pencil"></i> </a>
                     <a href="?page=siswa_hapus&kd='.$row['nis'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-danger"> <i class="menu-icon icon-trash"></i> </a>
				     </center></td>';		
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
