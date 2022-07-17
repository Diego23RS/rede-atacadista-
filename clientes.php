<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
}else{
	//SELECIONAR OS PACIENTES
$xconsulta = "SELECT * FROM `usuarios` order by nome";
$xquery = mysqli_query($conexao,$xconsulta) or die(mysqli_error());
$xquantos=mysqli_num_rows($xquery);
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
<body class="hold-transition skin-purple-light sidebar-mini">
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
        <b>Clientes</b>
        
      </h1>
	  
	  
	  <ol class="breadcrumb text-center">
        <li>
		<a href="add-cliente.php" class="btn btn-block btn-lg btn-info" style="color:white; border-radius:20px;"><b><i class="fa fa-plus"></i> Adicionar Cliente</b></a>
		</li>
      </ol>
	 
    
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		
		<div class="row">
		
		<!-- TABELA -->
        <div class="col-md-12">
			
<div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Lista de Clientes</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th>Idade</th>
                  <th>Endereço(s)</th>
                  <th>Telefone</th>
                  <th>Email</th>
				  <th>CPF</th>
				  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($xclientes = mysqli_fetch_assoc($xquery)){ ?>
				<tr>
                  <td style="vertical-align: middle;"><b><?php echo $xclientes['nome']; ?></b></td>
                  <td style="text-align:center;vertical-align: middle;">
				  <?php
				  //DESCOBRIR IDADE A PARTIR DA DATA DE NASCIMENTO
				   $data = $xclientes['data_nascimento'];
   
					// Separa em dia, mês e ano
					list($dia, $mes, $ano) = explode('/', $data);
				   
					// Descobre que dia é hoje e retorna a unix timestamp
					$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
					// Descobre a unix timestamp da data de nascimento do fulano
					$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
				   
					// Depois apenas fazemos o cálculo já citado :)
					$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
					echo $idade;
				  ?> anos
                  </td>
                  <td style="vertical-align: middle;">
				  <?php 
				  $idusuario = $xclientes['id'];
				  //SELECIONAR OS ENDERECOS
				$clienteEnd_consulta = "SELECT * FROM `enderecos` where idusuario='$idusuario'";
				$clienteEnd_query = mysqli_query($conexao,$clienteEnd_consulta) or die(mysqli_error());
				$quantosEnderecos=mysqli_num_rows($clienteEnd_query);
				  
				  ?>
				  <?php if ($quantosEnderecos==0){ ?>
				  Nenhum Cadastrado
				  <?php }else{ ?>
				   <a href="#" data-toggle="modal" data-target="#modal-endereco-<?php echo $xclientes['id'] ?>">
				   <i class="fa fa-map-marker"></i> <?php echo $quantosEnderecos; ?> Endereço(s)</a>
				  <?php } ?> 
				  </td>
                  <td style="vertical-align: middle;">
				  <?php 
				  $telefoneWhats=$xclientes['telefone'];
				  $telefoneWhats = str_replace('(', "", $telefoneWhats);
				  $telefoneWhats = str_replace(')', "", $telefoneWhats);
				  $telefoneWhats = str_replace(' ', "", $telefoneWhats);
				  $telefoneWhats = str_replace('-', "", $telefoneWhats);
				 
				  ?>
				  <a href="https://wa.me/55<?php echo $telefoneWhats; ?>?text=Ol%C3%A1"><i class="fa fa-whatsapp"></i> <?php echo $xclientes['telefone']; ?> </a>
				  </td>
                  <td style="vertical-align: middle;"><i class="fa fa-envelope"></i> <?php echo $xclientes['login']; ?></td>
				   <td style="vertical-align: middle;"> <?php echo $xclientes['CPF']; ?></td>
				  <td style="vertical-align: middle;">
				  <a href="https://wa.me/55<?php echo $telefoneWhats; ?>?text=Ol%C3%A1" class="btn btn-social-icon bg-olive btn-bitbucket" target="_blank"><i class="fa fa-whatsapp"></i></a>
				  &nbsp;&nbsp;&nbsp;
				  
				  
				   
				    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-deleta-<?php echo $xclientes['id'] ?>"><i class="fa fa-trash"></i> Deletar</a>
				  
					
				  </td>
                </tr>
		
		<div class="modal fade" id="modal-endereco-<?php echo $xclientes['id']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center"><b><i class="fa fa-map-marker"></i> Endereços Cadastrados</b></h2>
              </div>
              <div class="modal-body text-center" style="font-size:20px;">
             <div class="row">
			 <?php 
			 $contador=0;
			 while ($endereco = mysqli_fetch_assoc($clienteEnd_query)){ 
			 $contador=$contador+1;
			 ?>
				<div class="col-md-3">
					<div class="card">
					  <div class="card-body">
					    <?php echo $contador; ?>) <b><?php echo $endereco['logradouro']; ?>, <?php echo $endereco['numero']; ?>,</b> 
						<?php echo $endereco['complemento']; ?><br> <?php echo $endereco['bairro']; ?>, <?php echo $endereco['cidade']; ?> - <?php echo $endereco['estado']; ?><br>
						CEP: <?php echo $endereco['CEP']; ?>
						
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
		
		
		<div class="modal fade" id="modal-deleta-<?php echo $xclientes['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>CONFIRMAÇÃO</b></h4>
              </div>
              <div class="modal-body">
                <p><b style="color:red"><i class="fa fa-warning"></i> Atenção: Essa ação é irreversível!</b><br> Tem certeza que deseja deletar cliente <b><?php echo $xclientes['nome'] ?></b>?<br><br>Isso vai remover também todo <b>histórico de pedidos deste usuário</b> e <b>endereços</b> relacionados a este usuário.</p>
              </div>
              <div class="modal-footer">
			    <a href="acoes/deletar-cliente.php?ref=<?php echo $xclientes['id'] ?>" class="btn btn-danger pull-left">Sim. Deletar!</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               
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
                <p>Cliente adicionado com sucesso!</p>
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
                <p>Cliente removido com sucesso!</p>
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
                <p>Cliente atualizado com sucesso!</p>
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
   $("#menuClientes").addClass('active');
   $('#example1').DataTable({
	   "scrollY": "50vh",
		"scrollCollapse": true,
   });
   
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