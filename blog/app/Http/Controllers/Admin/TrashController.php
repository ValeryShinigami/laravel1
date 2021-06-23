<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class TrashController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'admin'] );
    }
    
    public function index()
    {
        $posts = Post::onlyTrashed()->get(); //récupère uniquement les articles en corbeille
        return view('admin.trash.index', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where("id", $id)->first(); //pour récuperer un article 
        $post->restore();
        return redirect()->back()->with(["success" => "cet article vient d'être restauré"]);
    }

    public function delete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        $path = parse_url($post->image);
        File::delete(public_path($path['path'])); //detruire l'ancienne image

        $post->forceDelete(); //laravel comprend qu'il faut vraiment tout supprimer
        
        return redirect()->back()->with(["success" => "cette article est définitivement supprimé"]);
    }

}
