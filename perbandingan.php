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
    if(isset($_GET['bid'])){
      $_SESSION['bid'] = $_GET['bid'];
    }
      $bid = $_SESSION['bid'];
    

    if(isset($_GET['date'])){
      $date = $_GET['date'];
    }else{
      $date = date("Y-m-d");
    }
    $bulan = substr($date,5,2);
    $tahun = substr($date,0,4);
    ?>
	  <!-- header -->
    <nav class="navbar" style="background-color: #654321; padding: 0%">
      <a href="admin.php"><img src="img/banner.png" style="width: 130%;"></a>
      <a href="logout.php" class = "btn btn-danger" style="margin-right: 10px">Logout</a>
    </nav>

    <!--card-->
    <div class="card mt-4" style="margin-left: 50px; margin-right: 50px;">
	  <div class="card-header bg-primary">
	   	<!--dropdown-->
     	<div class="dropdown">
		  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Pilih Bidang
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		  	<a class="dropdown-item" href="chart.php?bid=8">KAJATI</a>
		  	<a class="dropdown-item" href="chart.php?bid=9">WAKAJATI</a>
		    <a class="dropdown-item" href="chart.php?bid=1">PEMBINAAN</a>
		    <a class="dropdown-item" href="chart.php?bid=2">INTELIJEN</a>
		    <a class="dropdown-item" href="chart.php?bid=3">PIDANA UMUM</a>
		    <a class="dropdown-item" href="chart.php?bid=4">PIDANA KHUSUS</a>
		    <a class="dropdown-item" href="chart.php?bid=5">PERDATA DAN TATA USAHA NEGARA</a>
		    <a class="dropdown-item" href="chart.php?bid=6">PENGAWASAN</a>
		    <a class="dropdown-item" href="chart.php?bid=7">TATA USAHA</a>
		  </div>
		</div>
	  </div>
	  <div class="card-body">
	    <h5 class="card-title text-center">BIDANG
	    	<?php 
	    		if ($bid=='1') {
	    			echo "PEMBINAAN";
	    		}elseif ($bid=='2') {
	    			echo "INTELIJEN";
	    		}elseif ($bid=='3') {
	    			echo "PIDANA UMUM";
	    		}elseif ($bid=='4') {
	    			echo "PIDANA KHUSUS";
	    		}elseif ($bid=='5') {
	    			echo "PERDATA DAN TATA USAHA NEGARA";
	    		}elseif ($bid=='6') {
	    			echo "PENGAWASAN";
	    		}elseif ($bid=='7') {
	    			echo "TATA USAHA";
	    		}elseif ($bid=='8') {
	    			echo "KAJATI";
	    		}elseif ($bid=='9') {
	    			echo "WAKAJATI";
	    		}
	    	?>		
	    </h5>

	    <div class = "container">
        <div class = "row g-0">
          <div class = "col-md-4 mt-2">
          	<form method="GET" action="chart.php">
          		<div class="row">
          			<div class="col-md-6">
          				<input type="text"  name="date" class="form-control datepicker" placeholder="Tanggal">
          			</div>
          			<input type="submit" class = "btn btn-success" value ="Oke">
          		</div>
          	</form>
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Chart harian</h5>
                <canvas id="dChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-5">
            <div class = "card">
                <div class = "card-body">
                  <h5 class = "card-title">Chart Bulanan</h5>
                  <canvas id="mChart"></canvas>
                </div>
              </div>
          </div>
          <div class = "col-md-4 mt-5">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Chart Tahunan</h5>
                <canvas id="yChart"></canvas>
              </div>
            </div>
          </div>
        </div>
    </div>
	  </div>
	</div>
    
    
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2 fixed-bottom" style="background-color: #654321;">
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
		var dctx = document.getElementById("dChart").getContext('2d');
	    var mctx = document.getElementById("mChart").getContext('2d');
	    var yctx = document.getElementById("yChart").getContext('2d');
		var dChart = new Chart(dctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
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
    var mChart = new Chart(mctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
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
    var yChart = new Chart(yctx, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '$tahun'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
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
