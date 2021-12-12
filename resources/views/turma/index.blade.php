@extends("template/web")

@section("titulo", "Cadastro de Turma")

@section('formulario')

	<h3>Cadastro de Turma</h3>

	<form method="POST" action="/turma" class="row">

		@csrf
		<input type="hidden" name="id" value="{{ $turma->id }}">

		<div class="form-group col-6">
			<label for="nomeTurma">Nome da Turma: </label>
			<input type="text" name="nomeTurma" class="form-control" value="{{ $turma->nomeTurma }}">
		</div>
		<div class="form-group col-6">
			<label for="nomeCurso">Nome do Curso: </label>
			<input type="text" name="nomeCurso" class="form-control" value="{{ $turma->nomeCurso }}">
		</div>
		<div class="form-group col-12">
			<a href="/turma" class="btn btn-primary bottom">
				<i class="fas fa-plus"></i>
				Novo
			</a>
			<button type="submit" class="btn btn-success bottom">
				<i class="fas fa-save"></i>
				Salvar
			</button>
		</div>
	</form>
@endsection

@section('tabela')

	<h3>Lista de Turmas</h3>
	<table class="table table-striped">
		<colgroup>
			<col width="35%">
			<col width="35%">
			<col width="10%">
			<col width="10%">
		</colgroup>
		<thead>
			<tr>
				<th>Nome da Turma</th>
				<th>Nome do Curso</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($turmas as $turma)
				<tr>
					<td>{{ $turma->nomeTurma }}</td>
					<td>{{ $turma->nomeCurso }}</td>
					<td>
						<a href="/turma/{{ $turma->id }}/edit" class="btn btn-warning">
							<i class="fas fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/turma/{{ $turma->id }}">

							<input type="hidden" name="_method" value="DELETE">
							@csrf

							<button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?');">
								<i class="fas fa-trash"></i>
								Excluir
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection