<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{


$emailPagseguro=$_POST['emailPagseguro'];
$tokenPagseguro=$_POST['tokenPagseguro'];

$Atualiza_pag_consulta = "UPDATE api_pagseguro SET email_pagseguro = '$emailPagseguro', token_pagseguro = '$tokenPagseguro' WHERE id = '1'";
$Atualiza_pag_query = mysqli_query($conexao,$Atualiza_pag_consulta) or die(mysqli_error());


if ($Atualiza_pag_query == true) {
	header("Location: ../configuracoes.php?result=ok"); exit;
}else{
	header("Location: ../configuracoes.php?result=fail"); exit;
}

	
} 

 ?>