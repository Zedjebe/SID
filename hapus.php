<?php
    $Open = mysqli_connect("localhost","root","");
        if (!$Open){
        	die ("Koneksi ke Engine MySQL Gagal !");
        }
    $Koneksi = mysqli_select_db($Open,"sample");
        if (!$Koneksi){
        	die ("Koneksi ke Database Gagal !");
        }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    	$query   = "SELECT * FROM DESA WHERE ID='$id'";
    	$hasil   = mysqli_query($Open,$query);
    }else {
    	die ("Error. Tidak ada ID yang dipilih Silakan cek kembali! ");    
    }

    if (!empty($id) && $id != "") {
        $hapus = "DELETE FROM DESA WHERE id='$id'";
        $sql = mysqli_query ($Open,$hapus);
        if ($sql) {        
?>
        	<script language="JavaScript">
                alert('Data Warga <?=$id?> Berhasil dihapus!');
                document.location='data.php';
            </script>
<?php        
        } else {
            echo "<font color=red><center>Data Warga gagal dihapus</center></font>";    
        }
    }
    //Tutup koneksi engine MySQL
    mysqli_close($Open);
?>