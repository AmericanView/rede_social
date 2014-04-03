<?
	require('../include/pre.php');
	// add a new friend...
	if (is_numeric($_GET['id']))
	{
		$rs = mysql_query("select user from user_friends where user=" . $_SESSION['id'] . " and friend=" . $_GET['id'], $db)
			or bug("Database error, please try again");
		if (mysql_num_rows($rs)==0 && $_SESSION['id']!=$_GET['id'])
		{
			mysql_query("insert into user_friends(`user`, `friend`) values(" . $_SESSION['id'] . ", " . $_GET['id'] . ")", $db)
				or bug("Database error, please try again");
			header('Location: ' . get_querystring_char($_SERVER['HTTP_REFERER']) .'msg=Você somou um amigo novo!'); 
			bug();
		} else {
			header('Location: ' . get_querystring_char($_SERVER['HTTP_REFERER']) .'error=Usuário inválido,id ou usuário já é amigo'); 
			bug();
		}
	}
	else if (is_numeric($_GET['cm'])) // or join a community
	{
		$rs = mysql_query("SELECT count(user) as already_user FROM community_users WHERE user=". $_SESSION['id'] ." and community=". $_GET['cm'] ." LIMIT 1", $db)
			or bug('cannot find get community from database');
		$row = mysql_fetch_array($rs);
		if ($row['already_user']!='1')
		{
			mysql_query("INSERT INTO community_users(community, user, approved, moderator) VALUES (". $_GET['cm'] .", ". $_SESSION['id'] .", 1, 0)", $db)
						or bug('hmm... você não pode ser acrescentado como sócio da comunidade');
			header("Location: community.php?cm=". $_GET['cm'] ."&msg=Você entrou nesta comunidade!"); 
		} else
			header("Location: community.php?cm=". $_GET['cm'] ."&error=Você já é membro!"); 
		bug();
	}
	else if (is_numeric($_GET['cmu'])) // or UNjoin a community
	{
		$rs = mysql_query("DELETE FROM community_users WHERE user=". $_SESSION['id'] ." AND community=". $_GET['cmu'], $db)
			or bug('cannot find get community from database');
			header("Location: community.php?cm=". $_GET['cmu'] ."&msg=Você saiu desta comunidade!"); 
		bug();
	}
	else if (is_numeric($_GET['approve']))
	{
		$rs = mysql_query("UPDATE user_friends set approved=1 where user=". $_GET['approve'] . " AND friend=". $_SESSION['id'], $db)
			or bug('Error finding record');
		$rs = mysql_query("select user from user_friends where user=" . $_SESSION['id'] . " and friend=" . $_GET['approve'], $db)
			or bug("Database error, please try again");
		if (mysql_num_rows($rs)==0 && $_SESSION['id']!=$_GET['approve'])
		{
			mysql_query("insert into user_friends(`user`, `friend`) values(" . $_SESSION['id'] . ", " . $_GET['approve'] . ")", $db)
				or bug("Database error, please try again");
		}
		header("Location: index.php?msg=Você aprovou um amigo"); 
		bug();
	}
	else if (is_numeric($_GET['deny']))
	{
		$rs = mysql_query("DELETE from user_friends where user=". $_GET['deny'] . " AND friend=". $_SESSION['id'], $db)
			or bug('Error finding record');
		mysql_query("INSERT INTO messages (subject, body, sender, dest, date, system) VALUES ('[SYSTEM] ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] ." negou seu pedido de amizade', 'tem certeza que ele/ela é seu amigo(a)?', ". $_SESSION['id'] .", ". $_GET['deny'] .", '". date($MYSQL_DATE) ."', 1)")
			or bug('Error sending message to user');
		header("Location: index.php?msg=Você não aceitou usuário como amigo"); 
		bug();
	}

	header('Location: ' . get_querystring_char($_SERVER['HTTP_REFERER']) .'error=que pena,a operação não foi finalizada com sucesso'); 
	bug();
?>
