<?php
require('../bd/conexao.php');
session_start();

//Login só para Testes
//$_SESSION['LoginUsuario']='oficina-exemplo';

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
	}; 
	
if ($_GET['ref']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../categorias.php"); exit;
	
}; 	

$usuario=$_SESSION['LoginUsuario'];
$id=$_GET['ref'];

$deleta="DELETE FROM categorias WHERE id='$id'";
		$dquery = mysqli_query($conexao,$deleta)or die(mysqli_error());

if ($dquery == true) {
	header("Location: ../categorias.php?result=deleted"); exit;
}else{
	header("Location: ../categorias.php?result=fail"); exit;
}

?>