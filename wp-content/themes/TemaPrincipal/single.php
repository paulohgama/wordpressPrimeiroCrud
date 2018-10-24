<?php 
    require_once('header.php');  ?>
        <?php 
            if (have_posts()){
		while(have_posts()){
                    the_post();
	?>
	<center>
            <?php the_post_thumbnail('full'); ?>
            <h2><?php the_title(); ?></h2></center><br>
	<div class="col-sm-10">
            <?php the_content(); ?>
	</div>
	<?php $curso_meta_data = get_post_meta($post->ID); ?>
        <div class="col-sm-2">
            <dl>
                <dd>Chamada: <?= date('d/m/Y',  strtotime($curso_meta_data['chamada_id'][0])) ?></dd>
                <dd>Gratuito?
                    <?php if ($curso_meta_data['gratuito_id'][0]) {
                        echo 'Sim.';
                } else{
                        echo 'Nao.';
                } ?></dd>
                <?php if ((!$curso_meta_data['gratuito_id'][0])): ?>
                        <dd>Preço: R$ <?= $curso_meta_data['preco_id'][0] ?></dd>
                <?php endif ?>
                <dd>Vagas: <?= $curso_meta_data['vagas_id'][0] ?></dd>
                <dd>Vagas restantes: <?= $curso_meta_data['vagasrestantes_id'][0] ?></dd>
            </dl>
        </div>  
        <div class="col-sm-4">
            <span class="single-curso-data">
		<?php the_date(); ?>
            </span>
        </div>
        <div class="col-sm-offset-11 col-sm-1">
            <form method="POST" action="<?= get_site_url().'/formulario-de-inscricao/'?>">
                <input type="hidden" name="post_id" value="<?=$post->ID?>"/>
                <input type="hidden" name="preco" value="<?= $curso_meta_data['preco_id'][0] ?>"/>
                <input type="hidden" name="gratuito" value="<?= $curso_meta_data['gratuito_id'][0] ?>"/>
                <input type="hidden" name="titulo" value="<?= the_title() ?>"/>
                <input type="submit" class="btn btn-success" <?= (!$curso_meta_data['vagasrestantes_id'][0] > 0) ? 'disabled' : '' ?> value="Inscrição"/>
            </form>
        </div>
        <?php 
	}
    }
?>
<?php get_footer(); ?>