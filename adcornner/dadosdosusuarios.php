<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "redesocial";
$conexao = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($banco) or die(mysql_error());
?>
<?php
	session_start();
	if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])) {
		header("Location: index.php");
		exit;
	} else {
		echo "";
	}
	
?>
<?php
	
	$login = $_SESSION['login'];
	$sql = mysql_query("SELECT * FROM adms WHERE email = '$login'");
	while($linha = mysql_fetch_array($sql)){
		$nome = $linha['nome'];
		$sobrenome = $linha['sobrenome'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Área administrativa</title>
</head>

<body style="background-color:#000; color:#f4f4f4;">
<h1 align="center">Exibição de dados dos usuários</h1>
<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "redesocial";
$conexao = mysql_connect($servidor,$usuario,$senha);
mysql_select_db($banco);
$res = mysql_query("SELECT * FROM usuarios");
echo "<table align='center' border='1' style='background-color:#666;;'><tr><td align='center' style='color:#ff6c00;'>ID</td><td align='center' style='color:#ff6c00;'>E-mail</td><td align='center' style='color:#ff6c00;'>Nome Completo</td><td align='center' style='color:#ff6c00;'>Senha Criptografada</td></tr>";
while($escrever=mysql_fetch_array($res)){
echo "<tr><td>".$escrever['id']."</td><td>" . $escrever['email'] . "</td><td>" . $escrever['nome'].' '.$escrever['sobrenome']. "</td><td>" . $escrever['senha'] . "</td></tr>";
}
echo "</table>";
mysql_close($conexao);
?>
</body>
</html>