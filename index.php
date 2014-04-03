<?php

include('includes/header.php'); ?>        
        <div id="amarra-center-left">
            <div class="center">
              <div class="blocos" id="pagina">
               	<h2><?php echo ($idDaSessao<>$idExtrangeiro) ? 'Atualizações de '.$user_fullname : 'Atualizações de Mídias'; ?></h2>
                <?php 
                    echo '<br /><table width="auto" border="0"><tr><td><a href="albuns.php"><img src="images/publicar-foto.png" /></a></td></tr></table>';
					?>
                </div><!--blocos-->
<?php
echo "<meta HTTP-EQUIV='refresh' CONTENT='120;URL='>";
?>
                <?php
                if($list_amigos['num']>0){ new Notificacoes;
                $cache = Notificacoes::$cache;
                ?> <?php }else{ echo '<span style="font-size:13px;">Seja muito bem vindo(a) '.$user_nome.', aceite algumas <a href="sugestoes.php">Sugestões de amizade</a>!</span>'; } ?>

                <div class="blocos" id="notificacoes">
                    <ul>
                    <?php
                    foreach (Notificacoes::$dados as $campos){
                        extract($campos);
                        include('includes/notificacoes_'.$tipo.'.php');
						
					}
                    ?>
                    </ul>
                </div>

            </div><!--center-->
            
            <div class="right">
            
                <?php include('includes/amigos.php'); ?>
                                
            </div><!--right-->

                    
        </div><!--amarra-center-left-->
        
<?php include('includes/footer.php'); ?>