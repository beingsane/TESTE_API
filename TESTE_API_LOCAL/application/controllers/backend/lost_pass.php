<?
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';

	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;

	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}

class lost_pass extends CI_Controller_Auth_Login {
	public function index()	{
		$data			= array("errorCode" => "0" ,"errorDesc" => "Aguarde e siga as instruções por email.");
		
		$email 			= $this->input->post('email');
		$conta 			= "^[a-zA-Z0-9\._-]+@";
		$domino 		= "[a-zA-Z0-9\._-]+.";
		$extensao 		= "([a-zA-Z]{2,4})^";
		$pattern 		= $conta.$domino.$extensao;
		if (!preg_match($pattern,$email)){
			$data['errorCode'] = 1;
			$data['errorDesc'] = "O email digitado é inválido.";
			echo json_encode($data);
			return;
		}
		/////Verifica se o email existe na base
		$this->db->select('nomeSysUsuarios, emailSysUsuarios, ,idSysUsuarios, metodoPadraoSysUsuarios');
		$query			= $this->db->get_where('sys_usuarios',array('emailSysUsuarios' => $email));
		$result_user	= $query->result();
		if(!count($result_user)){
			$data	= array("errorCode"=>4,"errorDesc"=>"Verifique o email digitado!");
			echo json_encode($data);
			return;
		}
		
		/////Gera a nova senha para ser enviada por email
		$senha			= geraSenha(6);
		$code_generated	= geraSenha(20);
		/////Tenta inserir o passaporte
		$data_bd['pass_generated'] 	= $senha;
		$data_bd['email_user'] 		= $email;
		$data_bd['code_link'] 		= $code_generated;
		$data_bd['date_cad'] 		= time();
		
		/////Verifica se já existe um passaporte
		$query	= $this->db->get_where('sys_pass_lost',array('email_user' => $email));
		$this->db->select('date_cad');
		$result	= $query->result();
		if(count($result) && $result[0]->date_cad && $result[0]->date_cad+14400 > time()){
			$data['errorCode'] = 2;
			$data['errorDesc'] = "Voce possui um passaporte ativo aguarde as instruções por email.";
			echo json_encode($data);
			return;
		}else if(count($result) && $result[0]->date_cad){
			/////Atualiza o passaporte
			$this->db->update('sys_pass_lost', $data_bd ,array('email_user'=>$email));
			
		}else {
			$this->db->insert('sys_pass_lost', $data_bd);
			if(!$this->db->insert_id()){
				$data['errorCode'] = 2;
				$data['errorDesc'] = "Erro ao cadastrar novo passaporte.";
				echo json_encode($data);
				return;
			}
		}
		
		$link		  = '<a href="'._HTTP_BASEPATH_.'/backend/lost_pass/form_lost/'.$code_generated.'/'.$email.'" />Iniciar recuperação</a>';
		$mensagemHTML = "<h1>Solicição de recuperação de senha</h1>
		<p>Você solicitou uma nova senha, acesse o link abaixo para gerar uma nova senha.</p>
		<p>Após clicar no link será, enviado uma nova senha para este email.</p>
		<p>Se em até quatro horas vc não receber o email com a senha, inicie o processo novamente.</p>
		<p>Link: $link </p>";
		
		$assunto="Recuperar senha";
		/* Enviando a mensagem */
		$this->load->model('backend/send_email/send_email','enviaEmail');
		$data=$this->enviaEmail->envia($email,"","",$assunto,$mensagemHTML,"no-reply@servios-web.net");		
		echo json_encode($data);
	}
	public function form_lost($code = null,$email = null)	{
		if(!$code){
			die("O link que vc está acessando é inválido");
		}
		if(!$email){
			die("O link que vc está acessando é inválido");
		}
		
		/////Verifica os dados do passaporte
		$this->db->select('date_cad, pass_generated, id_pass_lost');
		$query = $this->db->get_where('sys_pass_lost', array('email_user' => urldecode($email), 'code_link'=>$code));
		$result	= $query->result();
		if(count($result)){
			/////Atualiza a senha do usuário
			$errorDesc["error"] = "Senha modificada com sucesso!<br/>Verifique seu email.";
			$errorCode= 1;
			
			if(!$this->db->update('sys_usuarios', array('passwordSysUsuarios' => md5($result[0]->pass_generated)) ,array('emailSysUsuarios'=>urldecode($email)))){
				$errorDesc["error"] = "Erro atualizando senha!";
				$errorCode= 1;
				return true;
			}else{
				$this->systablog->putLog(0,"backend/lost_pass/form_lost","O email[".urldecode($email)."] alterou a senha com sucesso!");
				/////Deleta o passaporte
				$mensagemHTML = "<h1>Alteração de senha</h1>
				<p>Sua senha foi alterada com sucesso.</p>
				<p>Sua nova senha é: <b>".$result[0]->pass_generated."</b></p>";
				
				$assunto="Nova Senha";
				/* Enviando a mensagem */
				$this->load->model('backend/send_email/send_email','enviaEmail');
				$this->enviaEmail->envia(urldecode($email), "", "", $assunto, $mensagemHTML, "no-reply@servios-web.net");
				
				$this->db->where('email_user', urldecode($email));
				if(!$this->db->delete('sys_pass_lost')){
					$this->systablog->putLog(0,"backend/lost_pass/form_lost","O passaporte para o email[".urldecode($email)."] com o ID[".$result[0]->id_pass_lost."]  foi removido com sucesso!");
				}
			}
			
			$this->load->view('backend/login',$errorDesc);
		}
		
	}
}