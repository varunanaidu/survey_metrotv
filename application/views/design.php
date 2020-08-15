<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="colorlib.com">

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
	<div class="loading" style="display: none;">Loading&#8230;</div>
	<div class="wrapper">
		<form role="form" id="wizard" accept-charset="UTF-8" method="POST">
			<!-- SECTION 1 -->
			<h2></h2>
			<section>
				<div class="inner">
					<div class="form-content">
						<div class="form-header">
							<h3>REGISTRASI</h3>
						</div>
						<p>Silakan isi data diri anda</p>
						<?php 
						if (isset($responden) && $responden != 0) {
							foreach ($responden as $row) {
								?>
								<div class="form-row">
									<div class="form-holder">
										<input type="hidden" name="resp_id" id="resp_id" value="<?= $resp_id?>">
										<input type="text" name="resp_name" id="resp_name" placeholder="Nama" class="form-control" value="<?= $row->resp_name?>">
									</div>
									<div class="form-holder">
										<input type="text" name="resp_email" id="resp_email" placeholder="Email" class="form-control" value="<?= $row->resp_email?>">
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<select name="range_age" id="range_age" class="form-control">
											<option selected="" disabled=""> Umur </option>
											<?php 
											if (isset($range_age) and $range_age != 0) {
												foreach ($range_age as $a) {
													?>
													<option value="<?= $a->range_id?>" <?= ($a->range_id == $row->range_id) ? 'selected' : '' ?> ><?= $a->age_range?></option>
													<?php 
												}
											}
											?>
										</select>
									</div>
									<div class="form-holder">
										<input type="text" name="resp_ph" id="resp_ph" placeholder="Nomor Handphone" class="form-control" value="<?= $row->resp_ph ?>">
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<select name="profession" id="profession" class="form-control">
											<option selected="" disabled=""> Pekerjaan </option>
											<?php 
											if (isset($profession) and $profession != 0) {
												foreach ($profession as $b) {
													?>
													<option value="<?= $b->prof_id?>" <?= ($b->prof_id == $row->prof_id) ? 'selected' : '' ?> ><?= $b->prof_title?></option>
													<?php 
												}
											}
											?>
										</select>
									</div>
									<div class="form-holder" style="align-self: flex-end; transform: translateY(4px);">
										<div class="checkbox-tick">
											<label class="male">
												<input type="radio" name="resp_gender" value="M" <?= ($row->resp_gender == 'M') ? 'checked' : '' ?>> Laki - Laki
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="resp_gender" value="F" <?= ($row->resp_gender == 'F') ? 'checked' : '' ?>> Perempuan
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<input type="text" name="resp_address" id="resp_address" placeholder="Alamat" class="form-control" value="<?= $row->resp_address ?>">
										(Mohon alamat dituliskan dengan lengkap sesuai domisili untuk memudahkan pengiriman souvenir)
									</div>
									<div class="form-holder">
										<select name="edu" id="edu" class="form-control">
											<option selected="" disabled=""> Pendidikan Terakhir </option>
											<?php 
											if (isset($edu) && $edu != 0) {
												foreach ($edu as $c) {
													?>
													<option value="<?= $c->edu_id?>" <?= ($c->edu_id == $row->edu_id) ? 'selected' : '' ?> ><?= $c->edu_title?></option>
													<?php 
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<select name="expense" id="expense" class="form-control">
											<option selected="" disabled=""> Pengeluaran perbulan </option>
											<?php 
											if (isset($expense) && $expense != 0) {
												foreach ($expense as $d) {
													?>
													<option value="<?= $d->expense_id?>" <?= ($d->expense_id == $row->expense_id) ? 'selected' : '' ?> ><?= $d->expense_range?></option>
													<?php 
												}
											}
											?>
										</select>
									</div>
									<div class="form-holder">
										<select name="province" id="province" class="form-control">
											<option selected="" disabled=""> Provinsi </option>
											<?php 
											if (isset($province) && $province != 0) {
												foreach ($province as $e) {
													?>
													<option value="<?= $e->prov_id?>" <?= ($e->prov_id == $row->prov_id) ? 'selected' : '' ?> ><?= $e->prov_title?></option>
													<?php 
												}
											}
											?>
										</select>
									</div>
								</div>

								<!-- BATAS PERULANGAN -->
								<?php 

							}
						}
						?>
					</div>
				</div>
			</section>

			<!-- SECTION 2 -->
			<h2></h2>
			<section>
				<div class="inner">
					<div class="form-content" >
						<div class="form-header">
							<h3>SURVEY</h3>
							<p>Berikan penilaian terhadap pernyataan berikut ini dengan skala 1-10</p>
							<div class="table-responsive">
								<table class="table" border="1" align="center" width="100%">
									<tr>
										<td colspan="2"> Sangat Pesimis </td>
										<td colspan="2"> Pesimis </td>
										<td> Cenderung Pesimis </td>
										<td> Cenderung Optimis </td>
										<td colspan="2"> Optimis </td>
										<td colspan="2"> Sangat Optimis </td>
									</tr>
									<tr>
										<td align="center"> 1 </td>
										<td align="center"> 2 </td>
										<td align="center"> 3 </td>
										<td align="center"> 4 </td>
										<td align="center"> 5 </td>
										<td align="center"> 6 </td>
										<td align="center"> 7 </td>
										<td align="center"> 8 </td>
										<td align="center"> 9 </td>
										<td align="center"> 10 </td>
									</tr>
								</table> 
							</div>
						</div>
						
						<?php 
						if (isset($question) && $question != 0) {
							$a=1;
							foreach ($question as $row) {
								if ($row->quest_category == 1) {
									?>
									<div class="form-row">
										<label><?= $a.'. '.$row->quest_title ?></label>
									</div>
									<div class="form-row">
										<div class="checkbox-tick">
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="1"> 1
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="2"> 2
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="3"> 3
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="4"> 4
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="5"> 5
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="6"> 6
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="7"> 7
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="8"> 8
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="9"> 9
												<span class="checkmark"></span>
											</label>
											<label class="male">
												<input type="radio" name="<?= $row->quest_id?>" value="10"> 10
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<?php 
									$a++;
								}
							}
						}
						?>
					</div>
				</div>
			</section>

			<!-- SECTION 3 -->
			<h2></h2>
			<section>
				<div class="inner">
					<div class="form-content">
						<div class="form-header">
							<h3>SURVEY</h3>
							<p>Berikan penilaian dan alasan Bapak/Ibu terhadap capaian kinerja Visi Jokowi-Amin dalam 100 hari pertama.</p>
							<div class="table-responsive">
								<table class="table" border="1" align="center" width="100%">
									<tr>
										<td colspan="2"> Sangat Pesimis </td>
										<td colspan="2"> Pesimis </td>
										<td> Cenderung Pesimis </td>
										<td> Cenderung Optimis </td>
										<td colspan="2"> Optimis </td>
										<td colspan="2"> Sangat Optimis </td>
									</tr>
									<tr>
										<td align="center"> 1 </td>
										<td align="center"> 2 </td>
										<td align="center"> 3 </td>
										<td align="center"> 4 </td>
										<td align="center"> 5 </td>
										<td align="center"> 6 </td>
										<td align="center"> 7 </td>
										<td align="center"> 8 </td>
										<td align="center"> 9 </td>
										<td align="center"> 10 </td>
									</tr>
								</table> 
							</div>
						</div>
						<?php 
						if (isset($question) && $question != 0) {
							$a=1;
							foreach ($question as $row) {
								if ($row->quest_category == 2) {
									?>
									<div class="form-row">
										<label><?= $a.'. '.$row->quest_title ?></label>
									</div>
									<div class="form-row">
										<label style="color: red"> HARAP DIISI DISERTAKAN ALASAN</label>
									</div>
									<div class="form-row">
										<div class="checkbox-tick">
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="1"> 1
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="2"> 2
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="3"> 3
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="4"> 4
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="5"> 5
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="6"> 6
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="7"> 7
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="8"> 8
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="9"> 9
												<span class="checkmark"></span>
											</label>
											<label>
												<input type="radio" name="<?= $row->quest_id?>" value="10"> 10
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<div class="form-row-address">
										<div class="form-holder">
											<textarea name="reason_<?= $row->quest_id?>" rows="2" cols="100" placeholder="Alasan"></textarea>

											<!-- <input type="text" name="reason_<?= $row->quest_id?>" id="<?= $row->quest_id?>" placeholder="Alasan" class="form-control"> -->
										</div>
									</div>
									<?php 
									$a++;
								}
							}
						}
						?>
					</div>
				</section>

				<!-- SECTION 4 -->
				<h2></h2>
				<section>
					<div class="inner">
						<div class="form-content">
							<div class="form-header">
								<h3>SURVEY</h3>
								<p>Berikan penilaian Bapak/Ibu terhadap capaian kinerja 100 hari pertama kabinet secara keseluruhan.</p>
								<div class="table-responsive">
								<table class="table" border="1" align="center" width="100%">
									<tr>
										<td colspan="2"> Sangat Pesimis </td>
										<td colspan="2"> Pesimis </td>
										<td> Cenderung Pesimis </td>
										<td> Cenderung Optimis </td>
										<td colspan="2"> Optimis </td>
										<td colspan="2"> Sangat Optimis </td>
									</tr>
									<tr>
										<td align="center"> 1 </td>
										<td align="center"> 2 </td>
										<td align="center"> 3 </td>
										<td align="center"> 4 </td>
										<td align="center"> 5 </td>
										<td align="center"> 6 </td>
										<td align="center"> 7 </td>
										<td align="center"> 8 </td>
										<td align="center"> 9 </td>
										<td align="center"> 10 </td>
									</tr>
								</table> 
							</div>
							</div>

							<?php 
							if (isset($question) && $question != 0) {
								$a=1;
								foreach ($question as $row) {
									if ($row->quest_category == 3) {
										?>
										<div class="form-row">
											<label><?= $a.'. '.$row->quest_title ?></label>
										</div>
										<div class="form-row">
											<div class="checkbox-tick">
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="1"> 1
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="2"> 2
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="3"> 3
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="4"> 4
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="5"> 5
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="6"> 6
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="7"> 7
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="8"> 8
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="9"> 9
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="10"> 10
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<?php 
										$a++;
									}
								}
							}
							?>

						</div>
					</div>
				</section>

				<!-- SECTION 5 -->
				<h2></h2>
				<section>
					<div class="inner">
						<div class="form-content">
							<div class="form-header">
								<h3>SURVEY</h3>
								<p>Berikan penilaian Bapak/Ibu terhadap penyelesaian/penanganan isu-isu yang berkembang pada 100 hari pertama kabinet Jokowi-Amin.</p>
								<div class="table-responsive">
								<table class="table" border="1" align="center" width="100%">
									<tr>
										<td colspan="2"> Sangat Pesimis </td>
										<td colspan="2"> Pesimis </td>
										<td> Cenderung Pesimis </td>
										<td> Cenderung Optimis </td>
										<td colspan="2"> Optimis </td>
										<td colspan="2"> Sangat Optimis </td>
									</tr>
									<tr>
										<td align="center"> 1 </td>
										<td align="center"> 2 </td>
										<td align="center"> 3 </td>
										<td align="center"> 4 </td>
										<td align="center"> 5 </td>
										<td align="center"> 6 </td>
										<td align="center"> 7 </td>
										<td align="center"> 8 </td>
										<td align="center"> 9 </td>
										<td align="center"> 10 </td>
									</tr>
								</table> 
							</div>
							</div>

							<?php 
							if (isset($question) && $question != 0) {
								$a=1;
								foreach ($question as $row) {
									if ($row->quest_category == 4) {
										?>
										<div class="form-row">
											<label><?= $a.'. '.$row->quest_title ?></label>
										</div>
										<div class="form-row">
											<div class="checkbox-tick">
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="1"> 1
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="2"> 2
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="3"> 3
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="4"> 4
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="5"> 5
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="6"> 6
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="7"> 7
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="8"> 8
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="9"> 9
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="10"> 10
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<?php 
										$a++;
									}
								}
							}
							?>

						</div>
					</div>
				</section>

				<!-- SECTION 6 -->
				<h2></h2>
				<section>
					<div class="inner">
						<div class="form-content">
							<div class="form-header">
								<h3>SURVEY</h3>
								<p>Berikan penilaian Bapak/Ibu terhadap capaian kinerja 100 hari pertama Kementerian berikut ini.</p>
								<div class="table-responsive">
								<table class="table" border="1" align="center" width="100%">
									<tr>
										<td colspan="2"> Sangat Pesimis </td>
										<td colspan="2"> Pesimis </td>
										<td> Cenderung Pesimis </td>
										<td> Cenderung Optimis </td>
										<td colspan="2"> Optimis </td>
										<td colspan="2"> Sangat Optimis </td>
									</tr>
									<tr>
										<td align="center"> 1 </td>
										<td align="center"> 2 </td>
										<td align="center"> 3 </td>
										<td align="center"> 4 </td>
										<td align="center"> 5 </td>
										<td align="center"> 6 </td>
										<td align="center"> 7 </td>
										<td align="center"> 8 </td>
										<td align="center"> 9 </td>
										<td align="center"> 10 </td>
									</tr>
								</table> 
							</div>
							</div>

							<?php 
							if (isset($question) && $question != 0) {
								$a=1;
								foreach ($question as $row) {
									if ($row->quest_category == 5) {
										?>
										<div class="form-row">
											<label><?= $a.'. '.$row->quest_title ?></label>
										</div>
										<div class="form-row">
											<div class="checkbox-tick">
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="1"> 1
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="2"> 2
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="3"> 3
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="4"> 4
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="5"> 5
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="6"> 6
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="7"> 7
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="8"> 8
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="9"> 9
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" name="<?= $row->quest_id?>" value="10"> 10
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<?php 
										$a++;
									}
								}
							}
							?>

						</div>
					</div>
				</section>

				<!-- SECTION 7 -->
				<h2></h2>
				<section>
					<div class="inner">
						<div class="form-content">
							<div class="form-header">
								<h3>SURVEY</h3>
							</div>
							<?php 
							if (isset($question) && $question != 0) {
								foreach ($question as $row) {
									if ($row->quest_category == 6) {
										?>
										<div class="form-row">
											<label><?= $row->quest_title?></label>
										</div>
									<div class="form-row">
										<label style="color: red"> HARAP DIISI DISERTAKAN ALASAN</label>
									</div>
										<div class="form-row">
											<div class="checkbox-tick">
												<label class="male">
													<input type="radio" id="rBtn" name="<?= $row->quest_id?>" value="Pesimis" onclick="if(this.checked){ $('#reasonContainer').show(); }"> Pesimis
													<span class="checkmark"></span>
												</label>
												<label class="male">
													<input type="radio" id="rBtn" name="<?= $row->quest_id?>" value="Optimis" onclick="if(this.checked){ $('#reasonContainer').show(); }"> Optimis
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<div id="reasonContainer" style="display: none;">
											<div class="form-row">
												<div class="form-holder">
													<label>Masukan Alasan Anda</label>
												</div>
											</div>
											<div class="form-row">
												<div class="form-holder">
													<textarea name="reason_<?= $row->quest_id?>" rows="5" cols="50"></textarea>
												</div>
											</div>
										</div>
										<?php 
									}
								}
							}
							?>
						</div>
					</div>
				</section>
			</form>
		</div>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

		<!-- JQUERY FORM -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>


		<!-- JQUERY STEP -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.steps.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<script src="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>

		<!-- URL -->
		<script type="text/javascript">var base_url = "<?php echo base_url(); ?>" </script>
		<!-- Template created and distributed by Colorlib -->
	</body>
	</html>
