<?
/**
 * Yogurt groupware
 *
 * created by Ricardo Alexandre de Oliveira Staudt,
 * licenced under GPL, please refer to licence.txt for more information
 */

	// is the user really logged?
	session_start();
	if(!isset($_SESSION['id']) || 
		!isset($_SESSION['first_name']) ||
		!isset($_SESSION['last_name']) || 
		!isset($_SESSION['username']) ||
		!isset($_SESSION['theme']))
	{
		header('Location: ../?error=Sua sessão expirou,entre com seu nome de usuário e senha novamente! &referer=http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); 
		die();
	}
	else
	{
		require_once ("../localSettings.php");
		require_once ("../lang/". $DEFAULT_LANGUAGE .".php");
		require_once ("../include/connect.php");
		require_once ("../include/system.php");
		require_once ("../themes/" . $_SESSION['theme'] . "/theme.php");
		
		//prepare the message for drawing the top later
		$rs = mysql_query("SELECT count(id) FROM messages where dest=". $_SESSION['id'] ." and seen=0", $db)
						or die("Database error, please try again");
		$row = mysql_fetch_array($rs);
		$topic_message = (($row['count(id)']<=0) ? '<font color="#bbbbbb">você não tem nenhuma mensagem nova</font>' : 'você tem <a href="messages.php">'. $row['count(id)'] .' novas mensagens</a>!');
		$rs = null; $row = null;
	}
	
	function bug($message)
	{
		require_once ("../include/connect.php");
		require_once ("../include/stringtools.php");
		$log = implode("<br>",apache_request_headers());
		mysql_query("INSERT INTO bugs (header, ip, message, date, user, querystring, form)
										values('". fixstring($log) ."', '". $REMOTE_ADDR ."', '". $message ."', '". date($MYSQL_DATE) ."', ". $_SESSION['id'] .", '". implode("<br>", $_GET) ."', '". implode("<br>", $_POST) ."')", $db)
						or die("Database error, please try again");
		die("<b>An error has ocurred during the system operation:</b><br><i>". $message ."</i><br>This error has been registered on our database, please <a href=\"reportbug.php\">confirm this as a bug</a> (if you haven't already), so we can solve it as fast as possible.");
	}
?>