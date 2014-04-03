<?php
$id = $_POST['id'];
$unlike = $_POST['unlikes'];
$likou = $_POST['likou'];

$conexao2 = mysql_connect('localhost','root','');
if (!$conexao2) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao2);

mysql_query("UPDATE `usuarios` SET unlikes = unlikes+1, likou = '".$likou."'WHERE id = '".$id."'");

mysql_close($conexao2);
?>
<?php header('Location: index.php'); ?>