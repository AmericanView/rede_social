<?php
ob_start();
session_start();

ini_set('display_errors', 'On');

include('classes/DB.class.php');
include('classes/Login.class.php');

include('classes/Amisade.class.php');
include('classes/Recados.class.php');
include('classes/Allbuns.class.php');
include('classes/Notificacoes.class.php');
include('php/funcoes.php');

$objLogin = new Login;

if(!$objLogin->logado()){
	include('login.php');
	exit();
}

if(isset($_GET['sair'])){
	$objLogin->sair();
	header('Location: ./');
    exit;
}

$idExtrangeiro = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['socialbigui_uid'];
$idDaSessao = $_SESSION['socialbigui_uid'];

$_SESSION["username"]=$idDaSessao;

$idExists = DB::getConn()->prepare('SELECT `id` FROM `usuarios` WHERE `id`=?');
$idExists->execute(array($idExtrangeiro));
if($idExists->rowCount()==0){
	$objLogin->sair();
    header('Location: ./');
    exit;
}

$dados = $objLogin->getDados($idExtrangeiro);

if(is_null($dados)){
	header('Location: ./');
	exit();
}else{
	extract($dados,EXTR_PREFIX_ALL,'user'); 
}

function user_img($img){
	return ($img<>'' AND file_exists('uploads/usuarios/'.$img)) ? $img : 'default.png';
}

$user_imagem = user_img($user_imagem);
$user_fullname = $user_nome.' '.$user_sobrenome;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title><?php echo $user_fullname ?></title>
<link rel="stylesheet" media="screen" href="estilos/template.css" type="text/css" />
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
</head>

<body>
<div id="solicit" align="center">
<span id="ocu"><a href="#" onclick="document.getElementById('solicit').style.display='none';"><img width="24" height="24" src="../images/solicitacoes.png" /></a></span>
<br />
	<span>
    <?php
                    $solicitacoes = DB::getConn()->prepare('SELECT * FROM `amisade` WHERE para=? ANd `status`=0');
					$solicitacoes->execute(array($idDaSessao));
					
					$dadosamisade = DB::getConn()->prepare("SELECT `nome`,`sobrenome` FROM `usuarios` WHERE `id`=? LIMIT 1");
					
					if($solicitacoes->rowcount()>0){
						$link = '<a href="php/amisade.php?ac=';
						echo '<ul style="list-style:none;">';
						while($resmeuamigo=$solicitacoes->fetch(PDO::FETCH_ASSOC)){
							
							$dadosamisade->execute(array($resmeuamigo['de']));
							$asdadsoamisade = $dadosamisade->fetch(PDO::FETCH_ASSOC);

$filename = 'uploads/usuarios/id_'.$resmeuamigo['de'].'.jpg';
if (file_exists($filename)) {
     $ima = '<img id="conv1" width="50" height="50" src="../uploads/usuarios/id_'.$resmeuamigo['de'].'.jpg" />';
} else {
     $ima = '<img id="conv2" width="50" height="50" src="../uploads/usuarios/default.png" />';
}

							
							echo '<table id="litsa" width="100%" border="0"><tr><td><br /><li><a href="perfil.php?uid='.$resmeuamigo['de'].'">'.$ima.'</a>&nbsp;&nbsp;<a href="perfil.php?uid='.$resmeuamigo['de'].'"><span id="pedido">'.$asdadsoamisade['nome'].' '.$asdadsoamisade['sobrenome'].'</span></a><br />'.
							$link.'aceitar|'.$resmeuamigo['id'].'"><br /><span style="float:left;">&nbsp;&nbsp;<input type="button" value="aceitar" /></span></a> '.
							$link.'remover|'.$resmeuamigo['de'].'|'.$idDaSessao.'|'.$resmeuamigo['id'].'"><span style="float:left;">&nbsp;&nbsp;<input type="button" value="recusar" /></span></a></li><br /><br /><br /></td></tr></table>';
						}
						echo '</ul>';
					}else{ echo '<br /><br /><br /><br /><span id="fusc">Nenhuma solicitação de amizade.</span><br /><br /><br /><br />';}
                        ?>
    </span>
    <ul>
    <li></li>
    <span id="rufus">

</span>
</ul>
</div><!--solicit-->
<meta HTTP-EQUIV='refresh' CONTENT='180;URL='>
<?php if(isset($_GET['perfil']) AND $_GET['perfil']=='CROP'):
include('php/foto-perfil.php');
endif; ?>

<div id="topo">
	<div class="cAlign">
        <span><?php
