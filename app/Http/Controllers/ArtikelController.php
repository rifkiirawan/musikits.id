<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikels = Informasi::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('artikel.index', ['artikels' => $artikels]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = Informasi::find($id);
        return view('artikel.show', ['artikel' => $artikel]);
    }
}
