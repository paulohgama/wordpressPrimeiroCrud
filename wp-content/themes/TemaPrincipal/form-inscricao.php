<?php
/*
Template Name: Formulario de Inscrição
*/
?>
<?php if(!isset($_POST['post_id']) || empty($_POST['post_id'])) {
        $location = get_site_url();
        header("location:$location");
        die();
    } get_header(); ?>

<div class="container">
    <form class="form-horizontal" action="" method="post">
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
                        <input id="email" class="form-control" type="email" placeholder="email@exemplo.com.br" name="email">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cep">CEP:</label>
                    <div class="col-sm-10">
                        <input id="cep" class="form-control" type="text" placeholder="Insira seu cep aqui" name="cep">
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
                <input type="hidden" name="post_id" value="<?= $_POST['post_id']?>">
                <div class="col-sm-offset-2 col-sm-10" style="margin-left: 180px">
                    <input class="btn btn-success" name="enviando" value="Enviar" type="submit"/>
                </div>
	</form>
</div>

<?php if(isset($_POST['enviando'])){
        $celular = $_POST['celular'];
        $telefone = $_POST['telefone'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $post = $_POST['post_id'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $data = $_POST['data'];
        
        global $wpdb;
        $inscrito_table = $wpdb->prefix.'inscritos';
        if($wpdb->insert(
            $inscrito_table,
            array(
                'inscrito_nome' => $nome,
                'inscrito_nascimento' => $data,
                'inscrito_cpf' => $cpf,
                'inscrito_cep' => $cep,
                'inscrito_email' => $email,
                'inscrito_cidade' => $cidade,
                'inscrito_bairro' => $bairro,
                'inscrito_estado' => $estado,
                'inscrito_telefone' => $telefone,
                'inscrito_celular' => $celular,
                'inscrito_endereco' => $endereco,
                'pk_post' => $post
            )
                )):
            ?>
            <div class="alert alert-success alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>INSCRITO COM SUCESS</strong>
            </div>
        <?php else: ?>
            <div class="alert alert-danger alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>ERRO AO INSERIR, VERIFIQUE SEUS DADOS E TENTE NOVAMENTE</strong>
            </div>
        <?php endif;
    } ?>

<script type="text/javascript" >

        $(document).ready(function() {
            function limpa_formulário_cep() {
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }
            
            $("#cep").blur(function() {
                var cep = $(this).val().replace(/\D/g, '');
                if (cep != "") {
                    var validacep = /^[0-9]{8}$/;
                    if(validacep.test(cep)) {
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                var estado = {
                                    SP:"São Paulo",
                                    RJ:"Rio de Janeiro",
                                    RS:"Rio Grande do Sul",
                                    PR:"Paraná",
                                    PB:"Paraíba",
                                    BA:"Bahia",
                                    ES:"Espírito Santo",
                                    MT:"Mato Grosso",
                                    MS:"Mato Grosso do Sul",
                                    MG:"Minas Gerais",
                                    RO:"Rondônia",
                                    AM:"Amazonas",
                                    AP:"Amapá",
                                    RR:"Roraima",
                                    SC:"Santa Catarina",
                                    SE:"Sergipe",
                                    CE:"Ceará",
                                    AL:"Alagoas",
                                    AC:"Acre",
                                    GO:"Goiás",
                                    PA:"Pará",
                                    PE:"Pernambuco",
                                    RN:"Rio Grande do Norte",
                                    MA:"Maranhão",
                                    DF:"Distrito Federal",
                                    PI:"Piauí",
                                    TO:"Tocantins"
                                };
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(estado[dados.uf]);
                            }
                            else {
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } 
                    else {
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } 
                else {
                    limpa_formulário_cep();
                }
            });
        });

    </script>

<?php get_footer();