<?php include "C:/xampp/htdocs/Awan/inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SID : Pakuweru Satu</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="https://projek.s3.amazonaws.com/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <script src="https://kit.fontawesome.com/e798145dc1.js" crossorigin="anonymous"></script>
     <!-- MORRIS CHART STYLES-->
    <link href="https://projek.s3.amazonaws.com/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="https://projek.s3.amazonaws.com/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>

<?php 
 
    /* Connect to MySQL and select the database. */   
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD); 

    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
 
    $database = mysqli_select_db($connection, DB_DATABASE); 
 
    /* Ensure that the DESA table exists. */   
    VerifyDESATable($connection, DB_DATABASE); 
 
    /* If input fields are populated, add a row to the DESA table. */ 
    $employee_kartu = htmlentities($_POST['KARTU']);    
    $employee_nik = htmlentities($_POST['NIK']);   
    $employee_name = htmlentities($_POST['NAMA']);  
    $employee_tanggal = htmlentities($_POST['TANGGAL']); 
    $employee_agama = htmlentities($_POST['AGAMA']); 
    $employee_jenis = htmlentities($_POST['JENIS']);  
    $employee_pendidikan = htmlentities($_POST['PENDIDIKAN']);  
    $employee_pekerjaan = htmlentities($_POST['PEKERJAAN']);  
    $employee_no = htmlentities($_POST['NO']); 
    $employee_status = htmlentities($_POST['STATUS']);
     
    if (strlen($employee_kartu) || strlen($employee_nik) || strlen($employee_name) || strlen($employee_tanggal) || strlen($employee_agama)  || strlen($employee_jenis) || strlen($employee_pendidikan) || strlen($employee_pekerjaan) || strlen($employee_no) || strlen($employee_status)) {     
        AddEmployee($connection, $employee_kartu, $employee_nik, $employee_name, $employee_tanggal, $employee_agama, $employee_jenis, $employee_pendidikan, $employee_pekerjaan, $employee_no, $employee_status);
    } 
?>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="data.php">S I D</a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> 
                <a href="halaman.php" class="btn btn-danger square-btn-adjust">Logout</a> 
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="https://projek.s3.amazonaws.com/assets/img/LOGO+KABUPATEN+MINAHASA.png" class="user-image img-responsive"/>
                    </li>
                    
                    <li>
                        <a class="active-menu"  href="data.php"><i class="fa fa-list"></i> Data Penduduk</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Perspektif Sosial Penduduk<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="pbs.php">Penerima Bantuan Sosial</a>
                            </li>
                            <li>
                                <a href="bsm.php">Bantuan Siswa Miskin</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Peristiwa<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="kelahiran.php">Kelahiran</a>
                            </li>
                            <li>
                                <a href="kematian.php">Kematian</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a  href="datamasuk.php"><i class="fa fa-long-arrow-alt-right"></i> Pindah Mausk</a>
                    </li>
                    <li>
                        <a  href="keluar.php"><i class="fa fa-long-arrow-alt-left"></i> Pindah Keluar</a>
                    </li>
                    <li>
                        <a  href="tentang.php"><i class="fa fa-desktop"></i> Tentang</a>
                    </li>
                    <li>
                        <a   href="biodata.php"><i class="fa fa-camera"></i> About Us</a>
                    </li> 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Sistem Informasi Desa</h2>   
                        <h5>Desa Pakuweru Satu, Kabupaten Minahasa Selatan. </h5>
                    </div>
                </div>

					<div class="panel panel-default">
                        <div class="panel-heading">
                            Pengisian Data Diri
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Lengkapi data di bawah sesuai dengan KTP dan KK</h3>
                                    <form role="form" action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                                        <div class="form-group input-group-sm">
                                            <label>No. KK</label>
                                            <input class="form-control" name="KARTU" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>No. NIK</label>
                                            <input class="form-control" name="NIK" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Nama Lengkap</label>
                                            <input class="form-control" name="NAMA" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <input class="form-control" name="TANGGAL" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Agama</label>
                                            <input class="form-control" name="AGAMA" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Jenis Kelamin</label>
                                            <input class="form-control" name="JENIS" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Pendidikan Terakhir</label>
                                            <input class="form-control" name="PENDIDIKAN" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Pekerjaan</label>
                                            <input class="form-control" name="PEKERJAAN" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>No. Telpon</label>
                                            <input class="form-control" name="NO" maxlength="90" size="60" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Status</label>
                                            <input class="form-control" name="STATUS" maxlength="90" size="60" />
                                        </div>
                                        <div align="right">
                                        	<input type="submit" value="Tambah Data" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="https://projek.s3.amazonaws.com/assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://projek.s3.amazonaws.com/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="https://projek.s3.amazonaws.com/assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="https://projek.s3.amazonaws.com/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="https://projek.s3.amazonaws.com/assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="https://projek.s3.amazonaws.com/assets/js/custom.js"></script>
    
   
</body>
</html>

<?php 
 
  /* Add an employee to the table. */ 
  function AddEmployee($connection, $kartu, $nik, $nama, $tanggal, $agama, $jenis, $pendidikan, $pekerjaan, $no, $status) {   
    $a = mysqli_real_escape_string($connection, $kartu); 
    $b = mysqli_real_escape_string($connection, $nik);    
    $c = mysqli_real_escape_string($connection, $nama);
    $d = mysqli_real_escape_string($connection, $tanggal);  
    $e = mysqli_real_escape_string($connection, $agama);
    $f = mysqli_real_escape_string($connection, $jenis);   
    $g = mysqli_real_escape_string($connection, $pendidikan); 
    $h = mysqli_real_escape_string($connection, $pekerjaan);  
    $i = mysqli_real_escape_string($connection, $no);   
    $j = mysqli_real_escape_string($connection, $status);


    $query = "INSERT INTO DESA (KARTU, NIK, NAMA, TANGGAL, AGAMA, JENIS, PENDIDIKAN, PEKERJAAN, NO, STATUS) VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j');"; 
 
    if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>"); 
  } 
 
  /* Check whether the table exists and, if not, create it. */ 
  function VerifyDESATable($connection, $dbName) {   
    if(!TableExists("DESA", $connection, $dbName))   {      
      $query = "CREATE TABLE DESA (
        ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        KARTU VARCHAR(30),         
        NIK VARCHAR(30),          
        NAMA VARCHAR(90),
        TANGGAL VARCHAR(90),
        AGAMA VARCHAR(90),
        JENIS VARCHAR(90),          
        PENDIDIKAN VARCHAR(90),  
        PEKERJAAN VARCHAR(90),        
        NO VARCHAR(45),          
        STATUS VARCHAR(90)       
      )"; 
 
     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");   
    } 
  } 
 
  /* Check for the existence of a table. */ 
  function TableExists($tableName, $connection, $dbName) {   
    $t = mysqli_real_escape_string($connection, $tableName);   
    $d = mysqli_real_escape_string($connection, $dbName); 
 
    $checktable = mysqli_query($connection, "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'"); 
 
    if(mysqli_num_rows($checktable) > 0) return true; 
 
    return false; 
  } 

?>
