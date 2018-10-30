<?php
/*
Template Name: Comprar
*/
?>
<?php get_header();
    define("EMAIL_PAGSEGURO", "santosps1990@gmail.com");
    define("TOKEN_PAGSEGURO", "");
    define("TOKEN_SANDBOX", "67FF854B56BF4E83B5F7A388012D8B50");

$TokenCard=$_POST['tokenCard'];
$HashCard=$_POST['hashCard'];
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
$data = date('Y-m-d', $_POST['data']);
$titulo = $_POST['titulo'];
$numero = $_POST['numero'];
$QtdParcelas=filter_input(INPUT_POST,'qntParcelas',FILTER_SANITIZE_SPECIAL_CHARS);
$ValorParcelas=filter_input(INPUT_POST,'ValorParcelas',FILTER_SANITIZE_SPECIAL_CHARS);
$preco= number_format($_POST['preco'], 2, '.', '');
$data = substr($data, 8, 2)."/".substr($data, 5, 2)."/".substr($data, 0, 4);
$Data["email"]=EMAIL_PAGSEGURO;
$Data["token"]=TOKEN_SANDBOX;
$Data["paymentMode"]="default";
$Data["paymentMethod"]="creditCard";
$Data["receiverEmail"]=EMAIL_PAGSEGURO;
$Data["currency"]="BRL";
$Data["itemId1"] = $post;
$Data["itemDescription1"] = $titulo;
$Data["itemAmount1"] = $preco;
$Data["itemQuantity1"] = 1;
$Data["notificationURL="]="http://ambiente-dev5.provisorio.ws/Paulo/Wordpress/notificacao/";
$Data["reference"]=$cpf;
$Data["senderName"]= 'Paulo Henrique';
$Data["senderCPF"]='47629364806';
$Data["senderAreaCode"]= '13';
$Data["senderPhone"]='988420047';
$Data["senderEmail"]='santosps1990@sandbox.pagseguro.com.br';
$Data["senderHash"]=$HashCard;
$Data["shippingType"]="1";
$Data["shippingAddressStreet"]=$endereco;
$Data["shippingAddressNumber"]=$numero;
$Data["shippingAddressComplement"]='';
$Data["shippingAddressDistrict"]=$bairro;
$Data["shippingAddressPostalCode"]='01452002';
$Data["shippingAddressCity"]=$cidade;
$Data["shippingAddressState"]=$estado;
$Data["shippingAddressCountry"]="BRA";
$Data["shippingCost"]="0.00";
$Data["creditCardToken"]=$TokenCard;
$Data["installmentQuantity"]=$QtdParcelas;
$Data["installmentValue"]=$ValorParcelas;
$Data["noInterestInstallmentQuantity"]=2;
$Data["creditCardHolderName"]=$nome;
$Data["creditCardHolderCPF"]=$cpf;
$Data["creditCardHolderBirthDate"]=$data;
$Data["creditCardHolderAreaCode"]=substr($telefone, 0, 2);
$Data["creditCardHolderPhone"]=substr($telefone, 2);
$Data["billingAddressStreet"]=$endereco;
$Data["billingAddressNumber"]=$numero;
$Data["billingAddressComplement"]='';
$Data["billingAddressDistrict"]=$bairro;
$Data["billingAddressPostalCode"]=$cep;
$Data["billingAddressCity"]=$cidade;
$Data["billingAddressState"]=$estado;
$Data["billingAddressCountry"]="BRA";

if(isset($_POST['comprando'])){
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
    $endereco = $_POST['endereco']." ".$_POST['numero'] ;
    $data = date('Y-m-d', $_POST['data']);
    $status = 'Aguardando confirmação de pagamento';

    global $wpdb;
    $inscrito_table = $wpdb->prefix.'inscritos';
    if($wpdb->insert($inscrito_table, array(
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
                                            'inscrito_status' => $status,
                                            'inscrito_data' => date('Y-m-d'),
                                            'pk_post' => $post))) 
    {?>
        <div class="alert alert-success alert-dismissible show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Inscrição efetuada com sucesso</strong>
        </div>
        <?php
        $BuildQuery=http_build_query($Data);
        $Url="https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";
        $Curl=curl_init($Url);
        curl_setopt($Curl,CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($Curl,CURLOPT_POST,1 );
        curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($Curl,CURLOPT_POSTFIELDS,$BuildQuery);
        $Retorno=curl_exec($Curl);
        curl_close($Curl);
        $Xml=simplexml_load_string($Retorno);
        if(!(substr($Xml, 1, 6) == "error")) {?>
            <div class="alert alert-success alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Transação efetuada, aguarde confirmação de pagamento</strong>
            </div>
        <?php
        	      $to = $email;
			      $subject = 'Cadastro efetuado com sucesso';
			      $body = 'Inscrição Recebida, Aguardando pagamento';
			      $headers = array('Content-Type: text/html; charset=UTF-8');
       
      			wp_mail( $to, $subject, $body, $headers );
         } else { ?>
            <div class="alert alert-danger alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>ERRO NA TRANSSAÇÃO POR FAVOR ENTRE EM CONTATO</strong>
            </div>
    <?php }  }else{ ?> 
            <div class="alert alert-danger alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= $wpdb->print_error() ?></strong>
            </div>
     <?php }
    }
    else 
    {?>
        <div class="alert alert-danger alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erro ao cadastrar</strong>
        </div>
    <?php }
    get_footer();