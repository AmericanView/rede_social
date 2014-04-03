<?php
$id = $_POST['iddoalbum'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("DELETE FROM albuns WHERE id='".$id."'");

mysql_close($conexao);
?>
<?php header('Location: ../albuns.php'); ?>