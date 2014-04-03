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
	<td align="center" valign="top" width="20%">
	<?
		draw_small_frame_top("Opções de pesquisa", "mini_stats");
		?>
		<table width="100%">
			<form action="searchfriends.php?search=1" method="POST">
			<tr>
            <td style="border-bottom: 1px solid #e0e0e0"> Sexo:<br>
			</td></tr>
			<tr><td align="center">
				<input name="s_male" type="checkbox" <? if ($_GET['search']!='1' || $_POST['s_male']=='1') print("checked") ?> value="1" class="checkbox">
              Mas. 
              <input name="s_female" type="checkbox" <? if ($_GET['search']!='1' || $_POST['s_female']=='1') print("checked") ?> value="1" class="checkbox">
              Fem.</td>
          </tr>
			
			<tr>
            <td style="border-bottom: 1px solid #e0e0e0"> Pa&iacute;s:<br>
			</td></tr>
			<tr><td align="center">
				<select name="s_country">
                <option value="NULL">- qualquer -</option>
              </select>
				</select>
			</td></tr>
			
			<tr>
            <td class="table_item"> Estado civil:<br>
			</td></tr>
			<tr><td align="left">
				<input name="s_single" <? if ($_GET['search']!='1' || $_POST['s_single']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Solteiro(a)<br>
				<input name="s_commited" <? if ($_GET['search']!='1' || $_POST['s_commited']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Comprometido(a)<br>
				<input name="s_married" <? if ($_GET['search']!='1' || $_POST['s_married']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Casado(a)<br>
				<input name="s_openrelation" <? if ($_GET['search']!='1' || $_POST['s_openrelation']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Aberto a rela&ccedil;&atilde;o</td>
          </tr>
			
			<tr>
            <td class="table_item"> Interesse em:<br>
			</td></tr>
			<tr><td align="left">
				<input name="s_friends" <? if ($_GET['search']!='1' || $_POST['s_friends']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Amizade<br>
				<input name="s_business" <? if ($_POST['s_business']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Neg&oacute;cios<br>
				<input name="s_dating" <? if ($_POST['s_dating']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Prefer&ecirc;ncia: </td>
          </tr>
			<tr><td align="center">
					&nbsp;	<select name="s_date_type">
                <option value="0">- qualquer -</option>
                <option value="1">homem &amp; mulher</option>
                <option value="2">homem</option>
                <option value="3">mulher</option>
              </select>
			</td></tr>

			<!--<tr><td style="border-bottom: 1px solid #e0e0e0">
				Keyword:<br>
			</td></tr>
			<tr><td align="center">
				<input name="s_keyword" value="<? print($_POST['s_keyword']) ?>" type="text" size=16>
			</td></tr>-->
			
			<tr><td height="6"></td></tr>
			
			<tr><td align="right">
				<input type="submit" value="Buscar!">
              &nbsp;
			</td></tr></form>
		</table>
		
		<?
		draw_small_frame_bottom();
	?>
	</td>
	<td align="center" valign="top" width="80%">
	<?
		show_system_messages();
		if ($_GET['search']=='1')
		{
			$sql="";
			if ($_POST['s_male']=='1' && $_POST['s_female']!='1') $sql .= " AND users.gender=0";
			if ($_POST['s_male']!='1' && $_POST['s_female']=='1') $sql .= " AND users.gender=1";
			if ($_POST['s_country']!='NULL') $sql .= " AND users.country=" . $_POST['s_country'];
			
			if ($_POST['s_single']=='1') $sql .= " AND (users.status=0 OR";
			else $sql .= " AND (";
			if ($_POST['s_commited']=='1') $sql .= " users.status=1 OR";
			else $sql .= "";
			if ($_POST['s_married']=='1') $sql .= " users.status=2 OR";
			else $sql .= "";
			if ($_POST['s_openrelation']=='1') $sql .= " users.status=3 OR";
			else $sql .= "";
			$sql .= " 1=2) ";
			
			if ($_POST['s_friends']=='1') $sql .= " AND users.looking_friends=1";
			//else $sql .= " AND (users.looking_friends=0";
			if ($_POST['s_business']=='1') $sql .= " AND users.looking_business=1";
			//else $sql .= " OR users.looking_business=0";
			if ($_POST['s_dating']=='1') $sql .= " AND users.looking_dating=1";
			//else $sql .= " OR users.looking_dating=0)";
			
		}
		$rs = mysql_query("SELECT countries.name as user_country, users.first_name, users.last_name, users.status, users.country, users.gender, users.id as id FROM users LEFT JOIN countries ON users.country=countries.id WHERE 1=1 ". $sql ." order by RAND() LIMIT 10", $db)
			or bug("Database error, please try again");
		?>
		<table width="100%" cellspacing=0 cellpadding=0>
		<tr><td align="center">
		<?
		draw_frame_top("Resultados da Pesquisa");

		if(mysql_num_rows($rs)<=0)
			print("Sua pesquisa não obteve resultados");
		?>
			<table width="100%">
			<?
			$count=0;
			while($row = mysql_fetch_array($rs))
			{
				if ($count==0) echo("<tr>");
			?>
				<td style="border-bottom: 1px solid #e9e9e9; border-left: 1px solid #e9e9e9" width="50%">
					<table cellspacing=0 cellpadding=3 width="100%">
							<td width="10%"><a href="profile.php?id=<? print($row['id']); ?>"><? draw_user_small_picture($row['id']) ?></a></td>
							<td width="90%" valign="top">
								<a href="profile.php?id=<? print($row['id']); ?>"><b><? print($row['first_name'] . " " . $row['last_name']); ?></b></a><br>
								<i><? if($row['gender']==0) print("masculino"); else print("feminino"); ?>, 
								<? if($row['status']==0) print("solteiro(a)"); elseif($row['status']==1) print("comprometido(a)"); elseif($row['status']==2) print("casado(a)"); else print("aberto(a) a relações"); ?>
								<br><? print($row['user_country']) ?></i>
							</td>
					</table>
				</td>
			<?
				$count++;
				if ($count>=2) 
				{
					$count=0;
					echo "</tr>";
				}
			}
			if ($count!=0) echo "</tr>";
			?>
			<tr>
				<td colspan="2"><br>
					<table width="65%" align="center" bgcolor="#FFFFCC" style="border: 1px solid #bbbbbb">
					<tr>
						
                      <td align="center"><strong>Obs</strong>: A busca mostra 
                        10 yogurt's em ordem aleat&oacute;ria, se quiser mais 
                        resultados precione <strong>Buscar</strong> novamente!</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		<?
		draw_frame_bottom();
		?>
		</td></tr>
		</table>
	</td>
</tr>
</table>
<?
	draw_bottom();
?>