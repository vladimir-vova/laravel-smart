<!DOCTYPE html>
<html>

<head>
	<title>Спасибо за заказ</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<style>
		.logo {
			font-size: 50px;
			font-weight: bold;
			color: #202020;
			margin-top: 10px;
			margin-bottom: 150px;
			font-family: 'Circ', Arial, sans-serif;
		}

		.spacibo {
			text-align: center;
			margin: 50px 0 50px 0;
		}

		.spacibo div {
			font-size: 25px;
			color: #202020;
			font-weight: 700;
		}

		.spacibo button {
			margin: 0 auto;
			width: 275px;
			height: 50px;
			background: none;
			border: 2px solid #ffea00;
			border-radius: 10px;
			margin-top: 50px;
		}

		.spacibo button a {
			text-decoration: none;
			color: #202020;
			font-size: 18px;
			font-weight: 500;
		}

		.footer {
			display: flex;
			justify-content: space-between;
			margin-top: 150px;
			margin-bottom: 30px;
		}

		.footer div {
			color: #202020;
			font-weight: 500;
		}
	</style>
	<link rel="shortcut icon" href="{{ asset('assets/img/logo2.png') }}">
</head>

<body>
	<div class="main">
		<div class="container logo">
			Future&CO
		</div>
		<div class="spacibo">
			<div>Спасибо за обращение, мы ответим Вам в течение 15 минут.</div>
			<button><a href="{{ route('index') }}">На главную<a></button>
		</div>
		<div class="footer container">
			<div>&copy;2020. Все права защищены.</div>
			<div>Россия, г.Пермь</div>
		</div>
	</div>
</body>

</html>