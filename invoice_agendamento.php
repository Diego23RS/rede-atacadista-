<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
}else{

//PEDIDOS DE HOJE
$hoje=date('d/m/Y');

	if(empty($_GET)){
	//SE NAO TEM GET
	header("Location: relatorio.php"); exit;
	}else{
	$id=$_GET['id'];	
	
	$xconsulta = "SELECT * FROM `pedidos` where id='$id'";
	$xquery = mysqli_query($conexao,$xconsulta) or die(mysqli_error());
	$xquantos=mysqli_num_rows($xquery);
	
	if ($xquantos>0){
	$pedidohoje = mysqli_fetch_assoc($xquery);	
	
				$compradorEmail=$pedidohoje['comprador'];
				
				//SELECIONAR O Usuario
				$cliente_consulta = "SELECT * FROM `usuarios` where login='$compradorEmail'";
				$cliente_query = mysqli_query($conexao,$cliente_consulta) or die(mysqli_error());
				$dados_cliente = mysqli_fetch_assoc($cliente_query);
				
				$carrinhoID=$pedidohoje['carrinho'];
				
				//SELECIONAR O CARRINHO
				$carrinho_consulta = "SELECT * FROM `carrinho` where id_carrinho='$carrinhoID'";
				$carrinho_query = mysqli_query($conexao,$carrinho_consulta) or die(mysqli_error());
				$quantosCarrinho=mysqli_num_rows($carrinho_query);
	}
	else{
	header("Location: relatorio.php"); exit;	
	}
	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="#" rel="icon">
<title>Atacadista - Imprimir</title>
<meta name="author" content="harnishdesign.net">
<!-- Stylesheet
======================= -->
<link rel="stylesheet" type="text/css" href="invoice/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="invoice/all.min.css">
<link rel="stylesheet" type="text/css" href="invoice/stylesheet.css">
</head>
<body onload="window.print();">
<!-- Container -->
<div class="container-fluid invoice-container"> 
  
  <!-- Header -->
  <header>
    <div class="row align-items-center">
      <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0"> <h3><img id="logo" src="dist/img/wholesaler.png" title="Atacadista" alt="Atacadista"> <b>Atacadista</h3></b></div>
      <div class="col-sm-5 text-center text-sm-right">
        <h4 class="mb-0">CUPOM FISCAL</h4>
        <p class="mb-0">Data: <?php echo date("d/m/Y");?></p>
      </div>
    </div>
    <hr class="my-4">
  </header>
  
  <!-- Main Content -->
  <main>
  
    <div class="row">
	 <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Nome Cliente:</span><br>
        <span class="font-weight-500 text-3"><?php echo $dados_cliente['nome']; ?></span> </div>
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Endereço:</span><br>
        <span class="font-weight-500 text-3"><?php echo $pedidohoje['endereco_completo']; ?></span> </div>
      <div class="col-sm-4"><span class="text-black-50 text-uppercase">Telefone:</span><br>
        <span class="font-weight-500 text-3"><?php echo $dados_cliente['telefone']; ?></span> </div>
    </div>
    <hr class="my-4">
    <div class="row">
      <div class="col-sm-4"> <span class="text-black-50 text-uppercase">HORÁRIO:</span><br>
        <span class="font-weight-500 text-3"></span><?php echo $pedidohoje['hora_pedido']; ?> </div>
      <div class="col-sm-4"> <span class="text-black-50 text-uppercase">Código do Produto:</span><br>
        <span class="font-weight-500 text-3"><?php echo $pedidohoje['carrinho']; ?></span> </div>
      
    </div>
    <hr class="my-4">
    <div class="row">
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Quantidade:</span><br>
        <span class="font-weight-500 text-3"><?php echo $quantosCarrinho; ?></span> </div>
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Valor Total:</span><br>
        <span class="font-weight-500 text-3">R$<?php echo $pedidohoje['valorTotal']; ?></span> </div>
		 <div class="col-sm-4"><span class="text-black-50 text-uppercase">Status:</span><br>
        <span class="font-weight-500 text-3"><?php echo $pedidohoje['status_pedido'];?></span> </div>
    </div>
  </main>
  
  <!-- Footer -->
  <footer class="text-center">
  <hr class="my-4">
  <p><strong>Atacadista</strong><br>
    Avanida Rodovia Pe15, 4097<br>
    Cep:53350-015, Olinda - Tabajara - Pernambuco. </p>
  <hr>
  </footer>
  <!-- Footer -->
</div>
<!-- Back to My Account Link -->

</body>
</html>