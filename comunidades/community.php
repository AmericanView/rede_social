<?
	//TODO: serious optimizations on the queries!
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	draw_top($topic_message);	//starts drawing the page
	
	$rs = mysql_query("SELECT *, communities.id as id, communities.name as name, community_categories.id as category_id, community_categories.name as category, users.id as owner_id, users.first_name as owner1, users.last_name as owner2 FROM communities RIGHT JOIN community_categories ON communities.category=community_categories.id RIGHT JOIN users ON communities.owner=users.id WHERE communities.id=" . $_GET['cm'], $db)
		or bug("Database error, please try again");
	if (mysql_num_rows($rs)<=0) bug("Id da comunidade é inválido");
	$row = mysql_fetch_array($rs);
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="16%">
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
	<td align="center" valign="top" width="84%">
		<?
		draw_frame_top($row['name']);
			?>
			<table width="100%" cellpadding=0 cellspacing=0>
			<tr>
				<td width="50%" valign="top">
					<?
					draw_small_frame_top(substr($row['name'], 0, 30) ." Informação", "mini_stats", 2);
					?>
					<table width="100%" cellpadding=2 cellspacing=0>
					<tr class="tr_item1">
						
                <td width="30%" valign="top" align="right"><font color="#990000">descri&ccedil;&atilde;o:</font></td>
						<td width="70%" valign="top"><? print($row['description']); ?></td>
					</tr>
					<tr class="tr_item2">
						
                <td width="30%" align="right"><font color="#990000">categoria:</font></td>
						<td width="70%"><? print($row['category']); ?></td>
					</tr>
					<tr class="tr_item1">
						
                <td width="30%" align="right"><font color="#990000">dono:</font></td>
						<td width="70%"><a href="profile.php?id=<?print($row["owner_id"]);?>"><? print($row['owner1'] . " " . $row['owner2']); ?></td>
					</tr>
					<tr class="tr_item2">
						
                <td width="30%" align="right"><font color="#990000">regras:</font></td>
						<td width="70%"><? print(($row['anonymous']=='1' ? "postagem anônima no fórum" : "fórum não anônimo") .", ". ($row['public']=='1' ? "Público" : "Restrito")); ?></td>
					</tr>
					<tr class="tr_item1">
						
                <td width="30%" align="right"><font color="#990000">membros:</font></td>
						<td width="70%"><? print("não implementado :P"); ?></td>
					</tr>
					<tr class="tr_item2">
						
                <td width="30%" align="right"><font color="#990000">criado:</font></td>
						<td width="70%"><? echo date_diff(strtotime($row['creation_date'])); ?></td>
					</tr>
					</table>
					<?
					draw_small_frame_bottom();
					?>
				</td>
				
				<td width="50%" valign="top">
				<?
				show_system_messages();
				draw_small_frame_top("Próximos Eventos", "mini_group", 0);
				
				$rs = mysql_query("SELECT  id, title, date FROM community_events WHERE community=". $_GET['cm'] ." and isnull(parent) ORDER BY date DESC LIMIT 5", $db)
								or bug("Database error, please try again");
				if (mysql_num_rows($rs)<=0)
					print("<b>Sem eventos agendados</b><br>");
				else
				{
				?>
					<table width="100%" cellpadding=1 cellspacing=0>
					<tr>
						
                <td width="70%" style="border-bottom: 1px solid #ffbbbb">&nbsp;<b>T&iacute;tulo</b></td>
						
                <td width="30%" style="border-bottom: 1px solid #ffbbbb"><b>Data</b></td>
					</tr>
					<?
					while($row = mysql_fetch_array($rs))
					{
					?>
						<tr>
							<td style="border-bottom: 1px solid #e9e9e9">&nbsp;<a href="viewevent.php?cm=<?print($_GET['cm']);?>&id=<?print($row['id']);?>"><?print($row['title']);?></a></td>
							<td style="border-bottom: 1px solid #e9e9e9" align="center"><?print(date($USER_DATE, strtotime($row['date'])));?></td>
						</tr>
					<?
					}
					?>
					</table>
				<?
				}
				echo "<div align=\"right\"><a href=\"newevent.php?cm=". $_GET['cm'] ."\">";
				draw_image("mini_news"); echo " <b>Novo Evento</b></a>&nbsp;&nbsp;</div>";
				draw_small_frame_bottom();
				?>
				</td>
				
			</tr>
			</table>
			<?
		draw_frame_bottom();
		?>
	</td>
