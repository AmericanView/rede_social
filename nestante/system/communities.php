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
				bug("Id do usuário é inválido");
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
		draw_frame_top("Lista de comunidades");
		show_system_messages();
		if (!is_numeric($_GET['id'])) // the user view
		{
			if (strlen($_GET['keyword'])<=0 && !is_numeric($_GET['cat']))
			{
				draw_small_frame_top("Minhas Comunidades", "mini_group");
				$rs = mysql_query("SELECT communities.id as id, communities.name FROM community_users INNER JOIN communities on community_users.community=communities.id WHERE community_users.user=". $_SESSION['id'] ." LIMIT 50", $db)
					or bug("Database error, please try again");
				?>
				<table width="100%" cellpadding=1 cellspacing=0>
				<tr>
					
          <td style="border-bottom: 1px solid #ffbbbb" width="53%"><b>nome</b></td>
          <td style="border-bottom: 1px solid #ffbbbb" width="26%"><b>&uacute;ltima 
            mensagem</b></td>
          <td style="border-bottom: 1px solid #ffbbbb" width="21%"><b>membro</b></td>
				</tr>
				<?
				if(mysql_num_rows($rs)<=0)
					print("<tr><td colspan=3>Você não é membro de nenhuma comunidade!</td></tr>");
				else
					while($row = mysql_fetch_array($rs))
					{
					?>
					<tr>
						<td style="border-bottom: 1px solid #e9e9e9"><a href="community.php?cm=<? print($row['id']); ?>"><? print($row['name'] ); ?></a></td>
						<td style="border-bottom: 1px solid #e9e9e9">&nbsp;x</td>
						<td style="border-bottom: 1px solid #e9e9e9">&nbsp;x</td>
					</tr>
					<?
					}
				?>
				<tr>
					
          <td colspan=3 align="right"><a href="editcommunity.php"><b> 
            <? draw_image("mini_group"); ?>
            Criar nova comunidade</b></a>&nbsp;&nbsp;</td>
				</tr>
				</table>
				<?
				draw_small_frame_bottom();
			}
			draw_small_frame_top("Procurar Comunidades", "mini_stats");
			?>
				<form action="" method="GET">
					<div align="center"><input name="keyword" type="text" value="<? print($_GET['keyword']); ?>" maxlength=20> &nbsp;
          <input type="submit" value="Busca">
        </div>
				</form>
			<?
				if (strlen($_GET['keyword'])>0 || is_numeric($_GET['cat']))
				{
					$sql = "SELECT id, name, description FROM communities WHERE ";
					if (strlen($_GET['keyword']) > 0) $sql .= " (name LIKE '%". $_GET['keyword'] ."%') ";
					else $sql .= " id = ". $_GET['cat'];
					$sql .= " LIMIT 30";
					$rs = mysql_query($sql, $db)
						or bug("Database error, please try again");
					if(mysql_num_rows($rs)<=0)
						print("A busca não encontrou nenhuma comunidade com a sua descrição");
					else
					{
						echo '<table width="100%" cellspacing=0 cellpadding=2>';
						while($row = mysql_fetch_array($rs))
						{
							echo '<tr><td class="table_item" width="20%" align="center"><a href="community.php?cm='. $row['id'] .'">';
							draw_community_small_picture($row['id']);
							echo '<br>'. $row['name'] .'</a></td>';
							echo '<td class="table_item" width="80%">'. $row['description'] .'</td></tr>';
						}
						echo '</table>';
					}
				}
				else
				{
					$rs = mysql_query("SELECT id, name from community_categories", $db)
						or bug("Database error, please try again");
					
					echo "<table width=\"75%\" align=center><tr><td valign=top align=center>";
					$count=0;
					while($row = mysql_fetch_array($rs))
					{
						echo '<a href="?cat='. $row['id'] .'">' . $row['name'] . '</a> (x)<br>';
						$count++;
						if($count==(mysql_num_rows($rs)/2)) echo "</td><td valign=top align=center>";
					}
					echo "</td></tr></table>";
				}
				
				draw_small_frame_bottom();
		}
		else	//viewing other user
		{
			$rs = mysql_query("SELECT communities.id as id, communities.name, communities.description FROM community_users INNER JOIN communities on community_users.community=communities.id WHERE community_users.user=". $_GET['id'] ." LIMIT 50", $db)
				or bug("Database error, please try again");
			
			if(mysql_num_rows($rs)<=0)
				print("<tr><td colspan=3>&nbsp;Este usuário não é membro de nenhuma comunidade</td></tr>");
			else
			{
				echo "<table width=\"100%\" cellpadding=2 cellspacing=0>";
				while($row = mysql_fetch_array($rs))
				{
					?>
						<tr>
							<td align="center" width="17%" valign="top" style="border-bottom: 1px solid #e9e9e9">
								<a href="community.php?cm=<?print($row['id']);?>"><?draw_community_small_picture($row['id']); echo "<br>" . $row['name'];?></a>
							</td>
							<td width="83%" valign="top" style="border-bottom: 1px solid #e9e9e9">
								<?print($row['description']);?></td>
						</td>
					<?
				}
				echo "</table>";
			}
		}
		draw_frame_bottom();
		?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>