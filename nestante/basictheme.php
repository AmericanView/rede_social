<?
	// The page layout
	function draw_image($name, $align="top")
	{
		?>
			<img src="<? print("img/" . $name . ".gif") ?>" align="<?print($align);?>" border=0>
		<?
	}
	
	function draw_top($message_warning="")
	{
	?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title>Yogurt!</title>
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
				
				TD {
					FONT: 10px Verdana, Arial, sans-serif; COLOR: #333333; TEXT-DECORATION: none
				}
				.smalltext {
					FONT: 10px Verdana, Arial, sans-serif; TEXT-DECORATION: none
				}
				.smalltextb {
					FONT: 10px Verdana, Arial, sans-serif; COLOR: #808080; TEXT-DECORATION: none; text-width: bold
				}
				 {
					SCROLLBAR-FACE-COLOR: #dddddd; SCROLLBAR-HIGHLIGHT-COLOR: #ffffff; SCROLLBAR-SHADOW-COLOR: #d1bd62; SCROLLBAR-ARROW-COLOR: #163461; SCROLLBAR-BASE-COLOR: #ffffff; scrollbar-3d-light-color: #163461; scrollbar-dark-shadow-color: #163461
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
				</style>
		</head>
		
		<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
		<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr> 
			<td><table width="750" border="0" cellspacing="1" cellpadding="2">
				<tr> 
				  <td width="590" height="50">&nbsp;&nbsp;<a href="."><img src="img/logo.gif" width="260" height="41" border="0"></a></td>
				  <td width="141" align="right">
				  <!--<img src="img/support.gif">-->
				  </td>
				</tr>
				<tr> 
				  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-top: 1px solid #ffaaaa">
              <tr align="center"> 
                <td width="16%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">O 
                  que &eacute;&nbsp;Yogurt?</a>&nbsp;&nbsp;</b></td>
                <td width="15%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">Termos 
                  de uso</a>&nbsp;&nbsp;</b></td>
                <td width="14%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;&nbsp;<a href="newuser.php" class="top_link" style="color:#bb0000">Cadastre-se!</a></b></td>
                <td width="21%" style="border-left: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">Pol&iacute;tica 
                  de Privacidade</a>&nbsp;&nbsp;</b></td>
                <td width="34%" style="border-left: 1px solid #ffaaaa"><em><font color="#bbbbbb" size="1">Qualquer 
                  semelhan&ccedil;a &eacute; mera coincid&ecirc;ncia :)</font></em></td>
              </tr>
            </table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td background="img/bg.gif"  valign="top">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td height=10 colspan=2>&nbsp;</td></tr>
			  </table>
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
					<td width="95%" style="border-right: 1px solid #ffaaaa">&nbsp;</td>
					
          <td style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="" class="top_link">Ajuda!</a>&nbsp;&nbsp;</b></td>
					
          <td style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="?" class="top_link">Suporte&nbsp;T&eacute;cnico</a>&nbsp;&nbsp;</b></td>
					
          <td style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="http://www.pracurtir.com.br" target="_blank" class="top_link">Pracurtir.com.br</a>&nbsp;&nbsp;</b></td>
					
          <td style="border-right: 1px solid #ffaaaa"><b>&nbsp;&nbsp;<a href="." class="top_link">Sair</a>&nbsp;&nbsp;</b></td>
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
		</html>	<?
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
			draw_small_frame_top($topic, null, 0);
			?><table width="100%" cellspacing=0 cellpadding=1>
		<?
	}
	function draw_menu_bottom()
	{
		?>
			<tr><td height=7></td></tr>
			</table>
		<?
		draw_small_frame_bottom();
	}
	function draw_menu_item_top()
	{
	?>
		<tr> 
			<td>&nbsp;<b>&raquo;</b>
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