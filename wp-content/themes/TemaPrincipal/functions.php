<?php
add_theme_support('post-thumbnails');
function my_function_admin_bar(){
    return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');
function cadastro_Cursos(){
	$singular = 'Treinamento';
	$plural = 'Treinamentos';
	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'add_new_item' => 'Adicionar novo '.$singular,
		'edit_new_item' => 'Editar '.$singular
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-admin-page',
		'supports' => $supports
	);
	register_post_type('treinamento', $args);
}
add_action('init', 'cadastro_Cursos');

function conteudo_treinamentos($post) {
	$curso_meta_data = get_post_meta($post->ID);
	?>
	<script>
		function Gratuito(){
			if ($('#Gratuito-input').attr('Checked')) {
				$('#Preco-input').attr('disabled',true);
				$('#Preco-input').attr('value','0,00');
			}
			else{
				$('#Preco-input').attr('disabled',false);	
			}
		}
		$('#Vagas-input').on('keyup', function(){
			$('#Vagas_Restantes-input').attr('value', $('#Vagas-input').attr('value'));
		});
	</script>
	<style>
		.metabox {
			display: flex;
			justify-content: space-between;
		}

		.metabox-item {
			flex-basis: 30%;

		}

		.metabox-item label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>
	<div class="metabox">
		<div class="metabox-item">
			<label for="Gratuito-input">Gratuito</label>
				<input id="Gratuito-input" class="metabox-input" type="checkbox" name="gratuito_id" onclick="Gratuito()" <?php 
					if ($curso_meta_data['gratuito_id'][0]) {
							echo 'Checked';
					} ?>
				>
			</div>
		</div>
		<div class="metabox-item">
			<label for="Preco-input">Preço:</label>
			<div class="input-addon-wrapper">
				<span class="input-addon">R$</span>
				<input id="Preco-input" class="metabox-input" type="text" name="preco_id"
				value="<?= number_format($curso_meta_data['preco_id'][0], 2, ',', '.'); ?>">
			</div>
		</div>
		<?php if ($curso_meta_data['gratuito_id'][0]) { ?>
			<script>$("#Preco-input").attr("disabled", true);</script>
			<?php
		} ?>
		<div class="metabox-item">
			<label for="Chamada-input">Chamada:</label>
			<input id="Chamada-input" class="metabox-input" type="date" name="chamada_id"
			value="<?= $curso_meta_data['chamada_id'][0]; ?>">
		</div>

		<div class="metabox-item">
			<label for="Vagas-input">Vagas:</label>
			<input id="Vagas-input" class="metabox-input" type="number" name="vagas_id"
			value="<?= $curso_meta_data['vagas_id'][0]; ?>">
			<input type="hidden" id="Vagas_Restantes-input" name="vagasrestantes_id" value="">
		</div>
	</div>
<?php

}

function atualizar($post_id){
	$checked = $_POST['gratuito_id'] ? true : false;
	update_post_meta( $post_id, 'gratuito_id', $checked );
	if ($checked == true) {
		?>
			<script>$('#Preco-input').attr('disabled',true);</script>
		<?php
	}
	if (isset($_POST['preco_id'])) {
		update_post_meta($post_id, 'preco_id', sanitize_text_field($_POST['preco_id']));
	}
	if (isset($_POST['chamada_id'])) {
		update_post_meta($post_id, 'chamada_id', sanitize_text_field($_POST['chamada_id']));
	}
	if (isset($_POST['vagas_id'])) {
		update_post_meta($post_id, 'vagas_id', sanitize_text_field($_POST['vagas_id']));
		if ($_POST['vagasrestantes_id'] != "") {
			update_post_meta($post_id, 'vagasrestantes_id', sanitize_text_field($_POST['vagasrestantes_id']));
		}
		else{
			update_post_meta($post_id, 'vagasrestantes_id', sanitize_text_field($_POST['vagas_id']));
		}
	}
}

function remove_menus(){

  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'plugins.php' );                //Plugins
  
}
add_action( 'admin_menu', 'remove_menus' );

add_action('save_post', 'atualizar');

function remove_footer_admin () {
    echo '';
}
 
function wpbeginner_remove_version() {
    return '';
}

add_filter('the_generator', 'wpbeginner_remove_version');
add_filter('admin_footer_text', 'remove_footer_admin');

function registra_informacoes() {
	add_meta_box(
		'informacoes-treinamentos',
		'Informações do treinamento',
		'conteudo_treinamentos',
		'treinamento',
		'normal',
			'high'
	);
}
add_action('add_meta_boxes', 'registra_informacoes');

function menu(){
	register_nav_menu('header-menu','main-menu');	
}
add_action('init', 'menu');