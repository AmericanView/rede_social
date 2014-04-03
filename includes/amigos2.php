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
				echo '<li><span><a href="perfil.php?uid='.$resAmigos[0].'"><img src="uploads/usuarios/'.user_img($resAmigos[3]).'" alt="" title="'.$nomecompleto.'" /></a></span></li>';
			}
		}else{
			echo '<span style="font-family:Eras Demi ITC;"><br />Você ainda não tem amigos!</span>';
		}
		?>
    </ul>
</div><!--blocos-->