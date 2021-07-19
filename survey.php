<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">

    <title>SURVEY KEPUASAN PELAYANAN</title>
  </head>
  <body>

    <style type="text/css">
    .box{
      padding: 30px 40px;
      border-radius: 5px;
    }
   </style>

	  <!-- Image and text -->
    <nav class="navbar" style="background-color: #654321; padding: 0px;">
      <a href="index.php">
        <img src="img/banner.png" style="width: 110%">
      </a>
    </nav>

	 
	<?php
		//panggil koneksi database
		include "koneksi.php";
    $bidang = $_GET['bid'];

	?>
	 <div class="container">
    <div class="jumbotron jumbotron-fluid text-center mt-4">
      <div class="container">
        <h1 class="display-4 ">Survey Kepuasan Pelayanan</h1>
        <p class="lead">Isilah survey kepuasan ini sesuai yang Anda rasakan</p>
      </div>
    </div>

	 	<div class="row text-center">
	 		<div class="col-md-4">
  	 			<a href="simpan.php?ket=sangat_puas&bidang=<?=$bidang;?>">
            <div class="bg-primary box text-white">
              <div class="row">
                <div class="col-md-6 mt-2">
                  <h2>SANGAT</h2>
                  <h2>PUAS</h2>
                </div>
                <div class="col-md-4">
                  <img src="img/sangat_puas.png" style="width: 100px;">
                </div>
              </div>
            </div>
          </a>
	 		</div>

	 		<div class="col-md-4">
          <a href="simpan.php?ket=puas&bidang=<?=$bidang;?>">
            <div class="bg-success box text-white">
              <div class="row">
                <div class="col-md-6 mt-4">
                  <h2>PUAS</h2>
                </div>
                <div class="col-md-4">
                  <img src="img/puas.png" style="width: 100px;">
                </div>
              </div>
            </div>
          </a>
      </div>

	 		<div class="col-md-4">
          <a href="simpan.php?ket=kurang&bidang=<?=$bidang;?>">
            <div class="bg-danger box text-white">
              <div class="row">
                <div class="col-md-6 mt-2">
                  <h2>TIDAK</h2>
                  <h2>PUAS</h2>
                </div>
                <div class="col-md-4">
                  <img src="img/kurang.png" style="width: 100px;">
                </div>
              </div>
            </div>
          </a>
      </div>

	 	</div>
	 	<!-- Akhir Row -->
	 </div>
	<!-- Akhir Container -->
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2 fixed-bottom" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>
  </body>
</html>
