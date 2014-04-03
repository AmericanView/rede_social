<?php
ob_start();
session_start();

ini_set('display_errors', 'On');

include('../../classes/DB.class.php');
include('../../classes/Login.class.php');

include('../../classes/Amisade.class.php');
include('../../classes/Recados.class.php');
include('../../classes/Allbuns.class.php');
include('../../classes/Notificacoes.class.php');
include('../../php/funcoes.php');

$objLogin = new Login;

if(!$objLogin->logado()){
	include('../../login.php');
	exit();
}

if(isset($_GET['sair'])){
	$objLogin->sair();
	header('Location: ../../');
    exit;
}

$idExtrangeiro = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['socialbigui_uid'];
$idDaSessao = $_SESSION['socialbigui_uid'];

$_SESSION["username"]=$idDaSessao;

$idExists = DB::getConn()->prepare('SELECT `id` FROM `usuarios` WHERE `id`=?');
$idExists->execute(array($idExtrangeiro));
if($idExists->rowCount()==0){
	$objLogin->sair();
    header('Location: ../../');
    exit;
}

$dados = $objLogin->getDados($idExtrangeiro);

if(is_null($dados)){
	header('Location: ../../');
	exit();
}else{
	extract($dados,EXTR_PREFIX_ALL,'user'); 
}

function user_img($img){
	return ($img<>'' AND file_exists('../../uploads/usuarios/'.$img)) ? $img : 'default.png';
}

$user_imagem = user_img($user_imagem);
$user_fullname = $user_nome.' '.$user_sobrenome;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Área administrativa</title>
<style type="text/css">
#lol{
	white-space:pre-wrap;
	word-wrap:break-word;
}
</style>
</head>

<body style="background-color:#000; color:#f4f4f4;">
<div id="lol">
<h1 align="center">Exibição de Perguntass</h1>
<?php
$conexao = mysql_connect('localhost','root','');
if (!$conexao)
{
die('Erro ao conectar: ' . mysql_error());
}
mysql_select_db('redesocial', $conexao);
$resultado = mysql_query("SELECT * FROM `listperguntas`");
while($escrever = mysql_fetch_array($resultado))
{
?>
<?php if(isset($escrever['responder'])){echo '';}else{ ?>
<table align="center" border="1" style="background-color:#666;"><tr><td align="center" style="color:#ff6c00;">ID</td><td align="center" style="color:#ff6c00;">UID</td><td align="center" style="color:#ff6c00;">Nome Completo</td><td align="center" style="color:#ff6c00;">Email do usuário</td>
<td align="center" style="color:#ff6c00;">Sexo</td><td align="center" style="color:#ff6c00;">Email de contato</td><td align="center" style="color:#ff6c00;">Reclamação</td><td align="center" style="color:#ff6c00;">Responder</td></tr>
<tr><td><?php echo $escrever['id'] ?></td><td><?php echo $escrever['uid'] ?></td><td><?php echo $escrever['nomecompleto'] ?></td><td><?php echo $escrever['emaildousuario'] ?></td><td><?php echo $escrever['sexo'] ?></td><td><?php echo $escrever['emaildecontato'] ?></td><td><?php echo $escrever['mensagem'] ?></td><td align="center">
<?php if(isset($escrever['responder'])){echo 'respondido';}else{ ?>
<form method="post" action="responderpergunta.php" ><input type="hidden" name="id" value="<?php echo $escrever['id'] ?>" /><input type="hidden" name="dataresposta" value="<?php echo date('d/m/Y').' as '.date('H:i:s') ?>" /><textarea placeholder="Responda a pergunta..." name="responder" rows="10" cols="50"></textarea><br /><input type="submit" value="Responder" /></form><?php } ?></td></tr>
</table>
<?php } ?>
<?php } ?></div>
</body>
</html>