<?php
  session_start();

  include("../inc/dbinfo.inc");

  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD); 

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
 
  $database = mysqli_select_db($connection, DB_DATABASE); 

  $id = $_GET['id'];
  $qu = "SELECT * FROM KELAHIRAN WHERE ID = '$id'";
  $sq = mysqli_query($connection, $qu) or die (mysql_error());
  $data = mysqli_fetch_array($sq);
?>

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
                    </div>
                </div>

          <div class="panel panel-default">
                        <div class="panel-heading">
                            Ubah Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Lengkapi data di bawah</h3>
                                     <?php
                                        $result = mysqli_query($connection, "SELECT * FROM KELAHIRAN"); 
                                        while($query_data = mysqli_fetch_row($result)) {  
                                    ?>
                                    <form role="form" action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                                        <div class="form-group input-group-sm">
                                            <label>ID</label>
                                            <input class="form-control" name="ID" maxlength="90" size="60" value="<?php echo $query_data[0]; ?>" readonly/>
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Tanggal Lahir</label>
                                            <input class="form-control" name="TANGGAL" maxlength="90" size="60" value="<?php echo $query_data[1]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Nama Bayi</label>
                                            <input class="form-control" name="NAMA" maxlength="90" size="60" value="<?php echo $query_data[2]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Jenis Kelamin</label>
                                            <input class="form-control" name="KELAMIN" maxlength="90" size="60" value="<?php echo $query_data[3]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Berat Bayi</label>
                                            <input class="form-control" name="BERAT" maxlength="90" size="60" value="<?php echo $query_data[4]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Panjang Bayi</label>
                                            <input class="form-control" name="PANJANG" maxlength="90" size="60" value="<?php echo $query_data[5]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Nama Ayah</label>
                                            <input class="form-control" name="AYAH" maxlength="90" size="60" value="<?php echo $query_data[6]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Nama Ibu</label>
                                            <input class="form-control" name="IBU" maxlength="90" size="60" value="<?php echo $query_data[7]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Kembar</label>
                                            <input class="form-control" name="KEMBAR" maxlength="90" size="60" value="<?php echo $query_data[8]; ?>" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label>Tempat Lahir</label>
                                            <input class="form-control" name="LAHIR" maxlength="90" size="60" value="<?php echo $query_data[9]; ?>" />
                                        </div>
                                        <div align="right">
                                            <input type="submit" name="edit" value="Edit" class="btn btn-primary"/>
                                        </div>
                                    </form>
                                    <?php
                                      }
                                    ?>
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
  $id = @$_POST["ID"];
  $tanggal = @$_POST["TANGGAL"];
  $nama = @$_POST["NAMA"];
  $kelamin = @$_POST["KELAMIN"];
  $berat = @$_POST["BERAT"];
  $panjang = @$_POST["PANJANG"];
  $ayah = @$_POST["AYAH"];
  $ibu = @$_POST["IBU"];
  $kembar = @$_POST["KEMBAR"];
  $lahir = @$_POST["LAHIR"];
  $edit = @$_POST["edit"];

  if($edit) {
    if($id == "" || $tanggal == "" || $nama == "" || $kelamin == "" || $berat == "" || $panjang == "" || $ayah == "" || $ibu == "" || $kembar == "" || $lahir == "" ){
      ?>
      <script type="text/javascript">alert("inputan tidak boleh kosong");
      </script>
      <?php
    }else {
        mysqli_query($connection, "update KELAHIRAN set TANGGAL = '$tanggal', NAMA = '$nama', KELAMIN = '$kelamin', BERAT = '$berat', PANJANG = '$panjang', AYAH = '$ayah', IBU = '$ibu', KEMBAR = '$kembar', LAHIR = '$lahir' where ID = '$id'") or die (mysql_error());
        ?>
        <script type="text/javascript">
        alert("Data berhasil diubah");
        window.location.href="kelahiran.php";
        </script>
        <?php
      }
    }
  ?>  
