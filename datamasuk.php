<?php include "../inc/dbinfo.inc"; ?>
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
 
    /* Ensure that the MASUK table exists. */   
    VerifyMASUKTable($connection, DB_DATABASE); 
 
    /* If input fields are populated, add a row to the MASUK table. */ 
    $employee_tanggal = htmlentities($_POST['TANGGAL']);    
    $employee_no = htmlentities($_POST['NO']);   
    $employee_alamat = htmlentities($_POST['ALAMAT']);  
    $employee_klasifikasi = htmlentities($_POST['KLASIFIKASI']); 
    $employee_alasan = htmlentities($_POST['ALASAN']); 
     
    if (strlen($employee_tanggal) || strlen($employee_no) || strlen($employee_alamat) || strlen($employee_klasifikasi) || strlen($employee_alasan)) {     
        AddEmployee($connection, $employee_tanggal, $employee_no, $employee_alamat, $employee_klasifikasi, $employee_alasan);
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
                    <img src="https://projek.s3.amazonaws.com/assets/img/9a90b792-2633-4e68-9a6a-088dcc5e6b27.png" class="user-image img-responsive"/>
					</li>
					
                    <li>
                        <a href="data.php"><i class="fa fa-list"></i> Data Penduduk</a>
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
                        <a class="active-menu" href="datamasuk.php"><i class="fa fa-long-arrow-alt-right"></i> Pindah Masuk</a>
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
                        <h2>Data Perpindahan Penduduk Masuk</h2>   
                        <h5>Desa Pakuweru Satu, Kabupaten Minahasa Selatan. </h5>
                        <br><br>

                        <a href="tambahmasuk.php" class="btn btn-primary">Tambah Data</a>
                        <br><br>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr style="text-align: center;">     
                                        <td>ID</td>  
                                        <td>TANGGAL PINDAH MASUK</td> 
                                        <td>NO. KEPALA KELUARGA</td> 
                                        <td>ALAMAT</td> 
                                        <td>KLASIFIKASI PINDAH</td> 
                                        <td>ALASAN PINDAH</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = mysqli_query($connection, "SELECT * FROM MASUK"); 
                                        while($query_data = mysqli_fetch_row($result)) {  
                                    ?>
                                    <tr>
                                        <td><?php echo $query_data[0]; ?></td>
                                        <td><?php echo $query_data[1]; ?></td>
                                        <td><?php echo $query_data[2]; ?></td>
                                        <td><?php echo $query_data[3]; ?></td>
                                        <td><?php echo $query_data[4]; ?></td>
                                        <td><?php echo $query_data[5]; ?></td>
                                        <td>
                                            <a href="editmasuk.php?id=<?php echo $query_data[0]; ?>" class="btn btn-success">Ubah</a>
                                            <a href="hapusmasuk.php?id=<?php echo $query_data[0]; ?>" class="btn btn-danger" onclick="return confirm('Yakin mau di hapus?');">Hapus</a>
                                        </td>
                                    </tr>
        
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <?php 
                                mysqli_free_result($result);   
                                mysqli_close($connection); 
                            ?> 

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
  function AddEmployee($connection, $tanggal, $no, $alamat, $klasifikasi, $alasan) {   
    $a = mysqli_real_escape_string($connection, $tanggal); 
    $b = mysqli_real_escape_string($connection, $no);    
    $c = mysqli_real_escape_string($connection, $alamat);
    $d = mysqli_real_escape_string($connection, $klasifikasi);  
    $e = mysqli_real_escape_string($connection, $alasan);


    $query = "INSERT INTO MASUK(TANGGAL, NO, ALAMAT, KLASIFIKASI, ALASAN) VALUES ('$a', '$b', '$c', '$d', '$e');"; 
 
    if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>"); 
  } 
 
  /* Check whether the table exists and, if not, create it. */ 
  function VerifyMASUKTable($connection, $dbName) {   
    if(!TableExists("MASUK", $connection, $dbName))   {      
      $query = "CREATE TABLE MASUK (
        ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        TANGGAL VARCHAR(30),         
        NO VARCHAR(30),          
        ALAMAT VARCHAR(90),
        KLASIFIKASI VARCHAR(90),
        ALASAN VARCHAR(90)     
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
