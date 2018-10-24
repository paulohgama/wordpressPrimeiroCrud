<?php
/*
Template Name: Formulario de Inscrição
*/
?>
<?php get_header();
if(isset($_POST['post_id']) || !empty($_POST['post_id'])) {?>
<div class="container">
    <form class="form-horizontal" id="formInscricao" action="<?= (!$_POST['gratuito'] || empty($_POST['gratuito'])) ? get_site_url().'/pagamento' : '' ?>" method="post">
		<div class="form-group">
                    <label class="label-control col-sm-2" for="nome">Nome:</label>
                    <div class="col-sm-10">
                        <input id="nome" class="form-control" type="text" required placeholder="Seu nome completo aqui" name="nome">
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="data">Data:</label>
                    <div class="col-sm-10">
                        <input id="data" class="form-control" type="text" required placeholder="Sua data de nascimento aqui" name="data">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cpf">CPF:</label>
                    <div class="col-sm-10">
                        <input id="cpf" class="form-control" type="text" required placeholder="Insira seu cpf aqui" name="cpf">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input id="email" class="form-control" type="email" required placeholder="email@exemplo.com.br" name="email">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cep">CEP:</label>
                    <div class="col-sm-10">
                        <input id="cep" class="form-control" type="text" required placeholder="Insira seu cep aqui" name="cep">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="endereco">Endereço:</label>
                    <div class="col-sm-6">
                        <input id="endereco" class="form-control" type="text" disabled required placeholder="Seu endereço aqui" name="endereco">
                    </div>
                    <label class="label-control col-sm-1" for="numero">Numero:</label>
                    <div class="col-sm-3">
                        <input id="numero" class="form-control" type="text" required placeholder="Seu numero aqui" name="numero">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="bairro">Bairro:</label>
                    <div class="col-sm-10">
                        <input id="bairro" class="form-control" type="text" required placeholder="Seu bairro aqui" disabled name="bairro">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="cidade">Cidade:</label>
                    <div class="col-sm-10">
                        <input id="cidade" class="form-control" type="text" required placeholder="Sua cidade aqui" disabled name="cidade">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="estado">Estado:</label>
                    <div class="col-sm-10">
                        <input id="estado" class="form-control" type="text" required placeholder="Seu estado aqui" disabled name="estado">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="telefone">Telefone:</label>   
                    <div class="col-sm-10">
                        <input id="telefone" class="form-control" type="tel" required placeholder="Seu telefone aqui" name="telefone">
                    </div>
		</div>
                <div class="form-group">
                    <label class="label-control col-sm-2" for="celular">Celular:</label>   
                    <div class="col-sm-10">
                        <input id="celular" class="form-control" type="text" required placeholder="Seu celular aqui" name="celular">
                    </div>
		</div>
                <input type="hidden" name="post_id" value="<?= $_POST['post_id']?>">
                <input type="hidden" name="preco" value="<?= (double) str_replace(',', '.', $_POST['preco'])?>">
                <input type="hidden" name="titulo" value="<?= $_POST['titulo']?>">
                <div class="col-sm-offset-2 col-sm-10" style="margin-left: 180px">
                    <input class="btn btn-success" name="enviando" value="<?= ($_POST['gratuito'] || !empty($_POST['gratuito'])) ? 'Enviar' : 'Enviar e Pagar'?>" type="submit"/>
                </div>
	</form>
</div>

<?php include 'includes/cadastro.php'; ?>

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
                    $('#formInscricao').validate({
           rules: {
               nome: {
                   required: true,
                   minlength: 5,
                   maxlength: 100
               },
               email: {
                   email: true,
                   required: true,
                   minlength: 10,
                   maxlength: 100
               },
               date: {
                   date: true,
                   required: true
               },
               numero: {
                   number: true,
                   required: true
               },
               cpf: "required",
               cep: "required",
               telefone: "required",
               celular: "required",
               endereco: "required"
           },
           errorClass: "text-danger bg-danger",
           messages: {
               nome: {
                   required: "Nome obrigatorio",
                   minlength: "Tamanhho minimo de 5 caracteres",
                   maxlength: "Tamanhho maximo de 100 caracteres"
               },
               email: {
                   email: 'E-mail invalido',
                   required: 'E-mail obrigatorio',
                   minlength: 'Tamanhho minimo de 5 caracteres',
                   maxlength: 'Tamanhho maximo de 100 caracteres'
               },
               data: {
                   date: 'Data invalida',
                   required: 'Data de nascimento obrigatoria'
               },
               numero: {
                   number:'Numero em formato invalido',
                   required: 'Numero da residencia obrigatoria'
               },
               cpf: 'CPF obrigatorio',
               cep: 'CEP obrigatorio',
               telefone: 'Telefone obrigatorio',
               celular: 'Celular obrigatorio',
               endereco: 'Endereço obrigatorio'
           }      
        });

        });

    </script>

        <?php } else { ?> <h1 style="text-align: center; margin-top: 300px">ESCOLHA UM CURSO PRIMEIRO</h1> <?php } get_footer();