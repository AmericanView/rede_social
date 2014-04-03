<?php
$de = $_POST['de'];
$para = $_POST['para'];
$status = $_POST['status'];
$data = $_POST['data'];
$mensagemp = $_POST['mensagemp'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("INSERT INTO `recados` SET `de`='".$de."', `para`='".$para."', `status`='".$status."', `data`='".$data."', `recado`='".$mensagemp."'");

mysql_close($conexao);
?>
<?php header('Location: ../perfil.php?uid='.$para.''); ?>