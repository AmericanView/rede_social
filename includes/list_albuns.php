<div id="listAlbuns">

<h2><?php echo ($idDaSessao<>$idExtrangeiro) ? ' '.$user_fullname.' tem em seu perfil '.$albuns['num'].' álbuns ' : 'Meu perfil tem '.$albuns['num'].' álbuns '; ?></h2>
    
    <?php if($idDaSessao==$idExtrangeiro){ ?>
    
    <hr />
    
    <?php 
    if(isset($_POST['criaralbum']) AND trim($_POST['tituloalbum'])<>''){
        $album = Albuns::newAlbum($user_id,$_POST['tituloalbum'],$_POST['descricao'],$_POST['permissao']);
        header('Location: albuns.php?uid='.$idDaSessao.'&aid='.$album.'&ac=ADD_FOTOS');
        exit();
    }
    ?>
    
    <form name="novoalbum" method="post" enctype="multipart/form-data" action="" >
        Nome do álbum :<br /><input type="text" name="tituloalbum" /><br />
        Descrição do álbum :<br /><textarea name="descricao" ></textarea>
        
        <br />
        Visibilidade do álbum :<br />
        <input type="radio" name="permissao" checked="checked" value="2" /> amigos
        <input type="radio" name="permissao" value="3" /> publico
        <input type="radio" name="permissao" value="1" /> privado
        <br />
        <input type="submit" name="criaralbum" value="Criar álbum" />
    </form>
    
    <?php } 
    
    if($albuns['num']>0){
        echo '<ul>';
		
		$visivel = Amisade::solicitacao($idDaSessao,$idExtrangeiro);
		
        foreach($albuns['dados'] as $resalbuns):
		
		if($idDaSessao <> $idExtrangeiro){
			$numfotos = Albuns::getAlbum($resalbuns['id']);
			$file = 'uploads/fotos/200/'.$resalbuns['capa'];
			$li = '<li><a href="albuns.php?uid='.$idExtrangeiro.'&aid='.$resalbuns['id'].'"><img src="'.(file_exists($file) ? $file : 'uploads/fotos/default.jpg' ).'" />'.$resalbuns['titulo'].'</a> ('.$numfotos['fotos']['num'].')</li>';			
		}else{
			
				$numfotos = Albuns::getAlbum($resalbuns['id']);
			$file = 'uploads/fotos/200/'.$resalbuns['capa'];
			$li = '<li><a href="albuns.php?uid='.$idExtrangeiro.'&aid='.$resalbuns['id'].'"><img src="'.(file_exists($file) ? $file : 'uploads/fotos/default.jpg' ).'" />'.$resalbuns['titulo'].'</a> ('.$numfotos['fotos']['num'].')<form method="post" action="../php/delalbuns.php"><input type="hidden" name="iddoalbum" value="'.$resalbuns['id'].'" /><input type="submit" value="Excluir" /></li>';
		}
			
			if($resalbuns['permissao']==1 AND $idDaSessao==$idExtrangeiro){
				echo $li;
			}elseif($resalbuns['permissao']==2){
				if($visivel['r']==2 OR $idDaSessao==$idExtrangeiro){
					echo $li;
				}				
			}elseif($resalbuns['permissao']==3){
				echo $li;
			}
		endforeach;
        echo '</ul>';
    }
	?>
	</div><!--listAlbuns-->