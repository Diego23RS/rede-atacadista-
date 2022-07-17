<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
} else{
	
//SELECIONAR AS CATEGORIAS
$xconsulta = "SELECT * FROM `categorias` order by categoria";
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
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="shortcut icon" href="dist/img/icone.png" type="image/x-icon">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <link rel="stylesheet" href="dist/css/sweetalert2.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
		.swal2-popup {
  font-size: 1.6rem !important;
}
		</style>
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
        <b>Adicionar Produto</b>
        
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
            <form method="POST" id="formId" action="acoes/adiciona-produto.php" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="row">
					<div class="col-md-2">
					
					<div class="form-group text-center">
							  <label>Até 5 Fotos</label>
							  <img id="imagemPreview" class="profile-user-img img-responsive img-circle" src="dist/img/produto.png" alt="Imagem de Perfil"><br>							 
							  
							  <input type="file" class="hidden" id="fileImagem" multiple="multiple" name="foto[]">
							  
							   <a href="#" id="selecionarImagem" class="btn btn-default btn-lg"><i class="fa fa-image"></i> Selecionar</a>
							 
							   <p class="help-block">Tamanho ideal: 512x512. <br>Formatos aceitos: jpg, png, gif.</p>
							  
							  <input type="text" class="hidden" id="fotodaWeb" name="fotodaWeb">
							  <br><br>
							</div>
						
						
					</div>
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-3">
								 <div class="form-group">
									  <label>Nome Produto <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Nome do Produto">
									</div>
							</div>
							<div class="col-md-2">
								 <div class="form-group">
									  <label>Categoria <sup style="color:red">*</sup></label>
									  <select id="categoriaProduto" name="categoriaProduto" class="form-control">
										<option value="">Escolha Categoria</option>
										<?php while ($xcategoria = mysqli_fetch_assoc($xquery)){ ?>
										<option value="<?php echo $xcategoria['id']; ?>"><?php echo $xcategoria['nome_categoria']; ?></option>										
										<?php } ?>
									  </select>
									</div>
							</div>
							<div class="col-md-3">
								 <div class="form-group">
									  <label>Titulo <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="tituloProduto" name="tituloProduto" placeholder="Titulo">
									</div>
							</div>
							<div class="col-md-3">
								 <div class="form-group">
									  <label>Subtitulo <sup style="color:red">*</sup></label>
									 <input type="text" class="form-control" id="subtituloProduto" name="subtituloProduto" placeholder="Subtítulo">
									</div>
							</div>
							<div class="col-md-1">
								 <div class="form-group">
									  <label>Preço (R$) <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="precoProduto" name="precoProduto" placeholder="0,00">
									</div>
							</div>
						</div>
						
						
						
						
						
						<div class="row">
						 <div class="col-md-12">
						  <div class="form-group">
									  <label>Descrição</label>
									 <textarea class="textarea" id="descricaoProduto" name="descricaoProduto" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
					<a id="mandaForm" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Cadastrar</a>
					<a href="produtos.php" class="btn btn-default btn-lg"><i class="fa fa-times"></i> Cancelar</a>
					</div>
				</div>
                
              </div>
            </form>
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
<script src="dist/js/sweetalert2.all.min.js"></script>
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
	
	//DATA DE NASCIMENTO
	$('#precoProduto').mask("#.##0,00", {reverse: true});
	
	//CPF MASK
	$('#CPF').mask('000.000.000-00', {reverse: true});
	
	//Date picker
    $('#datepicker').datepicker({
	  orientation: 'bottom',
	  format: 'dd/mm/yyyy',                
	  language: 'pt-BR',
      autoclose: true
    });
	
	//WYSIHTML5
	$('.textarea').wysihtml5();
	
	//MULTIPLE Select
	$('.select2').select2();
	
	
	$("#mandaForm").on('click', function() {
		var $fileUpload = $("input[type='file']");
		var nomeProduto = $("#nomeProduto").val();
		var categoriaProduto = $("#categoriaProduto").val();
		var tituloProduto = $("#tituloProduto").val();
		var subtituloProduto = $("#subtituloProduto").val();
		var precoProduto = $("#precoProduto").val();
		var descricaoProduto = $("#descricaoProduto").val();
		
				
		if (nomeProduto=="" || nomeProduto==null || categoriaProduto=="" || categoriaProduto==null || tituloProduto=="" || tituloProduto==null || subtituloProduto=="" || subtituloProduto==null || precoProduto=="" || precoProduto==null || descricaoProduto=="" || descricaoProduto==null ){
		 swal("Preencha todos os campos!","Todos os campos são obrigatórios!","error");
		 return false;	
		}else{
			//TUDO OK NO PREENCHIMENTO
			//TEM FOTO?
			if (parseInt($fileUpload.get(0).files.length)==0){
			swal("SEM FOTO!","Você precisa enviar pelo menos 1 foto!","error");
			return false;
			}else{
				//TEM MAIS QUE UMA foto
				//SE TIVER MAIS DE 5 IMAGENS
				if (parseInt($fileUpload.get(0).files.length)>5){
				swal("Limite de Imagens!","Você só pode enviar no máximo 5 imagens. Por favor selecione novamente até 5 imagens!","error");
				return false;
				}else{
					 $("#formId").submit();
				}
			}
			
			
			
			
		}
		
	});
	
	
 });
</script>

<script language="JavaScript">
    
	function ativaCamera(){
		
		Webcam.set({
        width: 200,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
	
	Webcam.attach( '#my_camera' );
	
	$("#imagemPreview").addClass('hidden');
	$("#my_camera").removeClass('hidden');	
	$("#WebCam").addClass('hidden');
	$("#tirarFoto").removeClass('hidden');
	$("#selecionarImagem").addClass('hidden');
	$("#DescartarFoto").removeClass('hidden');
    
	}
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            
            document.getElementById('imagemPreview').src = data_uri;
			$("#imagemPreview").removeClass('hidden');
			$("#my_camera").addClass('hidden');
			$("#tirarFoto").addClass('hidden');
			$("#uploadFoto").removeClass('hidden');
			//Webcam.reset();
        } );
		
		Webcam.reset();
    }
	
	function cancelVideo() {
		Webcam.reset();
	$("#imagemPreview").removeClass('hidden');
	$("#my_camera").addClass('hidden');	
	$("#WebCam").removeClass('hidden');
	$("#tirarFoto").addClass('hidden');
	$("#uploadFoto").addClass('hidden');
	$("#selecionarImagem").removeClass('hidden');
	$("#DescartarFoto").addClass('hidden');
	$("#imagemPreview").attr('src','dist/img/produto.png');
	}
	
	Webcam.on( 'error', function(err) {
		if (err=='NotAllowedError: Permission denied'){
		$('#modal-permissaoCamera').modal({backdrop: 'static', keyboard: false});
		$('#modal-permissaoCamera').modal('show');	
		}else{
			alert('Houve um erro ao ativar a webCam: '+err);
		}
    
	});
	
	function uploadFotoWebCam(){
 // Get base64 value from <img id='imageprev'> source
		 var base64image = document.getElementById("imagemPreview").src;

		 Webcam.upload( base64image, 'upload-webcam.php', function(code, text) {
		  $("#fotodaWeb").val(text);
		  $("#my_camera").addClass('hidden');	
			$("#WebCam").removeClass('hidden');
			$("#tirarFoto").addClass('hidden');
			$("#uploadFoto").addClass('hidden');
			$("#selecionarImagem").removeClass('hidden');
			$("#DescartarFoto").addClass('hidden');
			 $("#escolhaImagem").val('webcam');
		  //console.log(text);
		 });

}
	
</script>

</body>
</html>