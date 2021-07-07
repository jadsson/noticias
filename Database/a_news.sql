-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jul-2021 às 17:06
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `a_news`
--

CREATE DATABASE `a_news`;
USE `a_news`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_img` int(11) DEFAULT NULL,
  `id_news` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `id_img`, `id_news`, `id_user`, `content`, `dia`) VALUES
(7, NULL, 19, 1, '.................................', '2021-06-23 23:18:38'),
(10, NULL, 19, 4, 'Larissinha comentando', '2021-06-23 23:18:38'),
(12, NULL, 21, 1, 'Sou muito f&atilde; de Forza. Franquia sem igual!', '2021-06-24 02:55:29'),
(13, NULL, 21, 5, 'Amo Forza. Ansioso demaaaaaais pra jogar essa maravilha', '2021-06-24 02:59:05'),
(14, NULL, 22, 5, 'Ori, jogo incr&iacute;vel', '2021-06-24 03:04:46'),
(16, NULL, 22, 4, 'A sensa&ccedil;&atilde;o de jogar Ori &eacute; indescrit&iacute;vel', '2021-06-24 03:18:50'),
(17, NULL, 20, 1, 'VAMOS FLAMENGOOOOOOOOOOOOOOOOOOOO', '2021-06-24 03:33:19'),
(18, NULL, 24, 1, 'Anime sem igual ', '2021-06-24 03:43:19'),
(19, NULL, 21, 10, 'MEU DEEEEUUUS QUERO MUITO JOGAR ISSO LOGO', '2021-06-24 03:52:05'),
(21, NULL, 19, 10, 'O melhor jogo que eu j&aacute; joguei, sem d&uacute;vida', '2021-06-24 04:03:45'),
(22, NULL, 23, 10, 'Jogo maravilhoso ', '2021-06-24 04:08:40'),
(23, NULL, 20, 10, 'Meeeeeeeeeeengooooooooooooo', '2021-06-24 04:15:00'),
(28, NULL, 19, 18, 'Por qual motivo este &eacute; o meu jogo favorito? TODOS', '2021-06-24 14:18:37'),
(30, NULL, 21, 18, 'Vem Foza, vem logo', '2021-06-24 16:01:59'),
(34, NULL, 19, 1, 'The Witcher 3 &eacute; incompar&aacute;vel, tudo nele &eacute; muito acima da m&eacute;dia, o melhor jogo j&aacute; criado, a melhor franquia de jogos j&aacute; criada e s&oacute; minha opini&atilde;o importa. Caso discorde, BAN! ;)', '2021-06-24 16:27:26'),
(36, NULL, 22, 4, 'Jogo mais belo j&aacute; criado ', '2021-06-24 19:43:32'),
(37, NULL, 22, 1, 'MARAVILHOSO DEMAIS', '2021-06-24 19:44:03'),
(38, NULL, 23, 1, 'Jog&atilde;o demais', '2021-06-24 20:07:58'),
(39, NULL, 23, 18, 'Sou do The Witcher mas adoro Gears', '2021-06-24 22:19:45'),
(42, NULL, 23, 4, 'Gears &eacute; incr&iacute;vel', '2021-06-25 15:14:50'),
(43, NULL, 19, 19, 'Algu&eacute;m viu a Cirilla? Preciso conversar com ela.', '2021-06-25 15:35:40'),
(50, NULL, 21, 4, 'Lindo, jogo absolutamente lindo!', '2021-06-26 16:39:52'),
(55, NULL, 20, 4, 'EU TE AMO FLAMENGO!!!! VAMOOOOOOOOOOOOOOO', '2021-06-26 23:11:33'),
(56, NULL, 39, 4, 'Adoro Halo :) Vem logo seu lindo!', '2021-06-27 20:25:47'),
(57, NULL, 39, 1, 'Halo &eacute; bom demais. Ansioso pra jogar essa maravilha!!!', '2021-06-27 20:26:22'),
(58, NULL, 39, 15, 'SOU UM AMENDOBOBO', '2021-06-27 23:15:03'),
(59, NULL, 19, 15, 'Bobo bobo amendobobo yeah', '2021-06-27 23:40:12'),
(61, NULL, 23, 4, 'Oi :)', '2021-06-28 04:28:04'),
(67, NULL, 23, 1, 'novo teste do jadson', '2021-06-29 14:19:58'),
(74, NULL, 39, 12, 'Coment&aacute;rio da Lisinha SZ', '2021-06-29 21:59:33'),
(76, NULL, 39, 4, 'Oi', '2021-06-30 22:54:58'),
(79, NULL, 24, 5, 'Volta TV globinho pelo amor de deus', '2021-07-01 00:44:21'),
(80, NULL, 21, 12, 'Jogo muito maneiro ', '2021-07-01 00:54:10'),
(82, NULL, 39, 21, 'Nova ADM na &aacute;rea', '2021-07-01 01:20:41'),
(94, NULL, 24, 5, 'Oi, eu sou Goku!!', '2021-07-04 14:01:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_news` int(11) DEFAULT NULL,
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `img`
--