</tr>
</table>

<table width="98%" cellpadding=1 cellspacing=0>
<tr>
	<td width="65%" valign="top" align="center">
	<?
	draw_small_frame_top($row['name'] ." Forum", "mini_group", 0);
	
	$rs = mysql_query("SELECT  community_messages.id as id, community_messages.title, community_messages.parent, community_messages.sender, community_messages.date, users.first_name as from1, users.last_name as from2 FROM community_messages LEFT JOIN users ON community_messages.sender=users.id WHERE community_messages.community=". $_GET['cm'] ." and isnull(community_messages.parent) ORDER BY date DESC LIMIT 10", $db)
			or bug("Database error, please try again");
	if (mysql_num_rows($rs)<=0)
		print("<b>Esta comunidade não tem nenhum tópico</b><br>");
	else
	{
	?>
		<table width="99%" cellpadding=1 cellspacing=0 align="center">
		<tr>
			
          <td width="35%" class="table_top"><b>T&oacute;pico</b></td>
			
          <td width="25%" class="table_top"><b>Originador</b></td>
			
          <td width="22%" class="table_top"><b>Resposta</b></td>
			
          <td width="18%" class="table_top"><b>Criado</b></td>
		</tr>
		<?
		while($row = mysql_fetch_array($rs))
		{
		?>
			<tr>
				<td class="table_item">&nbsp;<a href="viewtopic.php?cm=<? print($_GET['cm']); ?>&parent=<? print($row['id']); ?>"><?print($row['title']);?></a></td>
				<td class="table_item" align="center"><a href=""><?print($row['from1'] ." ". $row['from2']);?></a></td>
				<td class="table_item" align="center">x</td>
				<td class="table_item" align="center"><? echo date_diff(strtotime($row['date'])); ?></td>
			</tr>
		<?
		}
		?>
		</table>
	<?
	}
	echo "&nbsp;<a href=\"writetopic.php?cm=". $_GET['cm'] ."\">";
	draw_image("mini_newmail"); echo " <b>Novo Tópico</b></a>&nbsp;&nbsp;";
	draw_small_frame_bottom();
	?>
	</td>
	<td width="35%" valign="top" align="center">
	<?
	draw_frame_top("Membros da Comunidade");
	
	$rs = mysql_query("SELECT *, users.id as id, countries.name as user_country, users.first_name, users.last_name, users.status, users.country, users.gender FROM community_users INNER JOIN users on community_users.user=users.id LEFT JOIN countries ON users.country=countries.id WHERE community_users.community=" . $_GET['cm'] . " order by users.last_login LIMIT 6", $db);
	if(mysql_num_rows($rs)<=0)
		print("Esta comunidade não tem membros!");
	?>
		<table width="100%">
		<?
		$count=0;
		while($row = mysql_fetch_array($rs))
		{
		?>
			<? if ($count==0) print("<tr>"); ?>
		<td align="center">
			<a href="profile.php?id=<? print($row['id']); ?>"><? draw_user_small_picture($row['id']) ?><br>
			<? print($row['first_name'] . " " . $row['last_name']); ?></a><br>
		</td>
			<? if ($count==2) print("</tr>"); ?>
		<?
			$count++;
			if ($count>=3) $count=0;
		}
		if ($count!=0) print("</tr>");
		?>
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