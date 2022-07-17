<?php
require('../bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
	}; 
	
if ($_GET['id']=='' or $_GET['status']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../pedidos.php"); exit;
	
}; 	

$usuario=$_SESSION['LoginUsuario'];
$id=$_GET['id'];
$status=$_GET['status'];

$atualizaStatus="UPDATE pedidos SET status_pedido='$status' where id='$id'";
$dquery = mysqli_query($conexao,$atualizaStatus)or die(mysqli_error());



if ($dquery == true) {
	header("Location: ../pedidos.php?result=atualized"); exit;
}else{
	header("Location: ../pedidos.php?result=fail"); exit;
}

?>