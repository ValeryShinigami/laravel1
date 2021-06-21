<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); //requete pour récuperer les catégories
      //  dd($categories); // pour voir les données dans le tableau c'est comme un vardump
        return view ('admin.posts.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            "title" => ["required", "string", "max:255"],
            "category_id" => ["required", "integer", "exists:categories,id"], //est ce que la catégorie existe dans la bdd ou non avec EXISTS
            "image" => ["required", "image", "dimensions:min_width=100,min_height=100"], //dimension de l'image pour ne pas utiliser des images petits ce n'est pas obligatoire
            "content" => ["required", "string"]
        ],
         
        [
            "title.required" => "le ttire est obligatoire",
            "title.string" => "Entrez une chaine de caratère",
            "title.max" => "Maximum 255 caractères",

            "category_id.required" => "la catégorie est obligatoire",
            "category_id.integer" => "ceci doit être un entier",
            "category_id.exists" => "cette catégorie n'existe pas",

            "image.required" => "l'image est obligatoire",
            "image.image" => "ceci n'est pas une image",
            "image.dimansions" => "largeur min: 100px et hauteur min: 100px",

            "content.required" => "le contenu est obligatoire",
            "content.string" => "Veuillez entrer une chaine de caractères",
        ]);

        if ($validator->fails())
         {
            return redirect()->back()->withErrors($validator)->withInput();
         }
         // je recupère l'image envoyée depuis le formulaire du Create
        $image = $request->image; //ceci est l'image en elle même

        //je crée un nom complet pour l'image afin de ne pas avoir 2 images qui auront le même nom
        $image_complete_name = time() . "_" . rand(1, 999999) . "_" . $image->getClientOriginalName();

         //je déplace l'image qui sera dans le dossier public/uploads/posts/images/
        $image->move('uploads/posts/images/', $image_complete_name); // move() c'est pour ce positionner au niveau du dossier Public automatiquement 

        Post::create([
            "title" => $request->title,
            "category_id" => $request->category_id,
            "image" => "uploads/posts/images/" . $image_complete_name,
            "content" => $request->content,

        ]);

        return redirect()->route('admin.posts.index')->with([
            "success" => "votre article vient d'être sauvegardé"
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
