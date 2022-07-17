<?php
require('../bd/conexao.php');

session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
	}; 

//Variavel $nome recebe valor passado campo nome do post
$vaiPara= $_POST["vaiPara"];

//Se variavel nome for vazia escreve - nada para ver aqui curioso
if ($vaiPara==''){
	echo "ERRO 401 - ACESSO RESTRITO";
	exit;
}else{

if ($vaiPara=="produto"){
	// COMANDO SQL
$consulta = "SELECT * FROM `produtos` order by nome_produto";
$query = mysqli_query($conexao,$consulta) or die(mysqli_error());
$quantos=mysqli_num_rows($query);

if ($query == true) {
	
	if ($quantos>0){
	$resultado .="<option value=\"\" selected disabled>Selecione o produto</option>";
	while ($produto = mysqli_fetch_assoc($query)){
		$resultado .="<option value=\"".$produto['id']."\">".$produto['nome_produto']."</option>";
		
	} 
	}
	
	if ($quantos<1) {
		$resultado="<option value=\"\">Nenhum produto cadastrado</option>";
		
	}
	
} else {
	$resultado = 0;
}
	
	echo $resultado;
}


if ($vaiPara=="categoria"){
$bconsulta = "SELECT * FROM `categorias` order by nome_categoria";
$bquery = mysqli_query($conexao,$bconsulta) or die(mysqli_error());
$bquantos=mysqli_num_rows($bquery);

if ($bquery == true) {
	
	if ($bquantos>0){
		$resultado .="<option value=\"\" selected disabled>Selecione a Categoria</option>";
	while ($categoria = mysqli_fetch_assoc($bquery)){
		$resultado .="<option value=\"".$categoria['id']."\">".$categoria['nome_categoria']."</option>";
		
	} 
	}
	
	if ($bquantos<1) {
		$resultado .="<option value=\"\">Nenhuma categoria cadastrada</option>";
		
	}
	
} else {
	$resultado = 0;
}
	
	echo $resultado;	
}
	

	
}

 ?>