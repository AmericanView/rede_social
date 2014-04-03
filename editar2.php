<?php
$id = $_POST['id'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$sobre = $_POST['sobre'];
$telefone = $_POST['telefone'];
$interesse = $_POST['interesse'];
$relacionamento = $_POST['relacionamento'];
$colegio = $_POST['colegio'];
$faculdade = $_POST['faculdade'];
$emailform = $_POST['emailform'];

$conexao = mysql_connect('localhost','root','');
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao);

mysql_query("UPDATE usuarios SET nome='".$nome."', sobrenome = '".$sobrenome."', sobre = '".$sobre."', telefone = '".$telefone."', interesse = '".$interesse."', relacionamento = '".$relacionamento."', colegio = '".$colegio."', faculdade = '".$faculdade."', emailform = '".$emailform."'WHERE id='".$id."'");

mysql_close($conexao);
?>
<?php header('Location: perfil.php'); ?>