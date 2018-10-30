<!doctype html>
<html>
	<head>
		<?php wp_head(); ?>
				

				<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
				<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
				<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
                <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
                <meta charset="utf-8">
		<title>
                <?php bloginfo('name');
		if (!is_home()):
			echo ' | ';
			the_title();
		endif;?></title>
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