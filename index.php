<!DOCTYPE HTML>

<?php
// conexão com o banco
require_once("app/config/conexao.php");

$consultaPostagem = $pdoConnection->query("SELECT * FROM postagem ORDER BY dataPost DESC");

?>

<html>

<head>

	<meta charset="utf-8" />
	<title>Ateliê Psicopedagógico</title>
	<link rel="shortcut icon" href="public/assets/images/logoremovido.png">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-SOMEINTEGRITY" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="public/assets/css/main.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="is-preload">
	<nav class="menu-lateral">
		<div class="btn-expandir">
			<i class="bi bi-list" id="btn-exp"></i>
		</div>
		<ul>

			<li class="item-menu ativo">
				<a href="index">
					<span class="icon"><i class="bi bi-house"></i></span>
					<span class="txt-link">HOME</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="textos">
					<span class="icon"><i class="bi bi-layout-text-window"></i></span>
					<span class="txt-link">TEXTOS</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="produtos">
					<span class="icon"><i class="bi bi-shop"></i></span>
					<span class="txt-link">PRODUTOS</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="contato">
					<span class="icon"><i class="bi bi-envelope-at"></i></span>
					<span class="txt-link">CONTATOS</span>
				</a>
			</li>

		</ul>
	</nav>
	<script src="public/assets/js/menu.js">
	</script>
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">
			<div class="inner">


				<!-- Header -->
				<header id="header">
					<a href="index.php" class="logo"><img src="public/assets/images/logo.jpeg" alt="" /></a>
					<a href="index.php" class="logo"><strong>Ateliê</strong> Psicopedagógico</a>
				</header>

				<!-- Banner -->
				<section id="banner">
					<div class="content">
						<header>
							<h1>Conheça um pouco do nosso ATELIE</h1>
						</header>
						<p>No ateliê, cada brinquedo é mais do que um objeto físico; é uma ferramenta de desenvolvimento emocional e cognitivo, moldando sorrisos, confiança e autoestima entre as crianças portadoras de necessidades especiais. Cada criação é um símbolo de esperança e possibilidades infinitas para um futuro brilhante e promissor.</p>
						<p>Através da arte, imaginação e dedicação incansável, transformamos o ateliê em um santuário de crescimento e progresso, onde o potencial de cada criança é celebrado e nutrido. Nosso compromisso apaixonado é oferecer um ambiente seguro e estimulante, onde cada criança pode florescer e encontrar alegria, independência e realização.</p>

					</div>
					<span class="image object">
						<img src="public/assets/images/pic06.jpg" alt="" />

					</span>
				</section>



				<!-- Section -->
				<section>
					<?php
					if ($consultaPostagem) {
					?>

						<header class="major">
							<h2>Últimas Notícias</h2>
							<br>
						</header>
						<div class="posts">

							<?php
							while ($conteudo = $consultaPostagem->fetch(PDO::FETCH_ASSOC)) {
								$nomeVendedora =  $conteudo['nomeVendedora'];
								$titulo =  $conteudo['titulo'];
								$dataPost =  $conteudo['dataPost'];
								$imagem =  $conteudo['imagem'];
								$texto = $conteudo['texto'];
							?>

								<article>
									<a href="#" class="image"><img class="responsive-image" src="app/controller/<?= $imagem ?>" alt="" width="auto" height="400px" /></a>
									<h6>Por: <?= $nomeVendedora ?></h6>
									<h6>Dia: <?= date('d/m/Y', strtotime($dataPost)) ?></h6>
									<h3><?= $titulo ?></h3>
									<p>
										<?= $texto ?>
									</p>
								</article>
							<?php
							}
							?>

						</div>

					<?php
					} else {
						echo "Erro na consulta SQL: " . $pdoConnection->errorInfo()[2];
					}
					?>

				</section>

			</div>

		</div>



	</div>
	<footer id="footer">
		<div class="inner">
			<div class="footer-content">
				<div class="social-icons">
					<a href="https://www.facebook.com/danineuropsicopedagoga/" class="social-icon"><i class="bi bi-facebook"></i></a>
					<a href="https://www.instagram.com/ateliepsicopedagogico/" class="social-icon"><i class="bi bi-instagram"></i></a>
					<a href="https://wa.me/5511976553216" class="social-icon"><i class="bi bi-whatsapp"></i></a>
				</div>
				<div class="footer-info">
					<p>"Me movo como educador, porque, primeiro, me movo como gente."</p>
					<p>&copy; 2023 Ateliê Psicopedagógico.</p>

					<p>Todos os direitos reservados</p>

				</div>
			</div>
		</div>
	</footer>



	<!-- Scripts -->
	<script src="public/assets/js/jquery.min.js"></script>
	<script src="public/assets/js/browser.min.js"></script>
	<script src="public/assets/js/breakpoints.min.js"></script>
	<script src="public/assets/js/util.js"></script>
	<script src="public/assets/js/main.js"></script>

</body>

</html>