<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() //qd on fait appel au construct on utilise le middleware qui s'appel auth
    {
        $this->middleware(['auth', 'admin']); //middleware sécurise la barre d'url
    }

    public function index()
    {
        return view('admin.index');
    }
}
