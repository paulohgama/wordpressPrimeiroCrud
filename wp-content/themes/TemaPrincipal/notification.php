<?php /* Template name:Notification*/
//header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
define("EMAIL_PAGSEGURO", "santosps1990@gmail.com");
define("TOKEN_PAGSEGURO", "");
define("TOKEN_SANDBOX", "67FF854B56BF4E83B5F7A388012D8B50");
//$codigo = $_POST['notificationCode'];
if(true){
	$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/".$_POST['notificationCode']."?email=".EMAIL_PAGSEGURO."&token=".TOKEN_SANDBOX."";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$transacao= curl_exec($curl);
	if($transaction == 'Unauthorized'){
   		exit;
	}
	curl_close($curl);
	$transaction = simplexml_load_string($transacao);
	$status = $transaction->status;
	global $wpdb;
	switch ($status) {
		case 1:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Aguardando Pagamento'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$stat = 'Aguardando Pagamento';
			break;
		case 2:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Em análise'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$stat = 'Em análise';
			break;
		case 3:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Paga'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$id = $wpdb->get_var('select pk_post from wp_inscritos inner join wp_posts on ID = pk_post where inscrito_cpf = '.$transaction->reference.';');
			$metaValue = $wpdb->get_var("select meta_value from wp_postmeta where meta_key = 'vagasrestantes_id' and post_id = ".$id.";");
			$wpdb->update('wp_postmeta', array('meta_value' => (intval($meta_value)-1) ), array('post_id' => $id , 'meta_key' => 'vagasrestantes_id'));
			$stat = 'Inscrição Confirmada com Sucesso';
			break;
		case 4:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Disponível'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$stat = 'Disponível';
			break;
		case 5:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Em disputa'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$stat = 'Em disputa';
			break;
		case 6:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Devolvida'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$stat = 'Devolvida';
			break;
		case 7:
			$wpdb->update( 
				'wp_inscritos', 
				array( 
					'inscrito_status' => 'Cancelada'
				), 
				array( 'inscrito_cpf' => $transaction->reference )
			);
			$stat = 'Cancelada';
			break;
		default:
		exit;
		break;
	}
				global $wpdb;
				$email = $wpdb->get_var('select inscrito_email from wp_inscritos where inscrito_cpf = '.$transaction->reference.';');
		       	$to = $email;
			    $subject = 'Atualização do status da compra';
			    $body = 'Status da Transação: '.$stat;
			    $headers = array('Content-Type: text/html; charset=UTF-8');
       
      			wp_mail( $to, $subject, $body, $headers );
}	