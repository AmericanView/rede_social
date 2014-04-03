<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */
	require("../include/pre.php");	// all the basic stuff
	require("../include/stringtools.php");
	
	$error=null;
	
	if (isset($_POST['save']))
	{
		if (strlen($_POST['name'])<2)
			$error="O campo nome deve ter pelo menos 2 caracteres";
		else if (strlen($_POST['description'])<4)
			$error="O campo descrição deve ter pelo menos 4 caracteres";
		else if (strlen($_POST['description'])>500)
			$error="O campo descrição não pode conter mais de 500 caracteres (". strlen($_POST['description']) ." chars currently)";
			
		if(isset($error))
		{
			$field_name=$_POST['name'];
			$field_description=$_POST['description'];
			$field_category=$_POST['category'];
			$field_anonymous=$_POST['anonymous'];
			$field_public=$_POST['public'];
		}
		else
		{
			if (is_numeric($_GET['cm']))
			{
				$rs_member = mysql_query("SELECT moderator, approved FROM community_users WHERE moderator=1 AND user=". $_SESSION['id'] ." AND community=" . $_GET['cm'], $db);
				if (mysql_num_rows($rs_member)>0)
				{
				
					mysql_query("UPDATE communities SET name='". fixstring($_POST['name']) ."', description='". fixstring($_POST['description']) ."', anonymous=". ($_POST['anonymous'] == '1' ? "1" : "0") .", public=". ($_POST['public'] == '1' ? "1" : "0") .", category=". $_POST['category'] ." WHERE id=". $_GET['cm'], $db)
						or bug("could not save community data");
					header("Location: community.php?cm=". $_GET['cm'] ."&msg=Dados modificados com sucesso"); 
				}
				else
					header("Location: community.php?cm=". $_GET['cm'] ."&error=Somente os moderadores podem modificar os dados"); 
			}
			else	//it's a new one
			{
				$sql = "INSERT INTO communities(`name`, `description`, `anonymous`, `public`, `category`, `owner`, `creation_date`) 
									VALUES('". fixstring($_POST['name']) ."', '". fixstring($_POST['description']) ."', ". ($_POST['anonymous'] == '1' ? "1" : "0") .", ". ($_POST['public'] == '1' ? "1" : "0") .", ". $_POST['category'] .", ". $_SESSION['id'] .", '". date($MYSQL_DATE) ."')";
				mysql_query($sql, $db) or bug("a comunidade não pôde ser criada");
				
				$rs = mysql_query("SELECT id FROM communities WHERE owner=". $_SESSION['id'] ." ORDER BY id DESC LIMIT 1", $db)
					or bug('hm... Community is created, by I cant redirect you there, try doing it yourself');
				$row = mysql_fetch_array($rs);
				mysql_query("INSERT INTO community_users(community, user, approved, moderator) VALUES (". $row['id'] .", ". $_SESSION['id'] .", 1, 1)", $db)
					or bug('hmm... não foi possível inserí-lo á comunidade');
				if (mysql_num_rows($rs)>0)
					header("Location: community.php?cm=". $row['id'] ."&msg=Parabéns! Sua comunidade foi criada,lembre-se de enviar uma foto e convidar amigos para participar dela!"); 
				else
					header("Location: .?msg=Parabéns! Sua nova comunidade foi criada,não deixe de convidar seus amigos para participar dela"); 
			}
			bug();
		}
	}
	if (is_numeric($_GET['cm']) && !isset($error))
	{
		$rs = mysql_query("SELECT id, name, description, anonymous, public, category FROM communities WHERE id=". $_GET['cm'], $db)
				or bug('Não foi possível carregar dados da comunidade');
		$row = mysql_fetch_array($rs);
		$field_name=unfixstring($row['name']);
		$field_description=unfixstring($row['description']);
		$field_category=$row['category'];
		$field_anonymous=$row['anonymous'];
		$field_public=$row['public'];
	}
	
	draw_top($topic_message);	//starts drawing the page
