<?
	require("localSettings.php");
	require("include/connect.php");
	require("include/stringtools.php");
	$error=null;
	
	if (isset($_POST['save']))
	{
		/*if (strlen($_POST['invitation_key'])<8)
			$error="The invitation key must have 8 digits";
		else*/ if (strlen($_POST['username'])<4)
			$error="Seu nome de usuário deve contar pelo menos 4 caracteres";
		else if (strlen($_POST['password'])<6 || strlen($_POST['c_password'])<6)
			$error="Sua senha(e a confirmação) devem conter no mínimo 6 caracteres";
		else if ($_POST['password']!=$_POST['c_password'])
			$error="Sua senha e a confirmação não estão coincidindo";
		else if (strlen($_POST['first_name'])<4)
			$error="Seu primeiro nome deve conter pelo menos 4 caracteres";
		else if (strlen($_POST['last_name'])<4)
			$error="Seu sobrenome deve conter pelo menos 4 caracteres";
		else if (strlen($_POST['email'])>0 && (strpos($_POST['email'], '@')<0 && strpos($_POST['email'], '.')<0))
			$error="Endereço de e-mail invalido";
	
		if (!isset($error))
		{
			/*$rs = mysql_query("select id from invitations where id='". strtoupper($_POST['invitation_key']) ."' and used=0", $db);
			if (mysql_num_rows($rs)<=0)
				$error = "Invitation key does not exist";
			else
			{*/
				$rs = mysql_query("select * from users where username='". strtolower($_POST['username']) ."'", $db);
				if (mysql_num_rows($rs)!=0)
					$error = "O nome de usuário que você escolheu já existe,por favor tente outro";
				else
				{
					$sql = "INSERT INTO users(`username`, `password`, `first_name`, `last_name`, `status`, `gender`, `country`, `email`, `looking_friends`, `looking_business`, `looking_dating`, `dating_type`) 
										values('". strtolower(fixstring($_POST['username'])) ."', '". fixstring($_POST['password']) ."', '". fixstring($_POST['first_name']) ."', '". fixstring($_POST['last_name']) ."', ";
					if (is_numeric($_POST['status'])) $sql .= $_POST['status'] . ", ";
					else $sql .= "NULL, ";
					if (is_numeric($_POST['gender'])) $sql .= $_POST['gender'] . ", ";
					else $sql .= "NULL, ";
					if (is_numeric($_POST['country'])) $sql .= $_POST['country'] . ", ";
					else $sql .= "NULL, ";
					if (strlen($_POST['email'])>0) $sql .= "'" . fixstring($_POST['email']) . "',";
					else $sql .= "NULL,";
					
					$sql .= ($_POST['looking_friends']=='1' ? '1' : '0') .", ". 
								($_POST['looking_business']=='1' ? '1' : '0') .", ". 
								($_POST['looking_dating']=='1' ? '1' : '0') .", ". $_POST['dating_type'];
					$sql .= ")";

					mysql_query($sql, $db);
					mysql_query("UPDATE invitations SET used=1 WHERE id='". strtoupper($_POST['invitation_key']) ."'", $db);
					
					header('Location: .?msg=Parabéns '. $_POST['first_name'] .',você agora é um usuário do Yogurt. Esperamos que você divirta-se bastante!'); 
					die();
				}
			/*}*/
		}
	}

	session_start();
	$_SESSION['id'] = null;
	$_SESSION['username'] = null;
	$_SESSION['first_name'] = null;
	$_SESSION['last_name'] = null;

	include("basictheme.php");

	draw_top();
?>
	<table width="100%" height="305">
	<tr>
		<td width="63%" align="center" valign="top">
		<?
			draw_small_frame_top("Informações básicas", "mini_smile");
			?>
			<table width="100%">
			<form action="" method="POST">
			<input type="HIDDEN" name="save" value="1">
			<!--<tr>
				<td width="30%" align="right" valign="top"><b>invitation key:</b>&nbsp;</td>
				<td width="70%"><input type="text" name="invitation_key" value="<?print($_POST['invitation_key']);?>" maxlength=8 size=8></td>
			</tr>-->
			<tr>
				
            <td width="30%" align="right" valign="top"><b><font color="990000">l</font><font color="990000">ogin:</font></b>&nbsp;</td>
				<td width="70%"><input type="text" name="username" value="<?print($_POST['username']);?>" maxlength=20 size=14></td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top"><b><font color="990000">senha:</font></b>&nbsp;</td>
				<td width="70%"><input type="password" name="password" value="<?print($_POST['password']);?>" maxlength=20 size=10></td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top"><b><font color="990000">confirmar 
              senha :</font></b>&nbsp;</td>
				<td width="70%"><input type="password" name="c_password" value="<?print($_POST['c_password']);?>" maxlength=20 size=10></td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top"><b>primeiro nome:</b>&nbsp;</td>
				<td width="70%"><input type="text" name="first_name" value="<?print($_POST['first_name']);?>" maxlength=20 size=20></td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top"><b>sobrenome:</b>&nbsp;</td>
				<td width="70%"><input type="text" name="last_name" value="<?print($_POST['last_name']);?>" maxlength=20 size=20></td>
			</tr>
			<tr>
				<td width="30%" align="right" valign="top">e-mail:&nbsp;</td>
				<td width="70%"><input type="text" name="email" value="<?print($_POST['email']);?>" size="30"  maxlength=60></td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top">sexo:&nbsp;</td>
				<td width="70%">
					<select name="gender">
                <option value="NULL" selected>- n&atilde;o informar -</option>
                <option value="0">masculino</option>
                <option value="1">feminino</option>
              </select>
				</td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top">estado civil:&nbsp;</td>
				<td width="70%">
					<select name="status">
                <option value="NULL" selected>- n&atilde;o informar -</option>
                <option value="0">solteiro(a)</option>
                <option value="1">comprometido(a)</option>
                <option value="2">casado(a)</option>
                <option value="3">aberto a rela&ccedil;&otilde;es</option>
              </select>
				</td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top">pa&iacute;s:&nbsp;</td>
				<td width="70%">
					<SELECT name=country>
                <option value="NULL">- n&atilde;o informar -</option>
                <option value="1">Afghanistan</option>
                <option value="2">Albania</option>
                <option value="3">Algeria</option>
                <option value="4">Andorra</option>
                <option value="5">Angola</option>
                <option value="6">Anguilla</option>
                <option value="7">Antigua and Barbuda</option>
                <option value="8">Argentina</option>
                <option value="9">Ashmore Cartier Islands</option>
                <option value="10">Australia</option>
                <option value="11">Austria</option>
                <option value="12">Bahamas, The</option>
                <option value="13">Bahrain</option>
                <option value="14">Bangladesh</option>
                <option value="15">Barbados</option>
                <option value="16">Bassa da India</option>
                <option value="17">Belgium</option>
                <option value="18">Belize</option>
                <option value="19">Benin</option>
                <option value="20">Bermuda</option>
                <option value="21">Bhutan</option>
                <option value="22">Bolivia</option>
                <option value="23">Botswana</option>
                <option value="24">Bouvet Island</option>
                <option value="25">Brasil</option>
                <option value="26">British Indian Ocean Territory</option>
                <option value="27">British Virgin Islands</option>
                <option value="28">Brunei</option>
                <option value="29">Bulgaria</option>
                <option value="30">Burma</option>
                <option value="31">Burundi</option>
                <option value="32">Cameroon</option>
                <option value="33">Canada</option>
                <option value="34">Cape Verde</option>
                <option value="35">Cayman Islands</option>
                <option value="36">Central African Republic</option>
                <option value="37">Chad</option>
                <option value="38">Chile</option>
                <option value="39">China</option>
                <option value="40">Christmas Island</option>
                <option value="41">Clipperton Island</option>
                <option value="42">Coco (Keeling) Islands</option>
                <option value="43">Colombia</option>
                <option value="44">Comoros</option>
                <option value="45">Congo</option>
                <option value="46">Cook Islands</option>
                <option value="47">Coral Sea Islands</option>
                <option value="48">Costa Rica</option>
                <option value="49">Cuba</option>
                <option value="50">Cyprus</option>
                <option value="51">Czechoslovakia</option>
                <option value="52">Denmark</option>
                <option value="53">Djibouti</option>
                <option value="54">Dominica</option>
                <option value="55">Dominican Republic</option>
                <option value="56">Ecuador</option>
                <option value="57">Egypt</option>
                <option value="58">El Salvador</option>
                <option value="59">Equatorial Guinea</option>
                <option value="60">Ethiopia</option>
                <option value="61">Europa Island</option>
                <option value="62">Faeroe Islands</option>
                <option value="63">Falkland Islands (Islas Malvinas)</option>
                <option value="64">Fiji</option>
                <option value="65">Finland</option>
                <option value="66">France</option>
                <option value="67">French Guiana</option>
                <option value="68">French Polynesia</option>
                <option value="69">French Southern Antarctic Lands</option>
                <option value="70">Gabon</option>
                <option value="71">Gambia, The</option>
                <option value="72">Gaza Strip</option>
                <option value="73">German Democractic Republic (E)</option>
                <option value="74">Germany, Berlin</option>
                <option value="75">Germany, Federal Republic of (W)</option>
                <option value="76">Ghana</option>
                <option value="77">Gibraltar</option>
                <option value="78">Glorioso Islands</option>
                <option value="79">Greece</option>
                <option value="80">Greenland</option>
                <option value="81">Grenada</option>
                <option value="82">Guadeloupe</option>
                <option value="83">Guatemala</option>
                <option value="84">Guernsey</option>
                <option value="85">Guinea</option>
                <option value="86">Guinea Bissau</option>
                <option value="87">Guyana</option>
                <option value="88">Haiti</option>
                <option value="89">Heard Island McDonald Islands</option>
                <option value="90">Hondurus</option>
                <option value="91">Hong Kong</option>
                <option value="92">Hungary</option>
                <option value="93">Iceland</option>
                <option value="94">India</option>
                <option value="95">Indonesia</option>
                <option value="96">Iran</option>
                <option value="97">Iraq</option>
                <option value="98">Iraq-Saudi Arabia Neutral Zone</option>
                <option value="99">Ireland</option>
                <option value="100">Israel</option>
                <option value="101">Italy</option>
                <option value="102">Ivory Coast</option>
                <option value="103">Jamaica</option>
                <option value="104">Jan Mayen</option>
                <option value="105">Japan</option>
                <option value="106">Jersey</option>
                <option value="107">Jordan</option>
                <option value="108">Juan DeNova Island</option>
                <option value="109">Kampuchea</option>
                <option value="110">Kenya</option>
                <option value="111">Kiribati</option>
                <option value="112">Korea, Dem People's Republic of</option>
                <option value="113">Kroea, Republic of</option>
                <option value="114">Kuwait</option>
                <option value="115">Laos</option>
                <option value="116">Lebanon</option>
                <option value="117">Lesotho</option>
                <option value="118">Liberia</option>
                <option value="119">Libya</option>
                <option value="120">Liechtenstein</option>
                <option value="121">Luxembourg</option>
                <option value="122">Macau</option>
                <option value="123">Madagascar (Malagasy Republic)</option>
                <option value="124">Malaysia</option>
                <option value="125">Maldives</option>
                <option value="126">Mali</option>
                <option value="127">Malta</option>
                <option value="128">Martinique</option>
                <option value="129">Mauritania</option>
                <option value="130">Maurititus</option>
                <option value="131">Mayotte</option>
                <option value="132">Mexico</option>
                <option value="133">Milawi</option>
                <option value="134">Monaco</option>
                <option value="135">Mongolia</option>
                <option value="136">Montserrat</option>
                <option value="137">Morocco</option>
                <option value="138">Mozambique</option>
                <option value="139">Namibia</option>
                <option value="140">Nauru</option>
                <option value="141">Nepal</option>
                <option value="142">Netherlands</option>
                <option value="143">Netherlands Antilles</option>
                <option value="144">New Caledonia</option>
                <option value="145">New Zealand</option>
                <option value="146">Nicaragua</option>
                <option value="147">Niger</option>
                <option value="148">Nigeria</option>
                <option value="149">Niue</option>
                <option value="150">Norfolk Island</option>
                <option value="151">Norway</option>
                <option value="152">Oman</option>
                <option value="153">Pakistan</option>
                <option value="154">Panama</option>
                <option value="155">Papua New Guinea</option>
                <option value="156">ParacelIslands</option>
                <option value="157">Paraguay</option>
                <option value="158">Peru</option>
                <option value="159">Philippines</option>
                <option value="160">Pitcairn Island</option>
                <option value="161">Poland</option>
                <option value="162">Portugal</option>
                <option value="163">Qator</option>
                <option value="164">Reunion</option>
                <option value="165">Romania</option>
                <option value="166">Rwanda</option>
                <option value="167">San Marino</option>
                <option value="168">Sao Tome Principe</option>
                <option value="169">Saudi Arabia</option>
                <option value="170">Senegal</option>
                <option value="171">Seychelles</option>
                <option value="172">Sierra Leone</option>
                <option value="173">Singapore</option>
                <option value="174">Soloman Islands</option>
                <option value="175">Somalia</option>
                <option value="176">South Africa</option>
                <option value="177">Spain</option>
                <option value="178">Spratly Island</option>
                <option value="179">Sri Lanka (Ceylon)</option>
                <option value="180">St. Christopher-Nevis</option>
                <option value="181">St. Helena</option>
                <option value="182">St. Lucia</option>
                <option value="183">St. Pierre Miquelon</option>
                <option value="184">St. Vincent and the Grenadines</option>
                <option value="185">Sudan</option>
                <option value="186">Suriname</option>
                <option value="187">Svalbard</option>
                <option value="188">Swaziland</option>
                <option value="189">Sweden</option>
                <option value="190">Switzerland</option>
                <option value="191">Syria</option>
                <option value="192">Taiwan</option>
                <option value="193">Tanzania, United Republic of</option>
                <option value="194">Thailand</option>
                <option value="195">Togo</option>
                <option value="196">Tokelau</option>
                <option value="197">Tonga</option>
                <option value="198">Trinidad Tobago</option>
                <option value="199">Tromelin Island</option>
                <option value="200">Tunisia</option>
                <option value="201">Turkey</option>
                <option value="202">Turks and Caicos Island</option>
                <option value="203">Tuvalu</option>
                <option value="204">Uganda</option>
                <option value="205">Union of Soviet Socialist Republics</option>
                <option value="206">United Arab Emirates</option>
                <option value="207">United Kingdom</option>
                <option value="208">United Kingdom - England</option>
                <option value="209">United Kingdom - Scotland</option>
                <option value="210">United States</option>
                <option value="211">Upper Volta</option>
                <option value="212">Uruguay</option>
                <option value="213">Vanuatu</option>
                <option value="214">Vatican City</option>
                <option value="215">Venezuela</option>
                <option value="216">Vietnam</option>
                <option value="217">Wallis and Futuna</option>
                <option value="218">West Berlin</option>
                <option value="219">Western Sahara</option>
                <option value="220">Western Samoa</option>
                <option value="221">Yemen (Aden)</option>
                <option value="222">Yemen (Sanaa)</option>
                <option value="223">Yugoslavia</option>
                <option value="224">Zaire</option>
                <option value="225">Zambia</option>
                <option value="226">Zimbabwe</option>
              </SELECT>
				</td>
			</tr>
			<tr>
				
            <td width="30%" align="right" valign="top">interesse em:&nbsp;</td>
				<td width="70%">
					<input name="looking_friends" <? if ($_POST['looking_friends']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Amigos<br>
					<input name="looking_business" <? if ($_POST['looking_business']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Neg&oacute;cios<br>
					<input name="looking_dating" <? if ($_POST['looking_dating']=='1') print("checked") ?> value="1" type="checkbox" class="checkbox">
              Prefer&ecirc;ncias: 
              <select name="dating_type">
                <option value="0" selected>- n&atilde;o informar -</option>
                <option value="1">homem &amp; mulher</option>
                <option value="2">homem</option>
                <option value="3">mulher</option>
              </select>
					<br>&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan=2 align="right" style="border-top: 1px solid #cccccc;"><br>
					<input type="Submit" value="Criar usu&aacute;rio!">
              &nbsp;&nbsp;
				</td>
			</tr>
			</form>
			</table>
			<?
			draw_small_frame_bottom();
		?>
		</td>
		
    <td width="37%" align="center" valign="top"> 
      <?
			if(isset($error))
			{
				draw_msg_frame_top("Erro de validação", "mini_error", 0);
					print("<center><font color=\"cc0000\"></b>". $error ."</b></font></center>");
				draw_msg_frame_bottom();
				//print("<br>");
			}
			if(isset($_GET['error']))
			{
				draw_msg_frame_top("Erro de validação", "mini_error", 0);
					print("<center><font color=\"cc0000\"></b>". $_GET['error'] ."</b></font></center>");
				draw_msg_frame_bottom();
				//print("<br>");
			}
			if(isset($_GET['msg']))
			{
				draw_msg_frame_top("Mensagem do sistema", null, 0);
					print("<center>". $_GET['msg'] . "</center>");
				draw_msg_frame_bottom();
				//print("<br>");
			}
			
			draw_frame_top("Bem vindo!");
			?>
      <div align="justify">Neste primeiro passo você informará a maioria das informaç&otilde;es 
        básicas, estas ser&atilde;o as informaç&otilde;es mais acessadas e utilizadas 
        pelo sistema. <BR>
        <BR>
        Os únicos campos exigidos são:<br>
        nome, login,senha e confirma&ccedil;&atilde;o de senha. O resto pode ser 
        deixado em branco. <BR>
        <BR>
        Todas as informações opcionais poder&atilde;o ser preenchidas ou modificadas 
        depois de cadastrar-se no <STRONG> Yogurt</STRONG>.<BR>
        <BR>
        <BR>
        <?
			draw_frame_bottom();
		?>
      </div></td>
	</tr>
	</table>
<?
	draw_bottom();
?>