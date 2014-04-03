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
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1 align="center">Escolha a sessão que deseja administrar</h1>
<div id="menu">
		<ul>
			<li><a href="./">Home</a></li>
			<li><a href="/adcornner/reclamacoes/adreclamacoes.php" target="_blank">Reclamações</a></li>
			<li><a href="/adcornner/perguntas/adperguntas.php" target="_blank">Perguntas</a></li>
		</ul>
	</div>

</body>
</html>