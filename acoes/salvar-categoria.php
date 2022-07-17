<?php
require('../bd/conexao.php');
session_start();

//Login só para Testes
//$_SESSION['LoginUsuario']='oficina-exemplo';

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
	}; 
	
if ($_POST['nomeCategoria']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../categorias.php"); exit;
	
}else{

$usuario=$_SESSION['LoginUsuario'];	

$categoria=$_POST['nomeCategoria'];
$icone=$_POST['icone'];

$text = preg_replace("/[^\w\s]/", "", iconv("UTF-8", "ASCII//TRANSLIT", $categoria));
$text = str_replace(" ", "-", $text);
$categoria_editada = strtolower($text);

$inserir="INSERT INTO `categorias` (nome_categoria,categoria,icone) value ('$categoria','$categoria_editada','$icone')";
$query = mysqli_query($conexao,$inserir)or die(mysqli_error());

if ($query == true) {
	header("Location: ../categorias.php?result=ok"); exit;
}else{
	header("Location: ../categorias.php?result=fail"); exit;
}
	
} 	






?>