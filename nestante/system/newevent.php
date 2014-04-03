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
		if (strlen($_POST['title'])<3 || strlen($_POST['title'])>80)
			$error='O campo título deve conter entre 3 e 80 caracteres';
		else if (!is_numeric($_POST['hour']))
			$error='O campo hora está vazio ou inválido';
		else if ($_POST['hour']<1 || $_POST['hour']>12)
			$error='O campo hora está inválido';
		else if (!is_numeric($_POST['minute']))
			$error='O campo minutos está vazio ou inválido';
		else if ($_POST['hour']<0 || $_POST['minute']>60)
			$error='O campo minutos está inválido';
		else if (strlen($_POST['location1'])<2 || strlen($_POST['location1'])>80)
			$error='O campo local deve ter entre 2 e 100 caracteres';
		else if (strlen($_POST['location2'])>80)
			$error='O campo Cidade/Estado não pode ter mais que 100 caracteres';
		else if (strlen($_POST['description'])>500)
			$error='O campo descrição deve conter menos de 500 caracteres ('. strlen($_POST['description']) .' chars currently)';
		
		
		if (!isset($error))
		{
			mysql_query("INSERT INTO community_events (title, description, location1, location2, parent, creator, date)
									VALUES ('". fixstring($_POST['title']) ."', '". fixstring($_POST['description']) ."', '". fixstring($_POST['location1']) ."', '". fixstring($_POST['location2']) ."', NULL, ". $_SESSION['id'] .",'". date($MYSQL_DATE, strtotime($_POST['year'] ."-". $_POST['month'] . "-" . $_POST['day']  ." ". $_POST['hour'] .":". $_POST['minute'] . ($_POST['ampm']=='0' ? 'am' : 'pm'))) ."')")
					or bug('could not save your event data, please go back a review the input data');
			
			$rs = mysql_query("SELECT id FROM community_events WHERE creator=". $_SESSION['id'] ." ORDER BY id DESC LIMIT 1", $db)
				or bug('hm... event is created, by I cant redirect you there, try doing it yourself');
			$row = mysql_fetch_array($rs);
			
			header("Location: viewevent.php?cm=". $_GET['cm'] ."&id=". $row['id'] ."&msg=Evento Criado!");
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
		show_system_messages();
		if (isset($error))
		{
			draw_small_frame_top(" Erro de validação", "mini_cancel");
				print("<font color=\"#cc0000\"><center>". $error ."</center></font>");
			draw_small_frame_bottom();
		}
		
		draw_frame_top("Evento da Comunidade");
		?>
			<table width="100%">
			<tr>
				<form method="POST" action="?save=1&cm=<?print($_GET['cm']);?>">
				<td>
					<table width="100%">
					<tr>
						
                  <td width="20%" align="right" valign="top"><b>T&iacute;tulo:</b>&nbsp;</td>
						<td width="80%"><input type="text" name="title" value="<?print($_POST['title']);?>" maxlength=80 size=50></td>
					</tr>
					<tr>
						
                  <td width="20%" align="right" valign="top"><b>Data:</b>&nbsp;</td>
						<td width="80%">
							<select name="month">
								<option value="1" <? if ($_POST['month']==1) print('selected'); ?>>janeiro</option>
								<option value="2" <? if ($_POST['month']==2) print('selected'); ?>>fevereiro</option>
								<option value="3" <? if ($_POST['month']==3) print('selected'); ?>>março</option>
								<option value="4" <? if ($_POST['month']==4) print('selected'); ?>>abril</option>
								<option value="5" <? if ($_POST['month']==5) print('selected'); ?>>maio</option>
								<option value="6" <? if ($_POST['month']==6) print('selected'); ?>>junho</option>
								<option value="7" <? if ($_POST['month']==7) print('selected'); ?>>julho</option>
								<option value="8" <? if ($_POST['month']==8) print('selected'); ?>>agosto</option>
								<option value="9" <? if ($_POST['month']==9) print('selected'); ?>>setembro</option>
								<option value="10" <? if ($_POST['month']==10) print('selected'); ?>>outubro</option>
								<option value="11" <? if ($_POST['month']==11) print('selected'); ?>>novembro</option>
								<option value="12" <? if ($_POST['month']==12) print('selected'); ?>>dezembro</option>
							</select>
							<select name="day">
							<?
								for ($i=1;$i<32;$i++)
									echo '<option value="'. $i .'" '. ($_POST['day']==$i ? 'selected' : '') .'>'. $i .'</option>';
							?>
							</select>
							<select name="year">
							<?
								for ($i=2004;$i<2010;$i++)
									echo '<option value="'. $i .'" '. ($_POST['year']==$i ? 'selected' : '') .'>'. $i .'</option>';
							?>
							</select>
						</td>
					</tr>
					<tr>
						
                  <td width="20%" align="right" valign="top"><b>Tempo:</b>&nbsp;</td>
						<td width="80%">
							<input type="text" value="<?print($_POST['hour']);?>" maxlength=2 size=1 name="hour"> : <input type="text" name="minute" maxlength=2 size=1 value="<?print($_POST['minute']);?>">
							<input type="radio" name="ampm" value="0" <? print($_POST['ampm']=='1' ? "" : "checado"); ?>>am <input type="radio" name="ampm" <? print($_POST['ampm']=='1' ? "checado" : ""); ?> value="1">pm
						</td>
					</tr>
					<tr>
						
                  <td width="20%" align="right" valign="top"><b>Local:</b>&nbsp;</td>
						<td width="80%"><input type="text" name="location1" value="<?print($_POST['location1']);?>" maxlength=100 size=40></td>
					</tr>
					<tr>
						
                  <td width="20%" align="right" valign="top">Cidade/Estado:&nbsp;</td>
						<td width="80%"><input type="text" name="location2" value="<?print($_POST['location2']);?>" maxlength=100 size=30></td>
					</tr>
					<tr>
						
                  <td width="20%" align="right" valign="top"><b>Descri&ccedil;&atilde;o:</b>&nbsp;</td>
						<td width="80%"><textarea name="description" rows="5" cols="40"><? print($_POST['description']); ?></textarea></td>
					</tr>
					<tr>
						<td width="20%" align="right" valign="top">&nbsp;</td>
						<td width="80%" height=30>&nbsp;
                    <input type="submit" value="Criar evento"></td>
					</tr>
					</table>
				</td>
				</form>
			</tr>
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