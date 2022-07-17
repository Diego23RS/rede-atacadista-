<?php 
require('../bd/conexao.php');

if ($_POST["email"]==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
}else{

$email = $_POST["email"];
$senha = $_POST["senha"];

//$senhaCriptografada= sha1($senha);

// Validação do usuário/senha digitados
$consulta = "SELECT * FROM usuarios_administrativos WHERE login = '$email' AND senha = '$senha'";
$query = mysqli_query($conexao,$consulta) or die(mysqli_error($conexao));

if (mysqli_num_rows($query) != 1) {

	header("Location:../login-fail.html"); exit;
	
} else {
	 // ENCONTROU USUARIO
	 
	$dados=mysqli_fetch_assoc($query);	//PUXAR DADOS NA VARIAVEL $dados
	session_start();
	$_SESSION['LoginUsuario'] = $email;
	$_SESSION['nome'] = $dados['nome'];
	$_SESSION['id'] = $dados['id'];
	
	
	header("Location:../pedidos.php"); exit;	
	
	
	
	
	
};

}


?>