<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

///Caminho para a raiz admpc
define("_SECTIONID_","ADMIN_BACKEND");
define("_NAME_SITE_LOCAL_","teste_api");
define("_NAME_EMPRESA_","Teste API");
define("_BASEPATH_",dirname($_SERVER["SCRIPT_FILENAME"]));
define("_DOMAIN_",$_SERVER["SERVER_NAME"]);
define("_LogClient_",_DOMAIN_."-"._SECTIONID_);
define("_PROTOCOL_",(!empty($_SERVER['HTTPS'])?"https://":"http://"));
define("_BASEURL_",_PROTOCOL_._DOMAIN_.":".$_SERVER["SERVER_PORT"]);
$docRoot		= $_SERVER["DOCUMENT_ROOT"];
$docRootSize	= strlen($docRoot);
$scriptFileName	= $_SERVER["SCRIPT_FILENAME"];
$scriptFileName = substr($scriptFileName,$docRootSize);
$absolutHTTP	= dirname($scriptFileName);
$absolutHTTP	= $absolutHTTP;
define("_HTTP_BASEPATH_",_BASEURL_);
define("_HTTP_CSSPATH_",_HTTP_BASEPATH_."/public/css");
define("_HTTP_IMGPATH_",_HTTP_BASEPATH_."/public/img");
define("_HTTP_JSPATH_",_HTTP_BASEPATH_."/public/js");

/* End of file constants.php */
/* Location: ./application/config/constants.php */