
<?php $css_especifico = 'index';
	require_once('header.php');  ?>
<main class="home-main">
	<div class="container">
		<h1>Ola, seja bem vindo</h1>
		<ul class="cursos-listagem">
			<?php 
			$args = array(
				'post_type' => 'treinamento'
			);
			$loop = new WP_Query($args); ?>
			<?php if(have_posts()){
				while(have_posts()){
					the_post();
			?>
			<li class="cursos-listagem-item">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
					<h3><?php the_title(); ?></h3>
					<p><?php the_excerpt(); ?></p>
				</a>
			</li>
			<?php
				}
			} ?>
		</ul>
	</div>
</main>
<?php get_footer(); ?>