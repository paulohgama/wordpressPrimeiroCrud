<?php
/*
Template Name: Cursos
*/
?>

<?php 
    get_header();
    $args = array(
	'post_type' => 'treinamento'
    );
    $loop = new WP_Query($args);
    if($loop->have_posts()): ?>
<div class="container-fluid">
    <div class="col-sm-offset-10">
       <h2>Cursos Disponiveis</h2>
    </div>
    <br/>
    <br/>
<div>
    <?php
    	while($loop->have_posts()):	$loop->the_post();
    ?>
    <div class="col-sm-2">
        <a role="button" class="btn btn-default" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('thumbnail');  ?>
            <h2><?php the_title(); ?></h2>
        </a>
    </div>
    <?php
	/*if ($contador%4 == 0) {
    	echo '</tr><tr class="cursos-listagem">';
        }
	else{
	$contador++;
	}*/
        endwhile;
        ?> </div></div> <?php
    endif;
get_footer();