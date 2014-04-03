<?php
	
	if(isset($_POST['upload']) AND $_POST['upload']=='capa'){
		$uid = $_POST['uid'];
		$imgantiga = $_POST['imgantiga'];
		
		if($imgantiga<>'default.jpg' AND file_exists('../uploads/capas/'.$imgantiga)){
			unlink('../uploads/capas/'.$imgantiga);
		}
		
		include('funcoes.php');
		
		$imagem = $_FILES['foto-capa'];
		
		$nome = 'id_'.$uid.'.jpg';
		
		$ext = array('image/jpeg','image/pjpeg','image/jpg','image/gif','image/png');	
		
		if(in_array($imagem['type'],$ext)){
			upload($imagem['tmp_name'],$imagem['name'],$nome,700,'../uploads/capas');
			
			include('../classes/DB.class.php');
			$update = DB::getConn()->prepare('UPDATE `usuarios` SET `capa`=? WHERE `id`=?');
			$update->execute(array($nome,$uid));
			
			if(file_exists('../uploads/capas/'.$nome)){
				header('Location: ../perfil.php?perfil=CROP');
				exit();
			}
		}
	}
	
	if(isset($_POST['salvar'])){
		$img = imagecreatefromjpeg('../uploads/capas/'.$_POST['imagem']);
		$largura = 160;
		$altura = ($largura * $_POST['h']) / $_POST['w'];
		
		$nova = imagecreatetruecolor($largura,$altura);
		
		imagecopyresampled($nova,$img,0,0,$_POST['x'],$_POST['y'],$largura,$altura,$_POST['w'],$_POST['h']);
		imagejpeg($nova,'../uploads/capas/'.$_POST['imagem'],80);
		header('Location: ../perfil.php');
	}
	
	header('Location: ../perfil.php');
