<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	draw_top($topic_message);	//starts drawing the page
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="16%">
		<?
			$rs_member = mysql_query("SELECT moderator, approved FROM community_users WHERE user=". $_SESSION['id'] ." AND community=" . $_GET['cm'], $db);
			if (mysql_num_rows($rs_member)>0)
			{
				$row_member = mysql_fetch_array($rs_member);
				draw_community_sidebar(($row['public']==1 ? true : ($row_member['approved']==1 ? true : false)), ($row_member['moderator']==0 || $row['owner']==$_SESSION['id'] ? true : false));
			}
			else
				draw_community_sidebar();
		?>
	</td>
	<td align="center" valign="top" width="84%">
	<?
		show_system_messages();
		$rs = mysql_query("SELECT *, users.id as id, countries.name as user_country, users.first_name, users.last_name, users.status, users.country, users.gender FROM community_users INNER JOIN users on community_users.user=users.id LEFT JOIN countries ON users.country=countries.id WHERE community_users.community=" . $_GET['cm'] . " order by users.last_login", $db)
			or bug("Database error, please try again");
		?>
		<table width="100%" cellspacing=0 cellpadding=0>
		<tr><td align="center">
		<?
		draw_frame_top("Membros da Comunidade</b> (" . mysql_num_rows($rs) . ")<b>");

		if(mysql_num_rows($rs)<=0)
			print("esta comunidade não tem nenhum sócio");
		?>
			<table width="100%">
					<?
					$count=0;
					while($row = mysql_fetch_array($rs))
					{
					?>
						<? if ($count==0) print("<tr>"); ?>
				<td>
					<table cellspacing=0 cellpadding=3 width="100%">
							<td width="10%"><a href="profile.php?id=<? print($row['id']); ?>"><? draw_user_small_picture($row['id']) ?></a></td>
							<td width="90%" valign="top">
								<a href="profile.php?id=<? print($row['id']); ?>"><b><? print($row['first_name'] . " " . $row['last_name']); ?></b></a><br>
								<i><? if($row['gender']==0) print("masculino"); else print("feminino"); ?>, 
								<? if($row['status']==0) print("solteiro(a)"); elseif($row['status']==1) print("comprometido(a)"); elseif($row['status']==2) print("casado(a)"); else print("aberto(a) a relações"); ?>
								<br><? print($row['user_country']) ?></i>
							</td>
					</table>
				</td>
						<? if ($count==3) print("</tr>"); ?>
					<?
						$count++;
						if ($count>=4) $count=0;
					}
					if ($count!=0) print("</tr>");
					?>
			</table>
		<?
		draw_frame_bottom();
		?>
		</td></tr>
		</table>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>