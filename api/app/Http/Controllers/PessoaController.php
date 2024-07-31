<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Pessoa::query();
        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }

        return $query->paginate(5);
    }

    public function store(Request $request)
    {
        $pessoa = Pessoa::create($request->all());

        return response()
            ->json($pessoa, 201);
    }

    public function show (int $pessoa)
    {
       $pessoaModel = Pessoa::find($pessoa);
       if ($pessoaModel === null) {
            return response()->json(['message' => 'Pessoa nao encontrada'], 404);
       }
       return $pessoaModel;
    }

    public function update (Pessoa $pessoa, Request $request)
    {
        $pessoa->fill($request->all());
        $pessoa->save();

        return $pessoa;
    }

    public function destroy (int $pessoa) 
    {
        Pessoa::destroy($pessoa);
        return response()->noContent();
    }


}
