<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;
	

	/**
	 * Constructor
	 */
	public function __construct(){
		self::$instance =& $this;
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)	{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance(){
		return self::$instance;
	}
	
	
	public static function sec_session_dell() {
	    $_SESSION = array();
		// Pega os parâmetros da sessão 
		$params = session_get_cookie_params();
		// Deleta o cookie atual.
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		// Destrói a sessão
		session_destroy();
	}
	public static function sec_session_start() {
	        $session_name 	= 'sec_session_frame'; // Define um nome padrão de sessão
	        $secure 		= false; // Defina como true (verdadeiro) caso esteja utilizando https.
	        $httponly		= true; // Isto impede que o javascript seja capaz de acessar a id de sessão. 
	 
	        ini_set('session.use_only_cookies', 1); // Força as sessões a apenas utilizarem cookies. 
	        $cookieParams = session_get_cookie_params(); // Recebe os parâmetros atuais dos cookies.
	        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
	        session_name($session_name); // Define o nome da sessão como sendo o acima definido.
	        session_regenerate_id(true); // regenerada a sessão, deleta a outra.
	}
	
	
	
	public static function authLogin() {
		$instance 	= self::get_instance();
		self::sec_session_start();
		if(!$instance->session->userdata('user_id') || !$instance->session->userdata('username') || !$instance->session->userdata('name_site')) {
			return false;
		}
		return true;
	}
	
	
	
	public static function authPermition() {
		$instance 				= self::get_instance();
				
		$class					= $instance->router->class;
		$metodo					= $instance->router->method;
		$permitionSession		= $instance->check_file_permitions->get_permitions();
		if(!isset($permitionSession[$class][$metodo])){
			return false;
		}
		return true;
	}
}




/////Verifica se está logado e redireciona para a página default controler apenas para o login
class CI_Controller_Auth_Login extends CI_Controller{
	public function __construct(){
		parent::__construct(); 
		self::sec_session_start();
		if(self::authLogin()){
			header("location:"._HTTP_BASEPATH_."/backend/default_page_mig");
		}
	}
}


/////Verifica apenas autenticação
class CI_Controller_Auth extends CI_Controller{
	public function __construct(){
		parent::__construct(); 
		self::sec_session_start();
		if(!self::authLogin()){
			header("location:"._HTTP_BASEPATH_."/backend/login_mig?error=Efetue login para continuar&url=".$_SERVER["REQUEST_URI"]);
		}
	}
}
/////Verifica apenas autenticação e retorna um json
class CI_Controller_Auth_JSON extends CI_Controller{
	public function __construct(){
		parent::__construct(); 
		self::sec_session_start();
		if(!self::authLogin()){
			$retval = array("errorCode"=>1000,"errorDesc"=>"Voce deve efetuar o login primeiro para continuar!");
			die(json_encode($retval));
		}
	}
}
/////Verifica autenticaçãoe permissáo e retorna um json
class CI_Controller_Auth_Permition_JSON extends CI_Controller{
	public function __construct(){
		parent::__construct(); 
		self::sec_session_start();
		if(!self::authLogin()){
			$retval = array("errorCode"=>1000,"errorDesc"=>"Voce deve efetuar o login primeiro para continuar!");
			die(json_encode($retval));
		}
		if(!self::authPermition()){
			$retval = array("errorCode"=>1000,"errorDesc"=>"Voce não tem permissão para acessar essa página!");
			die(json_encode($retval));
		}
	}
}





/////Veririfica autenticação e permição
class CI_Controller_Auth_Permition extends CI_Controller{
	public function __construct(){
		parent::__construct(); 
		self::sec_session_start();
		if(!self::authLogin()){
			header("location:"._HTTP_BASEPATH_."/backend/login_mig?error=Efetue login para continuar&url=".$_SERVER["REQUEST_URI"]);
			return;
		}
		if(!self::authPermition()){
			header("location:"._HTTP_BASEPATH_."/backend/error_mig/permition");
		}
	}
}


/////Verifica apenas permição
class CI_Controller_Permition extends CI_Controller{
	public function __construct(){
		parent::__construct(); 
		self::sec_session_start();
		if(!self::authPermition()){
			header("location:"._HTTP_BASEPATH_."/backend/error_mig/permition");
		}
	}
}

// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */