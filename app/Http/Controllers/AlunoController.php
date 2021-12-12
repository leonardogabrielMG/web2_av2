<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aluno = new Aluno();
        $alunos = DB::table("aluno AS a")
                        ->join("turma AS t", "a.turma", "=", "t.id")
                        ->select("a.id", "a.nomeAluno", "a.email", "a.matricula", "t.nomeTurma AS turma")
                        ->get();
        $turmas = Turma::All();

        return view("aluno.index", [
            "aluno" => $aluno,
            "alunos" => $alunos,
            "turmas" => $turmas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get("id") != "") {
            $aluno = Aluno::Find($request->get("id"));
        }else{
            $aluno = new Aluno();
        }

        $aluno->nomeAluno = $request->get("nomeAluno");
        $aluno->email = $request->get("email");
        $aluno->matricula = $request->get("matricula");
        $aluno->turma = $request->get("turma");

        $aluno->Save();
        $request->Session()->Flash("status", "salvo");

        return redirect("/aluno");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::Find($id);
        $alunos = DB::table("aluno AS a")
                        ->join("turma AS t", "a.turma", "=", "t.id")
                        ->select("a.id", "a.nomeAluno", "a.email", "a.matricula", "t.nomeTurma AS turma")
                        ->get();
        $turmas = Turma::All();

        return view("aluno.index", [
            "aluno" => $aluno,
            "alunos" => $alunos,
            "turmas" => $turmas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Aluno::Destroy($id);

        $request->Session()->Flash("status", "excluido");

        return redirect("/aluno");
    }
}
