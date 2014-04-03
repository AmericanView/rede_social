<?php
$id = $_POST['id'];
$nomecompleto = $_POST['nomecompleto'];
$emaildousuario = $_POST['emaildousuario'];
$sexo = $_POST['sexo'];
$datareclamacao = $_POST['datareclamacao'];
$emaildecontato = $_POST['emaildecontato'];
$mensagem = $_POST['mensagem'];


$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("INSERT INTO `listreclamacoes` SET `uid`='".$id."', `nomecompleto`='".$nomecompleto."', `emaildousuario`='".$emaildousuario."', `sexo`='".$sexo."', `datareclamacao`='".$datareclamacao."', `emaildecontato`='".$emaildecontato."', `mensagem`='".$mensagem."'");

mysql_close($conexao);
?>
<?php header('Location: ./'); ?>