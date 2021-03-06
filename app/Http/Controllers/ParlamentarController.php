<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Parlamentar;

class ParlamentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parlamentares = Parlamentar::all();
        return response()->json($parlamentares);
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
        $this->validate($request,[
            'nome'=>'required|string|max:100'
            ,'cpf'=>'required|integer'
            ,'email'=>'required|email'
            ,'telefone'=>'required'
            ,'tipo'=>'required'
            ,'numero_eleitoral'=>'required|integer|digits_between:4,5'
            ,'partido_sigla'=>'required|string|max:8'
        ]);

        $parlamentar = new Parlamentar();
        $parlamentar->nome = $request->input('nome');
        $parlamentar->cpf = $request->input('cpf');
        $parlamentar->email = $request->input('email');
        $parlamentar->telefone = $request->input('telefone');
        $parlamentar->tipo = $request->input('tipo');
        $parlamentar->numero_eleitoral = $request->input('numero_eleitoral');
        $parlamentar->partido_sigla = $request->input('partido_sigla');
        $parlamentar->save();

        $response = ['parliamentary'=>"parliamentary/{$parlamentar->id}"];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (empty($id) ) {
            return response()->json(['id'=>["The id field is required or invalid id"] ],422);
        }

        $find = Parlamentar::find($id);
        if ($find == null) {
            return response()->json(['id'=>["User not found"] ],404);
        }
        return $find;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'id'=>'integer|required|exists:parlamentares,id'
            ,'nome'=>'required|string|max:100'
            ,'cpf'=>'required|integer'
            ,'email'=>'required|email'
            ,'telefone'=>'required'
            ,'tipo'=>'required'
            ,'numero_eleitoral'=>'required|integer|digits_between:4,5'
            ,'partido_sigla'=>'required|string|max:8'
        ]);

        $parlamentar = Parlamentar::find($request->input('id') );
        $parlamentar->nome = $request->input('nome');
        $parlamentar->cpf = $request->input('cpf');
        $parlamentar->email = $request->input('email');
        $parlamentar->telefone = $request->input('telefone');
        $parlamentar->tipo = $request->input('tipo');
        $parlamentar->numero_eleitoral = $request->input('numero_eleitoral');
        $parlamentar->partido_sigla = $request->input('partido_sigla');
        $parlamentar->save();

        $response = ['parliamentary'=>"parliamentary/{$parlamentar->id}"];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer|exists:parlamentares,id'
        ]);

        Parlamentar::destroy($request->input('id') );
    }
}
