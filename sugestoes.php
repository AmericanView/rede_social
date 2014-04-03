<?php include('includes/header.php'); ?>        
        <div id="amarra-center-left">
        
            <div class="center"><!--blocos-->

                <div class="blocos" id="pagina">
                	<h2 style="color:#ff6c00;">Olá <?php echo $user_nome ?>! Adicione essas pessoas, pois elas desejam lhe conhecer.</h2>
                    
                    <?php
					if(isset($_GET['perfil']) AND $_GET['perfil']=='UPLOAD'){
						
						?>
                        <form name="upload-foto-perfil" enctype="multipart/form-data" method="post" action="php/crop.php">
                        	<input type="file" name="foto-perfil" />
                            <input type="submit" value="recortar" />
                            <input type="hidden" name="imgantiga" value="<?php echo $user_imagem ?>" />
                            <input type="hidden" name="upload" value="perfil" />
                            <input type="hidden" name="uid" value="<?php echo $idDaSessao ?>"/>
                        </form>
                        <?php
						
					}
					?>
                    <?php

$conexao = mysql_connect('localhost','root','');
if (!$conexao)
{
die('Erro ao conectar: ' . mysql_error());
}

mysql_select_db('redesocial', $conexao);
$resultado = mysql_query("SELECT * FROM usuarios ORDER BY RAND() LIMIT 10");
$photo = mysql_query("SELECT * FROM usuarios WHERE imagem");
while($linha = mysql_fetch_array($resultado))
{
?> <a href="perfil.php?uid=<?php echo $linha['id']; ?>"> 
<img style="float:right;" width="10%" height="10%" src="uploads/usuarios/<?php echo $linha['imagem']; ?>">
<?php

echo "<br />"; 
}
?>
</a>
<?php 
mysql_close($conexao );
?>
              </div><!--blocos-->
                
            </div><!--center-->
            
            <div class="right">
            
                <?php include('includes/amigos2.php'); ?>
                                
            </div><!--right-->

                    
        </div><!--amarra-center-left-->
        
<?php include('includes/footer.php'); ?>