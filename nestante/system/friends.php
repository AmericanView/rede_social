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
		if (is_numeric($_GET['id']))
		{
			$rs = mysql_query("SELECT id, first_name, last_name FROM users WHERE id=" . $_GET['id'] ." order by last_login DESC LIMIT 1", $db)
				or bug("Database error, please try again");
			if (mysql_num_rows($rs)<=0) 
				bug("Id de usuário inválido");
			$row = mysql_fetch_array($rs);
		
			$c_rs = mysql_query("SELECT friend FROM user_friends WHERE user_friends.user=". $_SESSION['id'] ." AND user_friends.friend=" . $_GET['id'] ." LIMIT 1", $db)
				or bug("Database error, please try again");
			
			draw_profile_sidebar($row, /*if user is already friend*/ (mysql_num_rows($c_rs)>0 ? TRUE : FALSE ));
		}
		else
			draw_user_sidebar();
	?>
	</td>
	<td align="center" valign="top" width="84%">
	<?
		show_system_messages();
		$rs = mysql_query("SELECT *, users.id as id, countries.name as user_country, users.first_name, users.last_name, users.status, users.country, users.gender FROM user_friends INNER JOIN users on user_friends.friend=users.id LEFT JOIN countries ON users.country=countries.id WHERE user=" . (is_numeric($_GET['id']) ? $_GET['id'] : $_SESSION['id']) . " order by users.first_name", $db)
			or bug("Database error, please try again");
		?>
		<table width="100%" cellspacing=0 cellpadding=0>
		<tr><td align="center">
		<?
		draw_frame_top("Amigos</b> (" . mysql_num_rows($rs) . ")<b>");

		if(mysql_num_rows($rs)<=0)
			print("Não tenho amigos");
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
							<td width="10%"><a href="profile.php?id=<? print($row['friend']); ?>"><? draw_user_small_picture($row['friend']) ?></a></td>
							<td width="90%" valign="top">
								<a href="profile.php?id=<? print($row['friend']); ?>"><b><? print($row['first_name'] . " " . $row['last_name']); ?></b></a><br>
								<i><? if($row['gender']==0) print("masculino"); else print("feminino"); ?>, 
								<? if($row['status']==0) print("solteiro(a)"); elseif($row['status']==1) print("comprometido(a)"); elseif($row['status']==2) print("casado(a)"); else print("aberto(a) a relação"); ?>
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
			<div align="left"><a href="searchfriends.php"><b><? draw_image("mini_stats"); ?> Procurar Amigos</b></a>
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