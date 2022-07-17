<?php
require('bd/conexao.php');

session_start();

//Login só para Testes
//$_SESSION['LoginUsuario']='oficina-exemplo';

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
}; 

$loginUser=$_SESSION['LoginUsuario'];

//SELECIONAR OS DADOS DO USUARIO LOGADO
$consulta = "SELECT * FROM `usuarios_administrativos` where login='$loginUser'";
$query = mysqli_query($conexao,$consulta) or die(mysqli_error());
$usuario = mysqli_fetch_assoc($query);

$nome=$usuario['nome'];


//SELECIONAR OS BANNERS
$xconsulta = "SELECT * FROM `banners` order by id";
$xquery = mysqli_query($conexao,$xconsulta) or die(mysqli_error());
$xquantos=mysqli_num_rows($xquery);

//SELECIONAR AS CIDADES
//$acidadeconsulta = "SELECT * FROM `cidades`";
//$acidadequery = mysqli_query($conexao,$acidadeconsulta) or die(mysqli_error());
//$acidadequantos=mysqli_num_rows($acidadequery);

$zxconsulta = "SELECT * FROM `produtos` order by nome_produto";
$zxquery = mysqli_query($conexao,$zxconsulta) or die(mysqli_error());
$zxquantos=mysqli_num_rows($zxquery);

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
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <!-- HEADER -->
  <?php include('layout/header.php'); ?>
 
 <!-- MENU -->
  <?php include('layout/menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Banners
        <small>Controle de Banners</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banners</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      
	  <div class="col-md-12">
	 <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Controle</a></li>
              <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-plus-circle"></i> Adicionar</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                
				<div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th class="hidden">ID</th>
				<th><i class="mdi mdi-camera"></i> Imagem</th>
				<th>Vai para</th>
				 <th>Alvo</th> 
				 <th>Colocado em:</th>
                 <th>Opções</th>   				  
                </tr>
                </thead>
                <tbody>
				<?php
				   if ($xquery == true) {
						if ($xquantos>0){
					while ($xbanners = mysqli_fetch_assoc($xquery)){
					$vaip=$xbanners['vai_para'];
					
					
					
					if ($vaip=="produto"){
						//PEGAR ANUNCIANTE
					$idAnunciante=$xbanners['alvo'];
					$anuncianteconsulta = "SELECT * FROM `produtos` where id='$idAnunciante'";
					$anunciantequery = mysqli_query($conexao,$anuncianteconsulta) or die(mysqli_error());
					$puxaanunciante = mysqli_fetch_assoc($anunciantequery);
					$anunciante=$puxaanunciante['nome_produto'];
					$resultadow=$anunciante;
					}
					
					if ($vaip=="categoria"){
						//PEGAR CATEGORIA
					$idCategoria=$xbanners['alvo'];
					$Categoriaconsulta = "SELECT * FROM `categorias` where id='$idCategoria'";
					$Categoriaquery = mysqli_query($conexao,$Categoriaconsulta) or die(mysqli_error());
					$puxaCategoria = mysqli_fetch_assoc($Categoriaquery);
					$Categoria=$puxaCategoria['nome_categoria'];
					$resultadow=$Categoria;
					}
					
					
									
					?>	
                <tr>
				 <td class="hidden"><?php echo $xbanners['id'] ?></td>
				 <?php if ($xbanners['imagem']==""){ ?>
				 <td><img src="dist/img/camera.jpg" width="40" height="40"></td>
				 <?php }else { ?>
				 <td><a href="#" data-toggle="modal" data-target="#modalImagem-<?php echo $xbanners['id'] ?>"><img src="<?php echo $xbanners['imagem'] ?>" width="40" height="40"></a></td>
				 <?php } ?>			 
				 <td><?php echo $xbanners['vai_para'] ?>
                  </td>
                  <td><?php echo $resultadow ?></td>
				  <td><?php echo $xbanners['data_postagem'] ?>
                  </td>
                 
                  <td>
				  <div class="btn-group">
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-<?php echo $xbanners['id'] ?>"><i class="fa fa-trash"></i> Excluir</button>
                     
                    </div>
				  
				  </td>
                                 
                </tr>
				
				<div class="modal fade" id="modalImagem-<?php echo $xbanners['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Imagem do banner</b></h4>
              </div>
              <div class="modal-body">
                <div class="row">
				<div class="col-md-12">
					
				<img style="max-width:100%;"  alt="" src="<?php echo $xbanners['imagem'] ?>">
							 
			 </div>
			 </div>
				
				
              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
				
				<div class="modal fade" id="modal-<?php echo $xbanners['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center"><b>CONFIRMAÇÃO</b></h4>
              </div>
              <div class="modal-body text-center">
                <p><b>Tem certeza que deseja deletar este banner abaixo? </b><br><br>
				<img style="max-width:100%;"  alt="" src="<?php echo $xbanners['imagem'] ?>">
				</p>
              </div>
              <div class="modal-footer">
			    <a href="acoes/deletar-banner.php?ref=<?php echo $xbanners['id'] ?>" class="btn btn-danger pull-left">Sim. Deletar!</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
				
					<?php }}}?>
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
             <form id="imagemForm" method="POST" action="acoes/adiciona-banner.php" enctype="multipart/form-data">   
			<div class="row">
			
			 <div class="col-md-4">
			 <label for="inputCity">Imagem do Banner<sup style="color:red"><b>*</b></sup></label>
			 <img id="imgPreview2" style="cursor:pointer;max-width:100%;" width="850" height="250" alt="" src="dist/img/banner-select.jpg">
			 <input type="file" name="imagemBanner" id="xfileImagem" accept="image/*" class="hidden" ><br><br>
			 
			 			 
			 </div>
			 
			 <div class="col-md-8">
			 
			
			 			
			<div id="divVaiPara" class="form-group col-md-4">
			<label for="inputCity">Vai para <sup style="color:red"><b>*</b></sup></label>
			  <select name="vaiPara" id="vaiPara" class="form-control" required>
                   
                     <option value="" disabled selected>Selecione uma opção</option>
					 <option value="categoria">Categoria</option>
					 <option value="produto">Produto</option>
					
                     
                  </select>
			</div>
			
			<div id="divAlvo" class="form-group col-md-4 hidden">
			<label for="inputCity">Alvo <sup style="color:red"><b>*</b></sup></label>
			  <select name="alvo" id="alvo" class="form-control" required>
                   
                     <option value="" disabled selected>Aguardando</option>
                    
                  </select>
			</div>
			
			
			
			
			
			
			
			<div id="divBotaoAtiva" class="form-group col-md-4 hidden">			
			<button type="submit" class="btn btn-block btn-success btn-lg">Adicionar Banner</button>
			</div>
			
			 
			 </div>
			 
			 
			
			</div>
			</form>
			
		
		
				
				
              </div>
              <!-- /.tab-pane -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
		
		
	  
      </div>
      <!-- /.row -->
      <!-- Main row -->
	  
	  
	  
	  

    </section>
    <!-- /.content -->
  </div>
  
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
                <p>Banner adicionado com sucesso!</p>
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
                <p>Banner removido com sucesso!</p>
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
		
		<div class="modal modal-success fade" id="modal-edited">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>SUCESSO</b></h4>
              </div>
              <div class="modal-body">
                <p>Banner editado com sucesso!</p>
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
		
		<div class="modal modal-danger fade" id="modal-semimagem">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>FALHOU!</b></h4>
              </div>
              <div class="modal-body">
                <p>Você não selecionou nenhuma imagem de banner. Por favor escolha uma imagem!</p>
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
		
		

 
</div>
<!-- ./wrapper -->

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
   $("#menuBanners").addClass('active');
           
   $(function () {
    $('#example1').DataTable();
	
	$('[data-toggle="tooltip"]').tooltip()
	
	<?php if(empty($_GET)){ ?> 

<?php }else { ?> 

<?php if ($_GET['result']=='ok'){ ?>	
	$('#modal-success').modal('show');
	<?php }; ?> 
	
	<?php if ($_GET['result']=='edited'){ ?>	
	$('#modal-edited').modal('show');
	<?php }; ?> 

	<?php if ($_GET['result']=='deleted'){ ?>	
	$('#modal-deleted').modal('show');
	<?php }; ?>

	<?php if ($_GET['result']=='fail'){ ?>	
	$('#modal-danger').modal('show');
	<?php }; ?>	
	
	<?php if ($_GET['result']=='semimagem'){ ?>	
	$('#modal-semimagem').modal('show');
	<?php }; ?>	
 
<?php }; ?> 
	
    
	
  })
  
  function readURL(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imgPreview').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}

		$("#fileImagem").change(function() {
		  readURL(this);
		 
		});
	
	$("#imgPreview").on('click', function() {
		$("#fileImagem").click();
	});
	
	function xreadURL(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imgPreview2').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}

		$("#xfileImagem").change(function() {
		  xreadURL(this);
		  
		});
	
	$("#imgPreview2").on('click', function() {
		$("#xfileImagem").click();
	});
	
	$(".middle").on('click', function() {
		$("#xfileImagem").click();
	});
	
	
	$("#vaiPara").on('change', function() {
		$("#alvo").empty();
		var vaiPara=$("#vaiPara").val();
		
		$.ajax({
		type: 'POST',
		data: {vaiPara:vaiPara},
		url: 'acoes/puxar-alvo.php',
		crossDomain: true,
				
		success: function (resposta) {
		//alert(resposta);
		if (resposta !== '0') {
		
		$("#alvo").append(resposta);
		$("#divAlvo").removeClass('hidden');
		}

		if (resposta == 0) {
		
		$('#modal-danger').modal('show');
		
		}

		},

		error: function (erro) {

		alert('Erro ao puxar: ' + erro.responseText);

		//RETORNO DE ERRO. NORMALMENTE ASSOCIADO A FALTA DE INTERNET OU NÃO COMUNICAÇÃO COM O ARQUIVO PHP;

		}


		});
	});
	
	$("#alvo").on('change', function() {
		$("#divBotaoAtiva").removeClass('hidden');
	});
	
	
   
});
</script>

 
	
	
</body>
</html>
