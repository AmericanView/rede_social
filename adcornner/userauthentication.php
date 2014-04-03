<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "redesocial";
$conexao = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($banco) or die(mysql_error());
?>

<html>

<head>
<title>Redirecionando...</title>
<script type="text/javascript">
function loginsuccessfully(){
	setTimeout("window.location='painel.php'", 3000);
}

function loginfailed(){
	setTimeout("window.location='index.php'", 3000);
}
</script>
</head>

<body>
<?php
$login=$_POST['login'];
$senha=$_POST['senha'];
$sql = mysql_query("SELECT * FROM adms WHERE email = '$login' and senha = '$senha'") or die(mysql_error());
$row = mysql_num_rows($sql);
if($row > 0) {
	session_start();
	$_SESSION['login']=$_POST['login'];
	$_SESSION['senha']=$_POST['senha'];
	echo "<center><h2>Login efetuado com sucesso! Aguarde um instante...</h2></center>";
	echo "<script>loginsuccessfully()</script>";
} else {
	echo "<center><h2>Login ou Senha Invalidos! Aguarde um instante para tentar novamente!</h2></center>";
	echo "<script>loginfailed()</script>";
}
?>
</body>

</html>