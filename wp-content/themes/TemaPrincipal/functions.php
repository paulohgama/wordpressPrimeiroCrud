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

		.form-group {
			flex-basis: 30%;

		}

		.form-group label {
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

		.form-control {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<div class="container">
            <div class="row">
		<label class="col-sm-2" for="Gratuito-input">Gratuito</label>
                <label class="col-sm-2" for="Preco-input">Preço:</label>
                <label class="col-sm-2" for="Chamada-input">Chamada:</label>
                <label class="col-sm-2" for="Vagas-input">Vagas:</label>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <input id="Gratuito-sim" class="radio-inline" type="radio" name="gratuito_id" value="true"> Sim
                    <input id="Gratuito-nao" class="radio-inline" type="radio" name="gratuito_id" value="false" checked> Não
                </div>
                <div class="col-sm-2">
                    <input id="Preco-input" class="form-control" type="text" name="preco_id" value="<?= number_format($curso_meta_data['preco_id'][0], 2, ',', '.'); ?>">
                </div>
                <div class="col-sm-2">
                    <input id="Chamada-input" class="form-control" type="text" name="chamada_id" value="<?= $curso_meta_data['chamada_id'][0]; ?>">
                </div>
                <div class="col-sm-2">
                    <input id="Vagas-input" class="form-control" type="number" name="vagas_id" min="2" value="<?= $curso_meta_data['vagas_id'][0]; ?>">
                    <input type="hidden" id="Vagas_Restantes-input" name="vagasrestantes_id" value="">
                </div>
            </div>
	</div>
        <script type="text/javascript">
        $(document).ready(function(){
            $("#Gratuito-sim").on('change', function()
            {
                $("#Preco-input").attr('disabled', true);
            });
            $("#Gratuito-nao").on('change', function()
            {
                $("#Preco-input").attr('disabled', false);
            });
        });
        </script>
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