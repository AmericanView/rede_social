<?
	session_start();
	$_SESSION['id'] = null;
	$_SESSION['username'] = null;
	$_SESSION['first_name'] = null;
	$_SESSION['last_name'] = null;
	
	require_once ("../localSettings.php");
	require_once ("../include/connect.php");
	require_once ("../include/stringtools.php");
	
	$rs = mysql_query("SELECT * FROM users WHERE username='" . fixstring($_POST["username"]) . "' LIMIT 1", $db)
		or die("Database error, please try again");

	if(mysql_num_rows($rs)>0)
	{
		$row = mysql_fetch_array($rs);
		if ($row["password"] == $_POST["password"])
		{
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['theme'] = $DEFAULT_THEME;
			$_SESSION['last_login'] = $row['current_login'];
			
			mysql_query("update users set last_login='" . $row["current_login"] . "', current_login='" . date($MYSQL_DATE) . "' where id=" . $row['id'])
				or bug("date values incorrect");
			
			if (strlen($_POST['referer'])>6)
				header('Location: '. $_POST['referer']); 
			else
				header('Location: ../system/'); 
			bug();
		}
	}

	header('Location: ../.?error=Login e/ou senha não encontrado(s)'); 
	
?>