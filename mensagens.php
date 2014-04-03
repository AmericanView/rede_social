<?php include('includes/header.php'); ?>        
        <div id="amarra-center-left">

            <div class="center">
               
                <div class="blocos" id="pagina">
                	<h2><?php echo ($idDaSessao<>$idExtrangeiro) ? 'Mensagens de '.$user_fullname : 'Feed de Mensagens'; ?></h2>
                    <?php include('includes/form_recados.php'); ?>
                    
                    <div id="listrecados">
                    	<?php
						if($recados['num']>0){
							echo '<ul>';
							foreach($recados['dados'] as $asRecados){
$conexao = mysql_connect('localhost','root','');
if (!$conexao)
{
die('Erro ao conectar: ' . mysql_error());
}
mysql_select_db('redesocial', $conexao);

								echo '<span id="foca">
								<form method="post" action="/php/delmsg.php">
								<input type="hidden" name="id" value="'.$asRecados['id'].'" />
								marcar como lido &nbsp;&nbsp;<span style="font-size:13px;"><input id="marcar" type="submit" value="●" /></span>
								</form></span>';
								echo '<li><span><img src="uploads/usuarios/'.user_img($asRecados['imagem']).'" /></span>
								<h2><a href="perfil.php?uid='.$asRecados['de'].'">'.$asRecados['nome'].' '.$asRecados['sobrenome'].'</a> - '.date('H:i',strtotime($asRecados[10])).'</h2>
								<h3>';
								echo '<ul><li>fala para: </li>';
								if($asRecados['para']=='amigos'){
									$amigos_recados = Amisade::list_amigos($asRecados['de']);
									
									foreach($amigos_recados['dados'] as $asAmigosRec){
										echo '<li><span><a href="perfil.php?uid='.$asAmigosRec['id'].'" /><img title="'.$asAmigosRec['nome'].' '.$asAmigosRec['sobrenome'].'" src="uploads/usuarios/'.user_img($asAmigosRec['imagem']).'" /></a></span></li>';
									}
									
								}elseif($asRecados['para']=='todos'){
									echo '<li>&nbsp;todos</li>';
								}else{
									$dados = $objLogin->getDados($asRecados['para']);
									echo '<li><span><a href="perfil.php?uid='.$dados['id'].'" /><img title="'.$dados['nome'].' '.$dados['sobrenome'].'" src="uploads/usuarios/'.user_img($dados['imagem']).'" /></a></span></li>';
									//echo '<li><span><img src="uploads/usuarios/'.user_img($dados['imagem']).'" /></span></li>';
								}
								echo '</ul>';
								echo '</h3>
								
								
								<!--esta linha de css faz a quebra automatica das linhas
								vindas do formulario white-space:pre-wrap; -->
								
								<pre><p style="white-space:pre-wrap; width:90%;">'.htmlspecialchars($asRecados[7]).'</p></pre></li>';
							}
							echo '</ul>';
						}
						?>
                    </div>
                    
                </div><!--blocos-->
                
            </div><!--center-->
            
            <div class="right">
            
                <?php include('includes/amigos.php'); ?>
                                
            </div><!--right-->

                    
        </div><!--amarra-center-left-->
        
<?php include('includes/footer.php'); ?>