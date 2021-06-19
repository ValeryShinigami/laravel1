<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $categories = Category::paginate(10); //pour recuperer toutes les catégories
        return view('admin.categories.index', compact('categories')); //pour le passer a la view index on utilise la fonction compatc()
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
            "name" => ['required', 'string', 'max:255', 'unique:categories'], //exists = unique mais en ++ est ce que le nom envoyé dans la requête existe deja
        ], 
        
        [
            "name.required" => "le nom est obligatoire",
            "name.string" => "entrez une chaine de caractère valide",
            "name.max" => "entrez au max 255 caractères",
            //"name.exists" => "cette catégorie n'existe pas dans la base de donnée",
            "name.unique" => "cette catégorie existe déjà. Veuillez en choisir une autre"
        
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //et si c'est bon on rentre les infos dans la BDD
        
        Category::create([
            "name" => $request->name
        ]);

        //puis on redirige l'utilisateur administrateur vers la page index des catégories

        return redirect()->route("admin.categories.index")->with([
            "success" => "Votre catégorie a été créée avec succès."
        ]);
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
        // $category = Category::find($id);
        $category = Category::where('id', $id)->first();
        //if ($category) //le if pour vérifier que si ca existe return true alors sinon redirection

        if (!$category) 
        {
            return redirect()->route('admin.categories.index')->with([
                "warning" => "Cette catégorie n'existe pas"
            ]);
        }
        else
        {
            return view("admin.categories.edit", compact('category'));
        }
        
        
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
        $category = Category::find($id);

        $validator = Validator::make($request->all(), 
        [
            "name" => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)], //exists = unique mais en ++ est ce que le nom envoyé dans la requête existe deja
        ], 
        
        [
            "name.required" => "le nom est obligatoire",
            "name.string" => "entrez une chaine de caractère valide",
            "name.max" => "entrez au max 255 caractères",
            "name.unique" => "cette catégorie existe déjà. Veuillez en choisir une autre"
        
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category->update([
            "name"=> $request->name
        ]);
        return redirect()->route('admin.categories.index')->with([
            "success" => "votre catégorie a été modifiée avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Je fais d'abord la requete pour récupérer la catégorie à supprimer
        $category = Category::find($id);

        //ensuite je fais la requete qui permet de supprimer la catégorie
        $category->delete();

        //puis pour ne pas laisser l'administrateur sur une page blanche on fait la redirection
        //vers la page index des catégories de l'espace admin
        return redirect()->route('admin.categories.index')->with([
            "success" => "votre catégorie a été supprimée avec succès."
        ]);

    }
}
