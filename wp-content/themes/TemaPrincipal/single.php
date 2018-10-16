<?php $css_especifico = 'single';
	require_once('header.php');  ?>
<main>
	<article>
		<?php 
			if (have_posts()){
				while(have_posts()){
					the_post();
				?>
				<div class="single-curso-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="container">
					<section class="chamada-principal">
						<?php the_title(); ?>
					</section>
					<?php the_content(); ?>
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