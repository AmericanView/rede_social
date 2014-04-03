<?
	// The page layout
	function get_theme_path()
	{
		return "../themes/minimal";
	}
	
	function draw_image($name, $align="top")
	{
		$image = "../img/" . $name . ".gif";
		if (file_exists($image))
			echo "<img src=\"". $image ."\" align=\"". $align ."\" border=0>";
	}
	
	function draw_top($message_warning="")
	{
	?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title>Yogurt Community!</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		</head>
		
		<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
		<b>YOGURT!</b>
		<hr>
			<b>&nbsp;&nbsp;<a href=".">Home</a>
			<a href="messages.php">Messages</a>
			<a href="friends.php">Friends</a>
			<a href="communities.php">Communities</a>
			<a href="">Diary</a>
			<a href="">Sandbox</a>
			<a href="">Preferences</a></b>&nbsp;&nbsp;
			<em><? print($message_warning); ?></em>
		<hr>
	<?
	}
	function draw_bottom()
	{
	?>
				<hr>
			<center>
				<font color="#aaaaaa">
					Yogurt build 002 beta
				</font>
			</center>
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
			  <td><b><? print($title) ?></b></td>
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
		<table width="98%" border="0" align="center" cellpadding="2" cellspacing="0">
			<tr>
			  <td><i><? print(str_replace(' ', '&nbsp;', '&nbsp;' . $text)); ?></i></td>
			</tr>
			<tr>
			  <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
				  <tr><td align="center">
	<?
	}
	function draw_small_frame_bottom()
	{
	?>
				  </td>
				  </tr>
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