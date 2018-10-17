<?php $css_especifico = 'single';
	require_once('header.php');  ?>
<main">
	<article>
		<?php 
			if (have_posts()){
				while(have_posts()){
					the_post();
				?>
				<div>
					<?php the_post_thumbnail(); ?>
				</div>
				<div>
						<h2><?php the_title(); ?><h2><br>
					<div class="row">
						<div class="col col-sm-8">
							<?php the_content(); ?>
						</div>
						<?php $curso_meta_data = get_post_meta($post->ID); ?>
						<ul class="col col-sm-4">
							<li>Chamada:</dt>
							<li><?= $curso_meta_data['chamada_id'][0] ?></li>
							<li>Gratuito?</li>
							<li><?php if ($curso_meta_data['gratuito_id'][0]) {
								echo 'Sim.';
							} else{
								echo 'Não.';
							} ?></li>
							<?php if (!($curso_meta_data['gratuito_id'][0])): ?>
								<li>Preço:</li>
								<li>R$ <?= $curso_meta_data['preco_id'][0] ?></li>
							<?php endif ?>
							<li>Vagas:</li>
							<li><?= $curso_meta_data['vagas_id'][0] ?></li>
							<li>Vagas restantes:</li>
							<li><?= $curso_meta_data['vagasrestantes_id'][0] ?></li>
						</dl>
					</div>
					<form method="POST" action="<?= get_site_url().'/formulario-de-inscricao/'?>">
						<input type="hidden" value="<?=$post->ID?>"/>
						<input type="submit" class="btn btn-success" value="Inscrição"/>
					</form>
					<span class="single-curso-data">
						<?php the_date(); ?>
					</span>
				</div>
			<?php 
				}
			}
		?>
	</article>
</main>
<?php get_footer(); ?>