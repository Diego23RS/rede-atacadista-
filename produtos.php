<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
}else{
	//SELECIONAR OS PACIENTES
$xconsulta = "SELECT * FROM `produtos` order by nome_produto";
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
   <link rel="stylesheet" href="dist/css/materialdesignicons.css">
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
<body class="hold-transition skin-yellow-light sidebar-mini">
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
        <b>Produtos</b>
        
      </h1>
	  
	 
	  <ol class="breadcrumb text-center">
        <li>
		<a href="add-produto.php" class="btn btn-block btn-lg btn-info" style="color:white; border-radius:20px;"><b><i class="fa fa-plus"></i> Adicionar Produto</b></a>
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
              <h3 class="box-title"><b>Lista de Produtos</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
				<th class="hidden">Produto</th>
                  <th><i class="fa fa-photo"></i></th>
                  <th>Produto</th>
                  <th>Categoria</th>
                  <th>Titulo</th>
                  <th>Subtitulo</th>
				  <th>Descrição</th>
				  <th>Preço (R$)</th>
				  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($xproduto = mysqli_fetch_assoc($xquery)){ 
				$idCategoria=$xproduto['categoria'];
				//SELECIONAR OS ENDERECOS
				$Categoria_consulta = "SELECT * FROM `categorias` where id='$idCategoria'";
				$Categoria_query = mysqli_query($conexao,$Categoria_consulta) or die(mysqli_error());
				$quantosCategoria=mysqli_num_rows($Categoria_query);
				$xcategoria = mysqli_fetch_assoc($Categoria_query);
				
				?>
				<tr>
				<td style="vertical-align: middle;" class="hidden"><b><?php echo $xproduto['nome_produto']; ?></b></td>
                  <td style="vertical-align: middle;"><a href="#" data-toggle="modal" data-target="#modal-<?php echo $xproduto['id'] ?>"> <img src="<?php if ($xproduto['imagemPrincipal']=='') { ?> dist/img/produto.png <?php } else { ?> <?php echo $xproduto['imagemPrincipal'];} ?>" width="50" height="50"></a>&nbsp; </td>
                   <td style="vertical-align: middle;"><b><?php echo $xproduto['nome_produto']; ?></b></td>
				   <td style="vertical-align: middle;"><b><?php echo $xcategoria['icone']; ?> <?php echo $xcategoria['nome_categoria']; ?></b></td>
				   <td style="vertical-align: middle;"><?php echo $xproduto['titulo']; ?></td>
				   <td style="vertical-align: middle;"><?php echo $xproduto['subtitulo']; ?></td>
				   <td style="vertical-align: middle;"><a href="#" data-toggle="modal" data-target="#modal-descricao-<?php echo $xproduto['id'] ?>">Ler Descrição</td>
				   <td style="vertical-align: middle;"><?php echo $xproduto['preco']; ?></td>
				   
				  <td style="vertical-align: middle;">
				  
				  
				  
				 
				   <a href="edit-produto.php?id=<?php echo $xproduto['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a>
				   &nbsp;&nbsp;&nbsp;
				    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-deleta-<?php echo $xproduto['id'] ?>"><i class="fa fa-trash"></i> Deletar</a>
				 
					
				  </td>
                </tr>
				
				<div class="modal fade" id="modal-<?php echo $xproduto['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center"><b><?php echo $xproduto['nome_produto'] ?></b></h4>
              </div>
              <div class="modal-body">
                <center><img src="<?php if ($xproduto['imagemPrincipal']=='') { ?> dist/img/user.png <?php } else { ?> <?php echo $xproduto['imagemPrincipal'];} ?>" class="img-responsive" style="min-width:300px"><br>
				
				<div class="row">
				<center>
					<div class="col-md-3">
					<img src="<?php if ($xproduto['foto2']=='') { ?> dist/img/user.png <?php } else { ?> <?php echo $xproduto['foto2'];} ?>" class="img-responsive">
					</div>
					<div class="col-md-3">
					<img src="<?php if ($xproduto['foto3']=='') { ?> dist/img/user.png <?php } else { ?> <?php echo $xproduto['foto3'];} ?>" class="img-responsive">
					</div>
					<div class="col-md-3">
					<img src="<?php if ($xproduto['foto4']=='') { ?> dist/img/user.png <?php } else { ?> <?php echo $xproduto['foto4'];} ?>" class="img-responsive" >
					</div>
					<div class="col-md-3">
					<img src="<?php if ($xproduto['foto5']=='') { ?> dist/img/user.png <?php } else { ?> <?php echo $xproduto['foto5'];} ?>" class="img-responsive">
					</div>
				</center>	
				</div>
				
				</center>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="modal-descricao-<?php echo $xproduto['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center"><b>Descrição do <?php echo $xproduto['nome_produto'] ?></b></h4>
              </div>
              <div class="modal-body">
                <center><?php echo $xproduto['descricao'] ?></center>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		
		<div class="modal fade" id="modal-deleta-<?php echo $xproduto['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>CONFIRMAÇÃO</b></h4>
              </div>
              <div class="modal-body">
                <p><b style="color:red"><i class="fa fa-warning"></i> Atenção: Essa ação é irreversível!</b><br> Tem certeza que deseja deletar produto <b><?php echo $xproduto['nome_produto'] ?></b>?<br><br></p>
				<p> Esta ação <b>não excluirá</b> pedidos realizados que contenham este produto.</p>
              </div>
              <div class="modal-footer">
			    <a href="acoes/deletar-produto.php?ref=<?php echo $xproduto['id'] ?>" class="btn btn-danger pull-left">Sim. Deletar!</a>
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
                <p>Produto adicionado com sucesso!</p>
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
                <p>Produto removido com sucesso!</p>
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
                <p>Produto atualizado com sucesso!</p>
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
   $("#menuProdutos").addClass('active');
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