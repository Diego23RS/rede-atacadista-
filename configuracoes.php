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

//PAGSEGURO
$consulta = "SELECT * FROM `api_pagseguro` where id='1'";
$query = mysqli_query($conexao,$consulta) or die(mysqli_error());
$pagseguro = mysqli_fetch_assoc($query);

//Frete
$Fconsulta = "SELECT * FROM `frete` where id='1'";
$Fquery = mysqli_query($conexao,$Fconsulta) or die(mysqli_error());
$frete = mysqli_fetch_assoc($Fquery);

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

<style>
   
.smartphone {
  position: relative;
  width: 360px;
  height: 640px;
  margin: auto;
  border: 16px black solid;
  border-top-width: 60px;
  border-bottom-width: 60px;
  border-radius: 36px;
}

/* The horizontal line on the top of the device */
.smartphone:before {
  content: '';
  display: block;
  width: 60px;
  height: 5px;
  position: absolute;
  top: -30px;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #333;
  border-radius: 10px;
}

/* The circle on the bottom of the device */
.smartphone:after {
  content: '';
  display: block;
  width: 35px;
  height: 35px;
  position: absolute;
  left: 50%;
  bottom: -65px;
  transform: translate(-50%, -50%);
  background: #333;
  border-radius: 50%;
}

