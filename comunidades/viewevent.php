<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	require("../include/stringtools.php");
	
	//there has to be a community
	if (!is_numeric($_GET['cm'])) { header('Location: '. get_querystring_char($_SERVER['HTTP_REFERER']) .'error=community ID not set'); bug(); }
	
	// saves event or comment
	$error = null;
	if($_GET['save']=='1')
	{
		if (strlen($_POST['description'])>0)
		{
			mysql_query("INSERT INTO community_events (title, description, location1, location2, parent, creator, community, date)
									VALUES ('". substr(fixstring($_POST['title']), 0, 100) ."', '". substr(fixstring($_POST['description']), 0, 500) ."', '', '', ". $_GET['id'] .", ". $_SESSION['id'] .", ". $_GET['cm'] .",'". date($MYSQL_DATE) ."')", $db)
					or bug('could not save your comment data, please go back a review the input data');
			header("Location: viewevent.php?cm=". $_GET['cm'] ."&id=". $_GET['id'] ."&msg=Seu comentário foi adicionado!");
		}
		else
			header("Location: viewevent.php?cm=". $_GET['cm'] ."&id=". $_GET['id'] ."&error=Texto Inválido!");
		bug();
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
		draw_frame_top("Evento da Comunidade");
		
		if (is_numeric($_GET['id']))
		{
			$rs = mysql_query("SELECT users.id as user_id, users.first_name as first_name, users.last_name as last_name, community_events.id, title, description, date, location1, location2, creator, parent FROM community_events INNER JOIN users ON community_events.creator=users.id WHERE community_events.id=". $_GET['id'] ." or parent=". $_GET['id'] ." order by community_events.id", $db)
				or bug('error when getting the event info');
			$row = mysql_fetch_array($rs);
		?>
			<table width="100%" cellpadding=0 cellspacing=0>
			<tr>
				<td width="55%" valign="top">
					<? draw_small_frame_top($row['title'], "mini_group");	?>
					<table width="100%" cellpadding=2 cellspacing=0>
					<tr class="tr_item1">
						
                <td width="20%" align="right"><font color="#990000">t</font><font color="#990000">&iacute;tulo:</font></td>
						<td width="80%"><b><? print($row['title']); ?></b></td>
					</tr>
					<tr class="tr_item2">
						
                <td align="right"><font color="#990000">data:</font></td>
						<td><?
									print(date($USER_DATE, strtotime($row['date'])));
								?>
						</td>
					</tr>
					<tr class="tr_item1">
						
                <td align="right"><font color="#990000">usu&aacute;rio:</font></td>
						<td><a href="profile.php?id=<? print($row['user_id']); ?>"><? print($row['first_name'] .' '. $row['last_name']); ?></a></td>
					</tr>
					<tr class="tr_item2">
						
                <td align="right"><font color="#990000">localidade:</font></td>
						<td><? print($row['location1'] .'<br>'. $row['location2']); ?></td>
					</tr>
					<tr class="tr_item1">
						
                <td align="right"><font color="#990000">descri&ccedil;&atilde;o:</font></td>
						<td><? print($row['description']); ?></td>
					</tr>
					</table>
					<? draw_small_frame_bottom(); ?>
				</td>
				<td width="45%" valign="top">
				<?
					show_system_messages();
					if (isset($error))
					{
						draw_small_frame_top(" Erro de validação", "mini_cancel");
							print("<font color=\"#cc0000\"><center>". $error ."</center></font>");
						draw_small_frame_bottom();
					}
					draw_small_frame_top("Comentário", "mini_reply");
					?>
						<table width="100%" cellpadding=1 cellspacing=1>
						<form action="?save=1&id=<?print($_GET['id']);?>&cm=<?print($_GET['cm']);?>" method="POST">
						<tr>
							
                  <td width="15%" valign="top" align="right">T&iacute;tulo:&nbsp;</td>
							<td width="85%" valign="top"><input type="text" name="title" maxlength=50 size=30></td>
						</tr>
						<tr>
							
                  <td width="15%" align="right" valign="top"><b>Texto:</b>&nbsp;</td>
							<td width="85%" valign="top"><textarea name="description" rows="1" cols="22"></textarea></td>
						</tr>
						<tr>
							<td width="15%" align="right" valign="top">&nbsp;</td>
							<td width="85%" valign="top">&nbsp;
                    <input type="submit" value="Enviar Coment&aacute;rio"></td>
						</tr>
						</form>
						</table>
					<?
					draw_small_frame_bottom();
				?>
				</td>
			</tr>
			</table>
			&nbsp;
			<? draw_frame_top("Comentários"); ?>
			<table width="100%">
			<?
			while($row = mysql_fetch_array($rs))
			{
			?>
			<tr>
				<td class="table_item">
					<table width="100%" cellpadding=0 cellspacing=0>
					<tr>
						<td width="15%" valign="top">
							<a href="profile.php&id=<?print($row['user_id']);?>"><? draw_user_small_picture($row['user_id']); ?><br><? print($row['first_name'] . ' ' . $row['last_name']); ?></a>
						</td>
						<td width="85%" valign="top">
							<b><? print($row['title']); ?></b> <font color="#999999"> - <i><?  print(date_diff(strtotime($row['date']))); ?> (<? print(date($USER_DATE, strtotime($row['date']))); ?>)</i></font><br>
							<? print($row['description']); ?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<?
			}
			?>
			<tr>
				<td align="center">
					<table width="60%" cellpadding=0 cellspacing=0>
					<tr><td align="center">
					
					
					
					</td></tr>
					</table>
				</td>
			</tr>
			</table>
			<? draw_frame_bottom(); ?>
		<?
		}
		else // create new
		{
			echo("no event id set!");
		}
		draw_frame_bottom();
		?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>