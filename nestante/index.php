<?php
	session_start();
	$_SESSION['id'] = null;
	$_SESSION['username'] = null;
	$_SESSION['first_name'] = null;
	$_SESSION['last_name'] = null;

	include("basictheme.php");
//	include("include/system.php");
?>
				<table width="100%" height="305">
				<tr>
					
    <td width="68%" align="center" valign="top"> 
      
      <div align="justify"><font style="font-size:11px">&nbsp; </font><FONT size="2" face="Verdana, Arial, Helvetica, sans-serif" style="FONT-SIZE: 11px"><strong> 
        Yogurt</strong> &eacute; um portal que lhe permite procurar e fazer novos 
        amigos, &eacute; um sistema parecido com o conhecid&iacute;ssimo <a href="http://www.orkut.com" target="_blank"><strong>ORKUT</strong></a>,sendo 
        que &eacute; otimizado e totalmente em portugu&ecirc;s. <br>
        Ainda estamos em fase de implementação, alguns links não estar&atilde;o 
        dispon&iacute;veis no momento. Se voc&ecirc; tiver dicas,d&uacute;vidas,ou 
        quiser relatar erros que possam estar ocorrendo no<strong> Yogurt</strong>,favor 
        enviar e-mail para <A 
                        href="mailto:yogurt@pracurtir.com.br">yogurt@pracurtir.com.br</A>.</FONT> 
        <br>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Esperamos 
        que voc&ecirc; goste e possa aproveitar ao m&aacute;ximo.Fa&ccedil;a amigos,crie 
        comunidades e curta bastante! </font> 
        <?php
						
						echo "<br><table width=\"70%\" align=\"center\"><tr><td>";
						("Yogurt people");
						echo "<img src=\"img/people.jpg\">";
						
						echo "</td></tr></table>";
					?>
      </div></td>
					<td width="33%" align="center" valign="bottom">
					<?php
						if(isset($_GET['error']))
						{
							draw_msg_frame_top("Erro de validação", "mini_error", 0);
								print("<center><font color=\"cc0000\"></b>". $_GET['error'] ."</b></font></center>");
							draw_msg_frame_bottom();
							//print("<br>");
						}
						if(isset($_GET['msg']))
						{
							draw_msg_frame_top("Mensagem do sistema", "mini_smile", 0);
								print("<center>". $_GET['msg'] . "</center>");
							draw_msg_frame_bottom();
							//print("<br>");
						}
						
						("Login do Usuário");
						?>
						<table width="100%">
						<form action="system/login.php" method="POST">
						<input type="HIDDEN" name="referer" value="<?print($_GET['referer']);?>">
						<tr>
							
            <td width="35%" align="right"><b>login:&nbsp;</b></td>
							<td width="65%"><input type="text" name="username" size="16" maxlength="20"></td>
						</tr>
						<tr>
							
            <td width="35%" align="right"><b>senha:&nbsp;</b></td>
							<td width="65%"><input type="password" name="password" size="12" maxlength="20"></td>
						</tr>
						<tr>
							<td width="35%" align="right">&nbsp;</td>
							<td width="65%"><input type="submit" value="Entrar!"></td>
						</tr>
						</form>
						</table>
						
					</td>
				</tr>
				</table>
