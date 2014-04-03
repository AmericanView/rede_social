<?php 
	$nFotos = count($cache['fotos'][$albumId]);
?>

<li class="<?php echo $tipo ?> lista">

	<div class="foto">
		<a title="<?php echo $userNome ?>" href="perfil.php?uid=<?php echo $userId?>"><img src="uploads/usuarios/<?php echo $userImagem?>" /></a>
	</div>

	<div class="right">

		<div class="header">
			<a href="perfil.php?uid=<?php echo $userId?>">
				<?php echo $userNome ?></a> adicionou <?php echo $nFotos ?> fotos no álbum <a href="albuns.php?uid=<?php echo $userId?>&aid=<?php echo $albumId?>"><?php echo $albumTitulo?></a><?php echo '<span style="font-size:12px; font-weight:bold;"> - '.date('d/m/Y',strtotime($data)).'</span>' ?></div>

		<div class="imagens">
			<ul class="nFotos<?=$nFotos>4?4:$nFotos?>">
				<?php $i=0; foreach ($cache['fotos'][$albumId] as $fotoId=>$fotoSRC): ?>
				<li><a href="albuns.php?uid=<?php echo $userId?>&aid=<?php echo $albumId?>&fid=<?php echo $fotoId ?>">
					<img src="uploads/fotos/350/<?php echo $fotoSRC ?>" /></a></li>
				<?php $i++; if($i==4) break; endforeach?>
                <br />
                <?php
					if($idDaSessao <> $userId){
$conexao = mysql_connect('localhost','root',''); 
if (!$conexao) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao); 
$resultado = mysql_query("SELECT * FROM usuarios WHERE id = '".$userId."'"); 
while($linha = mysql_fetch_array($resultado)) 
{ 
?>

<?php
if($idDaSessao <> $linha['likou']){
?>

<form method="post" action="like.php" > 
<input type="hidden" name="id" value="<?php echo $linha['id']; ?>" /> 
<select style="display:none;" name="like" />
<option>1</option>
</select>
<input style="display:none;" type="text" name="likou" value="<?php echo $idDaSessao; ?>" />
<span style="margin-left:1%;">
<?php
echo '<input style="margin-top:3px;" type="image" src="./images/likeng.png" />';
$curtidas = mysql_query("SELECT * FROM usuarios WHERE id = '".$userId."'"); 
while($linha = mysql_fetch_array($curtidas))
if($linha['likes'] >= 1000000000){
echo ' Mais de <span id="num">1 BILHÃO</span> pessoas gostam das postagens de '.$userNome.'';}else{echo ' Outras <span id="num">'.number_format($linha['likes'],0,",",".").'</span> pessoas gostam das postagens de '.$userNome.'';}
?> 
</span>
</form>
<?php }else{echo'<span id="votou">[AVALIADO]</span>';}}}else{echo '';} ?> <!--fimlikes-->
			<?php
					if($idDaSessao <> $userId){
$conexao2 = mysql_connect('localhost','root',''); 
if (!$conexao2) 
{
die('Erro ao conectar: ' . mysql_error()); 
}

mysql_select_db('redesocial', $conexao2); 
$resultado2 = mysql_query("SELECT * FROM usuarios WHERE id = '".$userId."'"); 
while($linha = mysql_fetch_array($resultado2)) 
{ 
?>

<?php
if($idDaSessao <> $linha['likou']){
?>

<form method="post" action="unlike.php" > 
<input type="hidden" name="id" value="<?php echo $linha['id']; ?>" /> 
<select style="display:none;" name="unlike" />
<option>1</option>
</select>
<input type="text" name="likou" style="display:none;" value="<?php echo $idDaSessao ?>" />
<span style="margin-left:1%;">
<?php
echo '<input style="margin-top:5px;" type="image" src="./images/likeg.png" />';
$curtidas2 = mysql_query("SELECT * FROM usuarios WHERE id = '".$userId."'"); 
while($linha = mysql_fetch_array($curtidas2))
if($linha['unlikes'] >= 1000000000){
echo ' E mais de <span id="num2">1 BILHÃO</span> pessoas não gostam';}else{echo ' E outras <span id="num2">'.number_format($linha['unlikes'],0,",",".").'</span> pessoas não gostam';}
?> 
</span>
</form>
<?php }else{echo'<span id="votou">Obrigado '.$user_nome.'!</span>';}}}else{echo '';} ?> 
			</ul>	
		</div>

	</div>

</li>