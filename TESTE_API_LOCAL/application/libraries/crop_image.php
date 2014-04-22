<?php
include('m2brimagem.class.php' );
class Crop_image
	{
		function crop($imageX,$imageY,$imageX2,$imageY2,$imageWidth,$imageHeigth,$imageName,$pathImage,$larguraFinal,$alturaFinal) {
			$oImg = new m2brimagem($imageName);
			if( $oImg->valida() != 'OK' ){
				return false;
			}
	
			$imagem_nome = md5(uniqid(time())).".".end(explode(".", $imageName));
			$oImg->posicaoCrop( $imageX, $imageY );
			$oImg->redimensiona($imageWidth, $imageHeigth, 'crop' );
			$oImg->redimensiona($larguraFinal, $alturaFinal);
			$oImg->grava($pathImage.$imagem_nome);
			/////Remove a imagem temporaria
			unlink($imageName);
			return $imagem_nome;
		}
		
		function redimenciona($imageName,$largura,$altura){
			$oImg = new m2brimagem($imageName);
			if( $oImg->valida() != 'OK' ){
				return false;
			}
			$oImg->redimensiona($largura, $altura);
			$oImg->grava($imageName);
			
		}
		
	}

