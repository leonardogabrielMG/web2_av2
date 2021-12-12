@extends("template/web")

@section("titulo", "Cadastro de Aluno")

@section('formulario')

	<h3>Cadastro de Aluno</h3>

	<form method="POST" action="/aluno" class="row">

		@csrf
		<input type="hidden" name="id" value="{{ $aluno->id }}">

		<div class="form-group col-12">
			<label for="nomeAluno">Nome do Aluno: </label>
			<input type="text" name="nomeAluno" class="form-control" value="{{ $aluno->nomeAluno }}">
		</div>
		<div class="form-group col-6">
			<label for="email">E-mail: </label>
			<input type="email" name="email" class="form-control" value="{{ $aluno->email }}">
		</div>
		<div class="form-group col-6">
			<label for="matricula">Matrícula: </label>
			<input type="text" name="matricula" class="form-control" value="{{ $aluno->matricula }}">
		</div>
		<div class="form-group col-6">
			<label for="turma">Turma: </label>
			<select name="turma" class="form-control">
				<option></option>
				@foreach ($turmas as $turma)
					@if($turma->id == $aluno->turma)
						<option value="{{ $turma->id }}" selected>{{ $turma->nomeTurma }}</option>
					@else
						<option value="{{ $turma->id }}">{{ $turma->nomeTurma }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="form-group col-6">
			<a href="/aluno" class="btn btn-primary bottom">
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

	<h3>Lista de Alunos</h3>
	<table class="table table-striped">
		<colgroup>
			<col width="30%">
			<col width="20%">
			<col width="15%">
			<col width="15%">
			<col width="10%">
			<col width="10%">
		</colgroup>
		<thead>
			<tr>
				<th>Nome do Aluno</th>
				<th>E-mail</th>
				<th>Matrícula</th>
				<th>Turma</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($alunos as $aluno)
				<tr>
					<td>{{ $aluno->nomeAluno }}</td>
					<td>{{ $aluno->email }}</td>
					<td>{{ $aluno->matricula }}</td>
					<td>{{ $aluno->turma }}</td>
					<td>
						<a href="/aluno/{{ $aluno->id }}/edit" class="btn btn-warning">
							<i class="fas fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/aluno/{{ $aluno->id }}">

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