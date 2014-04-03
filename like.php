<?php
$id = $_POST['id'];
$like = $_POST['likes'];
$likou = $_POST['likou'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("UPDATE `usuarios` SET likes = likes+1, likou = '".$likou."'WHERE id = '".$id."'");

mysql_close($conexao);
?>
<?php header('Location: index.php'); ?>