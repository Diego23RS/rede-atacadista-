<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
} else{
	if(empty($_GET)){
	//SE NAO TEM GET
	header("Location: produtos.php"); exit;
	}else{
	$id=$_GET['id'];	
	
	$xconsulta = "SELECT * FROM `produtos` where id='$id'";
	$xquery = mysqli_query($conexao,$xconsulta) or die(mysqli_error());
	$xquantos=mysqli_num_rows($xquery);
	
	//SELECIONAR AS CATEGORIAS
	$catxconsulta = "SELECT * FROM `categorias` order by categoria";
	$catxquery = mysqli_query($conexao,$catxconsulta) or die(mysqli_error());
	$catxquantos=mysqli_num_rows($catxquery);
	
	if ($xquantos>0){
	$xproduto = mysqli_fetch_assoc($xquery);	
	}else{
	header("Location: produtos.php"); exit;	
	}
	
	}
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
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="shortcut icon" href="dist/img/icone.png" type="image/x-icon">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
    <section class="content-header" style="margin-bottom:25px;">
      
	  <h1>
	  <a href="produtos.php"><i class="fa fa-arrow-left"></i></a>&nbsp;&nbsp;&nbsp;
        <b>Editar Produto</b>
        
      </h1>
    
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
				
				<div class="row">
					<div class="col-md-12">
					
					<div class="col-md-3">
					<div class="form-group text-center">
							  <label>Imagem Principal</label>
							  <img id="imagemPreview" class="profile-user-img img-responsive img-circle" src="<?php if ($xproduto['imagemPrincipal']=='') { ?> dist/img/produto.png <?php } else { ?> <?php echo $xproduto['imagemPrincipal'];} ?>" alt="Imagem de Perfil"><br>							 
							 
						<form method="POST" id="upPrincipal" action="acoes/altera-img-principal.php" enctype="multipart/form-data">							 
							  <input type="file" class="hidden" id="fileImagem" name="fotoPrincipal">
							  <input type="text" class="hidden" id="idImagemPrincipal" name="idImagemPrincipal" value="<?php echo $xproduto['id']; ?>">
						</form>
							  
							   <a href="#" id="selecionarImagem" class="btn btn-default btn-lg"><i class="fa fa-image"></i> Trocar</a>
							   
							 
							  
							  
							  
							  <br><br>
							</div>
					</div>	
						<div class="col-md-2">
							<div class="form-group text-center">
							  <label>Foto 2</label>
							  <img id="foto2" class="profile-user-img img-responsive img-circle" src="<?php if ($xproduto['foto2']=='') { ?> dist/img/produto.png <?php } else { ?> <?php echo $xproduto['foto2'];} ?>" alt="Imagem de Perfil"><br>							 
							  <form method="POST" id="upFoto2" action="acoes/altera-foto2.php" enctype="multipart/form-data">
							  <input type="file" class="hidden" id="fileImagem2" name="foto2">
							  <input type="text" class="hidden" id="idFoto2" name="idFoto2" value="<?php echo $xproduto['id']; ?>">
							  </form>
							  
							   <a href="#" id="selecionarImagem2" class="btn btn-default btn-lg"><i class="fa fa-image"></i> Trocar</a>
							   <a href="#" data-foto="foto2" data-idproduto="<?php echo $xproduto['id']; ?>" class="delete btn btn-danger btn-lg"><i class="fa fa-trash"></i></a>
							 
							  
							  
							  
							  <br><br>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group text-center">
							  <label>Foto 3</label>
							  <img id="foto3" class="profile-user-img img-responsive img-circle" src="<?php if ($xproduto['foto3']=='') { ?> dist/img/produto.png <?php } else { ?> <?php echo $xproduto['foto3'];} ?>" alt="Imagem de Perfil"><br>							 
							  
							  <form method="POST" id="upFoto3" action="acoes/altera-foto3.php" enctype="multipart/form-data">
							  <input type="file" class="hidden" id="fileImagem3" name="foto3">
							  <input type="text" class="hidden" id="idFoto3" name="idFoto3" value="<?php echo $xproduto['id']; ?>">
							  </form>
							  
							   <a href="#" id="selecionarImagem3" class="btn btn-default btn-lg"><i class="fa fa-image"></i> Trocar</a>
							   <a href="#" data-foto="foto3" data-idproduto="<?php echo $xproduto['id']; ?>" class="delete btn btn-danger btn-lg"><i class="fa fa-trash"></i></a>
							 
							  
							  
							  
							  <br><br>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group text-center">
							  <label>Foto 4</label>
							  <img id="foto4" class="profile-user-img img-responsive img-circle" src="<?php if ($xproduto['foto4']=='') { ?> dist/img/produto.png <?php } else { ?> <?php echo $xproduto['foto4'];} ?>" alt="Imagem de Perfil"><br>							 
							  
							  <form method="POST" id="upFoto4" action="acoes/altera-foto4.php" enctype="multipart/form-data">
							  <input type="file" class="hidden" id="fileImagem4" name="foto4">
							  <input type="text" class="hidden" id="idFoto4" name="idFoto4" value="<?php echo $xproduto['id']; ?>">
							  </form>
							  
							   <a href="#" id="selecionarImagem4" class="btn btn-default btn-lg"><i class="fa fa-image"></i> Trocar</a>
							   <a href="#" data-foto="foto4" data-idproduto="<?php echo $xproduto['id']; ?>" class="delete btn btn-danger btn-lg"><i class="fa fa-trash"></i></a>
							 
							  
							  
							  
							  <br><br>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group text-center">
							  <label>Foto 5</label>
							  <img id="foto5" class="profile-user-img img-responsive img-circle" src="<?php if ($xproduto['foto5']=='') { ?> dist/img/produto.png <?php } else { ?> <?php echo $xproduto['foto5'];} ?>" alt="Imagem de Perfil"><br>							 
							  
							  <form method="POST" id="upFoto5" action="acoes/altera-foto5.php" enctype="multipart/form-data">
							  <input type="file" class="hidden" id="fileImagem5" name="foto5">
							  <input type="text" class="hidden" id="idFoto5" name="idFoto5" value="<?php echo $xproduto['id']; ?>">
							  </form>
							  
							   <a href="#" id="selecionarImagem5" class="btn btn-default btn-lg"><i class="fa fa-image"></i> Trocar</a>
							   <a href="#" data-foto="foto5" data-idproduto="<?php echo $xproduto['id']; ?>" class="delete btn btn-danger btn-lg"><i class="fa fa-trash"></i></a>
							 
							  
							  
							  
							  <br><br>
							</div>
						</div>
						
					</div>
					
					<form method="POST" id="formId" action="acoes/atualizar-produto.php" enctype="multipart/form-data">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								 <div class="form-group">
									  <label>Nome Produto <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Nome do Produto" value="<?php echo $xproduto['nome_produto']; ?>">
									  <input type="text" class="hidden form-control" id="qualid" name="qualid" placeholder="ID" value="<?php echo $xproduto['id']; ?>">
									</div>
							</div>
							<div class="col-md-2">
								 <div class="form-group">
									  <label>Categoria <sup style="color:red">*</sup></label>
									  <select id="categoriaProduto" name="categoriaProduto" class="form-control">
										<option value="" disabled>Escolha Categoria</option>
										<?php while ($xcategoria = mysqli_fetch_assoc($catxquery)){ ?>
										<option value="<?php echo $xcategoria['id']; ?>" <?php if ($xproduto['categoria']==$xcategoria['id']){echo "selected";} ?>><?php echo $xcategoria['nome_categoria']; ?></option>										
										<?php } ?>
									  </select>
									</div>
							</div>
							<div class="col-md-3">
								 <div class="form-group">
									  <label>Titulo <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="tituloProduto" name="tituloProduto" placeholder="Titulo" value="<?php echo $xproduto['titulo']; ?>">
									</div>
							</div>
							<div class="col-md-3">
								 <div class="form-group">
									  <label>Subtitulo <sup style="color:red">*</sup></label>
									 <input type="text" class="form-control" id="subtituloProduto" name="subtituloProduto" placeholder="Subtítulo" value="<?php echo $xproduto['subtitulo']; ?>">
									</div>
							</div>
							<div class="col-md-1">
								 <div class="form-group">
									  <label>Preço (R$) <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="precoProduto" name="precoProduto" value="<?php echo $xproduto['preco']; ?>" placeholder="0,00">
									</div>
							</div>
						</div>
						
						
						
						
						
						<div class="row">
						 <div class="col-md-12">
						  <div class="form-group">
									  <label>Descrição</label>
									 <textarea class="textarea" id="descricaoProduto" name="descricaoProduto" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $xproduto['descricao']; ?></textarea>
									</div>					
						  </div>
						 </div>
					</div>
					
				</div>	
				
				
				
               
                
              </div>
              <!-- /.box-body -->
			  
			  
              <div class="box-footer">
				<div class="row">
					<div class="col-md-2">
					&nbsp;
					</div>
					<div class="col-md-10">
					<a id="mandaForm" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Atualizar</a>
					<a href="produtos.php" class="btn btn-default btn-lg"><i class="fa fa-times"></i> Cancelar</a>
					</div>
				</div>
                
              </div>
            </form>
			
			<div id="loadingCard" class="overlay hidden">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
			
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
  
  <div class="modal modal-danger fade" id="modal-permissaoCamera">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>SEM PERMISSÃO PARA WEB CAM!</b></h4>
              </div>
              <div class="modal-body">
                <p>Por favor ative a permissão do navegador para usar a Web Cam!</p>
              </div>
              <div class="modal-footer">
                <button type="button" onClick="cancelVideo()" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                
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
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="dist/js/jquery.mask.js"></script>
<script src="dist/js/webcam.min.js"></script>


<script>
 $(function () {
	  $("#menuProdutos").addClass('active');
	 //Whatsapp
	 $('#whats').mask('(00) 00000-0000');
	 
	 function readURL(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imagemPreview').attr('src', e.target.result);
			  $("#upPrincipal").submit();
			   $("#loadingCard").removeClass('hidden');
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}
		
		
		
		$("#fileImagem").change(function() {
		  readURL(this);
		  
		});
	
	$("#selecionarImagem").on('click', function() {
		$("#fileImagem").click();
	});
	
	function readURL2(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imagemPreview2').attr('src', e.target.result);
			  $("#upFoto2").submit();
			  $("#loadingCard").removeClass('hidden');
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}
		
		
		
		$("#fileImagem2").change(function() {
		  readURL2(this);	
		});
	
	$("#selecionarImagem2").on('click', function() {
		$("#fileImagem2").click();
	});
	
	function readURL3(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imagemPreview3').attr('src', e.target.result);
			  $("#upFoto3").submit();
			  $("#loadingCard").removeClass('hidden');
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}
		
		
		
		$("#fileImagem3").change(function() {
		  readURL3(this);	
		});
	
	$("#selecionarImagem3").on('click', function() {
		$("#fileImagem3").click();
	});
	
	function readURL4(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imagemPreview4').attr('src', e.target.result);
			  $("#upFoto4").submit();
			  $("#loadingCard").removeClass('hidden');
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}
		
		
		
		$("#fileImagem4").change(function() {
		  readURL4(this);	
		});
	
	$("#selecionarImagem4").on('click', function() {
		$("#fileImagem4").click();
	});
	
	function readURL5(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#imagemPreview5').attr('src', e.target.result);
			  $("#upFoto5").submit();
			  $("#loadingCard").removeClass('hidden');
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}
		
		
		
		$("#fileImagem5").change(function() {
		  readURL5(this);	
		});
	
	$("#selecionarImagem5").on('click', function() {
		$("#fileImagem5").click();
	});
	
	
	//DELETAR A IMAGEM
	$(".delete").on('click', function() {
		var foto=$(this).attr('data-foto');
		var idproduto=$(this).attr('data-idproduto');
		
		$("#loadingCard").removeClass('hidden');
		
		$.ajax({
            type: 'POST',
                                data: {foto:foto,idproduto:idproduto,valida:'ckErGAiLIzanITErWINSagRUenoWNsoiNEwITBULatiCABLAnD'},
                                url: 'acoes/atualiza-foto.php',
                                crossDomain: true,

                                success: function (respost) {
									//alert(respost);
									//app.dialog.alert(respost);
                                    if (respost == 0) {
                                     $("#loadingCard").addClass('hidden');   
									$("#"+foto).attr('src','dist/img/produto.png');   
								   
                                    }

                                    if (respost == 1) {
                                      $("#loadingCard").addClass('hidden');
									  alert('Houve algum problema na hora de excluir a foto. Tente novamente!')	;
                                      
                                    }

                                    

                                },

                                error: function (erro) {
                                    console.log('Erro ao conectar ao servidor: '+erro.message);                         
									
                                   
                                    
                                   
                                }

                            });
		
		
	});
			
	//PRECO
	$('#precoProduto').mask("#.##0,00", {reverse: true});
		
	//WYSIHTML5
	$('.textarea').wysihtml5();
	
	//MULTIPLE Select
	$('.select2').select2();
	
	$("#mandaForm").on('click', function() {
		var qualid = $("#qualid").val();
		var nomeProduto = $("#nomeProduto").val();
		var categoriaProduto = $("#categoriaProduto").val();
		var tituloProduto = $("#tituloProduto").val();
		var subtituloProduto = $("#subtituloProduto").val();
		var precoProduto = $("#precoProduto").val();
		var descricaoProduto = $("#descricaoProduto").val();
		
				
		if (qualid=="" || qualid==null || nomeProduto=="" || nomeProduto==null || categoriaProduto=="" || categoriaProduto==null || tituloProduto=="" || tituloProduto==null || subtituloProduto=="" || subtituloProduto==null || precoProduto=="" || precoProduto==null || descricaoProduto=="" || descricaoProduto==null ){
		 swal("Preencha todos os campos!","Todos os campos são obrigatórios!","error");
		 return false;	
		}else{
		  $("#formId").submit();	
			}
			
			
			
			
		});
		
	});
	
	
 
</script>



</body>
</html>