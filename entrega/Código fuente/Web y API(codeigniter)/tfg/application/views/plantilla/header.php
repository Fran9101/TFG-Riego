<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo ?> | TFG</title>
	<link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra-collapse">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="<?php echo base_url(); ?>">TFG</a>
      		</div>
      		<div class="navbar-collapse collapse" id="barra-collapse">
      			<ul class="nav navbar-nav">
      				<li><a href="<?php echo base_url(); ?>inicio/">Estadísticas</a></li>
      				<li><a href="<?php echo base_url(); ?>inicio/Prog">Programación</a></li>
      				<li><a href="<?php echo base_url(); ?>inicio/Conf">Configuración</a></li>
      			</ul>
      		</div>
      	</div>
    </nav>