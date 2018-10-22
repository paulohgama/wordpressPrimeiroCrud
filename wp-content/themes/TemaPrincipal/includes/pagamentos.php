<?php
/*
Template Name: Dados
*/
?>
<?php
    define("EMAIL_PAGSEGURO", "santosps1990@gmail.com");
    define("TOKEN_PAGSEGURO", "");
    define("TOKEN_SANDBOX", "67FF854B56BF4E83B5F7A388012D8B50");

    $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=".EMAIL_PAGSEGURO."&token=".TOKEN_SANDBOX."";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $retorno = curl_exec($curl);
    curl_close($curl);
    $xml = simplexml_load_string($retorno);
    echo json_encode($xml);