$filename = 'uploads/usuarios/id_'.$idDaSessao.'.jpg';
if (file_exists($filename)) {
    echo '<img width="20" height="20" src="../uploads/usuarios/id_'.$idDaSessao.'.jpg" />';
} else {
    echo '<img width="20" height="20" src="../uploads/usuarios/default.png" />';
}
?> &nbsp;&nbsp; <?php echo $_SESSION['socialbigui_usuario'] ?> &nbsp; <div id="pop" align="center">
<a href="#" onclick="document.getElementById('pop').style.display='none';"><span id="fecha">▼</span></a>
<br />
	<span id="jampas">
    Agora coloque oq você quer.
    </span>
    <ul>
    <li><span id="deo"><a href="configuracoes.php?id=<?php echo $idDaSessao ?>">configurações</a></span></li>
    <span id="rufus">
    <?php
$conexao = mysql_connect('localhost','root','');
if (!$conexao)
{
die('Erro ao conectar: ' . mysql_error());
}
mysql_select_db('redesocial', $conexao);
$resultado = mysql_query("SELECT * FROM usuarios WHERE id = '".$user_id."'");
while($linha = mysql_fetch_array($resultado))
{ 
?>
<li><form method="post" action="onlineperfil2.php" >
<input type="hidden" name="id" value="<?php echo $linha['id']; ?>" /> 
<input style="width:50%; background-color:#f8f8f8; display:none;" type="text" name="offline" value="2" />
<input id="te" type="submit" value="Sair" />
</form></li>
<?php
}
?>
</span>
</ul>
</div>

<a href="#" onclick="document.getElementById('pop').style.display='block';">▼</a></span>
<span id="notis"><a href="#" onclick="document.getElementById('solicit').style.display='block';"><img width="25" height="25" src="../images/solicitacoes.png" /></a></span>
    </div><!--calign-->
</div><!--topo-->

<div class="cAlign">
    <div id="header">
    
    	<div class="left">
        	
        </div><!--left-->
        
        <div class="center">
      		<ul>
                <li><a href="./">Início</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="mensagens.php">Mensagens</a></li>
                <li><a href="videos.php">v&iacute;deos</a></li>
                <li><a href="sugestoes.php">Sugestões</a></li>
            </ul> 
        </div><!--left-->
        
        <div class="right">
        <?php if($idDaSessao == 1){ ?>
        <img id="fox" src="images/balao.png" />
        <?php } ?>
        </div><!--left-->
        <?php if($idDaSessao == 1){ ?>
        	<span id="fox1"><?php $sql = "SELECT `id` FROM `usuarios`"; $query = mysql_query($sql); $qtde = mysql_num_rows($query); echo number_format($qtde,0,",","."); ?> usuários cadastrados!</span>
    <?php } ?>
    </div><!--header-->
    
    <div id="content">

		<div class="left">
                
            <div class="blocos" id="foto-perfil">
            	<a href="#"><img src="uploads/usuarios/<?php echo $user_imagem; ?>" alt="<?php echo $user_nome ?>" title="<?php echo $user_nome ?>" /></a>
                <?php if($idDaSessao==$idExtrangeiro): ?>
                <a href="perfil.php?perfil=UPLOAD" id="alterar-foto">alterar foto</a>
                <?php endif; ?>
            </div><!--blocos-->
            
            <?php 
			$list_amigos = Amisade::list_amigos($idExtrangeiro); 
			$albuns = Albuns::listAlbuns($idExtrangeiro);
			?>
            
            <div class="blocos" id="menu-lateral">
            
            	<ul>
                	<li><a href="perfil.php?uid=<?php echo $idExtrangeiro ?>" class="perfil"><?php echo $user_nome ?><span style="float:right;"><?php if($user_online == 1){ echo '<span style="color:#090; font-size:17px;">●</span>';}else{echo '<span style="color:#ccc; font-size:17px;">●</span>';} ?></span></a></li>
                    
                   	<?php $recados = Recados::getRecados($idExtrangeiro); ?>
                    
                	<li><a class="recados">Amigos <span><?php echo $list_amigos['num'] ?></span></a></li>
                    
                    <li><a href="albuns.php?uid=<?php echo $idExtrangeiro ?>" class="fotos">Fotos <span><?php echo Albuns::totalFotos($idExtrangeiro); ?></span></a></li>
                    <li><table width="1" height="5" border="0"><tr><td></td></tr></table><span><img width="58" height="13" src="images/popularidade.png" /></span><table width="1" height="10" border="0"><tr><td></td></tr></table> <span id="nub"><?php echo number_format($user_likes,0,",",".") ?></span></li>
                    <li><span><img width="58" height="13" src="images/baixa.png" /></span> <span id="nub2"><?php echo number_format($user_unlikes,0,",",".") ?></span></a><table width="1" height="10" border="0"><tr><td></td></tr></table></li>
                </ul>
            </div><!--blocos-->
            
        </div><!--left-->
        