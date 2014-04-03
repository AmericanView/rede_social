<?php
$id = $_POST['id'];
$online = $_POST['online'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("UPDATE usuarios SET online = '".$online."' WHERE id='".$id."'");

mysql_close($conexao);
?>
<?php header('Location: ../?sair=true'); ?>