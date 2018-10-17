<!doctype html>
<html>
	<head>
		<?php wp_head(); ?>
		<?php $home = get_template_directory_uri(); ?>
		<link rel="stylesheet" href="<?= $home ?>/comum.css">
		<link rel="stylesheet" href="<?= $home ?>/header.css">
		<link rel="stylesheet" href="<?= $home ?>/reset.css">
		<link rel="stylesheet" href="<?= $home ?>/<?= $css_especifico ?>.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<title><?php bloginfo('name');
		if (!is_home()) {
			echo ' | ';
			the_title();
		}?></title>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<a class="navbar-brand" href="<?=get_site_url()?>">Pagina Inicial</a>
			<ul class="navbar-nav">
			    <li class="nav-item">
			      <a class="nav-link" href="<?=get_site_url().'/cursos/'?>">Cursos</a>
			    </li>
			</ul>
		</nav>