<?php
require('../bd/conexao.php');
session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{

//diretório para salvar as imagens
$diretorio ='../dist/img/produtos/';
//Verificar a existência do diretório para salvar as imagens e informa se o caminho é um diretório
if(!is_dir($diretorio)){ 
    //echo "Pasta $diretorio nao existe";
}else{    
    $arquivo = isset($_FILES['foto']) ? $_FILES['foto'] : FALSE;
    //loop para ler as imagens
    for ($controle = 0; $controle < count($arquivo['name']); $controle++){        
        $destino = $diretorio."/".$arquivo['name'][$controle];
		$extensao = strtolower(substr($arquivo['name'][$controle],-4));
		$criptografa=sha1($arquivo['name'][$controle]);
		$novo_nome = $criptografa.date("Y.m.d-H.i.s").$extensao;
		$link =$site.$caminho_imagem_produtos.$novo_nome;
        //realizar o upload da imagem em php
        //move_uploaded_file — Move um arquivo enviado para uma nova localização
        if(move_uploaded_file($arquivo['tmp_name'][$controle], $diretorio.$novo_nome)){
            $foto[$controle]=$link;
			//echo "Upload Realizado<br>";
        }else{
            echo "Erro ao realizar upload";
        }        
    }

$foto1=$foto[0];
$foto2=$foto[1];
$foto3=$foto[2];
$foto4=$foto[3];
$foto5=$foto[4];

	
}
	
$nomeProduto=$_POST['nomeProduto'];
$categoriaProduto=$_POST['categoriaProduto'];
$tituloProduto=$_POST['tituloProduto'];
$subtituloProduto=$_POST['subtituloProduto'];
$precoProduto=$_POST['precoProduto'];
$descricaoProduto=$_POST['descricaoProduto'];

$hoje=date('d/m/Y');


$produto_inserir="INSERT INTO `produtos` (nome_produto,imagemPrincipal,foto2,foto3,foto4,foto5,categoria,titulo,subtitulo,preco,descricao,data_cadastro) value ('$nomeProduto','$foto1','$foto2','$foto3','$foto4','$foto5','$categoriaProduto','$tituloProduto','$subtituloProduto','$precoProduto','$descricaoProduto','$hoje')";
$produto_query = mysqli_query($conexao,$produto_inserir) or die(mysqli_error());

if ($produto_query== true) {
	header("Location: ../produtos.php?result=ok"); exit;
}else{
	header("Location: ../produtos.php?result=fail"); exit;
}

	
} 

 ?>