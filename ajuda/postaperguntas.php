<?php
$id = $_POST['id'];
$nomecompleto = $_POST['nomecompleto'];
$emaildousuario = $_POST['emaildousuario'];
$sexo = $_POST['sexo'];
$datapergunta = $_POST['datapergunta'];
$emaildecontato = $_POST['emaildecontato'];
$mensagem = $_POST['mensagem'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("INSERT INTO `listperguntas` SET `uid`='".$id."', `nomecompleto`='".$nomecompleto."', `emaildousuario`='".$emaildousuario."', `sexo`='".$sexo."', `datapergunta`='".$datapergunta."', `emaildecontato`='".$emaildecontato."', `mensagem`='".$mensagem."'");

mysql_close($conexao);
?>
<?php header('Location: ./'); ?>