<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	
	require("../include/stringtools.php");
	$error=null;
	if (isset($_GET['send']))
	{
		if(!is_numeric($_POST['parent']) && strlen($_POST['title'])<=0 || strlen($_POST['body'])<=0)
			$error = "você deixou campos obrigatórios em branco!";
		else if(strlen($_POST['title'])>200)
			$error = "O assunto não pode conter mais que 200 caracteres";
		else if(strlen($_POST['body'])>600)
			$error = "Não pode haver mais que 600 caracteres<br>It had ". strlen($_POST['body']) ." chars when you sent";
			
		if(!isset($error))
		{
			mysql_query("INSERT INTO community_messages(`community`, `parent`, `title`, `body`, `sender`, `date`)
									VALUES (". $_POST['cm'] .", ". (is_numeric($_POST['parent']) ? $_POST['parent'] : "NULL") .", '". fixstring($_POST['title']) ."', '". fixstring($_POST['body']) ."', ". $_SESSION['id'] .",'". date($MYSQL_DATE) . "')", $db)
				or bug("a mensagem não pode ser enviada");
			
			header('Location: community.php?cm='. $_POST['cm'] .'&msg=Sua mensagem foi acrescentada ao fórum'); 
			bug();
		}
	}
	
	draw_top($topic_message);	//starts drawing the page
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="15%">
	<?
		$rs_member = mysql_query("SELECT moderator, approved FROM community_users WHERE user=". $_SESSION['id'] ." AND community=" . $_GET['cm'], $db);
		if (mysql_num_rows($rs_member)>0)
		{
			$row_member = mysql_fetch_array($rs_member);
			draw_community_sidebar(($row['public']==1 ? true : ($row_member['approved']==1 ? true : false)), (/*$row_member['moderator']==0 ||*/ $row['owner']==$_SESSION['id'] ? true : false));
		}
		else
			draw_community_sidebar();
	?>
	</td>
	<td align="center" valign="top" width="80%">
		<?
		draw_frame_top("Fórum da Comunidade");
		?>
				<table width="100%">
				<form method="post" action="?send=1">
				<input type="HIDDEN" name="referer" value="<? if (isset($_POST['referer'])) print($_POST['referer']); else print($_SERVER['HTTP_REFERER']);?>">
				<input type="HIDDEN" name="cm" value="<? print($_GET['cm']); ?>">
				<input type="HIDDEN" name="parent" value="<? print($_GET['parent']); ?>">
				<tr>
					<td width="15%" valign="top">
						<table width=180 cellspacing=0 cellpadding=0>
						<tr><td>
						<?
							show_system_messages();
							if (isset($error))
							{
								draw_small_frame_top(" Erro de validação", "mini_cancel");
									print("<font color=\"#cc0000\"><center>". $error ."</center></font>");
								draw_small_frame_bottom();
							}
							if(is_numeric($_GET['parent']))
							{
								draw_small_frame_top(" Últimas mensagens do tópico", "mini_group");
									$rs = mysql_query("SELECT users.first_name as name1, users.last_name as name2, community_messages.* FROM community_messages INNER JOIN users ON community_messages.sender=users.id WHERE (community_messages.id=". $_GET['parent'] ." OR parent=". $_GET['parent'] .") and community=". $_GET['cm'] ." ORDER BY DATE DESC LIMIT 3", $db)
										or bug("informações de comunidade erradas ou problemas ao acessar o banco de dados");
									while($row = mysql_fetch_array($rs))
									{
									?>
										"<? print(substr(str_replace("<br>", " ", $row['body']), 0, 100)); if (strlen($row['body'])>100) print("...");?>"<br><font color="#888888">&nbsp;&nbsp;- <? print($row['name1'] ." ". $row['name2']); ?></font>
										<br><br>
									<?
									}
								draw_small_frame_bottom();
							}
						?>
						</td></tr>
						</table>
					</td>
					<td width="85%" valign="top">
					<?
						draw_small_frame_top((isset($_GET['parent']) ? " Responder o tópico" :"Novo Tópico"), "mini_mail");
					?>
						<table width="100%">
						<tr>
							
                  <td width="10%" valign="top" align="right"> 
                    <? if(!is_numeric($_GET['parent'])) print("<b>");?>
                    T&iacute;tulo:</b><br>
							</td>
							<td width="90%">
								<input type="text" name="title" size=45 maxlength=50 value="<? if (isset($error)) print($_POST['title']); else print($title); ?>">
							</td>
						</tr>
						<tr>
							
                  <td width="10%" valign="top" align="right"> <b>Texto:</b><br>
							</td>
							<td width="90%">
								<textarea name="body" rows="10" cols="36"><? if (isset($error)) print($_POST['body']); else print($body); ?></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td align="left">
								<input type="submit" value="Publicar">
                    &nbsp;
								<!--<input type="button" value="Cancel">-->
							</td>
						</tr>
						</table>
					<?
						draw_small_frame_bottom();
					?>
					</td>
				</tr>
				</form>
				</table>
		<?
		draw_frame_bottom();
		?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>