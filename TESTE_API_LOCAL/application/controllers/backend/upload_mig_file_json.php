<?
class Upload_mig_file_json extends CI_Controller_Auth_JSON {
		$upload_path				= _BASEPATH_."/public/img/temp_upload/";
			$data=array("errorCode"=>1 ,"errorDesc"=>"Erro subindo imagem.São permitidos apenas imagens JPG e de 1770px X 1110px ");
			echo json_encode($data);
			return;
		}
		
		/////Remove todos os arquivos da pasta temp_upload
		$diretorio = dir($upload_path);
		while($arquivo = $diretorio -> read()){
			$created 		= filemtime($upload_path.$arquivo);
			$data_current	= time()-10800;
			if($created < $data_current && $arquivo!="." && $arquivo!=".." ){
				unlink ($diretorio->path.$arquivo);
			}
		}
   		$diretorio -> close();