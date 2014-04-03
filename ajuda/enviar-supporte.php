<?php
ob_start();
session_start();

ini_set('display_errors', 'On');

include('../classes/DB.class.php');
include('../classes/Login.class.php');

include('../classes/Amisade.class.php');
include('../classes/Recados.class.php');
include('../classes/Allbuns.class.php');
include('../classes/Notificacoes.class.php');
include('../php/funcoes.php');

$objLogin = new Login;

if(!$objLogin->logado()){
	include('../login.php');
	exit();
}

if(isset($_GET['sair'])){
	$objLogin->sair();
	header('Location: ../');
    exit;
}

$idExtrangeiro = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['socialbigui_uid'];
$idDaSessao = $_SESSION['socialbigui_uid'];

$_SESSION["username"]=$idDaSessao;

$idExists = DB::getConn()->prepare('SELECT `id` FROM `usuarios` WHERE `id`=?');
$idExists->execute(array($idExtrangeiro));
if($idExists->rowCount()==0){
	$objLogin->sair();
    header('Location: ../');
    exit;
}

$dados = $objLogin->getDados($idExtrangeiro);

if(is_null($dados)){
	header('Location: ../');
	exit();
}else{
	extract($dados,EXTR_PREFIX_ALL,'user'); 
}

function user_img($img){
	return ($img<>'' AND file_exists('../uploads/usuarios/'.$img)) ? $img : 'default.png';
}

$user_imagem = user_img($user_imagem);
$user_fullname = $user_nome.' '.$user_sobrenome;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $user_fullname ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body id="phpbb">
<div class="conteneur_minwidth_IE">
<div class="conteneur_layout_IE">
<div class="conteneur_container_IE">
<div id="wrap"><a id="top" name="top" accesskey="t">
</a>
<div id="page-header">
<div class="headerbar">
<div class="inner">
<div id="logo-desc">
<a href="index.php" id="logo">
<img src="/images/bigui.png" alt="NandoForum" />
</a>
<div id="site-title">
<h1>Central de ajuda</h1>
</div>
<p>Para dúvidas e reclamações</p>
</div>
<span class="corners-bottom">
<span>
</span>
</span>
</div>
</div>
<div class="navbar">
<div class="inner">
<span class="corners-top">
<span>
</span>
</span>
<ul class="linklist navlinks">
<li>
<a class="mainmenu" href="../" rel="nofollow">
Página inicial
</a>
&nbsp;|
&nbsp;
</li>
<li>
<a class="mainmenu" href="reclamacoes.php" rel="nofollow">
Reclamações
</a>
&nbsp;|
&nbsp;
</li>
<li>
<a class="mainmenu" href="perguntas-frequentes.php" rel="nofollow">
Perguntas frequentes
</a>
&nbsp;|
&nbsp;
</li>
<li>
<a class="mainmenu" href="enviar-supporte.php" rel="nofollow">
Enviar uma pergunta
</a> 
&nbsp;
</ul>
<span class="corners-bottom">
<span>
</span>
</span>
</div>
</div>
</div>
<div id="page-body">
<div id="emptyidcc" class="no-left">
<div id="outer-wrapper">
<div id="wrapper">
<div id="container">
<div id="content">
<div id="emptyidleft">
</div>
<div id="main">
<div id="main-content"><br />
<?php echo 'Olá&nbsp'.$user_fullname.''; echo '&nbsp;você está acessando nosso suporte de ajuda no dia&nbsp;';date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y'); echo '&nbsp;as&nbsp;'; echo date('H:i:s A'); echo '&nbsp;e logo receberá um email com esclarecimentos e mais informações.';
?><br />
<br class="clear" />
<div class="forabg">
<div class="inner">
<span class="corners-top">
<span>
</span>
</span>

<ul class="topiclist">
<li class="header">
<dl class="icon">
<dd class="dterm">
<div class="table-title">
Fazer Pergunta
</div>
</dd>
</dl>
</li>
</ul>
<ul class="topiclist forums">
<li class="row">
<li>
<dl>
<div style='margin-top:4px; margin-bottom:5px; margin-left:10px; '>
<table width="100%" border="0">
<tr>
<td style="font-size:15px;"><br />
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
<form method="post" action="postaperguntas.php">
<input type="hidden" name="id" value="<?php echo $user_id ?>" />
<input type="hidden" name="nomecompleto" value="<?php echo $user_fullname ?>" />
<input type="hidden" name="emaildousuario" value="<?php echo $user_email ?>" />
<input type="hidden" name="sexo" value="<?php echo $user_sexo ?>" /><br />
<input type="hidden" name="datapergunta" value="<?php echo ''.date('d/m/Y').' as '.date('H:i:s').'' ?>" />
<label>Email para contato:</label><br /><input placeholder="Seu e-mail" type="text" name="emaildecontato" /><br /><br />
<label>Faça sua pergunta:</label><br /><textarea placeholder="Digite aqui sua pergunta..." name="mensagem" rows="10" cols="50"></textarea><br /><br />
<input type="submit" value="Enviar" />
</form>
<?php } ?>
<br /><br /></td>
</tr>
</table>
</dl>
</li>
</ul>
<span class="corners-bottom">
</span>
</div>
</div>
</body>
</html>