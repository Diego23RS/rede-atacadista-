<?php
require('bd/conexao.php');
session_start();

if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: login.html"); exit;
	
} else{
	


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
	  <a href="clientes.php"><i class="fa fa-arrow-left"></i></a>&nbsp;&nbsp;&nbsp;
        <b>Adicionar Cliente</b>
        
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
            <div class="box-header with-border">
              <h3 class="box-title">Preencha as Informações</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="acoes/adiciona-cliente.php" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="row">
					
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								 <div class="form-group">
									  <label>Nome Completo <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" placeholder="Informe o nome completo">
									</div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									  <label>Login <sup style="color:red">*</sup></label>
									  <input type="email" class="form-control" id="loginPaciente" name="loginPaciente" placeholder="exemplo@provedor.com">
									</div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									  <label>Senha <sup style="color:red">*</sup></label>
									  <input type="password" class="form-control" id="senhaPaciente" name="senhaPaciente" placeholder="Digite a senha">
									</div>
							</div>
						</div>
						
						<div class="row">
														
							<div class="col-md-4">
								 <div class="form-group">
									<label>Data de Nascimento: <sup style="color:red">*</sup></label>

									<div class="input-group date">
									  <div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									  </div>
									  <input type="text" name="dataNascimento" placeholder="00/00/0000" class="form-control pull-right" id="datepicker">
									</div>
									<!-- /.input group -->
								  </div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									  <label>CPF <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF">
									</div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									  <label>Telefone / Whatsapp <sup style="color:red">*</sup></label>
									  <input type="text" class="form-control" id="whats" name="whats" placeholder="(xx) xxxxx-xxxx">
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
					<button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Cadastrar</button>
					<a href="clientes.php" class="btn btn-default btn-lg"><i class="fa fa-times"></i> Cancelar</a>
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
<script src="dist/js/webcam.min.js"></script>


<script>
 $(function () {
	$("#menuClientes").addClass('active'); 
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
		 $("#fotodaWeb").val('');
		 $("#escolhaImagem").val('computador');
		});
	
	$("#selecionarImagem").on('click', function() {
		$("#fileImagem").click();
	});
	
	//DATA DE NASCIMENTO
	$('#datepicker').mask('00/00/0000');
	
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
	$("#imagemPreview").attr('src','dist/img/user.png');
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