<?php
$id = $_POST['id'];
$responder = $_POST['responder'];
$dataresposta = $_POST['dataresposta'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("UPDATE listperguntas SET responder='".$responder."', dataresposta='".$dataresposta."'WHERE id='".$id."'");

mysql_close($conexao);
?>
<?php header('Location: /adcornner/perguntas/adperguntas.php'); ?>