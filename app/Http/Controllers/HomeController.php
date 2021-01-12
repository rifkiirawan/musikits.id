<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getArtikel(){
        // TODO: Ambil yang paling atas buat jadi headlight, ambil 2 sisanya buat di home
        $top = Informasi::select("*")->orderBy("created_at", "desc")->take(1)->get();
        $artikels = Informasi::select("*")->orderBy("created_at", "desc")->skip(1)->take(2)->get();
        return view('welcome', ['top'=>$top], ['artikels'=>$artikels]);
    }
}
