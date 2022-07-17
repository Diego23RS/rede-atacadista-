<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{
$id=$_POST['qualid'];	
$nomeProduto=$_POST['nomeProduto'];
$categoriaProduto=$_POST['categoriaProduto'];
$tituloProduto=$_POST['tituloProduto'];
$subtituloProduto=$_POST['subtituloProduto'];
$precoProduto=$_POST['precoProduto'];
$descricaoProduto=$_POST['descricaoProduto'];

$hoje=date('d/m/Y');


$produto_inserir="UPDATE produtos SET nome_produto = '$nomeProduto', categoria = '$categoriaProduto',titulo='$tituloProduto', subtitulo='$subtituloProduto', preco='$precoProduto',descricao='$descricaoProduto' WHERE id = '$id'";
$produto_query = mysqli_query($conexao,$produto_inserir) or die(mysqli_error());

if ($produto_query== true) {
	header("Location: ../produtos.php?result=atualized"); exit;
}else{
	header("Location: ../produtos.php?result=fail"); exit;
}

	
} 

 ?>