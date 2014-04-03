<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	function delete_file($name)
	{
		if (file_exists($name))
		   unlink($name);
	}
	
	if ($_GET['send']=='1')
	{
		session_start();
	
		$filename = "../upload/" . uniqid("").tmp;
		
		$ext = strrchr($HTTP_POST_FILES["file"]["name"], '.');
		move_uploaded_file($HTTP_POST_FILES["file"]["tmp_name"], $filename);
		
		/*if ($ext=='.gif')
		{
			passthru("gif2png -O -d ../upload/". $filename);
			$filename = $filename . ".png";
			$img = @imagecreatefrompng($filename);
		}
		else*/ if($ext=='.jpg' && filesize($filename)<300832)
			$img = @imagecreatefromjpeg($filename);
		else
		{
		   delete_file($filename);
		   header('Location: upload.php?cm='. $_GET['cm'] .'&error=Somente fotos no formato .jpg com menos 300kb são aceitas&refresh='. uniqid(""));
		   die();
		}

		if (strlen($_GET['cm'])>0)
		{
			delete_file('c_'. $_GET['cm'].'.jpg');
			delete_file('c_'. $_GET['cm'].'_m.jpg');
		}
		else
		{
			delete_file($_SESSION['id'].'.jpg');
			delete_file($_SESSION['id'].'_m.jpg');
		}
		
		$size = getimagesize($filename);
		$width= $size[0];
		$height= $size[1];
		
		if ($width>128)
		{
			$percentage = 128 / $width;
			$width *= $percentage;
			$height *= $percentage;
			
			$img_r = imagecreatetruecolor ($width, $height);
			imagecopyresampled($img_r, $img, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
		}
		else
		{
			$img_r = $img;
		}
		
		if ($width>64)
		{
			$percentage = 64 / $width;
			$width *= $percentage;
			$height *= $percentage;
		}
		$img_sm = imagecreatetruecolor($width, $height);
		imagecopyresampled($img_sm, $img, 0, 0, 0, 0, $width, $height, $size[0],  $size[1]);
		
		if (strlen($_GET['cm'])>0)
		{
			ImageJpeg($img_r, "../upload/c_". $_GET['cm'] . ".jpg", 100);
			ImageJpeg($img_sm, "../upload/c_". $_GET['cm'] . "_m.jpg", 100);
		}
		else
		{
			ImageJpeg($img_r, "../upload/". $_SESSION['id'] . ".jpg", 100);
			ImageJpeg($img_sm, "../upload/". $_SESSION['id'] . "_m.jpg", 100);
		}
		
		delete_file($filename);
		
	   header('Location: upload.php?cm='. $_GET['cm'] .'&refresh='. uniqid(""));
	   die();
	}
	
	require("../include/pre.php");	// all the basic stuff
	require("../include/stringtools.php");
	
	draw_top($topic_message);	//starts drawing the page
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="100%">
		<?
		draw_frame_top("Upload da imagem");
		?>
				<table width="100%">
				<form method="post" action="upload.php?send=1<? if (strlen($_GET['cm'])>0) echo ('&cm='. $_GET['cm']) ?>"  enctype="multipart/form-data">
				<tr>
					<td width="15%" valign="top">
						<table width=180 cellspacing=0 cellpadding=0>
						<tr><td align="center">
						<?
						show_system_messages();
						
						if (strlen($_GET['cm'])>0)
							draw_community_picture($_GET['cm']);
						 else
							draw_user_picture($_SESSION['id']);
						
						echo "<br><br>";
						
						if (strlen($_GET['cm'])>0)
							draw_community_small_picture($_GET['cm']);
						 else
							draw_user_small_picture($_SESSION['id']);
						?>
						</td></tr>
						</table>
					</td>
					<td width="85%" valign="top">
					<?
						draw_small_frame_top((strlen($_GET['cm'])>0 ? "Foto da Comunidade" :"Foto do Usuário"), "mini_smile");
					?>
						<table width="100%">
						<tr>
							
                  <td width="10%" valign="top" align="right"> <b>Arquivo:</b><br>
							</td>
							<td width="90%">
								<input type="file" name="file" size=30>
							</td>
						</tr>
						<tr>
							<td></td>
							<td align="left">
								<input type="submit" value="Enviar Figura">
                    &nbsp;
							</td>
						</tr>
						</table>
						<br>
						<table width="80%" align="center" bgcolor="#FFFFCC" style="border: 1px solid #bbbbbb">
						<tr>
							
                  <td align="center"><strong>Importante</strong>: Somente arquivos 
                    .jpg menores que 300kb ser&atilde;o permitidos. Caso apresente 
                    erro no upload tente usar <strong>CTRL + F5</strong> </td>
						</tr>
						</table>
					<?
						draw_small_frame_bottom();
					?>
					</td>
				</tr>
				</form>
				</table>
		<?
		draw_frame_bottom();
		?>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>