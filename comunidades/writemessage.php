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
		if(strlen($_POST['subject'])<=0 || strlen($_POST['body'])<=0)
			$error = "Você deixou campos de preenchimento obrigatório em branco";
		else if(strlen($_POST['subject'])>200)
			$error = "O assunto não pode conter mais que 200 caracteres";
		else if(strlen($_POST['body'])>600)
			$error = "Não pode haver mais que 600 caracteres<br>It had ". strlen($_POST['body']) ." chars when you sent";
			
		if(!isset($error))
		{
			$rs = mysql_query("SELECT *, users.first_name, users.last_name FROM user_friends INNER JOIN users on user_friends.friend=users.id WHERE user=" . $_SESSION['id'] . " order by users.first_name LIMIT 100", $db)
				or bug("Database error, please try again");
			$sent_to_someone=false;
			$sent_to_id=false;
			while($row = mysql_fetch_array($rs))
				if($_POST["id_" . $row['id']] == '1')
				{
					$sent_to_someone=true;
					if($row['id']==$_GET['id']) $sent_to_id=true;
					mysql_query("INSERT INTO messages(subject, body, sender, dest, date, seen)
											VALUES ('" . fixstring($_POST['subject']) . "', '" . fixstring($_POST['body']) . "', " . $_SESSION['id'] . ", " . $row['id'] . ", '" . date($MYSQL_DATE) . "', 0)", $db)
						or bug("a mensagem não pôde ser enviada");
				}
			//sends to a non-friend
			if($_POST["id_" . $_GET['id']] == '1' && $sent_to_id==FALSE)
			{
					$sent_to_someone=true;
					mysql_query("INSERT INTO messages(subject, body, sender, dest, date, seen)
											VALUES ('" . fixstring($_POST['subject']) . "', '" . fixstring($_POST['body']) . "', " . $_SESSION['id'] . ", " . $_GET['id'] . ", '" . date($MYSQL_DATE) . "', 0)", $db)
						or bug("a mensagem não pode ser enviada");
			}
			if ($sent_to_someone==true)
			{
				if (isset($_POST['referer']))
					header('Location: ' . get_querystring_char($_POST['referer']) .'msg=Sua mensagem foi enviada com sucesso!'); 
				else
					header('Location: ../modules/messages.php?msg=Sua mensagem foi enviada com sucesso!'); 
				bug();
			}
			else
				$error = "A mensagem foi enviada!";
		}
	}

	draw_top($topic_message);	//starts drawing the page
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="15%">
	<?
		if (is_numeric($_GET['id']))
		{
			$rs = mysql_query("SELECT id, first_name, last_name FROM users WHERE id=" . $_GET['id'] ." order by last_login DESC LIMIT 1", $db)
				or bug("Database error, please try again");
			if (mysql_num_rows($rs)<=0) 
				bug("invalid user id");
			$row_id = mysql_fetch_array($rs);
		
			$c_rs = mysql_query("SELECT friend FROM user_friends WHERE user_friends.user=". $_SESSION['id'] ." AND user_friends.friend=" . $_GET['id'] ." LIMIT 1", $db)
				or bug("Database error, please try again");
			
			draw_profile_sidebar($row_id, /*if user is already friend*/ (mysql_num_rows($c_rs)>0 ? TRUE : FALSE ));
		}
		else
			draw_user_sidebar();
				
		if (isset($_GET['original']))
		{
			$rs = mysql_query("SELECT * FROM messages WHERE id=" . $_GET['original'], $db)
							or bug("Database error, please try again");
			$row = mysql_fetch_array($rs);
			$subject = $row['subject'];
			$body = "\n\n\n---\n>" . str_replace("\n", "\n>", unfixstring($row['body']));
		}
	?>
	</td>
	<td align="center" valign="top" width="80%">
		<?
		draw_frame_top("Nova Mensagem");
		?>
				<table width="100%">
				<form method="post" action="?send=1&id=<?print($_GET['id'])?>">
				<input type="HIDDEN" name="referer" value="<? if (strlen($_POST['referer'])>6) print($_POST['referer']); else print($_SERVER['HTTP_REFERER']);?>">
				<input type="HIDDEN" name="id" value="<? print($_GET['id']); ?>">
				<tr>
					<td width="10%" valign="top">
						<table width=140 cellspacing=0 cellpadding=0>
						<tr><td>
						<?
							show_system_messages();
							if (isset($error))
							{
								draw_small_frame_top(" Erro de validação", "mini_cancel");
									print("<font color=\"#cc0000\"><center>". $error ."</center></font>");
								draw_small_frame_bottom();
							}
							draw_small_frame_top("Envie", "mini_newmail");
							
								$rs = mysql_query("SELECT *, users.first_name, users.last_name FROM user_friends INNER JOIN users on user_friends.friend=users.id WHERE user=" . $_SESSION['id'] . " order by users.first_name LIMIT 100", $db)
									or bug("Database error, please try again");
								if(mysql_num_rows($rs)<=0)
									print("você não tem nenhum amigo!");
							?>
							<table cellspacing=0 cellpadding=0>
							<?
								if (isset($row_id))
								{
										print("<tr><td><input type=\"checkbox\" checked class=\"checkbox\" name=\"id_" . $row_id['id'] . "\" value=\"1\"></td><td><b>");
										print($row_id['first_name'] . " " . $row_id['last_name']);
										print("</b></td></tr>");
								}
								while($row = mysql_fetch_array($rs))
								{
									if($_GET['id']!=$row['id'])
									{
										print("<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"id_" . $row['id'] . "\" value=\"1\"></td><td>");
										print($row['first_name'] . " " . $row['last_name']);
										print("</td></tr>");
									}
								}
							?>
							</table>
							<?
							draw_small_frame_bottom();
						?>
						</td></tr>
						</table>
					</td>
					<td width="90%" valign="top">
					<?
						draw_small_frame_top("Mensagem", "mini_mail");
					?>
						<table>
						<tr>
							
                  <td width="10%" valign="top" align="right"> Assunto:<br>
							</td>
							<td width="90%">
								<input type="text" name="subject" size=45 maxlength=199 value="<? if (isset($error)) print($_POST['subject']); else if (isset($subject)) print('RE: '. $subject); ?>">
							</td>
						</tr>
						<tr>
							
                  <td width="10%" valign="top" align="right"> Texto:<br>
							</td>
							<td width="90%">
								<textarea name="body" rows="10" cols="40"><? if (isset($error)) print($_POST['body']); else print($body); ?></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td align="left">
								<input type="submit" value="Enviar Mensagem">
                    &nbsp;
								<input type="button" value="Cancelar">
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