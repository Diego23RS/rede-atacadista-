-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 06-Jul-2020 às 14:54
-- Versão do servidor: 5.6.41-84.1
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `guiad946_catalogo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `api_pagseguro`
--

CREATE TABLE `api_pagseguro` (
  `id` int(11) NOT NULL,
  `email_pagseguro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_pagseguro` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `api_pagseguro`
--

INSERT INTO `api_pagseguro` (`id`, `email_pagseguro`, `token_pagseguro`) VALUES
(1, 'Email Aqui', 'Token Aqui');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vai_para` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alvo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_postagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_carrinho` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comprador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagem_produto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `produto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco_unitario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `id_carrinho`, `comprador`, `imagem_produto`, `produto`, `quantidade`, `preco_unitario`, `total`) VALUES
(1, '7W114IFxjP_f58babb29f0f5d1eb01603606e5d90d0', 'c89756746414028605076@sandbox.pagseguro.com.br', 'https://genialcursos.com.br/app/catalogo/fotos/45d06771488965b9d37a7a587181c9ed.jpg', 'Detergente Ypê', '1', '1,50', '1,50'),
(2, 'V4CeNawAP6_f96a29787e345d52d57f68e9cc5bc307', 'c89756746414028605076@sandbox.pagseguro.com.br', 'https://genialcursos.com.br/app/catalogo/fotos/45d06771488965b9d37a7a587181c9ed.jpg', 'Detergente Ypê', '1', '1,50', '1,50'),
(3, 'ZNoUpC5S4V_2fce91c611eddc9354f00b3f3139a600', 'c89756746414028605076@sandbox.pagseguro.com.br', 'https://genialcursos.com.br/app/catalogo/fotos/1e53d118fc73c50e290d810c4608e188.jpg', 'Amaciante Confort', '3', '10,00', '30,00'),
(4, 'ZNoUpC5S4V_2fce91c611eddc9354f00b3f3139a600', 'c89756746414028605076@sandbox.pagseguro.com.br', 'https://genialcursos.com.br/app/catalogo/fotos/45d06771488965b9d37a7a587181c9ed.jpg', 'Detergente Ypê', '4', '1,50', '6,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome_categoria` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `icone` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome_categoria`, `categoria`, `icone`) VALUES
(1, 'Limpeza', 'limpeza', '<i class=\"mdi mdi-spray-bottle\"></i>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_notificacoes`
--

CREATE TABLE `config_notificacoes` (
  `id` int(11) NOT NULL,
  `APP_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `API_KEY` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config_notificacoes`
--

INSERT INTO `config_notificacoes` (`id`, `APP_ID`, `API_KEY`) VALUES
(1, 'Aqui APP ID', 'Aqui API Key');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `idusuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CEP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logradouro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complemento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `idusuario`, `CEP`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`) VALUES
(5, '1', '03047000', 'Rua 21 de Abril', '15', '', 'Brás', 'São Paulo', 'SP'),
(7, '3', '89870000', 'Avenida Brasilia', '123', '', 'Centro', 'Pinhalzinho', 'SC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frete`
--

CREATE TABLE `frete` (
  `id` int(11) NOT NULL,
  `tem_frete` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco_frete` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `frete`
--

INSERT INTO `frete` (`id`, `tem_frete`, `preco_frete`) VALUES
(1, 'nao', '0,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `comprador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `carrinho` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `frete` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logradouro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complemento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CEP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cod_transacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_pagamento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_boleto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bandeira_cartao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `final_cartao` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `valorTotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_pedido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_pagamento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_pedido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hora_pedido` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `comprador`, `carrinho`, `frete`, `endereco_completo`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `CEP`, `cod_transacao`, `tipo_pagamento`, `link_boleto`, `bandeira_cartao`, `final_cartao`, `valorTotal`, `status_pedido`, `status_pagamento`, `data_pedido`, `hora_pedido`) VALUES
(1, 'c89756746414028605076@sandbox.pagseguro.com.br', '7W114IFxjP_f58babb29f0f5d1eb01603606e5d90d0', '', 'Avenida Brasilia, 123  Centro, Pinhalzinho - SC Cep:89870000', 'Avenida Brasilia', '123', '', 'Centro', 'Pinhalzinho', 'SC', '89870000', '7E941CB6-65D9-4123-84EA-F5CABF875BFF', 'creditCard', '', 'visa', '1111', '1,50', 'Aprovado', '', '29/05/2020', '21:05:56'),
(2, 'c89756746414028605076@sandbox.pagseguro.com.br', 'V4CeNawAP6_f96a29787e345d52d57f68e9cc5bc307', '', 'Avenida Brasilia, 123  Centro, Pinhalzinho - SC Cep:89870000', 'Avenida Brasilia', '123', '', 'Centro', 'Pinhalzinho', 'SC', '89870000', 'F76FE8C8-96BC-4E0F-9224-343D296A71BA', 'boleto', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=84fe7a5c4a1b8a6cafea405584c881c4bad3c14f2f5918cd7669b7b91d6bf4272aae4c8528a9345d', '', '', '1,50', 'Aguardando', 'Aguardando', '29/05/2020', '21:06:29'),
(3, 'c89756746414028605076@sandbox.pagseguro.com.br', 'ZNoUpC5S4V_2fce91c611eddc9354f00b3f3139a600', '10,00', 'Avenida Brasilia, 123  Centro, Pinhalzinho - SC Cep:89870000', 'Avenida Brasilia', '123', '', 'Centro', 'Pinhalzinho', 'SC', '89870000', 'C054F5BD-F655-43E6-9808-0278BB597080', 'boleto', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=6c58c9432ebb39c20855d75512baa2c69a4ed1f303365a4eb9dd06f8f78f9a79ef1102ab0b3be8c9', '', '', '46,00', 'Aguardando', 'Aguardando', '26/06/2020', '21:35:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `imagemPrincipal` varchar(255) NOT NULL,
  `foto2` varchar(255) NOT NULL,
  `foto3` varchar(255) NOT NULL,
  `foto4` varchar(255) NOT NULL,
  `foto5` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `data_cadastro` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome_produto`, `imagemPrincipal`, `foto2`, `foto3`, `foto4`, `foto5`, `categoria`, `titulo`, `subtitulo`, `preco`, `descricao`, `data_cadastro`) VALUES
(1, 'Detergente Ypê', 'https://genialcursos.com.br/app/catalogo/fotos/45d06771488965b9d37a7a587181c9ed.jpg', 'https://genialcursos.com.br/app/catalogo/fotos/d8b3815f8222397e81fa676a5d53bbbb.jpg', 'https://genialcursos.com.br/app/catalogo/fotos/3b17e3278817b688d7c4d359d132d028.jpg', 'https://genialcursos.com.br/app/catalogo/fotos/b186a823d582fd0734b451d3005a196e.jpg', 'https://genialcursos.com.br/app/catalogo/fotos/78387320b86cacc9d82ac6b4e2abe18f.jpg', '1', 'Detergente ', '500 ml', '1,50', 'Detergente da marca Ypê. Concentrado, ótimo para lavar a louça gastando pouco. Com baixa taxa de poluição das águas.', '11/04/2020'),
(2, 'Amaciante Confort', 'https://genialcursos.com.br/app/catalogo/fotos/1e53d118fc73c50e290d810c4608e188.jpg', '', '', '', '', '1', 'Amaciante para roupas', '5 Litros', '10,00', 'O melhor amaciante que existe', '17/05/2020');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `playerID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CPF` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recuperaSenha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastro` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `playerID`, `login`, `senha`, `nome`, `data_nascimento`, `telefone`, `CPF`, `recuperaSenha`, `data_cadastro`) VALUES
(1, '', 'dimitriteixeira@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Dimitri Teixeira', '25/09/1991', '(49) 98807-0996', '123.456.781-23', 'atosiq', '18/05/2020'),
(3, '', 'c89756746414028605076@sandbox.pagseguro.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'José Comprador', '25/05/2020', '(49) 98807-0996', '221.119.447-85', '', '25/05/2020');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_administrativos`
--

CREATE TABLE `usuarios_administrativos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `recuperaSenha` varchar(255) NOT NULL,
  `telefone_contato` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_administrativos`
--

INSERT INTO `usuarios_administrativos` (`id`, `nome`, `login`, `senha`, `recuperaSenha`, `telefone_contato`) VALUES
(1, 'Teste da Silva', 'teste@gmail.com', '123', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `api_pagseguro`
--
ALTER TABLE `api_pagseguro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `config_notificacoes`
--
ALTER TABLE `config_notificacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `frete`
--
ALTER TABLE `frete`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios_administrativos`
--
ALTER TABLE `usuarios_administrativos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `api_pagseguro`
--
ALTER TABLE `api_pagseguro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `config_notificacoes`
--
ALTER TABLE `config_notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `frete`
--
ALTER TABLE `frete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios_administrativos`
--
ALTER TABLE `usuarios_administrativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