INSERT INTO `img` (`id`, `id_user`, `id_news`, `title`, `category`, `nome`) VALUES
(36, 1, 19, 'Imagens de The Witch', 'news', 'a1b059dee1c927720038d22970c634a7.jpg'),
(39, 1, 19, 'Imagens de The Witch', 'news', '03d8df0c873b1e54431160cc540ee13a.jpg'),
(40, 1, 19, 'Imagens de The Witch', 'news', 'c16e45407bc4bf305c07e62917f3b0be.png'),
(41, 1, 19, 'Imagens de The Witch', 'news', '4ed7e5ac2c8d95d515deb89003684471.jpg'),
(42, 4, 20, 'Flamengo Campeão', 'news', '35df3be7572b68dab96acb3a18ac51e3.jpg'),
(43, 4, 20, 'Flamengo Campeão', 'news', '12a7f99252d17c5adc8865715c7386d5.jpg'),
(44, 4, 20, 'Flamengo Campeão', 'news', 'ddecabb303355d0cc58ef69c424e4755.jpg'),
(45, 4, 20, 'Flamengo Campeão', 'news', '4de54d80cf730c6cd8bf9a3674339c97.jpg'),
(46, 4, 20, 'Flamengo Campeão', 'news', '09b7d1c0d796ee108d1abd35408310af.jpg'),
(47, 4, 20, 'Flamengo Campeão', 'news', '950240e59667dc50bf8cc24d90549a35.jpg'),
(48, 4, 20, 'Flamengo Campeão', 'news', '8626f396dbb35e080e06b4e57a8b0343.jpeg'),
(49, 4, 20, 'Flamengo Campeão', 'news', 'c22207460165d9c0b8675109a8d8206c.jpg'),
(54, 1, 21, 'Forza Horizon', 'news', '0aa648300fd71e24815cb0196504508f.jpg'),
(55, 1, 21, 'Forza Horizon', 'news', 'de8b27f8a80270d8b3b261e15e7d8317.jpg'),
(56, 1, 21, 'Forza Horizon', 'news', '875b3cd80b961c22eee4e79bca095b53.jpg'),
(57, 1, 21, 'Forza Horizon', 'news', 'ae8da9d38f47ca6ef84c104884d5f764.jpg'),
(59, 1, 21, 'Forza Horizon', 'news', '20f9030a8cae34538131bb1fcfcfd61c.jpg'),
(60, 1, 21, 'Forza Horizon', 'news', 'b57b331c6ed219ee3c0dd1853a6c8829.jpeg'),
(63, 1, 22, 'Ori ', 'news', '5286a29d6429c8d8f6fef1aad30b04c9.jpg'),
(64, 1, 22, 'Ori ', 'news', 'b02fd07ab3810608f2310f1d983f7a74.jpg'),
(66, 1, 22, 'Ori ', 'news', '7fbb0abe9c334df973485341f5fc8700.jpg'),
(67, 1, 22, 'Ori ', 'news', '25c81fcbcf1cb795ab0e89c1334c8718.jpg'),
(68, 1, 23, 'Gears', 'news', '4c56c8385cdbfe140f6b6bff96fe607f.jpg'),
(69, 1, 23, 'Gears', 'news', '8dd3bed8d0f16ed012b89bc93e77f333.jpg'),
(70, 1, 23, 'Gears', 'news', 'a3926786338e8a093ad64d055da915ac.jpg'),
(71, 1, 23, 'Gears', 'news', 'eb72e3bf09429da03ba35b394807ec92.jpeg'),
(73, 1, 24, 'Dragon ball', 'news', '4b70f8c31c656791c7d2eb94c6db0923.jpg'),
(74, 1, 24, 'Dragon ball', 'news', '15eda9030bede8ae61371c8462def6d6.jpg'),
(76, 1, 24, 'Dragon ball', 'news', 'e2affdc5ab4c13a2ccc10e0b7e7ad623.jpg'),
(100, 4, 39, 'Halo Infinite', 'news', '69cab1871b373b6824634ca934ce6556.jpg'),
(101, 4, 39, 'Halo Infinite', 'news', 'af7a9ed04100435b9d3a62bd0117c53a.jpeg'),
(102, 4, 39, 'Halo Infinite', 'news', 'c826781ba7dce67d45676d875f66993e.jpg'),
(155, 1, NULL, 'Imagens de teste', 'game', '09dd9e4792a1a571118cd5d70ed77845.png'),
(156, 1, NULL, 'Imagens de teste', 'game', '0e70ca9ad92048185d6bcfe4f0427d86.jpg'),
(157, 1, NULL, 'Imagens de teste', 'game', '33c513ceede9ba5ee48fad2c691071d6.jpg'),
(158, 1, NULL, 'Imagens de teste', 'game', '66c9fb9133f21a3585faad71e33db69b.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_adm` int(11) NOT NULL,
  `id_adm_upd` int(11) NOT NULL DEFAULT 0,
  `dia` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `content`, `id_adm`, `id_adm_upd`, `dia`, `upd`) VALUES
