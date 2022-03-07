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
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.css')?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/bootstrap-theme.min.css')?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/inicio-styles.css')?>">
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/alertifyjs/css/alertify.min.css') ?>"/>	
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css') ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.full.css') ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/consulta.css')?>" />
		<!-- Default theme -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/alertifyjs/css/themes/default.min.css') ?>"/>
		<!-- Semantic UI theme -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/alertifyjs/css/themes/semantic.min.css') ?>"/>	

		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
		<!--JS-->
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/css/bootstrap/js/bootstrap.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>	
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/DataTables/media/js/jquery.dataTables.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/validaciones_dif.js')?>"></script>	
		<script type="text/javascript" src="<?php echo base_url('assets/js/login.js')?>"></script>	
		<script type="text/javascript" src="<?php echo base_url('assets/js/listado.js')?>"></script>		
		<script type="text/javascript" src="<?php echo base_url('assets/js/alertifyjs/alertify.min.js') ?>"></script>	

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132702381-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-132702381-1');
		</script>		
	</head>
	<body>
		<?php 

			$this->load->view($contenido);
			
		?>
	</body>
</html>