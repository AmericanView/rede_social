<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	require("../include/stringtools.php");

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
		draw_frame_top("Tópico do fórum da comunidade");
		
		$rs = mysql_query("SELECT users.first_name as name1, users.last_name as name2, community_messages.* FROM community_messages INNER JOIN users ON community_messages.sender=users.id WHERE (community_messages.id=". $_GET['parent'] ." OR parent=". $_GET['parent'] .") and community=". $_GET['cm'] ." ORDER BY DATE", $db)
			or bug("wrong community information or problems accessing database");
		?>
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
							<a href="profile.php?id=<?print($row['sender']);?>"><? draw_user_small_picture($row['sender']); ?><br><? print($row['name1'] . ' ' . $row['name2']); ?></a>
						</td>
						<td width="85%" valign="top">
							<b><? print($row['title']); ?></b> <font color="#999999"> - <i><?  print(date_diff(strtotime($row['date']))); ?> (<? print(date($USER_DATE, strtotime($row['date']))); ?>)</i></font><br>
							<? print($row['body']); ?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<?
			}
			?>
			<tr>
				
          <td> &nbsp;<a href="writetopic.php?cm=<?print($_GET['cm']);?>&parent=<? print($_GET['parent']); ?>"><b> 
            <?draw_image("mini_reply");?>
            Responda a este t&oacute;pico</b></a></td>
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