<?php
require('../bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
	}; 
	
if ($_GET['ref']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../pedidos.php"); exit;
	
}; 	

$usuario=$_SESSION['LoginUsuario'];
$id=$_GET['ref'];

$consulta = "SELECT * FROM `usuarios` where id='$id'";
$query = mysqli_query($conexao,$consulta) or die(mysqli_error());
$cliente = mysqli_fetch_assoc($query);

$loginOriginal=$cliente['login'];

$deleta="DELETE FROM usuarios WHERE login='$loginOriginal'";
$dquery = mysqli_query($conexao,$deleta)or die(mysqli_error());
		
$xdeleteconsulta = "DELETE FROM pedidos WHERE comprador='$loginOriginal'";
$xdeletequery = mysqli_query($conexao,$xdeleteconsulta) or die(mysqli_error());	

$carrinhoxdeleteconsulta = "DELETE FROM carrinho WHERE comprador='$loginOriginal'";
$carrinhoxdeletequery = mysqli_query($conexao,$carrinhoxdeleteconsulta) or die(mysqli_error());

$enderecoxdeleteconsulta = "DELETE FROM enderecos WHERE idusuario='$id'";
$enderecoxdeletequery = mysqli_query($conexao,$enderecoxdeleteconsulta) or die(mysqli_error());

if ($dquery == true) {
	header("Location: ../clientes.php?result=deleted"); exit;
}else{
	header("Location: ../clientes.php?result=fail"); exit;
}

?>