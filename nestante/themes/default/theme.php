<?
	// The page layout
	function get_theme_path()
	{
		return "../themes/default";
	}
	
	function draw_image($name, $alt='')
	{
		$image = "../img/" . $name . ".gif";
		if (file_exists($image))
			echo "<img src=\"". $image ."\" align=\"absmiddle\" border=0 alt=\"". $alt ."\">";
	}
	
	function draw_top($message_warning="")
	{
	?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title>Yogurt !</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				<STYLE type=text/css>
				A:link {
					COLOR: #cc0000; TEXT-DECORATION: none;
				}
				A:visited {
					COLOR: #cc0000; TEXT-DECORATION: none
				}
				A:hover {
					COLOR: #cc0000; TEXT-DECORATION: underline
				}
				.top_link:link {
					COLOR: #555555; text-weight: bold; TEXT-DECORATION: none
				}
				.top_link:visited {
					COLOR: #555555; text-weight: bold; TEXT-DECORATION: none
				}
				.top_link:hover {
					COLOR: #aa0000; text-weight: bold; TEXT-DECORATION: none
				}
				.message_link:link {
					COLOR: #555555; TEXT-DECORATION: none
				}
				.message_link:visited {
					COLOR: #555555; TEXT-DECORATION: none
				}
				.message_link:hover {
					COLOR: #ff3030; TEXT-DECORATION: none
				}
				.menu_link:link {
					COLOR: #cc0000; text-weight: none; TEXT-DECORATION: none
				}
				.menu_link:visited {
					COLOR: #cc0000; text-weight: none; TEXT-DECORATION: none
				}
				.menu_link:hover {
					COLOR: #550000; text-weight: none; TEXT-DECORATION: underline
				}
				.table_top {
					border-bottom:1px solid #ffbbbb;
				}
				.table_item {
					border-bottom:1px solid #e9e9e9;
				}
				TD {
					FONT: 10px Verdana, Arial, sans-serif; COLOR: #333333; TEXT-DECORATION: none
				}
				.tr_item1 {
					background: #fff5f5;
				}
				.tr_item2 {
				}
				input {
					border: 1px solid #666666; background: #f9f9f9;
				}
				textarea {
					border: 1px solid #666666; background: #f9f9f9;
				}
				select {
					background: #f9f9f9;
				}
				.checkbox {
					border: none;
					background: none;
				}
				</style>
		</head>
		
		<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
		<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr> 
			<td><table width="750" border="0" cellspacing="1" cellpadding="2">
				<tr> 
				  <td width="590" height="50">&nbsp;&nbsp;<img src="../img/logo.gif" width="260" height="41"></td>
				  <td width="141" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="1">
					  <tr align="center">
						<td width="20%"><a href="." class="top_link"><?draw_image("menu_home")?></a></td>
						<td width="20%"><a href="messages.php" class="top_link"><?draw_image("menu_messages");?></a></td>
						<td width="20%"><a href="friends.php" class="top_link"><?draw_image("menu_friends");?></a></td>
						<td width="20%"><a href="communities.php" class="top_link"><?draw_image("menu_communities");?></a></td>
						<td width="20%"><a href="" class="top_link"><?draw_image("menu_diary");?></a></td>
					  </tr>
					  <tr align="center">
						<td width="20%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
						<td width="20%"><a href="" class="top_link"><?draw_image("menu_sandbox");?></a></td>
						<td width="20%"><a href="" class="top_link"><?draw_image("menu_preferences");?></a></td>
						<td width="20%"><a href="../" class="top_link"><?draw_image("menu_logoff");?></a></td>
					  </tr>
					</table> 
				  </td>
				</tr>
				<tr> 
				  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-top: 1px solid #ffaaaa">
					  <tr align="center"> 
						
                <td width="6%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="." class="top_link">Home</a>&nbsp;&nbsp;</b></td>
                <td width="10%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="messages.php" class="top_link">Mensagens</a>&nbsp;&nbsp;</b></td>
						
                <td width="7%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="friends.php" class="top_link">Amigos</a>&nbsp;&nbsp;</b></td>
						
                <td width="12%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="communities.php" class="top_link">Comunidades</a>&nbsp;&nbsp;</b></td>
						
                <td width="24%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;<a href="equipe.php" class="top_link"><SPAN id=pisk>Conhe&ccedil;a 
                  a equipe yogurt</SPAN></font></a>&nbsp;&nbsp;</b></td>
                <td width="41%" style="border-left: 1px solid #ffaaaa"><em><? print($message_warning); ?></em></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td background="../img/bg.gif" height=330 valign="top">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td height=10 colspan=2>&nbsp;</td></tr>
			  </table>
			  
			   <SCRIPT>
function piscar() {
var cor=document.getElementById('pisk').style.color;
if (cor=='black') cor='#FF0000'; 
else cor='black';
document.getElementById('pisk').style.color=cor;
setTimeout('piscar()', 300);
}
piscar();
  </SCRIPT>
			  
	<?
	}
	function draw_bottom()
	{
	?>
				&nbsp;
			</td>
		  </tr>
		  <tr>
			<td height="30" align="center">
			<table  width="100%" border="0" cellspacing="0" cellpadding="2" style="border-bottom: 1px solid #ffaaaa">
				<tr>
					<td width="48%" style="border-right: 1px solid #ffaaaa">&nbsp;</td>
					
          <td width="7%" style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">Ajuda!</a>&nbsp;&nbsp;</b></td>
					
          <td width="15%" style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">Suporte 
            T&eacute;cnico </a>&nbsp;&nbsp;</b></td>
					
          <td width="20%" style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">Pol&iacute;tica 
            de Privacidade</a>&nbsp;&nbsp;</b></td>
					
          <td width="10%" style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="../" class="top_link">Sair</a>&nbsp;&nbsp;</b></td>
				</tr>
			</table>
			</td>
		  </tr>
		  <tr>
			
    <td height="30" align="center"><font color="#aaaaaa" size="2">www.pracurtir.com.br 
      - Onde a Balada Acontece!</font></td>
		  </tr>
		</table>
		</body>
		</html>
	<?
	}
	
	// The big frame (with message)
	function draw_frame_top($title)
	{
	?>
		<table width="98%" border="0" align="center" cellpadding="2" cellspacing="0">
			<tr>
			  <td style="border-bottom: 1px solid #ffaaaa"><b><? print($title) ?></b></td>
			</tr>
			<tr>
			  <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
				  <tr><td align="center">
	<?
	}
	function draw_frame_bottom()
	{
	?>
				  </td>
				  </tr>
				</table></td>
			</tr>
		</table>
	<?
	}
	
	// small frame
	function draw_small_frame_top($text, $image=null, $spacing=2)
	{
	?>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr> 
			<td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td width="1%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td style="border-top: 1px solid #cccccc; border-left: 1px solid #cccccc;">&nbsp;</td>
					  </tr>
					</table></td>
				  <td width="1%"><?
						if (isset($image))
							draw_image($image);
				?></td>
				<td width="9%"><b><font color="#bb6666"><?
						print(str_replace(' ', '&nbsp;', '&nbsp;' . $text));
					?>&nbsp;</font></b></td>
				  <td width="90%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td style="border-top: 1px solid #cccccc; border-right: 1px solid #cccccc;">&nbsp;</td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td style="border: 1px solid #cccccc; border-top: none;"> 
			  <table width="100%" cellpadding=0 cellspacing=<?print($spacing);?>>
				<tr>
				  <td>
	<?
	}
	function draw_small_frame_bottom()
	{
	?>
				</td>
			  </tr>
			  <tr><td height=5></td></tr>
			</table></td>
		</tr>
	  </table>
	<?
	}

	// menu list (false for non menu really)
	function draw_menu_top($topic)
	{
			draw_frame_top($topic, null, 0);
			?><table width="100%" cellspacing=0 cellpadding=1>
		<?
	}
	function draw_menu_bottom()
	{
		?>
			<tr><td height=7></td></tr>
			</table>
		<?
		draw_frame_bottom();
	}
	function draw_menu_item_top()
	{
	?>
		<tr> 
			<td><b>&raquo;</b>
	<?
	}
	function draw_menu_item_bottom()
	{
	?>
			</td>
		</tr>
	<?
	}
	
	function draw_msg_frame_top($text, $icon=null)
	{
		draw_small_frame_top($text, $icon);
	}
		  
	function draw_msg_frame_bottom()
	{
		draw_small_frame_bottom();
	}
?>