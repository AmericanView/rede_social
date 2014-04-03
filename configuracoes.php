<?php include('includes/header.php'); ?>        
        <div id="amarra-center-left">
        
            <div class="center">
               
                <div class="blocos" id="dexar-recados">
                    <h2><?php echo ($idDaSessao<>$idExtrangeiro) ? $user_fullname : 'Meu perfil'; ?>
                    <span>
                    <?php 
					if($idDaSessao<>$idExtrangeiro){	
						
						$solicitacao = Amisade::solicitacao($idDaSessao,$idExtrangeiro);
						
						$link = '<a href="php/amisade.php?ac=';		
						
						if($solicitacao['r']==0){
							echo $link.'convite|'.$idDaSessao.'|'.$idExtrangeiro.'">adicionar amigo</a>';
						}elseif($solicitacao['r']==1){
							echo $link.'remover|'.$idDaSessao.'|'.$idExtrangeiro.'|'.$solicitacao['id'].'">cancelar pedido</a>';
						}elseif($solicitacao['r']==2){
							echo $link.'remover|'.$idDaSessao.'|'.$idExtrangeiro.'|'.$solicitacao['id'].'">desfazer amizade</a>';
						}
					}
					?>
                                        
                    </span></h2>
                    
                    
                </div><!--blocos-->

                <div class="blocos" id="pagina">
                	<h2>perfil</h2>
                    
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
                    <div id="luma">
                    <br />
                    <?php
$id = $_GET['id']; // Recebendo o valor vindo do link
$conexao = mysql_connect('localhost','root',''); // Mapeando o caminho do banco de dados
if (!$conexao) // Verificando se existe conexão com o caminho mapeado
{
die('Erro ao conectar: ' . mysql_error()); // Caso o caminho esteja errado, o usuário ou a senha esteja errado, irá mostrar esta mensagem
}

mysql_select_db('redesocial', $conexao); // Selecionando o banco de dados
$resultado = mysql_query("SELECT * FROM usuarios WHERE id = '".$id."'"); // Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_array($resultado)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>
<form method="post" action="editar2.php" >
<input type="hidden" name="id" value="<?php echo $linha['id']; ?>" /> 
Nome:<br /> <input style="width:50%; background-color:#f8f8f8;" type="text" name="nome" value="<?php echo $linha['nome']; ?>" /> <br /><br />
Sobrenome:<br /> <input style="width:50%; background-color:#f8f8f8;" type="text" name="sobrenome" value="<?php echo $linha['sobrenome']; ?>" /> <br /><br />
Telefone:<br /> <input style="width:50%; background-color:#f8f8f8;" type="text" name="telefone" maxlength="11" value="<?php echo $linha['telefone']; ?>" /> <br /><br />
E-mail:<br /> <input style="width:50%; background-color:#f8f8f8;" type="text" name="emailform" value="<?php echo $linha['emailform']; ?>" /> <br /><br />
Interesse em:<br /> <select style="width:50%; background-color:#f8f8f8;" name="interesse">
            <option><?php echo $linha['interesse'] ?></option>
            <option>Homens</option>
			<option>Mulheres</option>
			<option>Homens e Mulheres</option>
		</select> <br /><br />
        Status de relacionamento:<br /> <select style="width:50%; background-color:#f8f8f8;" name="relacionamento">
            <option><?php echo $linha['relacionamento'] ?></option>
            <option>Solteiro(a)</option>
			<option>Em um relacionamento sério</option>
			<option>Noivo(a)</option>
            <option>Casado(a)</option>
            <option>Em um relacionamento aberto</option>
            <option>Em um relacionamento enrolado</option>
            <option>Separado(a)</option>
            <option>Divorciado(a)</option>
            <option>Viúvo(a)</option>
		</select> <br /><br />
        Colégio:<br /> <select style="width:50%; background-color:#f8f8f8;" name="colegio">
            <option><?php echo $linha['colegio'] ?></option>
            <option>Ainda não</option>
            <option>Cursando</option>
			<option>Completo</option>
		</select> <br /><br />
        Faculdade:<br /> <select style="width:50%; background-color:#f8f8f8;" name="faculdade">
            <option><?php echo $linha['faculdade'] ?></option>
            <option>Ainda não</option>
            <option>Cursando</option>
			<option>Completo</option>
		</select> <br /><br />
Sobre mim:<br /> <textarea style="width:100%; height:200px; background-color:#f8f8f8;" type="text" name="sobre" maxlength="1000"><?php echo $linha['sobre']; ?></textarea> <br /><br />
<input type="image" src="images/salvar.png" value="Finalizar" />

</form>
<?php
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