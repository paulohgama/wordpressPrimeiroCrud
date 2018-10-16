<?php
add_theme_support('post-thumbnails');

function cadastro_Cursos(){
	$singular = 'Treinamento';
	$plural = 'Treinamentos';
	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'add_new_item' => 'Adicionar Novo '.$singular,
		'edit_new_item' => 'Editar '.$singular
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail',
		'excerpt'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-admin-page',
		'supports' => $supports
	);
	register_post_type('Treinamento', $args);
}
add_action('init', 'cadastro_Cursos');
function menu(){
	register_nav_menu('header-menu','main-menu');	
}
add_action('init', 'menu');