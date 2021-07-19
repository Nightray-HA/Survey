<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/Chart.js"></script>
    <script src="assets/datepicker/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="assets/datepicker/css/datepicker.css">


    <title>HASIL SURVEY KEPUASAN PELAYANAN</title>
  </head>
  <body>
    <?php
    session_start();
    if(empty($_SESSION['username'])){
    	echo "<script>alert('Maaf, Anda harus login terlebih dahulu untuk mengakses halaman ini!');
    	document.location='admin.php';</script>";
       	
    }

    include 'koneksi.php';
    if(isset($_POST['bulan']) && isset($_POST['tahun'])){
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
    }else{
      $date = date("Y-m-d");
	  $bulan = substr($date,5,2);
      $tahun = substr($date,0,4);
    }
    ?>
	  <!-- header -->
	  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #654321;padding: 0%">
	  <a href="chart.php"><img src="img/banner.png" style="width: 110%"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Data Survey Kepuasan Layanan
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="harian.php">Harian</a>
	          <a class="dropdown-item" href="bulanan.php">Bulanan</a>
	          <a class="dropdown-item" href="tahunan.php">Tahunan</a>
	        </div>
	      </li>
	    </ul>
	    <a href="logout.php" class = "btn btn-danger" style="margin-right: 20px">Logout</a>
	  </div>
	</nav>

    <!--card-->
    <div class="card mt-4" style="margin-left: 50px; margin-right: 50px;">
	  <div class="card-header bg-primary text-center text-white">
	   	<!--dropdown-->
     	Perbandingan Data Bidang Bulanan
	  </div>
	  <div class="card-body">
	    <div class = "container">
	    <div class="row">
	    	<div class="col-md-12">
			<form method = "POST" action = "bulanan.php" class="form-inline">
			  <label class="my-1 mr-2" for="bulan">Pilih Bulan</label>
			  <select name  = "bulan" class="custom-select my-1 mr-sm-2" id="bulan">
			    <option selected></option>
			    <option value="01">Januari</option>
			    <option value="02">Februari</option>
			    <option value="03">Maret</option>
			    <option value="04">April</option>
			    <option value="05">Mei</option>
			    <option value="06">Juni</option>
			    <option value="07">Juli</option>
			    <option value="08">Agustus</option>
			    <option value="09">September</option>
			    <option value="10">Oktober</option>
			    <option value="11">November</option>
			    <option value="12">Desember</option>
			  </select>
			  <label class="my-1 mr-2" for="tahun">Pilih Tahun</label>
			  <select name = "tahun" class="custom-select my-1 mr-sm-2" id="tahun">
			    <option selected></option>
			    <option value="2021">2021</option>
			    <option value="2022">2022</option>
			    <option value="2023">2023</option>
			    <option value="2024">2024</option>
			    <option value="2025">2025</option>
			  </select>
			  <button type="submit" class="btn btn-success my-1">Oke</button>
			</form>
	    	</div>
	    </div>
        <div class = "row">
          <div class = "col-md-4 mt-5">
          	<!-- grafik -->
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Kajati</h5>
                <canvas id="kajatiChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-5">
            <div class = "card">
                <div class = "card-body">
                  <h5 class = "card-title">Wakajati</h5>
                  <canvas id="wakajatiChart"></canvas>
                </div>
              </div>
          </div>
          <div class = "col-md-4 mt-5">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Pembinaan</h5>
                <canvas id="pembinaanChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Pidana Khusus</h5>
                <canvas id="pidsusChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
                <div class = "card-body">
                  <h5 class = "card-title">Pidana Umum</h5>
                  <canvas id="pidunChart"></canvas>
                </div>
              </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Intelijen</h5>
                <canvas id="intelChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Datun</h5>
                <canvas id="datunChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
                <div class = "card-body">
                  <h5 class = "card-title">Pengawasan</h5>
                  <canvas id="awasChart"></canvas>
                </div>
              </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Tata Usaha</h5>
                <canvas id="tuChart"></canvas>
              </div>
            </div>
          </div>
        </div>
    </div>
	  </div>
	</div>
    
    
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>

   <script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
    <script>
		var kajatictx = document.getElementById("kajatiChart").getContext('2d');
	    var wakajatictx = document.getElementById("wakajatiChart").getContext('2d');
	    var pembinaanctx = document.getElementById("pembinaanChart").getContext('2d');
	    var pidsusctx = document.getElementById("pidsusChart").getContext('2d');
	    var pidunctx = document.getElementById("pidunChart").getContext('2d');
	    var intelctx = document.getElementById("intelChart").getContext('2d');
	    var datunctx = document.getElementById("datunChart").getContext('2d');
	    var awasctx = document.getElementById("awasChart").getContext('2d');
	    var tuctx = document.getElementById("tuChart").getContext('2d');
		var Chart1 = new Chart(kajatictx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 8 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 8 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 8 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart2 = new Chart(wakajatictx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 9 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 9 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 9 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart3 = new Chart(pembinaanctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 1 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 1 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 1 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart4 = new Chart(pidsusctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 2 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 2 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 2 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart5 = new Chart(pidunctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 3 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 3 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 3 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart6 = new Chart(intelctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 4 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 4 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 4 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart7 = new Chart(datunctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 5 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 5 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 5 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart8 = new Chart(awasctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 6 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 6 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 6 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		var Chart9 = new Chart(tuctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 7 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 7 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = 7 and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
    <script src="assets/js/bootstrap.min.js"></script>    
  </body>
</html>
