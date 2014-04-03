<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<link rel="stylesheet" media="screen" href="css/login.css" type="text/css" />
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<div align="center">

	<table border="0" cellpadding="0" cellspacing="0" width="1000" bgcolor="#f4f4f4">
		<tr>
			<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="center" bgcolor="#f8f8f8">
					<img border="0" src="images/logogrande.png" width="1000" height="306"></td>
				</tr>
				<tr>
					<td align="center">
					<table border="0" cellpadding="0" cellspacing="0" width="1000" background="#f4f4f4">
						<tr>
							<td width="387" valign="top">
							&nbsp;<div align="center">
								<table border="1" bordercolor="#ff6c00" style="border-collapse: collapse" cellpadding="2" width="90%">
									
									<tr>
										<td><div class="boxLogin2">
        		<h5>Você não tem uma conta?</h5>
            	<h4><a href="cadastro.php">Cadastre-se</a></h4>
    		</div></td>
									</tr>
									<tr>
										<td><font face="Verdana" size="2">O conteúdo do 
                    site <font color="#fc3019"><b>L</b></font>uxus <i>girl</i> é 
                    destinado exclusivamente a pessoas maiores de 18 anos. </font>
                    					</td>
									</tr>
									<tr>
										<td><b><font face="Verdana" color="#ffffff" size="2"><a onClick="window.open('normas_condicoes.asp','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=500'); return false;" href="#"><font color="#fc3019">
                    Clique aqui</font></a>
								</font>
										</b><font face="Verdana" size="2">&nbsp;para 
                    tomar conhecimento dos termos e condições  para visitar o 
                    nosso site. Se você for maior de idade, leu e aceitou as 
                    condições de uso, <b>SEJA BEM VINDO</b>.</font></td>
									</tr>
									<tr>
										<td><b>
                    <font face="Verdana" size="1">A <font color="#fc3019"><b>L</b></font>uxus <i>girl</i> 
                    respeita o estatuto da criança e do adolescente. Denuncie a exploração sexual de menores.</font></b></td>
									</tr>
								</table>
							</div>
&nbsp;</td>
							<td valign="top" width="392">
							<div align="right">
								<table border="1" bordercolor="#ff6c00" style="border-collapse: collapse" cellpadding="2" width="80%" bgcolor="#f4f4f4">

<br />
<tr>
<td><b>
<font face="Verdana" size="2" color="#333"><br />
<span><?php if(isset($_POST['logar'])){
					
					$lembrar = isset($_POST['lembrar']) ? $_POST['lembrar'] : '';
					
					if($objLogin->logar($_POST['email'],$_POST['senha'],$lembrar)){
						header('Location: perfil.php');
						exit;
					}else{
						echo $objLogin->erro;
					}
				}?></span>
<form name="login" method="post" enctype="multipart/form-data" action="">
            		<span style="margin-left:2%;">E-mail:</span>
                	<input id="t" type="text" name="email" /><br /><br />
                	<span style="margin-left:2%;">Senha:</span>
                	<input id="t" type="password" name="senha" /><br /><br />
                	<span style="margin-left:2%;"></span>
                	<input type="checkbox" name="lembrar" />
                	Mantenha-me conectado<span></span><br /><br />
                	<span style="float:right;"><input type="submit" name="logar" value="Entrar" /></span>
            	</form></font></b></td>
</tr>
				
								</table>
							</div>
							</td>
						</tr>
					  </table>
					</td>

				</tr>
			</table>
			</td>
		</tr>
	</table>
</div>
<div align="center">
	<table border="0" cellpadding="0" cellspacing="0" width="1000"><br />
		<tr>
			<td height="45" background="">
			<p align="right"><font face="Verdana" size="1"><font color="fc3019"><b>L</b></font>uxus <i>girl</i> - 
			Todos os Direitos Reservados® - 2014</font></td>
	  </tr>
	</table>
</div>
</body>

</html>
