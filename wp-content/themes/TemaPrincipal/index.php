<?php $css_especifico = 'index';
	require_once('header.php');  ?>
<main class="home-main">
	<div class="container">
		<table style="width:100%;">
			<h1>Pagina Inicial</h1>
			<?php 
			$args = array(
				'post_type' => 'treinamento'
			);
			$loop = new WP_Query($args);
			//$contador = 0;
			if($loop->have_posts()): ?>
			<tr class="cursos-listagem">
				<?php
					while($loop->have_posts()):	$loop->the_post();
				?>
				<td class="cursos-listagem-item dados">
					<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
					<h2><?php the_title(); ?></h2>
					</a>
				</td>
				<?php
						/*if ($contador%4 == 0) {
							echo '</tr><tr class="cursos-listagem">';
						}
						else{
							$contador++;
						}*/
					endwhile;
				endif; ?>
			</tr>
		</table>
	</div>
</main>
<?php get_footer(); ?>