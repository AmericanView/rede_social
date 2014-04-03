<?
	function fixstring($str)
	{
		return str_replace("\n", "<br>", htmlspecialchars($str,  ENT_QUOTES));
		//$result = str_replace("'", "\"", $result);
	}

	function unfixstring($string)
	{
		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);
		return str_replace("\&", "&", str_replace("\'", "'", str_replace("<br>", "\n", strtr ($string, $trans_tbl))));
	}
?>