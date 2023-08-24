<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticias;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

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
        $dadosNoticias = Noticias::find($id);
        $contador = $dadosNoticias->count();

        if($dadosNoticias){
            return 'Noticias encontradas: '.$contador.' - '.$dadosNoticias.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'Noticias Não localizadas.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosNoticias =  $request->all();

        $valida = validator::make($dadosNoticias,[
            'titulo' => 'required',
            'conteudo' => 'required'
        ]);

        if($valida->fails()){
            return "Erro validação!!".$valida->$errors();
        }
        $dadosNoticiasBanco = Noticias::find($id);
        $dadosNoticiasBanco->titulo = $dadosNoticias['titulo'];
        $dadosNoticiasBanco->conteudo = $dadosNoticias['conteudo'];

        $enviarNoticias = $dadosNoticiasBanco->save();

        if($enviarNoticias){
            return 'A Noticia foi alterada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'A Noticia Não foi alterada.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $dadosNoticias = Noticias::find($id);
        if($dadosNoticias){
            $dadosNoticias->delete();
            return 'A Noticia foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'A Noticia Não foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    
    }
}
