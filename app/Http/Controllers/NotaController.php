<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Turma;
use App\Models\Aluno;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota = new Nota();
        $notas = DB::table("nota AS n")
                    ->join("aluno AS a", "n.aluno", "=", "a.id")
                    ->join("turma AS t", "n.turma", "=", "t.id")
                    ->select("n.id", "n.nota", "a.nomeAluno AS aluno", "t.nomeTurma AS turma")
                    ->get();
        $alunos = Aluno::All();
        $turmas = Turma::All();

        return view("nota.index", [
            "nota" => $nota,
            "notas" => $notas,
            "turmas" => $turmas,
            "alunos" => $alunos
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
            $nota = Nota::Find($request->get("id"));
        }else{
            $nota = new Nota();
        }

        $nota->turma = $request->get("turma");
        $nota->aluno = $request->get("aluno");
        $nota->nota = $request->get("nota");


        $nota->Save();
        $request->Session()->Flash("status", "salvo");

        return redirect("/nota");
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
        $nota = Nota::Find($id);
        $notas = DB::table("nota AS n")
                    ->join("aluno AS a", "n.aluno", "=", "a.id")
                    ->join("turma AS t", "n.turma", "=", "t.id")
                    ->select("n.id", "n.nota", "a.nomeAluno AS aluno", "t.nomeTurma AS turma")
                    ->get();
        $turmas = Turma::All();
        $alunos = Aluno::All();

        return view("nota.index", [
            "nota" => $nota,
            "notas" => $notas,
            "turmas" => $turmas,
            "alunos" => $alunos
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
        Nota::Destroy($id);

        $request->Session()->Flash("status", "excluido");

        return redirect("/nota");
    }
}