/* The screen (or content) of the device */
.smartphone .content {
  width: 100%;
  height: 100%;
  background: url('dist/img/android-back.png');
   background-size: 100% 100%;
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
    <section class="content-header">
      <h1>
        <i class="fa fa-gears"></i> Configurações
        <small>Controle geral</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      
	  <div class="col-md-12">
	 <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             
              <li class="active"><a href="#tab_2" data-toggle="tab"><i class="fa fa-bell"></i> Enviar Push</a></li>
			  <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-credit-card"></i> PagSeguro</a></li>
			    <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-truck"></i> Frete</a></li>
             
            </ul>
            <div class="tab-content">
             
              <div class="tab-pane active" id="tab_2">
             <form method="POST" action="acoes/notificacao-push.php" enctype="multipart/form-data">   
			<div class="row">
			
			 <div class="col-md-6">
			 
			 <div class="form-group col-md-12">
			  <label for="inputCity">Título Notificação <small style="color:gray">(Máximo 50 caracteres)</small></label>
			  <input type="text" class="form-control" maxlength="50" name="tituloNotificacao" id="tituloNotificacao" placeholder="Titulo da notificação" required>
			</div>
			
			<div class="form-group col-md-12">
			  <label for="inputCity">Conteúdo Notificação <small style="color:gray">(Máximo 150 caracteres)</small></label>
			  <textarea rows="5" class="form-control" maxlength="150" name="conteudoNotificacao" id="conteudoNotificacao" placeholder="Conteúdo da notificação"  required></textarea>
			</div>
			
			<div class="row">
			<div class="form-group col-md-12">
			<div class="col-md-4">			
			<button type="submit" class="btn btn-block btn-success btn-lg"><i class="fa fa-send"></i> Enviar Notificação</button>
			</div>
			</div>
			 </div>
			 			 
			 </div>
			 
			 <div class="col-md-6">
			 <center><label> Exemplo </label></center>
			 <div class="smartphone">
			  <div class="content">
				<div id="simuladorNotificao" class="box box-solid hidden" style="margin-top:30%">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-bell"></i> Notificação</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <b id="recebeTitulo" style="word-break: break-all;">Titulo</b>
			 <p id="recebeConteudo" style="word-break: break-all;">Conteúdo</p>
            </div>
            <!-- /.box-body -->
          </div>
			  </div>
			</div>			
			
			 
			 </div>
			 
			 
			
			</div>
			</form>
			
		
		
				
				
              </div>
              <!-- /.tab-pane -->
			  
			  <div class="tab-pane" id="tab_3">
             <form method="POST" action="acoes/atualiza-pagseguro.php">   
			<div class="row">
			
			 <div class="col-md-12">
			 
			 <div class="form-group col-md-6">
			  <label for="inputCity">Email Pagseguro </label>
			  <input type="text" class="form-control" name="emailPagseguro" id="emailPagseguro" placeholder="E-mail PagSeguro" value="<?php echo $pagseguro['email_pagseguro'];?>" required>
			</div>
			
			<div class="form-group col-md-6">
			  <label for="inputCity">Token Pagseguro </label>
			  <input type="text" class="form-control" name="tokenPagseguro" id="tokenPagseguro" placeholder="Token PagSeguro" value="<?php echo $pagseguro['token_pagseguro'];?>" required>
			</div>
			
			<div class="row">
			<div class="form-group col-md-12">
			<div class="col-md-4">			
			<button type="submit" class="btn btn-block btn-success btn-lg"><i class="fa fa-save"></i> Salvar</button>
			</div>
			</div>
			 </div>
			 			 
			 </div>
			 
			 
			 
			
			</div>
			</form>
			
		
				
              </div>
              <!-- /.tab-pane -->
			  
			  <div class="tab-pane" id="tab_4">
             <form method="POST" action="acoes/atualiza-frete.php">   
			<div class="row">
			
			 <div class="col-md-12">
			 
			 <div class="form-group col-md-4">
			  <label for="inputCity">Tem frete? </label>
			  <select class="form-control" style="width:100%" name="temFrete" id="temFrete" required>
					  <option value="nao" <?php if ($frete['tem_frete']=="nao"){echo "selected";} ?>>Não</option>
					  <option value="sim" <?php if ($frete['tem_frete']=="sim"){echo "selected";} ?>>Sim</option>					  
					</select>
			</div>
			
			<div id="divPrecoFrete" class="form-group col-md-4 <?php if ($frete['tem_frete']=="nao"){echo "hidden";} ?>">
			  <label for="inputCity">Preço Frete</label>
			  <input type="text" class="form-control" name="precoFrete" id="precoFrete" placeholder="0,00" value="<?php echo $frete['preco_frete'];?>">
			</div>
			
			<div class="row">
			<div class="form-group col-md-12">
			<div class="col-md-4">			
			<button type="submit" class="btn btn-block btn-success btn-lg"><i class="fa fa-save"></i> Salvar</button>
			</div>
			</div>
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
  <!-- /.content-wrapper -->
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
                <p>Configuração atualizada!</p>
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
                <p>Usuário removido com sucesso!</p>
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
		
		<div class="modal modal-success fade" id="modal-notok">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><i class="fa fa-bell"></i> NOTIFICAÇÃO ENVIADA</b></h4>
              </div>
              <div class="modal-body">
                <p>Notificação Push enviada com sucesso!</p>
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
		
		<div class="modal modal-danger fade" id="modal-nopermission">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>VOCÊ NÃO É ADMINISTRADOR!</b></h4>
              </div>
              <div class="modal-body">
                <p>Você não tem permissão para adicionar usuários. Por favor, peça ao administrador que adicione o usuário em questão!</p>
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
		
		<div class="modal modal-danger fade" id="modal-onesignal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>API KEY E APP ID NÃO CONFIGURADO!</b></h4>
              </div>
              <div class="modal-body">
                <p>Por favor, configure corretamente as informações de notificações da onesginal junto ao servidor!<br><b>Notificação não enviada</b></p>
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
<script src="dist/js/demo.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="dist/js/jquery.mask.js"></script>
<script>
$(document).ready(function() {
   
   
   var date = new Date();
date.setDate(date.getDate()-1);
$('#precoFrete').mask("#.##0,00", {reverse: true});
   
  
 $("#temFrete").on('change', function() {
	 var temfrete=$("#temFrete").val();
	 
	 if (temfrete=="nao"){
		$("#divPrecoFrete").addClass('hidden');
		$("#precoFrete").val('0,00');		
	 }else{
		$("#divPrecoFrete").removeClass('hidden'); 
		$("#precoFrete").val('5,00');
	 }
	 
 }); 
 
 $("#precoFrete").on('blur', function() {
	 var tamanho=$("#precoFrete").val().length;
	 
	 if (tamanho<3){
		 var precoFrete=$("#precoFrete").val();
		 if (precoFrete==''){
			$("#precoFrete").val('5,00'); 
		 }else{
		$("#precoFrete").val(precoFrete+',00');	 
		 }
		
			
	 }
	 
	 
	 
 }); 
	
$("#tituloNotificacao").on('input', function() {
    var edValue = document.getElementById("tituloNotificacao");
    var s = edValue.value;
	
	var xedValue = document.getElementById("conteudoNotificacao");
	var xs = xedValue.value;
    
	
	if ((s.length > 0)||(xs.length > 0)){
		
		$("#simuladorNotificao").removeClass('hidden');
		$("#simuladorNotificao").addClass('block');
	}else{
		$("#simuladorNotificao").removeClass('block');
		$("#simuladorNotificao").addClass('hidden');
	}

    var lblValue = document.getElementById("recebeTitulo");
    lblValue.innerText = ""+s;
});

$("#conteudoNotificacao").on('input', function() {
    var edValue = document.getElementById("conteudoNotificacao");
    var s = edValue.value;
	
	var xedValue = document.getElementById("tituloNotificacao");
	var xs = xedValue.value;
	
	if ((s.length > 0)||(xs.length > 0)){
		
		$("#simuladorNotificao").removeClass('hidden');
		$("#simuladorNotificao").addClass('block');
	}else{
		$("#simuladorNotificao").removeClass('block');
		$("#simuladorNotificao").addClass('hidden');
	}

    var lblValue = document.getElementById("recebeConteudo");
    lblValue.innerText = ""+s;
});


   
   $(function () {
    $('#example1').DataTable();
	
	$('[data-toggle="tooltip"]').tooltip()
	
	<?php if(empty($_GET)){ ?> 

<?php }else { ?> 

<?php if ($_GET['result']=='ok'){ ?>	
	$('#modal-success').modal('show');
	<?php }; ?> 
	
	<?php if ($_GET['result']=='notok'){ ?>	
	$('#modal-notok').modal('show');
	<?php }; ?> 

	<?php if ($_GET['result']=='deleted'){ ?>	
	$('#modal-deleted').modal('show');
	<?php }; ?>

	<?php if ($_GET['result']=='fail'){ ?>	
	$('#modal-danger').modal('show');
	<?php }; ?>	
	
	<?php if ($_GET['result']=='nopermission'){ ?>	
	$('#modal-nopermission').modal('show');
	<?php }; ?>	
	
	<?php if ($_GET['result']=='emailrepeat'){ ?>	
	$('#modal-emailrepeat').modal('show');
	<?php }; ?>
	
	<?php if ($_GET['result']=='onesignal'){ ?>	
	$('#modal-onesignal').modal('show');
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
	
	
	
	
   
});
</script>

 
	
	
</body>
</html>
