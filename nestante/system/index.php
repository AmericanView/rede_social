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
			draw_user_sidebar();
		?>
	</td>
	<td align="center" valign="top" width="42%">
		<?
		draw_frame_top($dict['home_Welcome'] ." ". $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "!");
			show_system_messages();
			draw_small_frame_top($dict['home_UserStatus'], "mini_stats", 2);
			if ($_SESSION['last_login'] != "0000-00-00 00:00:00")
				echo $dict['home_YouMadeYourLastLogin'] ." <b>". date_diff(strtotime($_SESSION['last_login'])) ."</b><br><i>". date($USER_DATE, strtotime($_SESSION['last_login'])) ." (". $dict['home_ServerTimeZone'] .")</i>";
			else
				echo $dict['home_ThisIsYourFirstLogin'];
			
			draw_small_frame_bottom();

			$rs = mysql_query("SELECT user_friends.user, user_friends.friend, user_friends.approved, users.id, users.first_name, users.last_name FROM user_friends INNER JOIN users ON user_friends.user=users.id WHERE user_friends.friend=". $_SESSION['id'] . " AND user_friends.approved=0", $db)
				or bug("Database error, please try again");
			
			if (mysql_num_rows($rs)>0)
			{
				draw_small_frame_top($dict['home_NewFriendsHaveAddedYou'], "mini_smile", 1);
				
				echo '<table width="100%" cellpadding=1 cellspacing=0>
						<tr><td class="table_top" width="70%"><b>Usuário</b></td><td class="table_top" width="30%"><b>Ação</b></td></tr>';
				while($row = mysql_fetch_array($rs))
				{
					echo '<tr><td class="table_item"><a href="profile.php?id='. $row['id'] .'">';
					echo $row['first_name'] .' '. $row['last_name'];
					echo '</td><td class="table_item" align="center"><a href="profile.php?id='. $row['id'] .'" alt="ver perfil">';
					draw_image("mini_stats", "ver perfil do usuário");
					echo '</a> <a href="confirm.php?approve='. $row['id'] .'">';
					draw_image("mini_ok", "aceitar como amigo");
					echo '</a> <a href="confirm.php?deny='. $row['id'] .'">';
					draw_image("mini_denial", "não é amigo");
					echo '</a></td></tr>';
				}
				echo '</table>';
			draw_small_frame_bottom();
			}

			draw_small_frame_top($dict['home_RecentForumMessages'], "mini_group", 1);
				
				// here I get the list of communities from the user in order to get the list of recent messages and list the communities later on
				$rs_cm = mysql_query("SELECT communities.id as id, communities.name FROM community_users INNER JOIN communities on community_users.community=communities.id WHERE community_users.user=". $_SESSION['id'] ." order by RAND()", $db)
					or bug("Database error, please try again");
				$sql = "SELECT communities.id as cm_id, communities.name, community_messages.parent, community_messages.id as id,community_messages.title, community_messages.date  from community_messages INNER JOIN communities ON community_messages.community=communities.id WHERE 1=1 and (";
				$sql_events = "";
				while($row = mysql_fetch_array($rs_cm))
				{
					$sql .= " community_messages.community=" . $row['id'] . " OR ";
					$sql_events .= " community_events.community=" . $row['id'] . " OR ";
				}
				$sql .= " 1=2) AND ISNULL(community_messages.parent) ORDER BY community_messages.date DESC LIMIT 8";
				$rs = mysql_query($sql, $db) or bug("Database error, please try again");
				if (mysql_num_rows($rs)>0)
				{
					echo '<table width="100%" cellpadding=1 cellspacing=0>
							<tr><td class="table_top" width="60%"><b>mensagem</b></td><td class="table_top" width="40%"><b>comunidade</b></td></tr>';
					while($row = mysql_fetch_array($rs))
					{
						echo '<tr><td class="table_item"><a href="viewtopic.php?parent='. $row['id'] .'&cm='. $row['cm_id'] .'">';
						echo $row['title'];
						echo '</td><td class="table_item"><a href="community.php?cm='. $row['cm_id'] .'">'. substr($row['name'], 0, 14) . (strlen($row['name'])>14 ? '...' : '') .'</a></td></tr>';
					}
					echo '</table>';
				} else
					echo $dict['home_NoCommunityMessagesOnYourList'] ;
					
			draw_small_frame_bottom();
			
			draw_small_frame_top($dict['home_UpcomingEvents'], "mini_group", 1);
				
				$sql = "SELECT communities.id as cm_id, communities.name, community_events.parent, community_events.id as id,community_events.title, community_events.date  from community_events INNER JOIN communities ON community_events.community=communities.id WHERE 1=1 and (";
				$sql .= $sql_events;
				$sql .= " 1=2) AND ISNULL(community_events.parent) ORDER BY community_events.date DESC LIMIT 5";
				$rs = mysql_query($sql, $db) or bug("Database error, please try again");
				
				if (mysql_num_rows($rs)>0)
				{
					echo '<table width="100%" cellpadding=1 cellspacing=0>
							<tr><td class="table_top" width="60%"><b>Mensagem</b></td><td class="table_top" width="40%"><b>Comunidade</b></td></tr>';
					while($row = mysql_fetch_array($rs))
					{
						echo '<tr><td class="table_item"><a href="viewevent.php?id='. $row['id'] .'&cm='. $row['cm_id'] .'">';
						echo $row['title'];
						echo '</td><td class="table_item"><a href="community.php?cm='. $row['cm_id'] .'">'. substr($row['name'], 0, 14) . (strlen($row['name'])>14 ? '...' : '') .'</a></td></tr>';
					}
					echo '</table>';
				} else
					echo $dict['home_NoUpcomingEventsOnYourList'] ;
			
			draw_small_frame_bottom();

draw_frame_bottom();
		
		?>
	</td>
	<td align="center" valign="top" width="42%">
	<?
		$rs = mysql_query("SELECT user_friends.user, user_friends.friend, users.first_name, users.last_name, users.status, users.gender FROM user_friends INNER JOIN users on user_friends.friend=users.id WHERE user=" . $_SESSION['id'] ." order by last_login DESC LIMIT 8", $db)
			or bug("Database error, please try again");
		draw_small_friend_list($rs);
		
		//using the list up in the forum topics
		if (mysql_num_rows($rs_cm)>0) mysql_data_seek($rs_cm, 0);
		draw_small_community_list($rs_cm);
	?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>