<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Survei</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Report NRC</h1>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<!-- <h3>34/350</h3> -->
									<?php 
									if ((isset($responden_complete) and $responden_complete != 0) and (isset($responden) and $responden != 0)) {
										?>
										<h3><?= sizeof($responden_complete) ?>/<?= sizeof($responden) ?></h3>
										<?php 
									}else{
										?>
										<h3>0</h3>
										<?php 
									}
									?>
									<p>Responden</p>
								</div>
								<div class="icon">
									<i class="ion ion-person"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-warning">
								<div class="inner">
									<?php 
									if ( (isset($per_province)) or (isset($province) and $province !=0 ) ) {
										?>
										<h3><?= $per_province . '/' . sizeof($province) ?></h3>
										<?php 
									}
									?>
									<p>Provinsi</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-3 col-6">
							<div class="small-box bg-success">
								<div class="inner">
									<h3>53<sup style="font-size: 20px">%</sup></h3>
									<p>Persentase</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>65</h3>
									<p>!@#$%^&*()_+</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div> -->
					</div>
					<!-- /.row -->
					<!-- Main row -->
					<div class="row">
						<!-- Left col -->
						<section class="col-lg-12 connectedSortable">
							<!-- Custom tabs (Charts with tabs)-->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										<i class="fas fa-chart-pie mr-1"></i>
										Grafik Responden yang Telah Menjawab Berdasarkan Jenis Kelamin
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="tab-content p-0">
										<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
									</div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</section>
						<!-- /.Left col -->
						<!-- right col (We are only adding the ID to make the widgets sortable)-->
					</div>

				</section>
				<!-- /.card -->


				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Rekapitulasi Responden</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive">
									<table id="concludeTbl" class="table table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th colspan="10">Demografi</th>
												<th colspan="9">Pertanyaan Umum</th>
												<th colspan="8">Visi Jokowi-Amin</th>
												<th colspan="31">Misi Jokowi-Amin</th>
												<th colspan="9">Isu Berkembang</th>
												<th colspan="34">Kementrian</th>
												<th colspan="2"></th>
											</tr>
											<tr>
												<th>Nama</th>
												<th>Email</th>
												<th>Umur</th>
												<th>Nomor Handphone</th>
												<th>Profesi</th>
												<th>Jenis Kelamin</th>
												<th>Alamat</th>
												<th>Pendidikan Terakhir</th>
												<th>Pengeluaran</th>
												<th>Provinsi</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama keseluruhan</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang EKONOMI</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang POLITIK</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang SOSIAL</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang BUDAYA</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang HUKUM</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang HAM</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang PERTAHANAN</th>
												<th>Bagaimana penilaian kinerja 100 hari pertama bidang KEAMANAN</th>
												<th>Pembangunan infrastruktur</th>
												<th>Alasan</th>
												<th>Pembangunan Sumber Daya Manusia (SDM)</th>
												<th>Alasan</th>
												<th>Investasi untuk membuka lapangan pekerjaan</th>
												<th>Alasan</th>
												<th>Reformasi Birokrasi</th>
												<th>Alasan</th>
												<th>Mengembangkan Sistem Jaringan Gizi dan Tumbuh Kembang Anak</th>
												<th>Mengembangkan Reformasi Sistem Kesehatan</th>
												<th>Mengembangkan Reformasi Sistem Pendidikan</th>
												<th>Revitalisasi Pendidikan dan Pelatihan Vokasi</th>
												<th>Menumbuhkan Kewirausahaan</th>
												<th>Menguatkan Kesetaraan Gender dan Pemberdayaan Perempuan</th>
												<th>Revitalisasi Industri untuk Menyongsong Revolusi Industri 4.0</th>
												<th>Mengembangkan Sektor-Sektor Ekonomi Baru</th>
												<th>Reformasi Ketenagakerjaan dengan sistem upah per jam</th>
												<th>Mengembangkan Produktivitas dan Daya Saing UMKM/Koperasi</th>
												<th>Mengembangkan Reformasi Sistem Jaminan Perlindungan Sosial</th>
												<th>Melanjutkan Pemanfaatan Dana Desa</th>
												<th>Pengembangan Kebijakan Tata Ruang Terintegrasi</th>
												<th>Mitigasi Perubahan Iklim</th>
												<th>Penegakan Hukum dan Rehabilitasi Lingkungan Hidup</th>
												<th>Pembinaan Ideologi Pancasila</th>
												<th>Revitalisasi Revolusi Mental</th>
												<th>Toleransi dan Kerukunan Sosial</th>
												<th>Mengembangkan Pemajuan Seni-Budaya</th>
												<th>Melanjutkan Penataan Regulasi</th>
												<th>Melanjutkan Reformasi Sistem dan Proses Penegakan Hukum</th>
												<th>Pencegahan dan Penindakan Korupsi</th>
												<th>Penghormatan, Perlindungan, dan Pemenuhan HAM</th>
												<th>Melanjutkan Haluan Politik Luar Negeri yang Bebas Aktif</th>
												<th>Melanjutkan Transformasi Sistem Pertahanan yang Modern dan TNI yang Profesional</th>
												<th>Melanjutkan Reformasi Keamanan dan Intelejen yang Profesional dan Terpercaya</th>
												<th>Mengembangkan Aparatur Sipil Negara yang Profesional</th>
												<th>Reformasi Sistem Perencanaan, Penganggaran, dan Akuntabilitas Birokrasi</th>
												<th>Percepatan Sistem Pemerintahan Berbasis Elektronik</th>
												<th>Menata Hubungan Pusat dan Daerah yang Lebih Sinergis</th>
												<th>Meningkatkan Kapasitas Daerah Otonom dalam Pelayanan Publik dan  Daya Saing Daerah</th>
												<th>Ibukota Baru “Nagara Rimba Nusa”</th>
												<th>Penghapusan Ujian Nasional</th>
												<th>Pemangkasan Eselon III dan IV</th>
												<th>Radikalisme</th>
												<th>Intoleransi</th>
												<th>Korupsi BUMN</th>
												<th>Kenaikan iuran BPJS</th>
												<th>Penanganan bencana alam seperti banjir dan tanah longsor</th>
												<th>Kedaulatan Negara (Natuna)</th>
												<th>Kemenko Polhukam</th>
												<th>Kemenko Perekonomian</th>
												<th>Kemenko Maritim dan Investasi</th>
												<th>Kemenko Pembangunan Manusia & Kebudayaan</th>
												<th>Kementerian Pertahanan</th>
												<th>Kementerian Luar Negeri</th>
												<th>Kementerian Dalam Negeri</th>
												<th>Kementerian PAN RB</th>
												<th>Kementerian Hukum dan HAM</th>
												<th>Kementerian Kominfo</th>
												<th>Kementerian Keuangan</th>
												<th>Kementerian PUPR</th>
												<th>Bappenas</th>
												<th>Kementerian Perhubungan</th>
												<th>Kementerian Perdagangan</th>
												<th>Kementerian Perindustrian</th>
												<th>Kementerian BUMN</th>
												<th>Kementerian Pertanian</th>
												<th>Kementerian KLHK</th>
												<th>Kementerian ATR / BPN</th>
												<th>Kementerian Koperasi</th>
												<th>Kementerian Ketenagakerjaan</th>
												<th>Kementerian Kelautan dan Perikanan</th>
												<th>Kementerian ESDM</th>
												<th>Kementerian Pariwisata dan Ekonomi Kreatif</th>
												<th>BKPM</th>
												<th>Kementerian Pendidikan</th>
												<th>Kementerian Kesehatan</th>
												<th>Kementerian Sosial</th>
												<th>Kementerian PPA</th>
												<th>Kementerian Agama</th>
												<th>Kementerian Pemuda dan Olahraga</th>
												<th>Kementerian Desa Pembangunan Daerah Tertinggal dan Transmigrasi</th>
												<th>Kementerian Ristek</th>
												<th>Bagaimana Indonesia di tahun 2020 ini?</th>
												<th>Alasan</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (isset($conclude) and $conclude != 0) {
												foreach ($conclude as $row) {
													?>
													<tr>
														<td><?= $row['resp_name'] ?></td>
														<td><?= $row['resp_email'] ?></td>
														<td><?= $row['age_range'] ?></td>
														<td><?= $row['resp_ph'] ?></td>
														<td><?= $row['prof_title'] ?></td>
														<td><?= $row['resp_gender'] ?></td>
														<td><?= $row['resp_address'] ?></td>
														<td><?= $row['edu_title'] ?></td>
														<td><?= $row['expense_range'] ?></td>
														<td><?= $row['prov_title'] ?></td>
														<?php 
														for ($i = 1; $i <= 9 ; $i++) { 
															if (isset($row[$i])) {
																?>
																<td> <?= $row[$i] ?> </td>
																<?php 
															}else{
																echo "<td></td>";
															}
														}
														for ($i = 10; $i <= 13 ; $i++) { 
															if (isset($row[$i]) and isset($row['reason_'.$i])) {
																?>
																<td><?= $row[$i] ?></td>
																<td><?= $row['reason_'.$i] ?></td>
																<?php  
															}else{
																echo "<td></td>";
																echo "<td></td>";
															}
														}
														for ($i = 14; $i <= 87 ; $i++) { 
															if (isset($row[$i])) {
																?>
																<td><?= $row[$i] ?></td>
																<?php 
															}else{
																echo "<td></td>";
															}
														}
														for ($i = 88; $i <= 88 ; $i++) { 
															if (isset($row[$i]) and isset($row['reason_'.$i])) {
																?>
																<td><?= $row[$i] ?></td>
																<td><?= $row['reason_'.$i] ?></td>
																<?php 
															}else{
																echo "<td></td>";
																echo "<td></td>";
															}
														}
														?>
													</tr>
													<?php 
												}
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.card -->
					</div>
				</section>
				<!-- /.card -->

				<section class="content">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Data responden yang telah melakukan pengisian kuisoner</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="respFix" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Provinsi</th>
												<th>Detail</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (isset($fix_resp) and $fix_resp != 0) {
												foreach ($fix_resp as $row) {
													?>
													<tr>
														<td><?= $row->resp_name ?></td>
														<td><?= $row->prov_title ?></td>
														<td><button class="btn btn-sm btn-primary" id="detailBtn" data-id="<?= $row->resp_id ?>">Selengkapnya</button></td>
													</tr>
													<?php 
												}
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->


					<div id="details-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="respNameHead">Header</h4>
									<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
								</div>
								<div class="modal-body">
									<table id="question" class="table table-bordered table-striped" width="100%">
										<thead>
											<tr>
												<th width="50%" >Pertanyaan</th>
												<th width="15%" >Jawaban</th>
												<th width="35%" >Alasan</th>
											</tr>
										</thead>
										<tbody id="containerResp"></tbody>
									</table>
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Daftar Jawaban Responden</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive">
									<table id="answerTable" class="table table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th>Pertanyaan</th>
												<th width="5%">1</th>
												<th width="5%">2</th>
												<th width="5%">3</th>
												<th width="5%">4</th>
												<th width="5%">5</th>
												<th width="5%">6</th>
												<th width="5%">7</th>
												<th width="5%">8</th>
												<th width="5%">9</th>
												<th width="5%">10</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (isset($answer) and $answer != 0) {
												for ($i = 0; $i < sizeof($answer); $i++) { 
													?>
													<tr>
														<td><?= $answer[$i]['Question'] ?></td>
														<?php 
														for ($j = 1; $j <= sizeof($answer[$i]['Answer']); $j++) { 
															?>
															<td><?= $answer[$i]['Answer'][$j]['Total'] ?></td>
															<?php 
														}
														?>
													</tr>
													<?php 
												}
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.card -->
					</div>
				</section>
				<!-- /.card -->

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Data responden yang belum melakukan pengisian kuisoner</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive">
									<table id="respTemp" class="table table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th width="25%">No.Handphone</th>
												<th width="25%">Email</th>
												<th width="25%">Name</th>
												<th width="25%">Provinsi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (isset($temp_resp) and $temp_resp != 0) {
												foreach ($temp_resp as $row) {
													?>
													<tr data-id="<?= $row->resp_id ?>">
														<td><?= $row->resp_ph ?></td>
														<td><?= $row->resp_email ?></td>
														<td><?= $row->resp_name ?></td>
														<td><?= $row->prov_title ?></td>
													</tr>
													<?php 
												}
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.card -->
					</div>
				</section>
				<!-- /.card -->

			</div>
			<!-- /.row (main row) -->
			<footer class="main-footer">
				<strong>NRC TEAM.</strong>
				All rights reserved.
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 1.0
				</div>
			</footer>
		</div>
		<!-- ./wrapper -->

		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- ChartJS -->
		<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
		<!-- Sparkline -->
		<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
		<!-- JQVMap -->
		<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
		<!-- daterangepicker -->
		<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
		<!-- Summernote -->
		<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
		<!-- overlayScrollbars -->
		<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js"></script>
		<!-- DataTables -->
		<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.js"></script>
		<script type="text/javascript">var base_url = "<?php echo base_url(); ?>" </script>

		<script type="text/javascript">
			$(document).ready(function() {

				var data_resp_male		 = <?php echo sizeof($responden_male) ?>;
				var data_resp_female     = <?php echo sizeof($responden_female) ?>;

				var donutData        = {
					labels: [
					'Pria', 
					'Wanita',
					],
					datasets: [
					{
						data: [data_resp_male,data_resp_female],
						backgroundColor : ['#f56954', '#00a65a'],
					}
					]
				}

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
    	maintainAspectRatio : false,
    	responsive : true,
    	showLabel : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
    	type: 'pie',
    	data: pieData,
    	options: pieOptions,
    })

    // #################################################################################################################################################################

    var tempResp = $('#respTemp').DataTable();
    var fixResp = $('#respFix').DataTable();
    var answerResp = $('#answerTable').DataTable();
    var concludeResp = $('#concludeTbl').DataTable({
    	"dom"			: "lBftrip",
    	"responsive"	: true,
    	"lengthChange" : true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "buttons"		: [
        'excelHtml5'
        ]
    });

    fixResp.on('click', '#detailBtn', function (e) {
    	e.preventDefault();

    	var data = { 'resp_id' : $(this).data('id') };

    	$.ajax({
    		url : base_url + 'report/view_details',
    		type : 'POST',
    		dataType : 'JSON',
    		data : data,
    		success : function (data) {
    			$('#containerResp tr').html('');
    			$('#respNameHead').text(data.resp_name + ' (' + data.prov_title +')');
    			for (var i = 0; i < data.data.length; i++) {
    				var reason;
    				if(data.data[i].reason == null){
    					reason = '';
    				}else{
    					reason = data.data[i].reason;
    				}
    				$('#containerResp').append('<tr><td>'+data.data[i].question+'</td><td>'+data.data[i].answer+'</td><td>'+reason+'</td></tr>');
    			}
    		}
    	});

    	$('#details-modal').modal('show');
    });
});
</script>
</body>
</html>
