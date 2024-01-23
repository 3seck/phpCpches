<?php

?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Concesionario Multimarca</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="estilos.css">
</head>

<body id="top">

	<section id="banner" data-video="images/banner">
		<div class="inner">
			<header>
				<h1>Concesionario Multimarca</h1>
				<p>Somos un Concesionario Multimarca Líder en su sector.</p>
				<p>Calidad y Precio garantizado</p>
			</header>
			<a href="#main" class="more">Learn More</a>
		</div>
	</section>

	<div id="main">
		<div class="inner">
			<div class="thumbnails">
				<?php
				include "cliente.php";
				$client = new client();
				$modelos = $client->obtenerModelos();
				foreach ($modelos as $marca => $modelosMarca) {
				?>
					<div class="box">
						<a href="#" class="image fit" title="ver video">
							<img src="images/<?= strtolower($marca) ?>.png" alt="logo <?= $marca ?>" />
						</a>
						<div class="inner">
							<h3><?= $marca ?></h3>
							<button class="mostrar-modelos-btn" onclick="mostrarModelos('<?= $marca ?>')">Mostrar Modelos</button>
							<ul id="<?= $marca ?>" class="modelos-list" style="display: none;">
								<?php foreach ($modelosMarca as $modelo) { ?>
									<li><?= $modelo ?></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer id="footer">
		<div class="inner">
			<h2>Sigue nuestras redes sociales</h2>
			<p>A responsive video gallery template with a functional lightbox<br />
				designed by <a href="https://templated.co/">Templated</a> and released under the Creative Commons License.</p>

			<ul class="icons">
				<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
				<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
			</ul>
			<p class="copyright">&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com/">Unsplash</a>. Videos: <a href="http://coverr.co/">Coverr</a>.</p>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.poptrox.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script>
		// Script para manejar el despliegue de modelos sin jQuery
		function mostrarModelos(marca) {
			var modelosList = document.getElementById(marca);

			if (modelosList.style.display === 'none' || modelosList.style.display === '') {
				modelosList.style.display = 'block';
			} else {
				modelosList.style.display = 'none';
			}
		}
	</script>
	</script>
</body>

</html>