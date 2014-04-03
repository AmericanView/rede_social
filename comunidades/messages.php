<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	if (isset($_GET['current']))
	{
		mysql_query("UPDATE messages set seen=1 where id=". $_GET['current'], $db)
			or bug("Database error, please try again");
	}
	else if (isset($_GET['delete']))
	{
		if ($_GET['delete']=='x')
		{
			$rs = mysql_query("SELECT id FROM messages WHERE dest=" . $_SESSION['id'] . " LIMIT 50", $db)
				or bug("Database error, please try again");
			while($row = mysql_fetch_array($rs))
			{
				if($_POST["m" . $row['id']] == '1')
					mysql_query("DELETE FROM messages WHERE id=". $row['id'] . " and dest=". $_SESSION['id'], $db)
						or bug("Não pôde apagar mensagem");
			}
		}
		else
				mysql_query("DELETE FROM messages WHERE id=". $_GET['delete'] . " and dest=". $_SESSION['id'], $db)
					or bug("Não pôde apagar mensagem");
		header('Location: messages.php?msg=Mensagem(s) Removida(s) com sucesso'); 
		bug();
	}

	function highlight_text($query=null, $text)
	{
		if (strlen($query)>0)
		{
			$xtemp = $text;
			$queries= split(" ", $query);
			for ($j=0;$j<count($queries);$j++)
				if(strlen($queries[$j])>1)
					$xtemp = str_replace($queries[$j], "<font style=\"background: #ffff00\"><b>". $queries[$j] ."</b></font>", $xtemp);
			return $xtemp;
		}
		else
			return $text;
	}
	
	function is_inside($query=null, $text)
	{
		if (strlen($query)>0)
		{
			$queries= split(' ', $query);
			for ($j=0;$j<count($queries);$j++)
				if(strlen($queries[$j])>3)
					if (strpos(strtoupper($text), strtoupper($queries[$j]))>0)
						return TRUE;
		}
		return FALSE;
	}
	
	$search='';
	if (isset($_POST['search'])) $search=$_POST['search'];
	
	draw_top($topic_message); // start drawing the page
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="16%">
		<? draw_user_sidebar(); ?>
	</td>
	<td align="center" valign="top" width="82%">
		<?
		//draw_frame_top("My messages");
			show_system_messages();
			draw_frame_top($_SESSION['first_name'] ." caixa de entrada", "mini_mail", 0);
			
			$rs = mysql_query("SELECT messages.id as message_id, messages.subject, messages.body, messages.sender, messages.dest, messages.date, messages.system, messages.seen, users.id as from_id, users.first_name, users.last_name FROM messages INNER JOIN users ON messages.sender=users.id where dest=". $_SESSION['id'] ." order by message_id LIMIT 50", $db)
							or bug("Database error, please try again");
			if (mysql_num_rows($rs)<=0) print("<b>Você não tem mensagens</b>");
			else if (mysql_num_rows($rs)>=48) print("<center><b>Obs: São exibidas só 50 mensagens, você tem que remover mensagens mais velhas para visualizar as mais novas!</b></center>");
			?><form method="post" name="formmessages" action="messages.php?delete=x">
			<table width="100%" cellpadding=0 cellspacing=0><tr><td>
				<table width="100%" cellpadding=0 cellspacing=0>
				<?
				while($row = mysql_fetch_array($rs))
				{
				?>
				<tr bgcolor="<? if($_GET['current']==$row['message_id'] || is_inside($search, $row['body'])) print("#fff5f5"); ?>">
					<td class="table_item" width=3% align="center"><input type="checkbox" name="m<? print($row['message_id']); ?>" value="1"></td>
					<td class="table_item" width=4% align="center">
					<? if ($_GET['current']!=$row['message_id']) { ?><a href="?current=<?print($row['message_id']);?>" class="message_link"><? } ?> <? if ($row['seen']==0) {  draw_image("mini_newmail"); } else { draw_image("mini_mail"); } ?></a></td>
					<td style="border-bottom: 1px solid #e0e0e0;" width=50%>
					<? if ($_GET['current']!=$row['message_id']) { ?><a href="?current=<?print($row['message_id']);?>" class="message_link"><? if ($row['seen']==0) { ?><b><? } ?><? } ?><? print(highlight_text($search, $row['subject'])); ?><? if ($_GET['current']!=$row['message_id']) { ?><? if ($row['seen']==0) { ?></b><? } ?></a><? } ?>
					</td>
					<td class="table_item" width=18% align="center">
						<a href="profile.php?id=<?print($row['from_id']);?>" class="message_link"><? if ($row['seen']==0) { ?><b><? } ?><? print($row['first_name'] . " " . $row['last_name']); ?><? if ($row['seen']==0) { ?></b><? } ?></a>
					</td>
					<td class="table_item" width=20% align="center"><? if ($row['seen']==0) { ?><b><? } print(date_diff(strtotime($row['date']))); if ($row['seen']==0) { ?></b><? } ?></td>
				</tr>
					<?
					if ($_GET['current']==$row['message_id'] || is_inside($search, $row['body']))
					{
					?>
					<tr>
						<td width=100%  colspan=5 align="center" cellspacing=1 cellpadding=1 bgcolor="#fff5f5">
						  <table width="100%" cellspacing=0 cellpadding=3><tr><td>
							<table width="93%" cellspacing=0 cellpadding=2 style="border: 1px solid #d9d9d9;" align="center">
							<tr>
								<td bgcolor="#f6f6f6" style="border-bottom: 1px solid #d9d9d9">
									<b>Assunto:</b> <? print(highlight_text($search, $row['subject'])); ?> &nbsp;(<a href="profile.php?id=<?print($row['from_id']);?>"><? print($row['first_name'] . " " . $row['last_name']); ?></a>)<br>
									<b>Data:</b> <? print(date("M d Y - h:i a", strtotime($row['date']))); ?>
								</td>
							</tr>
							<tr>
								
                          <td bgcolor="#f6f6f6" style="border-bottom: 1px solid #d9d9d9"> 
                            <a href="writemessage.php?id=<?print($row['from_id']);?>&original=<?print($row['message_id']);?>"> 
                            <? draw_image("mini_reply", "middle"); ?>
                            Resposta</a> &nbsp;&nbsp; <a href="?delete=<?print($row['message_id']);?>"> 
                            <? draw_image("mini_trash", "middle"); ?>
                            Remover</a> </td>
							</tr>
							<tr>
								<td bgcolor="#ffffff">
									<table><tr><td style="font-face: Verdana, Helvetica; font-size:11px">
										<? print(highlight_text($search, $row['body'])); ?>
									</td></tr></table>
								</td>
							</tr>
							</table>
						  </td></tr></table>
						</td>
					</tr>
					<?
					}
				}
				?>
				<tr>
					
              <td colspan=5> &nbsp; 
                <? if (mysql_num_rows($rs)>0) { ?>
                <a href="#" onclick="document.formmessages.submit();"> 
                <? draw_image("mini_trash", "middle"); ?>
                Remover selecionadas</a> &nbsp;&nbsp; 
                <? } ?>
                <a href="writemessage.php"><b> 
                <? draw_image("mini_mail", "middle"); ?>
                Mensagem nova</b></a> </td>
				</tr></form>
				</table>
			</td></tr></table>
			<?
			draw_frame_bottom();
			echo "<table width=\"80%\"><tr><td>";
			draw_small_frame_top("Procure palavras nas mensagens", "mini_stats");
			?>
				<form action="messages.php?search=x" method="POST">
				<center>
						<input type="text" name="search" maxLength=50 size=30 value="<? print($_POST['search']); ?>"> 
    <input type="submit" value="Buscar">
				</center>
				</form>
			<?
			draw_small_frame_bottom();
			echo "</td></tr></table>";
		//draw_frame_bottom();
		?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>