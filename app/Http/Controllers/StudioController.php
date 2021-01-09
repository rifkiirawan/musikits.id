<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Admin;
use App\Models\Informasi;
use App\Models\Pengguna;
use App\Models\Inventaris;
use App\Models\InventarisDetail;
use Carbon\Carbon;
use Exception;
use Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\AlatBarang;
use App\Models\Sewa_Studio;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sewa.studio');
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
        $validator = Validator::make($request->all(), [
            'waktu_mulai'         => 'required',
            'waktu_selesai'         => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('gagal', $validator->errors());
            return redirect()->back()->withInput();
        }

        try {
                DB::transaction(function() use ($request){
                    Sewa_Studio::create([
                        'waktu_mulai' => $request->input('waktu_mulai'),
                        'waktu_selesai' => $request->input('waktu_selesai'),
                        'id_pengguna' => $request->session()->get('id'),
                        'created_at' => Carbon::now()->toRfc2822String(),
                        'updated_at' => Carbon::now()->toRfc2822String()
                    ]);
                }, 5);
            Session::flash('sukses', 'Penyewaan berhasil diajukan, silahkan menunggu verifikasi dari admin');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('gagal', 'Penyewaan tidak berhasil diajukan'.$e->getMessage());
            return redirect()->back();
        }
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
