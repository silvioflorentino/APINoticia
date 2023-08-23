<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticias;
use Illuminate\Support\Facades\Validator;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosNoticias = Noticias::All();

        return 'Noticias encontrada: '.$dadosNoticias;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosNoticias = $request->All();
        $valida = Validator::make($dadosNoticias,[
            'titulo' => 'required',
            'conteudo' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $RegistrosNoticias = Noticias::create($dadosNoticias);
        if($RegistrosNoticias){
            return 'Dados cadastros com sucesso.';
        }else{  
            return 'Dados não cadastrados no banco de dados';
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosNoticias = Noticias::All();
        $dadosNoticias1 = $dadosNoticias->find($id);
        $dadosNoticias1->delete();

        return 'rr'; 
    }
}
