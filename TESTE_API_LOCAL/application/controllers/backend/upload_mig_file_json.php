<?
class Upload_mig_file_json extends CI_Controller_Auth_JSON {	public function index(){		$data						= array("errorCode"=>0 ,"errorDesc"=>"success","data"=>_HTTP_IMGPATH_."/anunciosTemp/imageAnuncio1.jpg");
		$upload_path				= _BASEPATH_."/public/img/temp_upload/";		$config['upload_path'] 		= $upload_path;				$config['allowed_types'] 	= 'jpg|png|x-png|x-jpg';		$config['max_width'] 		= '1770';		$config['max_height'] 		= '1110';		$config['encrypt_name'] 	= true;		$this->load->library('upload', $config);		if (!$this->upload->do_upload('arquivo')){
			$data=array("errorCode"=>1 ,"errorDesc"=>"Erro subindo imagem.São permitidos apenas imagens JPG e de 1770px X 1110px ");
			echo json_encode($data);
			return;
		}		$imgUp = $this->upload->data();		$data=array("errorCode"=>0 ,"errorDesc"=>"success","data"=>_HTTP_BASEPATH_."/public/img/temp_upload/{$imgUp["file_name"]}","dataName"=>$imgUp["file_name"]);		echo json_encode($data);
		
		/////Remove todos os arquivos da pasta temp_upload
		$diretorio = dir($upload_path);
		while($arquivo = $diretorio -> read()){
			$created 		= filemtime($upload_path.$arquivo);
			$data_current	= time()-10800;
			if($created < $data_current && $arquivo!="." && $arquivo!=".." ){
				unlink ($diretorio->path.$arquivo);
			}
		}
   		$diretorio -> close();	}}