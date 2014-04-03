<?
	function draw_user_picture($id)
	{
		$image = "../upload/". $id .".jpg";
		if (file_exists($image))
			echo "<img src=\"". $image ."\" border=0>";
		else
			echo "<img src=\"../upload/0.gif\" border=0>";
	}

	function draw_user_small_picture($id)
	{
		$image = "../upload/". $id ."_m.jpg";
		if (file_exists($image))
			echo "<img src=\"". $image ."\" border=0>";
		else
			echo "<img src=\"../upload/0_m.gif\" border=0>";
	}
	
	function draw_community_picture($id)
	{
		$image = "../upload/c_". $id .".jpg";
		if (file_exists($image))
			echo "<img src=\"". $image ."\" border=0>";
		else
			echo "<img src=\"../upload/0.gif\" border=0>";
	}

	function draw_community_small_picture($id)
	{
		$image = "../upload/c_". $id ."_m.jpg";
		if (file_exists($image))
			echo "<img src=\"". $image ."\" border=0>";
		else
			echo "<img src=\"../upload/0_m.gif\" border=0>";
	}
	
	function draw_user_sidebar()
	{
		?>
		<table width="140" cellpadding="0" cellspacing="0">
		<tr><td align="center">
			<a href="."><? draw_user_picture($_SESSION['id']);
			echo "</a><br>";
			draw_menu_top("Menu do usuário");
				draw_menu_item_top();
					?><a href="profile.php?id=<? print($_SESSION['id']); ?>" class="menu_link">ver meu perfil</a><?
				draw_menu_item_bottom();
				draw_menu_item_top();
					?><a href="writemessage.php" class="menu_link">escrever mensagem</a><?
				draw_menu_item_bottom();
				draw_menu_item_top();
					?><a href="searchfriends.php" class="menu_link">procurar amigos</a><?
				draw_menu_item_bottom();
				draw_menu_item_top();
					?><a href="upload.php" class="menu_link">mudar minha figura</a><?
				draw_menu_item_bottom();
			draw_menu_bottom();
			?>
		</td></tr>
		</table>
		<?
	}

	function draw_profile_sidebar($row, $friend, $this_is_me=false)
	{
		?>
		<table width="140" cellpadding="0" cellspacing="0">
		<tr><td align="center">
			<a href="profile.php?id=<? print($row['id']); ?>"><? draw_user_picture($row['id']);
			echo "</a><br>";
			draw_menu_top($row['first_name'] .' '. $row['last_name']);
				draw_menu_item_top();
				if ($this_is_me)
				{
					?><a href="editprofile.php" class="menu_link">editar meu perfil</a><?
				draw_menu_item_bottom();
				draw_menu_item_top();
					?><a href="upload.php" class="menu_link"><b>mudar minha figura</b></a><?
				}
				else
				{
					?><a href="writemessage.php?id=<? print($row['id']); ?>" class="menu_link">enviar mensagem</a><?
				}
			draw_menu_item_bottom();
				if (!$friend && !$this_is_me)
				{
					draw_menu_item_top();
						?><a href="confirm.php?id=<? print($row['id']); ?>" class="menu_link">adicionar aos amigos</a><?
					draw_menu_item_bottom();
				}
			draw_menu_bottom();
			?>
		</td></tr>
		</table>
		<?
	}
	
	function draw_community_sidebar($member=false, $owner=false)
	{
			echo "<a href=\"community.php?cm=". $_GET['cm'] ."\">";
			draw_community_picture($_GET['cm']);
			echo "</a>";
			draw_frame_top("Menu da Comunidade");
				if (!$owner)
				{
					draw_menu_item_top();
					if (!$member)
					{
						?><a href="confirm.php?cm=<? print($_GET['cm']); ?>" class="menu_link">entrar na comunidade</a><?
					}
					else
					{
							?><a href="confirm.php?cmu=<? print($_GET['cm']); ?>" class="menu_link">sair da comunidade</a><?
					}
					draw_menu_item_bottom();
				}
				draw_menu_item_top();
					?><a href="viewmembers.php?cm=<? print($_GET['cm']); ?>" class="menu_link">ver membros</a><?
				draw_menu_item_bottom();
				draw_menu_item_top();
					?><a href="" class="menu_link">ver eventos</a><?
				draw_menu_item_bottom();
				draw_menu_item_top();
					?><a href="" class="menu_link">forum de mensagens</a><?
				draw_menu_item_bottom();
				if ($owner)
				{
					draw_menu_item_top();
						?><a href="upload.php?cm=<?print($_GET['cm'])?>" class="menu_link">mudar figura</a><?
					draw_menu_item_bottom();
					draw_menu_item_top();
						?><a href="editcommunity.php?cm=<? print($_GET['cm']); ?>" class="menu_link">editar comunidade</a><?
					draw_menu_item_bottom();
				}
			draw_frame_bottom();
	}
	
	function draw_small_friend_list($rs)
	{
		?>
		<table width="96%" cellspacing=0 cellpadding=0>
		<tr><td align="center">
		<?
		draw_frame_top("Amigos</b> (<a href=\"friends.php?id=". $_GET['id'] ."\">ver todos os amigos</a>)<b>");

		if(mysql_num_rows($rs)<=0)
			print("usuário não possui amigos");
		?>
			<table width="100%">
			<?
			$count=0;
			while($row = mysql_fetch_array($rs))
			{
			?>
				<? if ($count==0) print("<tr>"); ?>
				<td align="center" width="25%">
					<a href="profile.php?id=<? print($row['friend']); ?>"><? draw_user_small_picture($row['friend']) ?><br>
					<? print($row['first_name'] . " " . $row['last_name']); ?></a><br>
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
		<?
	}

	function draw_small_community_list($rs)
	{
		?>
		<table width="96%" cellspacing=0 cellpadding=0>
		<tr><td align="center">
		<?
		draw_frame_top("Comunidades</b> (<a href=\"communities.php?id=". $_GET['id'] ."\">ver todas as comunidades</a>)<b>");

		if(mysql_num_rows($rs)<=0)
			print("este usuário não está associado a nenhuma comunidade");
		?>
			<table width="100%">
			<?
			$count=0;
			$listed=0;
			while($row = mysql_fetch_array($rs))
			{
			?>
				<? if ($count==0) print("<tr>"); ?>
				<td align="center" width="33%">
					<a href="community.php?cm=<? print($row['id']); ?>"><? draw_community_small_picture($row['id']) ?><br>
					<? print($row['name'] ); ?></a><br>
				</td>
				<? if ($count==2) print("</tr>"); ?>
			<?
				$count++;
				if ($count>=3) $count=0;
				$listed++;
				if ($listed>=6) break;
			}
			if ($count!=0) print("</tr>");
			?>
			</table>
		<?
		draw_frame_bottom();
		?>
		</td></tr>
		</table>
		<?
	}
	
	function date_diff ($date)
	{
		
		$year = -(date('Y', $date) - date('Y'));
		$month = -(date('m', $date) - date('m'));
		$day = -(date('d', $date) - date('d'));
		$hour = -(date('G', $date) - date('G'));
		$minute = -(date('i', $date) - date('i'));
		
		if (date('Y', $date) <= "2003")
			return 'poucos segundos atrás';
		else if ($year > 0)
			return $year .' ano'. ($year>1 ? 's' : '') .' atrás';
		else if ($month > 0)
			return $month .' mês'. ($month>1 ? 's' : '') .' atrás';
		else if ($day > 0)
			if ($day>1)
				return $day .' dias atrás';
			else
				return 'ontem';
		else if ($hour > 0)
			return $hour .' hora'. ($hour>1 ? 's' : '') .' atrás';
		else if ($minute > 0)
			return $minute .' minuto'. ($minute>1 ? 's' : '') .' atrás';
		else
			return 'poucos segundos atrás';
	}
	
	function get_querystring_char($url)
	{
		if (strpos($url, '?')>0)
			return $url . '&';
		else
			return $url . '?';
	}
	
	function show_system_messages()
	{
		if(isset($_GET['error']))
		{
			draw_msg_frame_top("Erro no sistema", "mini_error", 0);
				print("<center><font color=\"cc0000\"></b>". $_GET['error'] ."</b></font></center>");
			draw_msg_frame_bottom();
			//print("<br>");
		}
		if(isset($_GET['msg']))
		{
			draw_msg_frame_top("Mensagem do sistema", "mini_smile", 0);	
				print("<center>". $_GET['msg'] . "</center>");
			draw_msg_frame_bottom();
			//print("<br>");
		}
	}
?>