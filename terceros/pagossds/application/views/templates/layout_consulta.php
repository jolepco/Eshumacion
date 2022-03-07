<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="baseurl" content="<?php echo base_url();?>">
		<title><?php echo $titulo?></title>
		<!--CSS-->
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap-theme.css')?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/inicio-styles.css')?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css') ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.full.css') ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/consulta.css')?>" />
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/alertifyjs/css/alertify.min.css') ?>"/>	
		<!-- Default theme -->
		<link rel="stylesheet" type="text/css" href="<?php base_url('assets/js/alertifyjs/css/themes/default.min.css') ?>"/>
		<!-- Semantic UI theme -->
		<link rel="stylesheet" type="text/css" href="<?php base_url('assets/js/alertifyjs/css/themes/semantic.min.css') ?>"/>	

		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
	</head>
	<body>
		<?php
			$this->load->view($contenido);
		?>
		<!--JS-->
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/jQuery/jquery-3.3.1.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/DataTables/js/datatables.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/validaciones_dif.js')?>"></script>	
		<script type="text/javascript" src="<?php echo base_url('assets/js/login.js')?>"></script>	
		<script type="text/javascript" src="<?php echo base_url('assets/js/listado.js')?>"></script>		
		<script type="text/javascript" src="<?php echo base_url('assets/js/alertifyjs/alertify.min.js') ?>"></script>
	</body>
</html>