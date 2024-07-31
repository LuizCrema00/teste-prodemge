<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login (Request $request) 
    {
        $credentials = $request->only('email', 'password'); //realiza a requisicao de email e senha

        if(Auth::attempt($credentials) === false) {         //Utiliza o metodo attempt do Auth para verificar se o usuario existe
            return response()->json('Unauthorized', 401);  //Se nao existir, retorna a mensagem Unauthorized com status 401
        }
    
        $user = Auth::user();
        $token = $user->createToken('token');              //Se existir, cria token para esse usuario
    
        return response()->json($token->plainTextToken);   //retorna o token em formato json

    }
}
