<?php
require('../bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
	}; 
	
if ($_GET['ref']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../banners.php"); exit;
	
}; 	

$usuario=$_SESSION['LoginUsuario'];
$id=$_GET['ref'];

$deleta="DELETE FROM banners WHERE id='$id'";
		$dquery = mysqli_query($conexao,$deleta)or die(mysqli_error());

if ($dquery == true) {
	header("Location: ../banners.php?result=deleted"); exit;
}else{
	header("Location: ../banners.php?result=fail"); exit;
}

?>