<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Registrasi</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/concept-master/')?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link href="<?=base_url('assets/concept-master/')?>assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url('assets/concept-master/')?>assets/libs/css/style.css">
	<link rel="stylesheet" href="<?=base_url('assets/concept-master/')?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
		}
	</style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
	<!-- ============================================================== -->
	<!-- signup form  -->
	<!-- ============================================================== -->
	<form class="splash-container" action="<?=base_url('Regis/proses')?>" method="post">
		<div class="card">
			<div class="card-header">
				<h3 class="mb-1">Registrations Form</h3>
			</div>
			<?php if(!empty($this->session->flashdata('msg'))){?>
				<div class="alert alert-danger" role="alert">
					<?=$this->session->flashdata('msg')?>
				</div>
			<?php }?>           
			<div class="card-body">
				<div class="form-group">
					<input class="form-control form-control-lg" type="text" name="nama" required="" placeholder="Nama" autocomplete="off">
				</div>
				<div class="form-group">
					<input class="form-control form-control-lg" type="text" name="username" required="" placeholder="Username" autocomplete="off">
				</div>
				
				<div class="form-group">
					<input class="form-control form-control-lg" name="password" id="pass1" type="password" required="" placeholder="Password">
				</div>
				<div class="form-group pt-2">
					<button class="btn btn-block btn-primary" type="submit">Register My Account</button>
				</div>
			</div>
			<div class="card-footer bg-white">
				<p>Already member? <a href="<?=base_url('Login')?>" class="text-secondary">Login Here.</a></p>
			</div>
		</div>
	</form>
</body>
</html>