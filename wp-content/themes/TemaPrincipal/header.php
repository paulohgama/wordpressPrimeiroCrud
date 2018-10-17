<!doctype html>
<html>
	<head>
		<?php wp_head(); ?>
		<?php $home = get_template_directory_uri(); ?>
		<link rel="stylesheet" href="<?= $home ?>/comum.css">
		<link rel="stylesheet" href="<?= $home ?>/header.css">
		<link rel="stylesheet" href="<?= $home ?>/reset.css">
		<link rel="stylesheet" href="<?= $home ?>/<?= $css_especifico ?>.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <meta charset="utf-8">
		<title><?php bloginfo('name');
		if (!is_home()) {
			echo ' | ';
			the_title();
		}?></title>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-head">
                            <a class="navbar-brand" href="#">Treinamentos Wordpress</a>
                        </div>
			<ul class="nav navbar-nav">
                            <li><a href="<?=get_site_url()?>">Pagina Inicial</a> </li>
                            <li><a class="nav-link" href="<?=get_site_url().'/cursos/'?>">Cursos</a></li>
			</ul>
                    </div>
		</nav>