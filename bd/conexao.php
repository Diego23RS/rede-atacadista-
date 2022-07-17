<?php
$conexao = mysqli_connect('localhost','root', '');
$banco = mysqli_select_db($conexao,'catalogo-com-checkout');
mysqli_set_charset($conexao,'utf8');

//CAMINHOS DAS URLS DA PLATAFORMA
$site ='http://seusite.com.br/plataforma/vendas/'; // -> Exemplo: https://meusite.com.br/plataforma/

//** MELHOR NÃO ALTERAR ESSES CAMINHOS **//
$caminho_imagem_banners ='dist/img/banners/';
$caminho_imagem_produtos ='dist/img/produtos/';

?>