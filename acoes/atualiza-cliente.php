<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{

$usuario=$_SESSION['LoginUsuario'];	

$idCliente=$_POST['idCliente'];
$nomeCompleto=$_POST['nomeCompleto'];
$loginCliente=$_POST['loginCliente'];
$senhaCliente=$_POST['senhaCliente'];
$dataNascimento=$_POST['dataNascimento'];
$CPF=$_POST['CPF'];

$telefone=$_POST['whats'];
$senhaCliente= sha1($senhaCliente);


$hoje=date('Y-m-d');

$Atualiza_usuarios_consulta = "UPDATE usuarios SET nome = '$nomeCompleto', login = '$loginCliente',senha='$senhaCliente',data_nascimento='$dataNascimento',telefone='$telefone',CPF='$CPF' WHERE id = '$idCliente'";
$Atualiza_usuarios_query = mysqli_query($conexao,$Atualiza_usuarios_consulta) or die(mysqli_error());


if ($Atualiza_usuarios_query == true) {
	header("Location: ../clientes.php?result=atualized"); exit;
}else{
	header("Location: ../clientes.php?result=fail"); exit;
}

	
} 

 ?>