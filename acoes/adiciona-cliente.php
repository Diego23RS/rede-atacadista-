<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{

$usuario=$_SESSION['LoginUsuario'];	

$nomeCompleto=$_POST['nomeCompleto'];
$loginCliente=$_POST['loginPaciente'];
$senhaCliente=$_POST['senhaPaciente'];
$dataNascimento=$_POST['dataNascimento'];
$CPF=$_POST['CPF'];
$whats=$_POST['whats'];

$senhaCliente= sha1($senhaPaciente);

//VERIFICAR SE JÁ TEM AQUELE E-MAIL CADASTRADO
$Aconsulta = "SELECT * FROM `usuarios` where login='$loginCliente'";
$Aquery = mysqli_query($conexao,$Aconsulta) or die(mysqli_error());
$Aquantos=mysqli_num_rows($Aquery);

if ($Aquantos==1){
	header("Location: ../clientes.php?result=emailrepeat"); exit;
}else{
$hoje=date('d/m/Y');

$cliente_inserir="INSERT INTO `usuarios` (login,senha,nome,data_nascimento,telefone,CPF,data_cadastro) value ('$loginCliente','$senhaCliente','$nomeCompleto','$dataNascimento','$whats','$CPF','$hoje')";
$cliente_query = mysqli_query($conexao,$cliente_inserir) or die(mysqli_error());

if ($cliente_query== true) {
	header("Location: ../clientes.php?result=ok"); exit;
}else{
	header("Location: ../clientes.php?result=fail"); exit;
}
}
	
} 

 ?>