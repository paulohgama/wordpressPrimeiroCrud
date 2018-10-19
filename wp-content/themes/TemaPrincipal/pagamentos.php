<?php
/*
Template Name: PagSeguro
*/
get_header();
?>
<?php



?>
<script type="text/javascript">

$(document).ready(function(){
    var Root = "<?= getcwd() ?>\pagamentos.php";

    $("#pagar").click( function(){
        $.ajax({
           url: Root,
           type: 'POST',
           dataType:'json',
           success: function(data)
           {
               PagSeguroDirectPayment.setSessionId(data.id);
           }
        });
    });
});
</script>
<form id="pagseguro" action="https://ws.sandbox.pagseguro.uol.com.br/v2/sessions"
<button id="pagar">Pagar</button>
<?phpget_footer();