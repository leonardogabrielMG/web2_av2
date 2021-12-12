@extends("template/web")

@section("titulo", "Cadastro de Turma")

@section('formulario')

	<h3>Cadastro de Turma</h3>

	<form method="POST" action="/nota" class="row">

		@csrf
		<input type="hidden" name="id" value="{{ $nota->id }}">

		<div class="form-group col-3">
			<label for="turma">Nome da Turma: </label>
			<select name="turma" class="form-control">
				<option></option>
				@foreach ($turmas as $turma)
					@if($turma->id == $nota->turma)
						<option value="{{ $turma->id }}" selected>{{ $turma->nomeTurma }}</option>
					@else
						<option value="{{ $turma->id }}">{{ $turma->nomeTurma }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="form-group col-7">
			<label for="aluno">Aluno: </label>
			<select name="aluno" class="form-control">
				<option></option>
				@foreach ($alunos as $aluno)
					@if ($aluno->id == $nota->aluno)
						<option value="{{ $aluno->id }}" selected>{{ $aluno->nomeAluno }}</option>
					@else
						<option value="{{ $aluno->id }}">{{ $aluno->nomeAluno }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="form-group col-2">
			<label for="nota">Nota: </label>
			<input type="text" name="nota" class="form-control" value="{{ $nota->nota }}">
		</div>
		<div class="form-group col-12">
			<a href="/nota" class="btn btn-primary bottom">
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
			<col width="20%">
			<col width="50%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
		</colgroup>
		<thead>
			<tr>
				<th>Nome da Turma</th>
				<th>Aluno</th>
				<th>Nota</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($notas as $nota)
				<tr>
					<td>{{ $nota->turma }}</td>
					<td>{{ $nota->aluno }}</td>
					<td>{{ $nota->nota }}</td>
					<td>
						<a href="/nota/{{ $nota->id }}/edit" class="btn btn-warning">
							<i class="fas fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/nota/{{ $nota->id }}">

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