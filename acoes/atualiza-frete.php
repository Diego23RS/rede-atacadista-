<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{


$temFrete=$_POST['temFrete'];
$precoFrete=$_POST['precoFrete'];

$Atualiza_frete_consulta = "UPDATE frete SET tem_frete = '$temFrete', preco_frete = '$precoFrete' WHERE id = '1'";
$Atualiza_frete_query = mysqli_query($conexao,$Atualiza_frete_consulta) or die(mysqli_error());


if ($Atualiza_frete_query == true) {
	header("Location: ../configuracoes.php?result=ok"); exit;
}else{
	header("Location: ../configuracoes.php?result=fail"); exit;
}

	
} 

 ?>