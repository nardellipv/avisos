<html lang="en">

<head>

	<meta charset="UTF-8">
	<title>Avisos Mendoza</title>


	<style>
		@import 'https://fonts.googleapis.com/css?family=VT323';

		body,
		h1,
		h2,
		h3,
		h4,
		p,
		a {
			color: #e0e2f4;
		}

		body,
		p {
			font: normal 20px/1.25rem "VT323", monospace;
		}

		h1 {
			font: normal 2.75rem/1.05em "VT323", monospace;
		}

		h2 {
			font: normal 2.25rem/1.25em "VT323", monospace;
		}

		h3 {
			font: lighter 1.5rem/1.25em "VT323", monospace;
		}

		h4 {
			font: lighter 1.125rem/1.2222222em "VT323", monospace;
		}

		body {
			background: #0414a7;
		}

		.container {
			width: 90%;
			margin: auto;
			max-width: 640px;
		}

		.bsod {
			padding-top: 10%;
		}

		.bsod .neg {
			text-align: center;
			color: #0414a7;
		}

		.bsod .neg .bg {
			background: #aaaaaa;
			padding: 0 15px 2px 13px;
		}

		.bsod .title {
			margin-bottom: 50px;
		}

		.bsod .nav {
			margin-top: 35px;
			text-align: center;
		}

		.bsod .nav .link {
			text-decoration: none;
			padding: 0 9px 2px 8px;
		}

		.bsod .nav .link:hover,
		.bsod .nav .link:focus {
			background: #aaaaaa;
			color: #0414a7;
		}
	</style>

	<script>
		window.console = window.console || function(t) {};
	</script>



	<script>
		if (document.location.search.match(/type=embed/gi)) {
	  window.parent.postMessage("resize", "*");
	}
	</script>

</head>

<body translate="no">
	<main class="bsod container">
		<h1 class="neg title"><span class="bg">Error - 500</span></h1>
		<p>Hay un error en la solicitud que estas realizando!!!</p>
		<p>Le pedimos disculpas, si continua el error puede enviar un email a:</p>
		<p>* info@avisosmendoza.com.ar</p>
		<nav class="nav">
			<a href="{{ route('home') }}" class="link">Volver al inicio</a>
		</nav>
	</main>

</body>
</html>