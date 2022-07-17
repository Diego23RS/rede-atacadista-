<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{

$id=$_POST['idFoto4'];

if(!empty($_FILES['foto4']['name'])){
$ext_imagem = strtolower(substr($_FILES['foto4']['name'],-4)); //Pegando extensão do arquivo
$puro_imagem = $id.date("Y.m.d-H.i.s") . $ext_imagem; //Definindo um novo nome para o arquivo
$new_name_imagem = $site.$caminho_imagem_produtos.$puro_imagem; //Definindo um novo nome para o arquivo
$dir_imagem = '../dist/img/produtos/'; //Diretório para uploads

//MOVENDO Imagem Doutor 
move_uploaded_file($_FILES['foto4']['tmp_name'], $dir_imagem.$puro_imagem); //Fazer upload do arquivo
}
	



$produto_inserir="UPDATE produtos SET foto4 = '$new_name_imagem' WHERE id = '$id'";
$produto_query = mysqli_query($conexao,$produto_inserir) or die(mysqli_error());

if ($produto_query== true) {
	header("Location: ../edit-produto.php?id=$id"); exit;
}else{
	header("Location: ../edit-produto.php?id=$id"); exit;
}

	
} 

 ?>