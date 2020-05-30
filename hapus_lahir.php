<?php
include "../inc/dbinfo.inc";
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD); 

    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
 
    $database = mysqli_select_db($connection, DB_DATABASE);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    	$query   = "SELECT * FROM KELAHIRAN WHERE ID='$id'";
    	$hasil   = mysqli_query($connection,$query);
    }else {
    	die ("Error. Tidak ada ID yang dipilih Silakan cek kembali! ");    
    }

    if (!empty($id) && $id != "") {
        $hapus = "DELETE FROM KELAHIRAN WHERE id='$id'";
        $sql = mysqli_query ($connection,$hapus);
        if ($sql) {        
?>
        	<script language="JavaScript">
                alert('Data Warga <?=$id?> Berhasil dihapus!');
                document.location='kelahiran.php';
            </script>
<?php        
        } else {
            echo "<font color=red><center>Data Warga gagal dihapus</center></font>";    
        }
    }
    //Tutup koneksi engine MySQL
    mysqli_close($Open);
?>