<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff

	draw_top($topic_message);	//starts drawing the page
	
	$rs = mysql_query("SELECT *, users.id as id, countries.name as country_name FROM users left join countries on users.country=countries.id WHERE users.id=" . $_GET['id'] ." order by last_login DESC LIMIT 1", $db)
		or bug("Database error, please try again");
	if (mysql_num_rows($rs)<=0) 
		bug("Id do usuário é inválido");
	$row = mysql_fetch_array($rs);
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="16%">
		<?
			$c_rs = mysql_query("SELECT friend FROM user_friends WHERE user_friends.user=". $_SESSION['id'] ." AND user_friends.friend=" . $_GET['id'] ." LIMIT 1", $db)
				or bug("Database error, please try again");
			
			draw_profile_sidebar($row, /*if user is already friend*/ (mysql_num_rows($c_rs)>0 ? TRUE : FALSE ), /*this is me*/ ($_GET['id']==$_SESSION['id'] ? TRUE : FALSE) );
		?>
	</td>
	<td align="center" valign="top" width="42%">
		<?
		draw_frame_top($row['first_name'] . " " . $row['last_name'] . "  Perfil");
		?>
			<table width="100%" cellpadding=2 cellspacing=0>
			<tr class="tr_item1">
				
          <td width="30%" align="right"><font color="#990000">nome:</font></td>
				<td width="70%"><? print($row['first_name'] . " " . $row['last_name']); ?></td>
			</tr>
			<tr class="tr_item2">
				
          <td align="right"><font color="#990000">g&ecirc;nero:</font></td>
				<td><? print($row['gender']==0 ? "masculino" : "feminino"); ?></td>
			</tr>
			<tr class="tr_item1">
				
          <td align="right"><font color="#990000">Estado de rela&ccedil;&atilde;o:</font></td>
				<td><? 
							if ($row['status']==0)
								print("solteiro(a)");
							if ($row['status']==1)
								print("comprometido(a)");
							if ($row['status']==2)
								print("casado(a)");
							if ($row['status']==3)
								print("aberto(a) a relações");
						?></td>
			</tr>
			<tr class="tr_item2">
				
          <td align="right"><font color="#990000">p</font><font color="#990000">a&iacute;s:</font></td>
				<td><? print($row['country_name']); ?></td>
			</tr>
			<tr  class="tr_item1">
				
          <td align="right"><font color="#990000">&uacute;ltimo login:</font></td>
				<td><? echo date_diff(strtotime($row['current_login']));
							//if ($row['last_login']!="0000-00-00 00:00:00") print($row['last_login']); else print("just entered yogurt!");
						?></td>
			</tr>
			<tr class="tr_item2">
				
          <td align="right" valign="top"><font color="#990000">sobre mim:</font></td>
				<td><b><? print($row['about_me']); ?></b></td>
			</tr>
			</table>
		<?
		draw_frame_bottom();
		?>
	</td>
	<td align="center" valign="top" width="42%">
	<?
		show_system_messages();
		$rs = mysql_query("SELECT *, users.first_name, users.last_name, users.status, users.gender FROM user_friends INNER JOIN users on user_friends.friend=users.id WHERE user=" . $_GET['id'] . " LIMIT 8", $db)
			or bug("Database error, please try again");
		draw_small_friend_list($rs);
		
		$rs = mysql_query("SELECT communities.id as id, communities.name FROM community_users INNER JOIN communities on community_users.community=communities.id WHERE community_users.user=". $_GET['id'] ." order by RAND() LIMIT 8", $db)
			or bug("Database error, please try again");
		draw_small_community_list($rs);
	?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>