(19, 'THE WITCHER 3', 'games', 'The Witcher 3 &eacute;, de longe, a melhor obra da hist&oacute;ria dos games. Com uma quantidade de conte&uacute;do imensa, o jogo te proporciona dezenas de horas de gameplay diversa e variada; s&oacute; a hist&oacute;ria principal dura em torno de 40 horas. Caso voc&ecirc; queira completar todas as quests do jogo ir&aacute;, com certeza, levar mais de 100 horas. A dimens&atilde;o &eacute; t&atilde;o exorbitante que existem miss&otilde;es ocultas as quais voc&ecirc; pode encontrar passeando pelo mapa, ou n&atilde;o. A gameplay &eacute; infinitamente melhor que os dois irm&atilde;os mais novos da saga e a quantidade e diversidade de inimigos e npc\\\'s dispon&iacute;vel no jogo &eacute;, sem d&uacute;vida, uma das maiores de todos os games. Muitos players consideram a DLC Blood and Wine melhor que o pr&oacute;prio jogo base; eu discordo levemente desse ponto. Isso obviamente n&atilde;o significa que eu considere as DLC\\\'s algo ruim, muito pelo contr&aacute;rio, s&atilde;o espetaculares. O enredo principal se passa no Continente e ilhas Skellig; Geralt est&aacute; &agrave; procura de Yennefer que o convocou para uma conversa em meio &agrave; guerra de Nilfgaard contra os nortelungos. Durante o encontro com a feiticeira, o bruxo descobre que na verdade n&atilde;o se tratava de uma reuni&atilde;o com cunho sexual ou pra relembrar os bons e velhos tempos, mas sim para informar Geralt que sua antiga protegida, Cirilla havia retornado e estava em perigo e, obviamente, ele deveria encontr&aacute;-la onde quer que estivesse escondendo-se. Em Velen os primeiros passos se d&atilde;o com pistas adquiridas por um espi&atilde;o chamado Hendrik que desafortunadamente recebeu a visita nada agrad&aacute;vel da ca&ccedil;ada selvagem antes que o bruxo pudesse encontr&aacute;-lo, ou pelo menos encontr&aacute;-lo vivo. Continuando a busca, Geralt deve encontrar-se com um Bar&atilde;o de Velen e uma bruxa para obter informa&ccedil;&otilde;es a respeito de um misterioso indiv&iacute;duo de cabelos brancos e cicatriz no rosto.    ', 1, 1, '2021-06-22 01:43:23', '2021-06-25 17:29:26'),
(20, 'Flamengo: O melhor time do mundo', 'outros', 'Todos vimos o quanto o Clube de Regatas do Flamengo &eacute; poderoso e imponente quando bem administrado. A sele&ccedil;&atilde;o  rubro-negra veio se reestruturando nos &uacute;ltimos anos e agora colhe os frutos desse grande trabalho. S&atilde;o t&iacute;tulos atr&aacute;s de t&iacute;tulos acumulados e um elenco com grandes nomes e em grande fase no futebol brasileiro. Gabigol, o artilheiro de tudo que disputa, t&ecirc;m quase 1 gol por partida atuando pelo clube; Gerson &eacute; o melhor meia do mundo e at&eacute; do Brasil; Diego Ribas, o velho mais disposto que voc&ecirc; ver&aacute; correr atr&aacute;s de uma bola; Bruno Henrique, oto patamar... enfim, s&atilde;o in&uacute;meras as caracter&iacute;sticas deste elenco que poderiam aparecer aqui. Mas o mais importante &eacute; que o Flamengo atual perdeu a zica de finais e geralmente, quando chega, &eacute; pra vencer de fato. Infelizmente, nada dura pra sempre e com o Flamengo n&atilde;o foi diferente. Atualmente o time &eacute; comandado por uma mula de n&iacute;vel baix&iacute;ssimo chamada Rog&eacute;rio Ceni. Antes, logo ap&oacute;s a sa&iacute;da de Jorge Jesus, os dirigentes trouxeram o ex auxiliar de Pepe Guardiola; por&eacute;m o cidad&atilde;o n&atilde;o tinha nenhuma condi&ccedil;&atilde;o de comandar o time e simplesmente destruiu tudo o que o portugu&ecirc;s havia constru&iacute;do em termos t&aacute;ticos no Flamengo. Um erro gigantesco seguido de outro, mas que, ainda assim, n&atilde;o impediram que mais um campeonato Brasileiro, Supercopa, Carioca fossem conquistados por esse elenco vencedor.', 4, 1, '2021-06-24 03:32:55', '2021-06-27 03:13:06'),
(21, 'Forza Horizon 5', 'games', 'A melhor franquia de corridas em mundo aberto do mercado traz seu quinto lan&ccedil;amento. Ambientado no M&eacute;xico o novo jogo traz a conhecida mec&acirc;nica dos seus antecessores com gr&aacute;ficos hiper-realistas.  Durante a apresenta&ccedil;&atilde;o na E3 foi mostrada a gameplay sem os enfeites de trailer que todos j&aacute; conhecemos, e o que se viu foi realmente impressionante. Constru&iacute;da com fotogrametria, a ambienta&ccedil;&atilde;o do jogo faz parecer que voc&ecirc; est&aacute; vendo um v&iacute;deo em 4k de ambientes capturados no mundo real. Os servidores do jogo ir&atilde;o suportar mais players simult&acirc;neos do que seu antecessor, esperamos que n&atilde;o ocorram os problemas de conex&atilde;o frequentes. Forza Horizon 5 chega em novembro pra Xbox e PC, direto no Xbox Game Pass, o servi&ccedil;o de games imbat&iacute;vel da Microsoft. Para que j&aacute; est&aacute; acostumado aos Forzas anteriores o maior impacto de diferen&ccedil;a com certeza ser&atilde;o os gr&aacute;ficos, pois a franquia sempre teve uma mec&acirc;nica de jogo impec&aacute;vel e n&atilde;o h&aacute; motivos para pensar que ser&aacute; diferente desta vez. Forza Horizon &eacute; maravilhoso!!!', 1, 4, '2021-06-24 02:30:54', '2021-06-26 22:59:08'),
(22, 'Ori And The Will of The Wisps', 'games', 'Jogo absolutamente fant&aacute;stico. Ori traz seu auge com a melhor arte j&aacute; vista em um game aliada a uma das melhores trilhas sonoras. Dessa vez com maior gama de ataques e diversidade de inimigos, o gameplay passou do vinho para um vinho melhor ainda; &eacute; tanta possibilidade diferente que at&eacute; hoje, mesmo com 100% do game conclu&iacute;do, ainda n&atilde;o consegui utilizar todos os combos de habilidades. Os boss que foram adicionados s&atilde;o o que faltava na franquia, j&aacute; que Ori and the blind forest n&atilde;o traz batalhas desse tipo. Ori and The Will of the Wisps traz batalhas surreais de tanto detalhe mec&acirc;nico e beleza, a luta contra a Aranha gigante &eacute; muito melhor do que eu esperava. Vale ressaltar que no Xbox Series X, Ori and the will of the wisps roda em at&eacute; 6k 60fps, sendo a resolu&ccedil;&atilde;o mais baixa 4k 120fps.  ', 1, 1, '2021-06-25 04:32:46', '2021-06-27 16:21:56'),
(23, 'Gears 5: O melhor da franquia', 'games', 'Um jogo espetacular em todos os sentidos! Gears 5 traz gr&aacute;ficos impressionantes; gameplay ainda melhor que seus antecessores, com novas mec&acirc;nicas e armas; al&eacute;m de um hist&oacute;ria robusta, reveladora e com decis&otilde;es pol&ecirc;micas. O jogo se inicia com os Gears na miss&atilde;o de lan&ccedil;ar um foguete que porta o sat&eacute;lite do martelo da aurora, j&aacute; no ato 1 voc&ecirc; encontra diversos inimigos diferentes e uma esp&eacute;cie de mini-boss (h&aacute; diversos durante a campanha). No ato 2 (meu preferido) voc&ecirc; se encontra em um ambiente g&eacute;lido e com ainda mais inimigos, incluindo a matriarca. Durante esse ato, Kait come&ccedil;a a receber contatos telep&aacute;ticos e busca descobrir do que se trata. O fim deste ato se d&aacute; com a melhor batalha do game. Voc&ecirc; enfrentar&aacute; a Matriarca, uma criatura da fam&iacute;lia dos berserks por&eacute;m muito mais poderosa e com uma din&acirc;mica de combate sem compara&ccedil;&atilde;o com seus primos. N&atilde;o ser&aacute; necess&aacute;rio o uso do martelo da aurora para derrot&aacute;-la, uma vez que a batalha se d&aacute; sobre uma piscina congelada dentro de uma base militar abandonada...                                                         ', 1, 1, '2021-06-25 04:23:17', '2021-07-04 03:31:44'),
(24, 'Dragon Ball', 'animes', 'O melhor anime de todos os tempos. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta placeat molestiae eveniet modi ducimus ea atque reprehenderit minima voluptate repellat Nulla dicta ea ullam repudiandae molestiae quidem, quas magnam hic. Dragon ball &eacute; sem igual Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta placeat molestiae eveniet modi ducimus ea atque reprehenderit minima voluptate repellat Nulla dicta ea ullam repudiandae molestiae quidem, quas magnam hic. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta placeat molestiae eveniet modi ducimus ea atque reprehenderit minima voluptate repellat Nulla dicta ea ullam repudiandae molestiae quidem, quas magnam hic. ', 1, 0, '2021-06-27 03:42:20', '2021-07-03 21:55:37'),
(39, 'HALO INFINITE: O QUE ESPERAR?', 'games', 'Est&aacute; chegando aquela que promete ser a maior obra, em termos de dimens&atilde;o, de Halo. O novo jogo da 343 ser&aacute; lan&ccedil;ado ainda em 2021 e com uma grande novidade: modo pvp free, ou seja, qualquer pessoa pode jogar mesmo n&atilde;o tendo comprado o jogo base ou n&atilde;o sendo assinante do Xbox Gamepass (o que &eacute; praticamente obrigat&oacute;rio, principalmente pra n&oacute;s do Brasil). Como prometido, houveram melhorias substanciais nos gr&aacute;ficos do jogo, que agora j&aacute; n&atilde;o aparentam tanto aquela textura opaca; por&eacute;m n&atilde;o h&aacute; nada de espetacular na engine de Halo, ent&atilde;o n&atilde;o espere texturas hiper-realistas. Entretanto, o que realmente importa para os f&atilde;s de Halo &eacute; o gameplay, e isso t&aacute; simplesmente insano. Novas armas foram adicionadas junto com o misterioso gancho no bra&ccedil;o dos Spartans. Sim, pelo que foi mostrado no trailer de gameplay, &eacute; poss&iacute;vel utilizar o gancho em qualquer &aacute;rea jog&aacute;vel do mapa incluindo armas de advers&aacute;rios que voc&ecirc; acabou de matar e em ve&iacute;culos flutuantes.', 4, 1, '2021-06-27 20:04:24', '2021-07-04 12:09:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comum',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `user_name`, `type_user`, `email`, `pwd`) VALUES
(1, 'jadson', 'master', 'jadson@gmail.com', '$2y$10$MFyAmax8Fbjwk9Ysixc2L.Qf/mM/DJVEvokmgACQn9zIQfn7ylJEy'),
(4, 'larissa', 'adm', 'larissa@gmail.com', '$2y$10$kHZiL.v.V/QjqGlnVbWrze60rzSscThBbtDFT6nZjSWiJnorC0yai'),
(5, 'efraim', 'comum', 'efraim@gmail.com', '$2y$10$W6X/HWCP0qS97RQIukfbe.3lNBrsVlwWVlLMifG1UvSK4zh0EmCuy'),
(6, 'cirilla', 'comum', 'cirilla@gmail.com', '$2y$10$7c8z58LnsHmfI84ninDygOKAJgxpcN9Vvn8wqJ6VCkjeOaUwc8.Hy'),
(7, 'laura', 'comum', 'laura@gmail.com', '$2y$10$0sJHz7LV8M6MQh95bCu9WeGgrhU23wSMWwmW0/XSyfmnFBB/gKkJS'),
(8, 'jhon', 'comum', 'jhon@gmail.com', '$2y$10$5Oc7n6LeXPC1VcR0ZgbEguomxMpg8B2Rbco3Ge0L5b3M9rwGQ.tEm'),
(9, 'marienne', 'comum', 'marienne@gmail.com', '$2y$10$Ta6Fl/IZM6E9B9AuRLy4puvQSHctQUxsQ20q4gOOpbaGBD6Hh3iKm'),
(10, 'luma', 'comum', 'luma@gmail.com', '$2y$10$XsvkJk24wDVDyAsekYbwe.tkIkYxcpiAh172e.horNbd9My.wmdnm'),
(11, 'mary', 'comum', 'mary@hotmail.com', '$2y$10$iUKwVbJk1kwyZaUgzwuKrO0ATIUllpEH/LWoPOF9u/zysaSRGl9iu'),
(12, 'lissandra', 'comum', 'lissandra@gmail.com', '$2y$10$zeSD3CfOlXw3IeSiQcVcyej/yvypJ93A6ha4emREy5i4KDTCvHGk2'),
(13, 'musa', 'comum', 'musa@gmail.com', '$2y$10$nXhUqw9gFqBzY4clcYQHW.1RAk9nzsyzytc8Tg5hfRp3yYzuUu972'),
(14, 'marcela', 'comum', 'marcela@gmail.com', '$2y$10$UYI2aESmcfdQ/sXubOKh4er8vRk0VJI78D8W/hG7GsYG3QKdGL1g2'),
(15, 'amendobobo', 'comum', 'amendobobo@gmail.com', '$2y$10$Sx14xJ4h5nkJUC9JHCE2A.sT.99QQ03TjRSOVnwCfAoOQ8isQUWfO'),
(16, 'yennefer', 'comum', 'yennefer@gmail.com', '$2y$10$N1RTCDQP/lO3JrhyJxct6O4w8nZqWW/lbShPnnXvM15VhN6dfoTJ2'),
(17, 'Triss', 'adm', 'triss@gmail.com', '$2y$10$ieWytgvzxCYTY5OvPOhEpuLazDwR6eiobsSnsasbPTZX1WLjSot2m'),
(18, 'fringilla', 'comum', 'fringilla@gmail.com', '$2y$10$7fJp38Kd0OGLoNcDkRGBZeaSWifZO6bVpPbYfSIvbu0GXIo3wSmAO'),
(19, 'filippa', 'comum', 'filippa@gmail.com', '$2y$10$Ct1chCgpsTc/l0n6cjYxOelT3tsh.n0BIItKBUF4ZUUzDHPbydTcu'),
(21, 'Essi', 'adm', 'essi@gmail.com', '$2y$10$rlrjw7kROBzjUh..ZvHO9uAPJqP9OgwMwrBIzvv4zK9JJPHa1hef6'),
(22, 'vesemir', 'comum', 'vesemir@hotmail.com', '$2y$10$qQhdKrbvZNb5/36/fPFE2.gOyPw89pWbM446gFHScQWc9TqkzVaCO'),
(27, 'gerciane', 'comum', 'gerciane@gmail.com', '$2y$10$WnXZXL0fwPCmnsbG.KVzxuOEV1iVj7v7VHWfy5HJwVkuCNgKT4KZ.'),
(28, 'sara', 'comum', 'sara@gmail.com', '$2y$10$RSwmhycdLA0Ywv5PiuAlAO4M8h9H6.6FaK2f.EvtFdSqWMvoh/myy');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_img` (`id_img`),
  ADD KEY `id_news` (`id_news`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_news` (`id_news`);

--
-- Índices para tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adm` (`id_adm`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de tabela `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_img`) REFERENCES `img` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `img_ibfk_2` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
