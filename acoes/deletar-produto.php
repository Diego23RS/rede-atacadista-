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

		
$xdeleteconsulta = "DELETE FROM produtos WHERE id='$id'";
$xdeletequery = mysqli_query($conexao,$xdeleteconsulta) or die(mysqli_error());	


if ($xdeletequery == true) {
	header("Location: ../produtos.php?result=deleted"); exit;
}else{
	header("Location: ../produtos.php?result=fail"); exit;
}

?>