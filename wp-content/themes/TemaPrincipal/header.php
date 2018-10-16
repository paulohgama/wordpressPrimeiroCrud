<!doctype html>
<html>
	<head>
		<?php wp_head(); ?>
		<?php $home = get_template_directory_uri(); ?>
		<link rel="stylesheet" href="<?= $home ?>/comum.css">
		<link rel="stylesheet" href="<?= $home ?>/header.css">
		<link rel="stylesheet" href="<?= $home ?>/reset.css">
		<link rel="stylesheet" href="<?= $home ?>/<?= $css_especifico ?>.css">
		<meta charset="utf-8">
		<title><?php bloginfo('name');
		if (!is_home()) {
			echo ' | ';
			the_title();
		}?></title>
	</head>
	<body>
		<header>
			<div class="container">
				<?php
				$args = array('theme-location' => 'header-menu');
				wp_nav_menu($args); ?>
			</div>
		</header>