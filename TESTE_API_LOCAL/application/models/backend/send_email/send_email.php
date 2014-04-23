<?
class Send_email extends CI_Model {
	function envia($emailDestino,$copia,$copiaOculta,$assunto,$mensagem,$emailRemetente=""){
			//Defina aqui um e-mail válido e do domínio

			$email = 'webmaster@servicos-web.net';
			//Retira www do endereço
			$www = "www.";
			$tem = stripos($_SERVER['HTTP_HOST'], $www);
			if ($tem === false) {
					$dominiocliente = $_SERVER['HTTP_HOST'];
			} else {
					$dominiocliente = substr($_SERVER['HTTP_HOST'], 4, 50);
			}
			$dominios = '/(tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$)/';
			if (preg_match($dominios, $dominiocliente)) {
			        //Se o endereço for um dos acima utiliza como from o e-mail definido na variável email
					$emailsender=$email;
			} else {
					//Se o endereço for diferente monta o email do campo from com nomedaconta@endereconaurl
					$conta = preg_split('/@/', $email);
			        // Defina na linha abaixo em 'webmaster' a conta de seu e-mail sem '@domínio'
					$emailsender=$conta[0].'@'.$dominiocliente;		
				    // Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
			        // você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
			}
			/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
			if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
			elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
			else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
			// Passando os dados obtidos pelo formulário para as variáveis abaixo
			$emailremetente    = $emailRemetente==""? "no-reply@teste.com.br" :trim($emailRemetente);
			$emaildestinatario = trim($emailDestino);
			$comcopia          = trim($copia);
			$comcopiaoculta    = trim($copiaOculta);
			$assunto           = $assunto;
			$mensagem          = $mensagem;
			 

			/* Montando o cabeçalho da mensagem */
			$headers = "MIME-Version: 1.1".$quebra_linha;
			$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
			// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
			$headers .= "From: ".$emailsender.$quebra_linha;
			$headers .= "Return-Path: " . $emailsender . $quebra_linha;
			// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
			// Se não houver um valor, o item não deverá ser especificado.
			if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
			if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
			$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
			// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
			/* Enviando a mensagem */
			if(mail($emailDestino, $assunto, $mensagem, $headers, "-r". $emailsender)){
				$data=array("error"=>0,"message"=>"E mail enviado com sucesso!");
			}else{
				$data=array("errorCode"=>1,"errorDesc"=>"Erro ao enviar a mensagem para o email [{$emaildestinatario}] ");
			}
			 return $data;
			
	}
}