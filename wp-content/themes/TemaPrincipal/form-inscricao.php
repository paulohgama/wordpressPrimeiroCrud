<?php
/*
Template Name: Formulario de Inscrição
*/
?>
<?php 
    
    if(!isset($_POST['post_id']) || empty($_POST['post_id']))
    {
        $location = get_site_url();
        header("location:$location");
        die();
    }
    get_header();
?>
<div class="container">
	<form class="form-horizontal" method="post">
		<div class="form-group">
                    <label class="label-control col-sm-2" for="nome">Nome:</label>
                    <div class="col-sm-10">
                        <input id="nome" class="form-control" type="text" placeholder="Seu nome completo aqui" name="nome">
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="data">Data:</label>
                    <div class="col-sm-10">
                        <input id="data" class="form-control" type="text" placeholder="Sua data de nascimento aqui" name="data">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cpf">CPF:</label>
                    <div class="col-sm-10">
                        <input id="cpf" class="form-control" type="text" placeholder="Insira seu cpf aqui" name="cpf">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input id="form-email" class="form-control" type="email" placeholder="email@exemplo.com.br" name="email">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cep">CEP:</label>
                    <div class="col-sm-10">
                        <input id="rg" class="form-control" type="text" placeholder="Insira seu cep aqui" name="cep">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="endereco">Endereço:</label>
                    <div class="col-sm-10">
                        <input id="endereco" class="form-control" type="" placeholder="Seu endereço aqui" name="endereco">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="bairro">Bairro:</label>
                    <div class="col-sm-10">
                        <input id="bairro" class="form-control" type="text" placeholder="Seu bairro aqui" name="bairro">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cidade">Cidade:</label>
                    <div class="col-sm-10">
                        <input id="cidade" class="form-control" type="text" placeholder="Sua cidade aqui" name="cidade">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="estado">Estado:</label>
                    <div class="col-sm-10">
                        <input id="estado" class="form-control" type="text" placeholder="Seu estado aqui" name="estado">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="telefone">Telefone:</label>   
                    <div class="col-sm-10">
                        <input id="telefone" class="form-control" type="tel" placeholder="Seu telefone aqui" name="telefone">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="celular">Celular:</label>   
                    <div class="col-sm-10">
                        <input id="celular" class="form-control" type="text" placeholder="Seu celular aqui" name="celular">
                    </div>
		</div>
                <div class="col-sm-offset-2 col-sm-10" style="margin-left: 180px">
                    <button class="btn btn-success" type="submit">Enviar</button>
                </div>
	</form>
</div>
<?php get_footer(); ?>