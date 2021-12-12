<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("titulo")</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>
	<nav class="navbar">
  		<ul class="nav">
	    	<li class="nav-item">
	    		<a href="/turma" class="nav-link active">Turmas</a>
	    	</li>
	    	<li class="nav-item">
	    		<a href="/aluno" class="nav-link active">Alunos</a>
	    	</li>
	    	<li class="nav-item">
	    		<a href="/nota" class="nav-link active">Notas</a>
	    	</li>
	  </ul>
	  <p class="navbar-text nav-item active">Alunos: Fernando Santos e Leonardo Gabriel</p>
	</nav>

	@if (Session::get("status") == "salvo")
		<div class="alert alert-success" role="alert">
			Salvo com sucesso!
		</div>
	@endif

	@if (Session::get("status") == "excluido")
		<div class="alert alert-danger" role="alert">
			Excluido com sucesso!
		</div>
	@endif


	<div class="container">
		@yield("formulario")
		@yield("tabela")
	</div>
</body>
</html>