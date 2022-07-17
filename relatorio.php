<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
}else{

//PEDIDOS DE HOJE
$hoje=date('d/m/Y');

//HOJE
$xconsulta = "SELECT * FROM `pedidos` where data_pedido='$hoje' order by id desc";
$xquery = mysqli_query($conexao,$xconsulta) or die(mysqli_error($conexao));
$xquantos=mysqli_num_rows($xquery);

//SELECT HOJE
$sel_xconsulta = "SELECT * FROM `pedidos` where data_pedido='$hoje' order by id desc";
$sel_xquery = mysqli_query($conexao,$sel_xconsulta) or die(mysqli_error($conexao));
$sel_xquantos=mysqli_num_rows($sel_xquery);

//HISTORICO
$axconsulta = "SELECT * FROM `pedidos` where data_pedido!='$hoje' order by id desc";
$axquery = mysqli_query($conexao,$axconsulta) or die(mysqli_error($conexao));
$axquantos=mysqli_num_rows($axquery);

//SELECT HISTORICO
$asel_xconsulta = "SELECT * FROM `pedidos` where data_pedido!='$hoje' order by id desc";
$asel_xquery = mysqli_query($conexao,$asel_xconsulta) or die(mysqli_error($conexao));
$asel_xquantos=mysqli_num_rows($asel_xquery);

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-language" content="pt-br">
  <title>Vendas | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="shortcut icon" href="dist/img/icone.png" type="image/x-icon">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

  <!-- HEADER -->
  <?php include('layout/header.php'); ?>
 
 <!-- MENU -->
  <?php include('layout/menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom:25px;">
      <h1>
        <b>Relatórios do Pedidos</b><br>
        
		
      </h1>
	  
	  
    
    </section>

   <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<div class="row">
			<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><b>Hoje (<?php echo $xquantos; ?>)</b></a></li>
              <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-history"></i> Histórico de Pedidos</a></li>
                          
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
		
		<!-- TABELA -->
        <div class="col-md-12">
			
			<div class="box">
          
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
				<th class="hidden">ID</th>
				<th class="hidden">ID Carrinho</th>
                  <th>Cliente</th>
                  <th>Carrinho</th>
                  <th>Endereço de Entrega</th>
				  <th>Frete</th>
                  <th>Hora</th>
				  <th>Transação</th>
				  <th>Valor</th>
				  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
				<?php while ($pedidohoje = mysqli_fetch_assoc($xquery)){ 
				$compradorEmail=$pedidohoje['comprador'];
				$carrinhoID=$pedidohoje['carrinho'];
				
				//SELECIONAR O Usuario
				$cliente_consulta = "SELECT * FROM `usuarios` where login='$compradorEmail'";
				$cliente_query = mysqli_query($conexao,$cliente_consulta) or die(mysqli_error());
				$dados_cliente = mysqli_fetch_assoc($cliente_query);
				
				
				
				//SELECIONAR O CARRINHO
				$carrinho_consulta = "SELECT * FROM `carrinho` where id_carrinho='$carrinhoID'";
				$carrinho_query = mysqli_query($conexao,$carrinho_consulta) or die(mysqli_error());
				$quantosCarrinho=mysqli_num_rows($carrinho_query);
				
				
				?>
                <tr>
				<td class="hidden" style="vertical-align: middle;">
				   <?php echo $pedidohoje['id']; ?>				
				  </td>	
				  <td class="hidden" style="vertical-align: middle;">
				   <?php echo $pedidohoje['carrinho']; ?>				
				  </td>
                  <td style="vertical-align: middle;">
				  <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-cliente-<?php echo $pedidohoje['id']; ?>"><u><i class="fa fa-user"></i> <?php echo $dados_cliente['nome']; ?></u></a>				
				  </td>		  
                  <td style="vertical-align: middle;">
				  <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-carrinho-<?php echo $pedidohoje['id']; ?>"><u><i class="fa fa-shopping-cart"></i> <?php echo $quantosCarrinho; ?> Produtos</u></a>
                  </td>
                  <td style="vertical-align: middle;">
				  <?php echo $pedidohoje['endereco_completo']; ?>
				  </td>
				  <td style="vertical-align: middle;">
				  <?php if ($pedidohoje['frete']==''){ ?>
				  Grátis
				  <?php }else{ ?>
				  R$ <?php echo $pedidohoje['frete']; ?>
				  <?php }?>
				  </td>
                  <td style="vertical-align: middle;">
				 <?php echo $pedidohoje['hora_pedido']; ?>
				 
				  </td>
                  <td style="vertical-align: middle;">
				  <?php if ($pedidohoje['tipo_pagamento']=='creditCard'){ ?>
				 <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-transacao-<?php echo $pedidohoje['id']; ?>"><u>Cartão de Crédito <?php if($pedidohoje['status_pagamento']=="Disponível" or $pedidohoje['status_pagamento']=="Pago"){echo "<b style='color:green !important'><i class='fa fa-check-circle'></i></b>";}else{echo "<b style='color:red !important'><i class='fa fa-times'></i></b>";}?> </u></a>
				  <?php }else{ ?>
				  <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-transacao-<?php echo $pedidohoje['id']; ?>"><u>Boleto <?php if($pedidohoje['status_pagamento']=="Disponível" or $pedidohoje['status_pagamento']=="Pago"){echo "<b style='color:green !important'><i class='fa fa-check-circle'></i></b>";}else{echo "<b style='color:red !important'><i class='fa fa-times'></i></b>";}?></u></a>
				  <?php }?>
				  </td>
				  <td style="vertical-align: middle;">
				  R$ <?php echo $pedidohoje['valorTotal']; ?>
				  </td>
                </tr>
				
				 <div class="modal fade" id="modal-cliente-<?php echo $pedidohoje['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b><i class="fa fa-info-circle"></i> Cliente <?php echo $dados_cliente['nome']; ?></b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             <?php 
				  $telefoneWhats=$dados_cliente['telefone'];
				  $telefoneWhats = str_replace('(', "", $telefoneWhats);
				  $telefoneWhats = str_replace(')', "", $telefoneWhats);
				  $telefoneWhats = str_replace(' ', "", $telefoneWhats);
				  $telefoneWhats = str_replace('-', "", $telefoneWhats);
				 
				  ?>
				  
			  Email: <?php echo $dados_cliente['login']; ?><br><br>
			  Telefone: <a href="https://wa.me/55<?php echo $telefoneWhats; ?>?text=Ol%C3%A1"><i class="fa fa-whatsapp"></i> <?php echo $dados_cliente['telefone']; ?> </a><br><br>
			  CPF: <?php echo $dados_cliente['CPF']; ?><br><br>
			  Idade: <?php
				  //DESCOBRIR IDADE A PARTIR DA DATA DE NASCIMENTO
				   $data = $dados_cliente['data_nascimento'];
   
					// Separa em dia, mês e ano
					list($dia, $mes, $ano) = explode('/', $data);
				   
					// Descobre que dia é hoje e retorna a unix timestamp
					$whoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
					// Descobre a unix timestamp da data de nascimento do fulano
					$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
				   
					// Depois apenas fazemos o cálculo já citado :)
					$idade = floor((((($whoje - $nascimento) / 60) / 60) / 24) / 365.25);
					echo $idade;
				  ?> anos <br><br>
			  Cadastrou em <?php echo $dados_cliente['data_cadastro']; ?><br>
              </div>
              <div class="modal-footer">
			   
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		 <div class="modal fade" id="modal-carrinho-<?php echo $pedidohoje['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b><i class="fa fa-shopping-cart"></i> Itens no Carrinho</b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             <div class="row">
			 <?php 
			 $contador=0;
			 while ($dados_carrinho = mysqli_fetch_assoc($carrinho_query)){ 
			 $contador=$contador+1;
			 ?>
				<div class="col-md-3">
					<div class="card">
					  <div class="card-body">
					    Produto: <?php echo $contador; ?> 
						<img src="<?php echo $dados_carrinho['imagem_produto']; ?>" class="img-responsive"><br>
						<b><?php echo $dados_carrinho['produto']; ?></b><br>
						<span class="badge" style="font-size:18px">Pediu: <?php echo $dados_carrinho['quantidade']; ?> und.</span><br>
						Prec.Un: R$ <?php echo $dados_carrinho['preco_unitario']; ?><br>
						Total: R$ <?php echo $dados_carrinho['total']; ?>
						
					  </div>
					</div>
				</div>
			 <?php } ?> 	
			 </div>
			  
			  
              </div>
              <div class="modal-footer">
			   
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="modal-transacao-<?php echo $pedidohoje['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b>Status do Pagamento: <?php if($pedidohoje['status_pagamento']==""){echo "Não informado";}else{echo $pedidohoje['status_pagamento'];} ?></b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             Código da Transação PagSeguro: <br>
			 <h3><?php echo $pedidohoje['cod_transacao']; ?></h3><br>
			<?php if ($pedidohoje['tipo_pagamento']=="creditCard"){?>  
			 Tipo: Cartão de Crédito &nbsp; Bandeira: <?php echo $pedidohoje['bandeira_cartao']; ?> &nbsp; Final Cartão: <?php echo $pedidohoje['final_cartao']; ?> 
			<?php }else{?> 
			Tipo: Boleto &nbsp; <br><br>
			Link Boleto: <a href="<?php echo $pedidohoje['link_boleto']; ?>" target="_blank"><?php echo $pedidohoje['link_boleto']; ?></a> 
			<?php }?>
              </div>
              <div class="modal-footer">
			   
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		 <div class="modal modal-default fade" id="modal-confirmationHoje_<?php echo $pedidohoje['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Status Atual: <?php echo $pedidohoje['status_pedido']; ?></b></h4>
              </div>
              <div class="modal-body">
			  <b>Informações do Pedido</b><br>
				<p>Cliente: <?php echo $dados_cliente['nome']; ?><br>
				<?php if ($pedidohoje['tipo_pagamento']=="creditCard"){?>  
			 Tipo: Cartão de Crédito &nbsp; Bandeira: <?php echo $pedidohoje['bandeira_cartao']; ?> &nbsp; Final Cartão: <?php echo $pedidohoje['final_cartao']; ?> 
			<?php }else{?> 
			Tipo: Boleto &nbsp; 			 
			<?php }?> Status pagamento: <?php if($pedidohoje['status_pagamento']==""){echo "Não informado";}else{echo $pedidohoje['status_pagamento'];} ?><br>Valor Total: R$ <?php echo $pedidohoje['valorTotal']; ?></p>
                <h2><b>Mudando status para:</b><br> 
				<b id="statusHoje<?php echo $pedidohoje['id']; ?>"></b></h2>
              </div>
              <div class="modal-footer">
			  <a href="" id="confirma<?php echo $pedidohoje['id']; ?>" class="btn btn-success pull-left">Confirmar</a>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
	
   
   
		
		
				
				
                <?php } ?>
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->			
		
		  		
		</div>
				
		</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
				<div class="col-md-12">
			
			<div class="box">
          
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" style="width:100%" class="table table-bordered table-striped table-hover">
               <thead>
                <tr>
				<th class="hidden">ID</th>
				<th class="hidden">ID Carrinho</th>
                  <th>Cliente</th>
                  <th>Carrinho</th>
                  <th>Endereço de Entrega</th>
				  <th>Frete</th>
				  <th>Data</th>
                  <th>Hora</th>
				  <th>Transação</th>
				  <th>Valor</th>
				  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
				<?php while ($apedidohoje = mysqli_fetch_assoc($axquery)){ 
				$acompradorEmail=$apedidohoje['comprador'];
				$acarrinhoID=$apedidohoje['carrinho'];
				
				//SELECIONAR O Usuario
				$acliente_consulta = "SELECT * FROM `usuarios` where login='$acompradorEmail'";
				$acliente_query = mysqli_query($conexao,$acliente_consulta) or die(mysqli_error());
				$adados_cliente = mysqli_fetch_assoc($acliente_query);
				
				
				
				//SELECIONAR O CARRINHO
				$acarrinho_consulta = "SELECT * FROM `carrinho` where id_carrinho='$acarrinhoID'";
				$acarrinho_query = mysqli_query($conexao,$acarrinho_consulta) or die(mysqli_error());
				$aquantosCarrinho=mysqli_num_rows($acarrinho_query);
				
				
				?>
                <tr>
				<td class="hidden" style="vertical-align: middle;">
				   <?php echo $apedidohoje['id']; ?>				
				  </td>	
				  <td class="hidden" style="vertical-align: middle;">
				   <?php echo $apedidohoje['carrinho']; ?>				
				  </td>
                  <td style="vertical-align: middle;">
				  <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-cliente-<?php echo $apedidohoje['id']; ?>"><u><i class="fa fa-user"></i> <?php echo $adados_cliente['nome']; ?></u></a>				
				  </td>		  
                  <td style="vertical-align: middle;">
				  <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-carrinho-<?php echo $apedidohoje['id']; ?>"><u><i class="fa fa-shopping-cart"></i> <?php echo $aquantosCarrinho; ?> Produtos</u></a>
                  </td>
                  <td style="vertical-align: middle;">
				  <?php echo $apedidohoje['endereco_completo']; ?>
				  </td>
				  <td style="vertical-align: middle;">
				  <?php if ($apedidohoje['frete']==''){ ?>
				  Grátis
				  <?php }else{ ?>
				  R$ <?php echo $apedidohoje['frete']; ?>
				  <?php }?>
				  </td>
				  <td style="vertical-align: middle;">
				  <?php
					// Array com os dias da semana
					$diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');

					// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
					$data = $apedidohoje['data_pedido'];
					$nova_data = explode("/", $data);
					$data= $nova_data[2] . "-" . $nova_data[1] . "-" . $nova_data[0];

					// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
					$diasemana_numero = date('w', strtotime($data));

					// Exibe o dia da semana com o Array
					echo $diasemana[$diasemana_numero];
					?><br>
				<?php echo $apedidohoje['data_pedido'];  ?>
				  </td>
                  <td style="vertical-align: middle;">
				 <?php echo $apedidohoje['hora_pedido']; ?>
				 
				  </td>
                  <td style="vertical-align: middle;">
				  <?php if ($apedidohoje['tipo_pagamento']=='creditCard'){ ?>
				 <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-transacao-<?php echo $apedidohoje['id']; ?>"><u>Cartão de Crédito <?php if($apedidohoje['status_pagamento']=="Disponível" or $apedidohoje['status_pagamento']=="Pago"){echo "<b style='color:green !important'><i class='fa fa-check-circle'></i></b>";}else{echo "<b style='color:red !important'><i class='fa fa-times'></i></b>";}?> </u></a>
				  <?php }else{ ?>
				  <a href="#" style="color:blue;" data-toggle="modal" data-target="#modal-transacao-<?php echo $apedidohoje['id']; ?>"><u>Boleto <?php if($apedidohoje['status_pagamento']=="Disponível" or $apedidohoje['status_pagamento']=="Pago"){echo "<b style='color:green !important'><i class='fa fa-check-circle'></i></b>";}else{echo "<b style='color:red !important'><i class='fa fa-times'></i></b>";}?></u></a>
				  <?php }?>
				  </td>
				  <td style="vertical-align: middle;">
				  R$ <?php echo $apedidohoje['valorTotal']; ?>
				  </td>
				  
				 <td style="vertical-align: middle;">
				  		  
						<a href="invoice_agendamento.php?id=<?php echo $apedidohoje['id']; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Impimir</a>
				
				  </td>
                </tr>
				
				 <div class="modal fade" id="modal-cliente-<?php echo $apedidohoje['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b><i class="fa fa-info-circle"></i> Cliente <?php echo $adados_cliente['nome']; ?></b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             <?php 
				  $xtelefoneWhats=$adados_cliente['telefone'];
				  $xtelefoneWhats = str_replace('(', "", $xtelefoneWhats);
				  $xtelefoneWhats = str_replace(')', "", $xtelefoneWhats);
				  $xtelefoneWhats = str_replace(' ', "", $xtelefoneWhats);
				  $xtelefoneWhats = str_replace('-', "", $xtelefoneWhats);
				 
				  ?>
			  <i class="fa fa-envelope"></i> <?php echo $adados_cliente['login']; ?><br><br>
			  <a href="https://wa.me/55<?php echo $xtelefoneWhats; ?>?text=Ol%C3%A1"><i class="fa fa-whatsapp"></i> Telefone: <?php echo $adados_cliente['telefone']; ?> </a><br><br>
			  CPF: <?php echo $adados_cliente['CPF']; ?><br><br>
			  Idade: <?php
				  //DESCOBRIR IDADE A PARTIR DA DATA DE NASCIMENTO
				   $adata = $adados_cliente['data_nascimento'];
   
					// Separa em dia, mês e ano
					list($adia, $ames, $aano) = explode('/', $adata);
				   
					// Descobre que dia é hoje e retorna a unix timestamp
					$awhoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
					// Descobre a unix timestamp da data de nascimento do fulano
					$anascimento = mktime( 0, 0, 0, $ames, $adia, $aano);
				   
					// Depois apenas fazemos o cálculo já citado :)
					$aidade = floor((((($awhoje - $anascimento) / 60) / 60) / 24) / 365.25);
					echo $aidade;
				  ?> anos <br><br>
			  Cadastrou em <?php echo $adados_cliente['data_cadastro']; ?><br>
              </div>
              <div class="modal-footer">
			   
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		 <div class="modal fade" id="modal-carrinho-<?php echo $apedidohoje['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b><i class="fa fa-shopping-cart"></i> Itens no Carrinho</b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             <div class="row">
			 <?php 
			 $acontador=0;
			 while ($adados_carrinho = mysqli_fetch_assoc($acarrinho_query)){ 
			 $acontador=$acontador+1;
			 ?>
				<div class="col-md-3">
					<div class="card">
					  <div class="card-body">
					    Produto: <?php echo $acontador; ?> 
						<img src="<?php echo $adados_carrinho['imagem_produto']; ?>" class="img-responsive"><br>
						<b><?php echo $adados_carrinho['produto']; ?></b><br>
						<span class="badge" style="font-size:18px">Pediu: <?php echo $adados_carrinho['quantidade']; ?> und.</span><br>
						Prec.Un: R$ <?php echo $adados_carrinho['preco_unitario']; ?><br>
						Total: R$ <?php echo $adados_carrinho['total']; ?>
						
					  </div>
					</div>
				</div>
			 <?php } ?> 	
			 </div>
			  
			  
              </div>
              <div class="modal-footer">
			   
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="modal-transacao-<?php echo $apedidohoje['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b>Status do Pagamento: <?php if($apedidohoje['status_pagamento']==""){echo "Não informado";}else{echo $apedidohoje['status_pagamento'];} ?></b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             Código da Transação PagSeguro: <br>
			 <h3><?php echo $apedidohoje['cod_transacao']; ?></h3><br>
			<?php if ($apedidohoje['tipo_pagamento']=="creditCard"){?>  
			 Tipo: Cartão de Crédito &nbsp; Bandeira: <?php echo $apedidohoje['bandeira_cartao']; ?> &nbsp; Final Cartão: <?php echo $apedidohoje['final_cartao']; ?> 
			<?php }else{?> 
			Tipo: Boleto &nbsp; <br><br>
			Link Boleto: <a href="<?php echo $apedidohoje['link_boleto']; ?>" target="_blank"><?php echo $apedidohoje['link_boleto']; ?></a> 
			<?php }?>
              </div>
              <div class="modal-footer">
			   
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		 <div class="modal modal-default fade" id="modal-confirmationHoje_<?php echo $apedidohoje['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Status Atual: <?php echo $apedidohoje['status_pedido']; ?></b></h4>
              </div>
              <div class="modal-body">
			  <b>Informações do Pedido</b><br>
				<p>Cliente: <?php echo $adados_cliente['nome']; ?><br>
				<?php if ($apedidohoje['tipo_pagamento']=="creditCard"){?>  
			 Tipo: Cartão de Crédito &nbsp; Bandeira: <?php echo $apedidohoje['bandeira_cartao']; ?> &nbsp; Final Cartão: <?php echo $apedidohoje['final_cartao']; ?> 
			<?php }else{?> 
			Tipo: Boleto &nbsp; 			 
			<?php }?> Status pagamento: <?php if($apedidohoje['status_pagamento']==""){echo "Não informado";}else{echo $apedidohoje['status_pagamento'];} ?><br>Valor Total: R$ <?php echo $apedidohoje['valorTotal']; ?></p>
                <h2><b>Mudando status para:</b><br> 
				<b id="statusHoje<?php echo $apedidohoje['id']; ?>"></b></h2>
              </div>
              <div class="modal-footer">
			  <a href="" id="confirma<?php echo $apedidohoje['id']; ?>" class="btn btn-success pull-left">Confirmar</a>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
	
   
   
		
		
				
				
                <?php } ?>
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->			
		
		  		
		</div>
				</div>
              </div>
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
		</div>
		

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- FOOTER -->
  <?php include('layout/footer.php'); ?>
  
 
  
  
  <div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>SUCESSO</b></h4>
              </div>
              <div class="modal-body">
                <p>Paciente adicionado com sucesso!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal modal-success fade" id="modal-deleted">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>SUCESSO</b></h4>
              </div>
              <div class="modal-body">
                <p>Paciente removido com sucesso!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal modal-success fade" id="modal-atualized">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>SUCESSO</b></h4>
              </div>
              <div class="modal-body">
                <p>Status do Pedido atualizado com sucesso!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
				
		  <div class="modal modal-danger fade" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>FALHOU!</b></h4>
              </div>
              <div class="modal-body">
                <p>Houve algum problema. Tente novamente!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
				
		<div class="modal modal-danger fade" id="modal-emailrepeat">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>E-MAIL JÁ CADASTRADO!</b></h4>
              </div>
              <div class="modal-body">
                <p>Este e-mail já está cadastrado. Informe outro por favor!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
 
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
   $("#menuPedidos").addClass('active');
   $('#example1').DataTable({
	   //"scrollY": "50vh",
		"scrollCollapse": true,
		"order": [[ 0, "desc" ]]
   });
   
   $('#example2').DataTable({	   
		"scrollCollapse": true,
		"order": [[ 0, "desc" ]]
   });
   
  <?php while ($sel_pedidohoje = mysqli_fetch_assoc($sel_xquery)){ ?>
		$("#mudaStatusHoje_<?php echo $sel_pedidohoje['id']; ?>").on('change',function(){
	  var status= $("#mudaStatusHoje_<?php echo $sel_pedidohoje['id']; ?>").val();
	  $("#statusHoje<?php echo $sel_pedidohoje['id']; ?>").html(status);
	  $("#modal-confirmationHoje_<?php echo $sel_pedidohoje['id']; ?>").modal('show');
	  $("#confirma<?php echo $sel_pedidohoje['id']; ?>").attr("href","acoes/atualizar_status.php?id=<?php echo $sel_pedidohoje['id']; ?>&status="+status);
	  
   });
  <?php } ?> 
  
  <?php while ($asel_pedidohoje = mysqli_fetch_assoc($asel_xquery)){ ?>
		$("#mudaStatusHoje_<?php echo $asel_pedidohoje['id']; ?>").on('change',function(){
	  var status= $("#mudaStatusHoje_<?php echo $asel_pedidohoje['id']; ?>").val();
	  $("#statusHoje<?php echo $asel_pedidohoje['id']; ?>").html(status);
	  $("#modal-confirmationHoje_<?php echo $asel_pedidohoje['id']; ?>").modal('show');
	  $("#confirma<?php echo $asel_pedidohoje['id']; ?>").attr("href","acoes/atualizar_status.php?id=<?php echo $asel_pedidohoje['id']; ?>&status="+status);
	  
   });
  <?php } ?> 
   
   
    <?php if(empty($_GET)){ ?> 

<?php }else { ?> 

<?php if ($_GET['result']=='ok'){ ?>	
	$('#modal-success').modal('show');
	<?php }; ?> 
	
	<?php if ($_GET['result']=='atualized'){ ?>	
	$('#modal-atualized').modal('show');
	<?php }; ?> 
		
	<?php if ($_GET['result']=='deleted'){ ?>	
	$('#modal-deleted').modal('show');
	<?php }; ?>

	<?php if ($_GET['result']=='fail'){ ?>	
	$('#modal-danger').modal('show');
	<?php }; ?>	
			
	<?php if ($_GET['result']=='emailrepeat'){ ?>	
	$('#modal-emailrepeat').modal('show');
	<?php }; ?>
	 
<?php }; ?> 
   
});
</script>
</body>
</html>