<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //on valide les données
        
        $validator = Validator::make($request->all(), 
        [
            "name" => ['required', 'string', 'max:255', "exists:categories,name", 'unique.categories'] //exists = unique mais en ++ est ce que le nom envoyé dans la requête existe deja
        ], 
        
        [
            "name.required" => "le nom est obligatoire",
            "name.string" => "entrez une chaine de caractère valide",
            "name.max" => "entrez au max 255 caractères",
            "name.exists" => "cette catégorie n'existe pas dans la base de donnée",
            "name.unique" => "cette catégorie existe déjà. Veuillez en choisir une autre"
        
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //et si c'est bon on rentre les infos dans la BDD
        

        //puis on redirige l'utilisateur administrateur vers la page index des catégories
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
        //
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
    public function destroy($id)
    {
        //
    }
}
