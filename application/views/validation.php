<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css">

	<!-- STYLE CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>
<body>
	<div class="wrapper">
		<h2></h2>
		<div class="inner">
			<div class="form-content">
				<div class="form-header">
					<h3>REGISTRASI</h3>
				</div>
				<form method="POST" id="validation-form" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-holder">
							<input type="text" name="resp_email" id="resp_email" placeholder="Email" class="form-control" required="">
						</div>
						<div class="form-holder">
							<input type="number" name="resp_ph" id="resp_ph" placeholder="Nomor Handphone" class="form-control" required="">
						</div>
					</div>
					<div class="form-row">
						<button type="submit" class="btn btn-primary" >Masuk</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<h2></h2>
		<div class="inner">
			<div class="form-content">
				<div class="form-header">
					<h3> Panduan cara Mengisi Kuisioner <br/> Kinerja 100 Hari Jokowi-Amin </h3>
				</div>
				<!-- CONTENT GOES HERE -->
				<p style=" text-align: justify;"> 1.	Login dengan email dan no hp yang didaftarkan ke News Reseacrh Center <br/>
					2. Jika Anda tidak memiliki email, maka login dengan  menggunakan email survei@metrotvnews.tv<br/>
					<p style="color:red; text-align: justify;">3.	Pastikan seluruh pertanyaan diisi, alasan wajib diisi apabila pertanyaan membutuhkan alasan (page 3 dan 5). <br/> Setelah isi, klik tombol selesai. Maka secara otomatis data yang sudah Anda isi akan tersimpan. </p>
					<p style=" text-align: justify;"> 4.	Bapak/Ibu bisa merevisi jawaban hingga tanggal 17 Januari 2020 pukul 24.00 WIB <br/>
						5.	Identitas pribadi wajib diisi lengkap untuk bisa mengisi kuisioner <br/>
						6.	Seluruh jawaban dan identitas Bapak/Ibu dijamin kerahasiaannya. <br/>
					7.	Jika ada masalah dalam pengisian, silakan hubungi ke Saikhu Baghowi (081218314379)</p>
					<!-- END OF CONTENT -->
				</div>
			</div>
		</div>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

		<!-- JQUERY FORM -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- URL -->
		<script type="text/javascript">
			var base_url = "<?php echo base_url(); ?>";

			$(document).ready(function() {
				$('#validation-form').on('submit', function (e) {
					e.preventDefault();

					var formData = new FormData(this);

					$.ajax({
						url : base_url + 'site/validate_responder',
						dataType : 'JSON',
						type : 'POST',
						cache: false,
						contentType: false,
						processData: false,
						data : formData,
						success     : function (data) {
							if (data.type == 'done_complete') {
								console.log(data);
								location.href = base_url + 'site/survey?rsp=' + data['resp_id'];
							}else if(data.type == 'done'){
								console.log(data);
								location.href = base_url + 'site/survey?rsp=' + data['resp_id'];
							}else{
								console.log(data);
								location.href = base_url + 'site/close';
							}
						}
					});
				});
			});
		</script>
	</body>
	</html>
