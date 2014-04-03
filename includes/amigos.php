<div class="blocos" id="publicidade">
    <!-- <img src="midias/banner.png" /> -->
    <iframe width="300" height="250" src="propagandas/propagandas-quadrado.php" frameborder="0" scrolling="no"></iframe>    
</div><!--blocos-->

<div class="blocos" id="meus-amigos">

    <table border="1" bordercolor="#ff6c00" style="border-collapse: collapse" cellpadding="2" width="100%"><tr><td><span style="font-family:Eras Demi ITC; font-size:14px;">Amigos de <?php echo $user_fullname ?><a href="#" style="color:#ff6c00;">todos</a></span></td></tr></table>
    
    <ul>
    	<?php
		if($list_amigos['num']>0){
			foreach($list_amigos['dados'] as $resAmigos){
				$nomecompleto=$resAmigos[1].' '.$resAmigos[2];
				$nomecompleto=ucwords($nomecompleto);
				$nomecompleto=utf8_encode($nomecompleto);
				echo '<li><span><a href="perfil.php?uid='.$resAmigos[0].''.$resAmigos[1].''.$resAmigos[2].'"><img src="uploads/usuarios/'.user_img($resAmigos[3]).'" alt="" title="'.$nomecompleto.'" /></a></span></li>';
			}
		}else{
			echo '<span style="font-family:Eras Demi ITC;"><br />Você ainda não tem amigos!</span>';
		}
		?>
    </ul>
</div><!--blocos-->

<!--startchat-->
<?php if($idDaSessao == $idExtrangeiro){ ?>
<div id="contatos">
	<ul>
    <table width="100%" border="0">
    <tr>
    <td>
    <span id="rampa">Procurar amigos<br />
            <form name="pesquisa-all" action="busca.php" method="get">
            	<input placeholder="Pesquisar..." type="text" name="s" /><input width="23" height="23" type="image" src="../images/buscar.png" />
            </form>
            </span><br />
    </td>
    </tr>
    <tr>
    <td>
            <form method="post" action="onlineperfil.php">
            <input type="hidden" name="id" value="<?php echo $user_id; ?>" />
            <label>Ficar Online </label><input type="radio" value="1" name="online" /><br />
            <label>Ficar Offline </label><input type="radio" value="0" name="online" /><br />
            <input type="submit" value="Confirmar status" />
            </form>
            <br /><br />
    </td>
    </tr>
    <tr style="background-color:#333; font-family:Verdana; font-size:10px; color:#ccc;" height="20">
    <td>
    Você tem <?php echo number_format($list_amigos['num'],0,",",".") ?> amigos
    </td>
    </tr>
    </table><br /><br />
<?php
		if($list_amigos['num']>0){
			foreach($list_amigos['dados'] as $resAmigos){
				$nomecompleto=$resAmigos[1].' '.$resAmigos[2];
				$nomecompleto=$nomecompleto;
				$nomecompleto=ucwords($nomecompleto);
				$nomecompleto=utf8_encode($nomecompleto);
				$bstatus = mysql_query("SELECT * FROM usuarios WHERE id = ".$resAmigos[0]."");
while($linha = mysql_fetch_array($bstatus))
if($linha['online'] > 0){echo '<li id="cans2"><a href="javascript:;" onclick="javascript:chatWith(\''.$resAmigos['0'].'\',\''.$nomecompleto.'\')"><span id="copi">●</span>'.$resAmigos[1].'<img width="38" height="38" style="float:left;" src="uploads/usuarios/'.user_img($resAmigos[3]).'" alt="" title="'.$nomecompleto.'" /></a></li>';}
			}}
		?>
        <?php
		if($list_amigos['num']>0){
			foreach($list_amigos['dados'] as $resAmigos){
				$nomecompleto=$resAmigos[1].' '.$resAmigos[2];
				$nomecompleto=$nomecompleto;
				$nomecompleto=ucwords($nomecompleto);
				$nomecompleto=utf8_encode($nomecompleto);
				$bstatus = mysql_query("SELECT * FROM usuarios WHERE id = ".$resAmigos[0]."");
while($linha = mysql_fetch_array($bstatus))
if($linha['online'] < 1){echo '<li id="cans2"><a href="javascript:;" onclick="javascript:chatWith(\''.$resAmigos['0'].'\',\''.$nomecompleto.'\')">'.$resAmigos[1].'<img width="38" height="38" style="float:left;" src="uploads/usuarios/'.user_img($resAmigos[3]).'" alt="" title="'.$nomecompleto.'" /></a></li>';}
			}}
		?>
    </ul>
</div>
<?php } ?>
<!--stopchat-->

<!--notif-->
<?php if($idDaSessao == $idExtrangeiro){ ?>
<?php $contarecados = "SELECT `para` FROM `recados` WHERE `para`=".$idDaSessao.""; $conta = mysql_query($contarecados); $resultconta = mysql_num_rows($conta) ?>
<?php if($recados['num'] > 0){ ?>
<table id="cot" border="0">
<tr>
<td>
<?php if($recados['num'] > 98){ ?>
<?php echo '&nbsp;+99&nbsp;';}else{ echo '&nbsp;'.$resultconta.'&nbsp;';} ?>
</td>
</tr>
</table>
<?php } ?>
<?php } ?>
<!--endnotif-->

<div id="suk"><table width="180" height="640" border="1">
<tr>
<td>&nbsp;

</td>
</tr>
</table></div><br />