?>
<table width=100% cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="top" width="65%">
	<?
		draw_small_frame_top("Dados da comunidade", "mini_group");
		?>
		<table width="100%">
		<form action="?cm=<? echo $_GET['cm']; ?>" method="POST">
		<input type="HIDDEN" name="save" value="1">
		<tr>
			<td width="30%" align="right" valign="top"><b>Nome da comunidade:</b>&nbsp;</td>
			<td width="70%"><input type="text" name="name" value="<?print($field_name);?>" maxlength=100 size=30></td>
		</tr>
		<tr>
			<td width="30%" align="right" valign="top"><b>Descri&ccedil;&atilde;o:</b>&nbsp;</td>
			<td width="70%"><textarea name="description" rows="5" cols="30"><?print($field_description);?></textarea></td>
		</tr>
		<tr>
			<td width="30%" align="right" valign="top"><b>Categoria:</b>&nbsp;</td>
			<td width="70%"> <SELECT name=category>
                <OPTION 
                                value=21 selected>Animais de Estimação &amp; Animais</OPTION>
                <OPTION value=3>Artes &amp; Entretenimento</OPTION>
                <OPTION 
                                value=1>Atividades</OPTION>
                <OPTION 
                                value=4>Automóvel</OPTION>
                <OPTION 
                                value=6>Cidades &amp; Bairros</OPTION>
                <OPTION 
                                value=26>Ciência &amp; História</OPTION>
                <OPTION 
                                value=13>Comida, Bebida &amp; Vinho</OPTION>
                <OPTION value=8>Computador &amp; Internet</OPTION>
                <OPTION value=10>Culturas &amp; Comunidade</OPTION>
                <OPTION 
                                value=7>Empresa</OPTION>
                <OPTION value=25>Escolas &amp; Educação</OPTION>
                <OPTION value=22>Esporte &amp; Recreação</OPTION>
                <OPTION value=11>Familia &amp; Casa</OPTION>
                <OPTION value=15>Gay, Lesbica &amp; Bi</OPTION>
                <OPTION value=16>Governo &amp; Político</OPTION>
                <OPTION value=18>Hobbies &amp; Artes</OPTION>
                <OPTION 
                                value=19>Individuals</OPTION>
                <OPTION 
                                value=14>Jogos</OPTION>
                <OPTION value=12>Moda &amp; Beleza</OPTION>
                <OPTION 
                                value=20>Musica</OPTION>
                <OPTION 
                                value=5>Negócios</OPTION>
                <OPTION 
                                value=28>Outros</OPTION>
                <OPTION value=9>Países &amp; Região</OPTION>
                <OPTION value=23>Religião &amp; Doutrinas</OPTION>
                <OPTION value=24>Romance &amp; Relationships</OPTION>
                <OPTION 
                                value=17>Saúde &amp; Fitness</OPTION>
                <OPTION 
                                value=2>Universidades &amp; Escolas</OPTION>
                <OPTION 
                              value=27>Viagem</OPTION>
              </SELECT> </td>
		</tr>
		<tr>
			<td width="30%" align="right" valign="top">&nbsp;</td>
			<td width="70%"><input name="anonymous" <? if ($field_anonymous=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Permitir postagens an&ocirc;nimas</td>
		</tr>
		<tr>
			<td width="30%" align="right" valign="top">&nbsp;</td>
			<td width="70%"><input name="public" <? if ($field_public=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Permitir usu&aacute;rio entrar s/ aprova&ccedil;&atilde;o</td>
		</tr>
		<tr>
			<td align="center" valign="top" colspan=2>
				<br>
					<table width="80%" align="center" bgcolor="#FFFFCC" style="border: 1px solid #bbbbbb">
					<tr>
						
                  <td align="center">Obs: A figura (logo) da comunidade pode ser 
                    mudada depois que a comunidade tiver sido criada.</td>
					</tr>
					</table>
				&nbsp;
			</td>
		</tr>
			<tr>
				<td colspan=2 align="right" style="border-top: 1px solid #cccccc;"><br>
					<input type="Submit" value="Criar comunidade!">
              &nbsp;&nbsp;
				</td>
			</tr>
			</form>
		</table>
		<?
		draw_small_frame_bottom();
	?>
	</td>
	<td align="center" valign="top" width="35%"> 
      <?
		show_system_messages();
		if(isset($error))
		{
			draw_msg_frame_top("Erro de validação", "mini_error", 0);
				print("<center><font color=\"cc0000\"></b>". $error ."</b></font></center>");
			draw_msg_frame_bottom();
			//print("<br>");
		}
		draw_frame_top("Nova Comunidade");
		?>
      <div align="justify">Com uma comunidade criada voc&ecirc; pode interagir 
        com pessoas postando mensagens e achando amigos novos entre os membros. 
        <?
		draw_frame_bottom();
	?>
      </div></td>
</tr>
</table>
<?
	draw_bottom();
?>