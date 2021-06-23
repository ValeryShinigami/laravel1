<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'admin'] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->get(); //pour récupérer les tags du plus récent au plus ancien
        return view("admin.tags.index", compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tags.create");
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
            "name" => ['required', 'string', 'max:255', 'unique:tags'], //exists = unique mais en ++ est ce que le nom envoyé dans la requête existe deja
        ], 
        
        [
            "name.required" => "le nom est obligatoire",
            "name.string" => "entrez une chaine de caractère valide",
            "name.max" => "entrez au max 255 caractères",
            //"name.exists" => "cette catégorie n'existe pas dans la base de donnée",
            "name.unique" => "ce tag existe déjà. Veuillez en choisir une autre"
        
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //et si c'est bon on rentre les infos dans la BDD
        
        Tag::create([
            "name" => $request->name
        ]);

        //puis on redirige l'utilisateur administrateur vers la page index des catégories

        return redirect()->route("admin.tags.index")->with([
            "success" => "Votre tag a été crée avec succès."
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
          $tag = Tag::where('id', $id)->first();
          //if ($category) //le if pour vérifier que si ca existe return true alors sinon redirection
  
          if (!$tag) 
          {
              return redirect()->route('admin.tags.index')->with([
                  "warning" => "Ce tag n'existe pas"
              ]);
          }
          else
          {
              return view("admin.tags.edit", compact('tag'));
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
        $tag = Tag::find($id);

        $validator = Validator::make($request->all(), 
        [
            "name" => ['required', 'string', 'max:255', Rule::unique('tags')->ignore($tag->id)], //exists = unique mais en ++ est ce que le nom envoyé dans la requête existe deja
        ], 
        
        [
            "name.required" => "le nom est obligatoire",
            "name.string" => "entrez une chaine de caractère valide",
            "name.max" => "entrez au max 255 caractères",
            "name.unique" => "ce tag existe déjà. Veuillez en choisir une autre"
        
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tag->slug = null; //pour pouvoir mettre un nouveau slug lors de la modification

        $tag->update([
            "name"=> $request->name
        ]);
        return redirect()->route('admin.tags.index')->with([
            "success" => "votre tag a été modifiée avec succès."
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
         $tag = Tag::find($id);

         //ensuite je fais la requete qui permet de supprimer la catégorie
         $tag->delete();
 
         //puis pour ne pas laisser l'administrateur sur une page blanche on fait la redirection
         //vers la page index des catégories de l'espace admin
         return redirect()->back()->with([
             "success" => "votre tag a été supprimée avec succès."
         ]);
    }
}
