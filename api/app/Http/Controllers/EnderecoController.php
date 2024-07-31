<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnderecoFormRequest;
use Illuminate\Http\Request;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Endereco::query();                                           //cria uma query para consulta da model imovel

        $query->orderBy('id', 'asc');

        return $query->paginate(5); 
    }

    public function store(EnderecoFormRequest $request)
    {
        $endereco = Endereco::create($request->all());

        return response()
            ->json($endereco, 201);
    }

    public function show (int $endereco)
    {
       $pessoaModel = Endereco::find($endereco);
       if ($pessoaModel === null) {
            return response()->json(['message' => 'Endereco nao encontrada'], 404);
       }
       return $pessoaModel;
    }

    public function update (Endereco $endereco, EnderecoFormRequest $request)
    {
        $endereco->fill($request->all());
        $endereco->save();

        return $endereco;
    }

    public function destroy (int $endereco) 
    {
        Endereco::destroy($endereco);
        return response()->noContent();
    }
}
