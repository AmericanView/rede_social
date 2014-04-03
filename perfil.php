<?php include('includes/header2.php'); ?>   
        <div id="amarra-center-left">
        
            <div class="center">
           
                <div id="dexar-recadosp">
                
                <table id="tb" width="100%" border="0"><tr><td align="center">
				<?php
					if(isset($_GET['perfil']) AND $_GET['perfil']=='UPLOAD'){
						
						?>
                        <br /><br /><br /><br /><span id="ex">Escolha uma foto com tamanho 161 x 185 pixels.</span><br /><br />
                        <form name="upload-foto-perfil" enctype="multipart/form-data" method="post" action="php/crop.php">
                        	<input type="file" name="foto-perfil" />
                            <input type="submit" value="Finalizar" />
                            <input type="hidden" name="imgantiga" value="<?php echo $user_imagem ?>" />
                            <input type="hidden" name="upload" value="perfil" />
                            <input type="hidden" name="uid" value="<?php echo $idDaSessao ?>"/>
                        </form>
                        <br /><br /><br /><br /><br />
                        <?php
						
					}
					?>
                    <?php
					if(isset($_GET['perfil']) AND $_GET['perfil']=='UPLOADS'){
						
						?>
                        <br /><br /><br /><br /><span id="ex">Escolha uma capa com tamanho 660 x 250 pixels.</span><br /><br />
                        <form name="upload-foto-capa" enctype="multipart/form-data" method="post" action="php/crop2.php">
                        	<input type="file" name="foto-capa" />
                            <input type="submit" value="Finalizar" />
                            <input type="hidden" name="imgantiga" value="<?php echo $user_imagem ?>" />
                            <input type="hidden" name="upload" value="capa" />
                            <input type="hidden" name="uid" value="<?php echo $idDaSessao ?>"/>
                        </form>
                        <br /><br /><br /><br /><br />
                        <?php
						
					}
					?>
                    </td></tr></table><br />
                    <?php if($idDaSessao <> $idExtrangeiro){ ?>
                	<table width="auto" border="0" id="fecha2">
                    <tr><td>
                    <?php
						$solicitacao = Amisade::solicitacao($idDaSessao,$idExtrangeiro);
						
						$link = '<a href="php/amisade.php?ac=';		
						
						if($solicitacao['r']==0){
							echo $link.'convite|'.$idDaSessao.'|'.$idExtrangeiro.'"><img src="../images/adicionar.png" /></a>';
						}elseif($solicitacao['r']==1){
							echo $link.'remover|'.$idDaSessao.'|'.$idExtrangeiro.'|'.$solicitacao['id'].'"><img src="../images/cancelarsolicitacao.png" /></a>';
						}elseif($solicitacao['r']==2){
							echo $link.'remover|'.$idDaSessao.'|'.$idExtrangeiro.'|'.$solicitacao['id'].'"><img src="../images/desfazeramizade.png" /></a>';
						}
					?>
                    </td><td>
                    <a href="#" onclick="document.getElementById('tuf').style.display='block';"><img src="images/mensagem.png" /></a>
                    </td>
                    </tr>
                    </table>
                    <?php } ?>
                <h3><span style="font-family:Verdana; font-size:13px;">Selo</span></h3><br />
                   <?php if(isset($user_selo)){ echo '<img style="background-color:#fffccc;" src="images/selos/'.$user_selo.'.png" />' ?><?php }else{ echo '<h3 align="center" style="background-color:#fffccc;">Continue online e ganhará selos!</h3>'; } ?> <?php echo $user_selodesc ?>
                    <br /><br />
                    <h2>Sobre <?php echo ($idDaSessao<>$idExtrangeiro) ? $user_fullname : 'mim'; ?>
                    <span>
                    
                                        
                    </span></h2><br />
                    <h3 align="center" style="background-color:#f4f4f4; text-align:center;"><?php echo $user_sobre; ?></h3>
                    
                    
                </div><!--blocos-->

                <div class="blocos" id="pagina">
                    
                    <h2>Perfil</h2><br /><br />
                    <div style="font-family:Verdana; font-size:11px;">
                    <br />
                    ✎ <span id="info">Nome</span>: <?php echo $user_fullname ?>
                    <br /><br />
                    ♀♂ <span id="info">Gênero</span>: <?php echo $user_sexo ?>
                    <br /><br />
                    웃 <span id="info">Data de nascimento</span>: <?php echo date('d/m/Y', strtotime($user_nascimento)); ?>
                    <br /><br />
                    ✆ <span id="info">Telefone</span>: <?php echo $user_telefone ?>
                    <br /><br />
                    ✍ <span id="info">E-mail</span>: <?php echo $user_emailform ?>
                    <br /><br />
                    ❣ <span id="info">Interesse em</span>: <?php echo $user_interesse ?>
                    <br /><br />
                    ❤ <span id="info">Status de relacionamento</span>: <?php echo $user_relacionamento ?>
                    <br /><br />
                    ✄ <span id="info">Colégio</span>: <?php echo $user_colegio ?>
                    <br /><br />
                    ❢ <span id="info">Faculdade</span>: <?php echo $user_faculdade ?>
                    <br /><br />
                    <span id="info">Mensagem do sistema</span>: <h2>
					
                    <span style="color:#ff0000;"><?php echo $user_aviso ?></span>
                    
                    </h2>
                    </div>
                </div><!--blocos-->
            </div><!--center-->
            
            <div class="right">
            
                <?php include('includes/amigos.php'); ?>
                                
            </div><!--right-->

                    
        </div><!--amarra-center-left-->
        
<?php include('includes/footer.php'); ?>