<?php
/*
Template Name: Formulario de Inscrição
*/
?>
<?php get_header(); ?>
<div class="container">
	<form class="form-horizontal" method="post">
		<div class="form-nome">
			<label for="form-nome">Nome:</label>
			<input id="form-nome" type="text" placeholder="Seu nome aqui" name="form-nome">
		</div>
		<div class="form-email">
			<label for="form-email">Email:</label>
			<input id="form-email" type="email" placeholder="email@exemplo.com.br" name="form-email">
		</div>
		<div class="form-mensagem">
			<label for="form-mensagem">Mensagem:</label>
			<textarea id="form-mensagem" name="form-mensagem"></textarea>
		</div>
		<button type="submit">Enviar</button>
	</form>
</div>
<?php get_footer(); ?>