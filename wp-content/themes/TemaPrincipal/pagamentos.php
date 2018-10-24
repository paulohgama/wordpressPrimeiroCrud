<?php
/*
Template Name: PagSeguro
*/
get_header();
?>
<?php
if(isset($_POST['post_id']) || !empty($_POST['post_id'])) {?>
<script type="text/javascript">

$(document).ready(function(){
    $("#comprar").hide();
    var Root = "<?= get_site_url().'/dados' ?>";
    var Amount = <?= $_POST['preco'] ?>;
    $("#preco").val(Amount);
    $.ajax({
           url: Root,
           type: 'POST',
           dataType:'json',
           success: function(data)
           {
               PagSeguroDirectPayment.setSessionId(data.id);
           },
           complete: function()
           {
               listarMeiosPagamentos();
           }
    });
    function listarMeiosPagamentos()
    {
        PagSeguroDirectPayment.getPaymentMethods({
            amount: Amount,
            success: function(data)
            {
                //$.each(data.paymentMethods.CREDIT_CARD.options, function(i, obj){
                //    $('#credito').append("<p class='col-sm-2'><img src='https://stc.pagseguro.uol.com.br/"+obj.images.SMALL.path+"'/>"+obj.displayName+"</p>");
                //});
                //$('#boleto').append("<p class='col-sm-2'><img src='https://stc.pagseguro.uol.com.br/"+data.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path+"'/>"+data.paymentMethods.BOLETO.options.BOLETO.displayName+"</p>");
                //$.each(data.paymentMethods.ONLINE_DEBIT.options, function(i, obj){
                //    $('#debito').append("<p class='col-sm-2'><img src='https://stc.pagseguro.uol.com.br/"+obj.images.SMALL.path+"'/>"+obj.displayName+"</p>");
                //});
            },
            complete: function(data)
            {
                
            }
        });
    }
    
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    
    $("#NumeroCartao").on('keyup', function(){
        var cartao = $(this).val();
        var qnt = cartao.length;
        if(qnt == 6){
            PagSeguroDirectPayment.getBrand({
                cardBin: cartao,
                success: function(data){
                    $("#imageBrand").html("<img src='https:/stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/"+data.brand.name+".png'>");
                    getParcelas(data.brand.name);
                    $("#Bandeira").val(data.brand.name);
                },
                error: function(data)
                {
                    alert("Cartão não reconhecido");
                    $("#imageBrand").empty();
                }
            });
        }
        if(qnt < 6)
        {
            $("#imageBrand").empty();
        }
    });
    function getParcelas(Bandeira)
    {
        PagSeguroDirectPayment.getInstallments({
            amount: Amount,
            maxInstallmentNoInterest: 2,
            brand: Bandeira,
            success: function(data){
                $('#qntParcelas').empty();
                $('#qntParcelas').append("<option value=''>Selecione numero de parcelas</option>");
                $.each(data.installments, function(i, obj){
                    $.each(obj, function(j, objto){
                        var NumberValue = objto.installmentAmount;
                        var Number = "R$" + NumberValue.toFixed(2).replace(".", ",");
                        var NumberParcelas= NumberValue.toFixed(2);
                        $('#qntParcelas').show().append("<option value='"+objto.quantity+"' label='"+NumberParcelas+"'>"+objto.quantity+" parcelas de "+Number+"</option>");
                    });
                });
            }
        });
    }
    function getTokenCredit(Bandeira)
    {
        PagSeguroDirectPayment.createCardToken({
            cardNumber: '4111111111111111',
            brand: Bandeira,
            cvv: $("#Verification").val(),
            expirationMonth: $("#Mes").val(),
            expirationYear: $("#Ano").val(),
            success: function(data){
                $("#NumeroCartao").addClass('.is-valid');
                $("#Verification").addClass('.is-valid');
                $("#Mes").addClass('.is-valid');
                $("#Ano").addClass('.is-valid');
                $("#Token").val(data.card.token);
                if($("#Token").val() !== '')
                {
                    $("#comprar").show();
                }
            }
        });
    }
    $("#Verification").blur(function (){
        getTokenCredit($("Bandeira").val());
    });
    $("#Mes").blur(function (){
        getTokenCredit($("Bandeira").val());
    });
    $("#Ano").blur(function (){
        getTokenCredit($("Bandeira").val());
    });
    $("#NumeroCartao").blur(function (){
        getTokenCredit($("Bandeira").val());
    });
    
    $("#comprar").on('click', function(event){
        event.preventDefault();
        PagSeguroDirectPayment.onSenderHashReady(function(response){
            $("#Hash").val(response.senderHash);
            if($("#Token").val() !== '' && $("#Hash").val() !== '')
            {
                $("#Pagamento").submit();
            }
        });
    });
    
    $("#qntParcelas").on('change',function(){
        var ValueSelected=document.getElementById('qntParcelas');
        $("#ValorParcelas").val(ValueSelected.options[ValueSelected.selectedIndex].label);
    });
    $.getJSON("https://viacep.com.br/ws/"+ <?= $_POST['cep'] ?> +"/json/?callback=?", function(dados) {
        $("#endereco").val(dados.logradouro);
        $("#bairro").val(dados.bairro);
        $("#cidade").val(dados.localidade);
        $("#estado").val(dados.uf);
    });
});
</script>

<div class="container mt-3">
  <h2>Formas de Pagamento</h2>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item active">
      <a class="nav-link" href="#credito">Credito</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#debito">Debito</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#boleto">Boleto</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <div id="credito" style="border: 1px solid #000; border-radius: 10px" class="container tab-pane active"><br>
      <h3>CREDITO</h3>
      <form action="<?= get_site_url().'/comprar' ?>" id="Pagamento" method="POST">
          <div class="form-group col-sm-6">
              <input type="text" id="NumeroCartao" class="form-control" maxlength="16" style="float:left; width: 90%" name="NumeroCartao" placeholder="Numero do cartão" value="" />
              <div id="imageBrand" style="float: right; width: 10%"></div>    
          </div>
          <div class="form-group col-sm-6">
              <select name="qntParcelas" class="form-control" id="qntParcelas">
                  <option value="">Selecione numero de parcelas</option>
              </select>
          </div >
          <div class="form-group col-sm-6">
              <div class="form-group col-sm-2" style="width: 33%; margin-left: -15px">
                <input name="verification" class="form-control" id="Verification" placeholder="Digito verificador"/>
            </div>
            <div class="form-group col-sm-2" style="width: 33.5%; margin-left: -10px">
                <input name="mes" class="form-control" id="Mes" placeholder="Mes de vencimento"/>
            </div>
            <div class="form-group col-sm-2" style="width: 33%; margin-left: -10px">
                <input name="ano" class="form-control" id="Ano" placeholder="Ano de vencimento"/>
            </div>
          </div>
          <input type="hidden" name="tokenCard" id="Token"/>
          <input type="hidden" name="hashCard" id="Hash"/>
          <input type="hidden" name="bandeira" id="Bandeira"/>
          <input type="hidden" name="ValorParcelas" id="ValorParcelas"/>
          <input type="hidden" name="nome" id="nome" value="<?= $_POST['nome'] ?>"/>
          <input type="hidden" name="data" id="data" value="<?= $_POST['data'] ?>"/>
          <input type="hidden" name="cpf" id="cpf" value="<?= $_POST['cpf'] ?>"/>
          <input type="hidden" name="email" id="email" value="<?= $_POST['email'] ?>"/>
          <input type="hidden" name="cep" id="cep" value="<?= $_POST['cep'] ?>"/>
          <input type="hidden" name="endereco" id="endereco" value="<?= $_POST['endereco'] ?>"/>
          <input type="hidden" name="numero" id="numero" value="<?= $_POST['numero'] ?>"/>
          <input type="hidden" name="bairro" id="bairro" value="<?= $_POST['bairro'] ?>"/>
          <input type="hidden" name="estado" id="estado" value="<?= $_POST['estado'] ?>"/>
          <input type="hidden" name="cidade" id="cidade" value="<?= $_POST['cidade'] ?>"/>
          <input type="hidden" name="telefone" id="telefone" value="<?= $_POST['telefone'] ?>"/>
          <input type="hidden" name="celular" id="celular" value="<?= $_POST['celular'] ?>"/>
          <input type="hidden" name="titulo" id="titulo" value="<?= $_POST['titulo'] ?>"/>
          <input type="hidden" name="preco" id="preco" value="<?= $_POST['preco'] ?>"/>
          <input type="hidden" name="post_id" id="post_id" value="<?= $_POST['post_id'] ?>"/>
          <input id="comprar" name="comprando" style="margin-left: 15px" class="btn btn-primary" role="button" value="Comprar"/>
      </form>
      <br>
    </div>
    <div id="debito" style="border: 1px solid #000; border-radius: 10px" class="container tab-pane fade"><br>
      <h3>DEBITO</h3>
      
    </div>
    <div id="boleto" style="border: 1px solid #000; border-radius: 10px"class="container tab-pane fade"><br>
      <h3>BOLETO</h3>
      
    </div>
  </div>
</div>

<?php } else { ?> <h1 style="text-align: center; margin-top: 300px">ESCOLHA UM CURSO PRIMEIRO</h1> <?php } get_footer();