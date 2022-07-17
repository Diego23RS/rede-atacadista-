<?php
require('../bd/conexao.php');

$valida=mysqli_real_escape_string($conexao,$_POST["valida"]);

$idproduto= mysqli_real_escape_string($conexao,$_POST["idproduto"]);
$foto= mysqli_real_escape_string($conexao,$_POST["foto"]);


if ($valida!=='ckErGAiLIzanITErWINSagRUenoWNsoiNEwITBULatiCABLAnD'){
	echo "ERRO 401 - ACESSO NEGADO!";
	exit;
}else{
	
if (mysqli_query($conexao,"UPDATE produtos set $foto='' where id='$idproduto'")){
	
$erro=0; //TUDO OK
	
}else{
	$erro=1; //NÃO ENVIADO PARA BANCO - FALHOU
}

	echo $erro;
	
}



?>