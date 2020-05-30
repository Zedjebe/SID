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
 
    /* Ensure that the KELAHURAN table exists. */   
    VerifyKELAHIRANTable($connection, DB_DATABASE); 
 
    /* If input fields are populated, add a row to the KELAHIRAN table. */ 
    $employee_tanggal = htmlentities($_POST['TANGGAL']);   
    $employee_nama = htmlentities($_POST['NAMA']);  
    $employee_kelamin = htmlentities($_POST['KELAMIN']); 
    $employee_berat = htmlentities($_POST['BERAT']); 
    $employee_panjang = htmlentities($_POST['PANJANG']);  
    $employee_ayah = htmlentities($_POST['AYAH']);    
    $employee_ibu = htmlentities($_POST['IBU']);    
    $employee_kembar = htmlentities($_POST['KEMBAR']);    
    $employee_lahir = htmlentities($_POST['LAHIR']);
     
    if (strlen($employee_tanggal) || strlen($employee_nama) || strlen($employee_kelamin) || strlen($employee_berat) || strlen($employee_panjang)  || strlen($employee_ayah) || strlen($employee_ibu) || strlen($employee_kembar) || strlen($employee_lahir)) {     
        AddEmployee($connection, $employee_tanggal, $employee_nama, $employee_kelamin, $employee_berat, $employee_panjang, $employee_ayah, $employee_ibu, $employee_kembar, $employee_lahir);
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
                        <a class="active-menu" href="#"><i class="fa fa-sitemap"></i> Peristiwa<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="kelahiran.php">Kelahiran</a>
                            </li>
                            <li>
                                <a href="kematian.php">Kematian</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a  href="datamasuk.php"><i class="fa fa-long-arrow-alt-right"></i> Pindah Masuk</a>
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
                        <h2>Data Kelahiran</h2>
                        <h5>Desa Pakuweru Satu, Kabupaten Minahasa Selatan. </h5>
                        <br><br>

                        <a href="tambah_lahir.php" class="btn btn-primary">Tambah Data</a>
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
                                        <td>TGL. LAHIR</td>
                                        <td>NAMA BAYI</td> 
                                        <td>JENIS KELAMIN</td> 
                                        <td>BERAT BAYI</td> 
                                        <td>PANJANG BAYI</td>    
                                        <td>NAMA AYAH</td>    
                                        <td>NAMA IBU</td>    
                                        <td>KEMBAR</td>    
                                        <td>TEMPAT LAHIR</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = mysqli_query($connection, "SELECT * FROM KELAHIRAN"); 
                                        while($query_data = mysqli_fetch_row($result)) {  
                                    ?>
                                    <tr>
                                        <td><?php echo $query_data[0]; ?></td>
                                        <td><?php echo $query_data[1]; ?></td>
                                        <td><?php echo $query_data[2]; ?></td>
                                        <td><?php echo $query_data[3]; ?></td>
                                        <td><?php echo $query_data[4]; ?></td>
                                        <td><?php echo $query_data[5]; ?></td>
                                        <td><?php echo $query_data[6]; ?></td>
                                        <td><?php echo $query_data[7]; ?></td>
                                        <td><?php echo $query_data[8]; ?></td>
                                        <td><?php echo $query_data[9]; ?></td>
                                        <td>
                                            <a href="edit_lahir.php?id=<?php echo $query_data[0]; ?>" class="btn btn-success">Ubah</a>
                                            <a href="hapus_lahir.php?id=<?php echo $query_data[0]; ?>" class="btn btn-danger" onclick="return confirm('Yakin mau di hapus?');">Hapus</a>
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
  function AddEmployee($connection, $tanggal, $nama, $kelamin, $berat, $panjang, $ayah, $ibu, $kembar, $lahir) {   
    $a = mysqli_real_escape_string($connection, $tanggal);    
    $b = mysqli_real_escape_string($connection, $nama);
    $c = mysqli_real_escape_string($connection, $kelamin);  
    $d = mysqli_real_escape_string($connection, $berat);
    $e = mysqli_real_escape_string($connection, $panjang);   
    $f = mysqli_real_escape_string($connection, $ayah); 
    $g = mysqli_real_escape_string($connection, $ibu); 
    $h = mysqli_real_escape_string($connection, $kembar); 
    $i = mysqli_real_escape_string($connection, $lahir);


    $query = "INSERT INTO KELAHIRAN(TANGGAL, NAMA, KELAMIN, BERAT, PANJANG, AYAH, IBU, KEMBAR, LAHIR) VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i');"; 
 
    if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>"); 
  } 
 
  /* Check whether the table exists and, if not, create it. */ 
  function VerifyKELAHIRANTable($connection, $dbName) {   
    if(!TableExists("KELAHIRAN", $connection, $dbName))   {      
      $query = "CREATE TABLE KELAHIRAN (
        ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        TANGGAL VARCHAR(30),          
        NAMA VARCHAR(90),
        KELAMIN VARCHAR(90),
        BERAT VARCHAR(90),
        PANJANG VARCHAR(90),         
        AYAH VARCHAR(30),         
        IBU VARCHAR(30),         
        KEMBAR VARCHAR(30),          
        LAHIR VARCHAR(90)     
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
