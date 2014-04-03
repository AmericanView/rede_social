<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<script type="text/javascript" src="js/jcrop.js"></script>

<script type="text/javascript">
$(function(){
	$('#cropbox').Jcrop({
		aspectRatio: 0,
		onSelect: updateCoords
	});
	
	function updateCoords(c){
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};
});
</script>
</head>
<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../perfil.php'>
<body style="display:none;">
<div id="content-crop">
<img src="uploads/capas/<?php echo $user_imagem ?>"  id="cropbox" />
<form name="crop" method="post" enctype="multipart/form-data" action="php/crop2.php">
	<input type="hidden" name="imagem" value="<?php echo $user_imagem ?>" />
    <input type="hidden" name="x" id="x" />
    <input type="hidden" name="y" id="y" />
    <input type="hidden" name="w" id="w" />
    <input type="hidden" name="h" id="h" />
    <input type="submit" value="salvar" name="salvar" />
</form>
</div><!--content-crop-->
</body>
</html>