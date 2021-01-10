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
use App\Models\Sewa_Alat;
use DateTime;

class DashboardUserController extends Controller
{
    public function index(Request $request)
    {
        // query sewa alat
        $alats =  DB::table('peminjaman')
        ->join('pengguna','pengguna.id','peminjaman.id_pengguna')
        ->join('alat','alat.id','peminjaman.id_alat')
        ->select('peminjaman.*', 'alat.nama_alat')
        ->where('pengguna.id', '=', $request->session()->get('id'))
        ->orderBy('updated_at')
        ->paginate(5);

        // query sewa studio
        $studios =  DB::table('sewa_studio')
        ->join('pengguna','pengguna.id','sewa_studio.id_pengguna')
        ->select('sewa_studio.*')
        ->where('pengguna.id', '=', $request->session()->get('id'))
        ->orderBy('updated_at')
        ->paginate(5);

        $user = Pengguna::find($request->session()->get('id'));

        return view('dashboard.index', compact('user', 'alats', 'studios'));
    }

    public function showListInventory(Request $request) {
        $inventariss = Inventaris::paginate(10);
        $user = Pengguna::find($request->session()->get('id'));

        return view('dashboard.inventaris.index', compact('inventariss', 'user'));
    }

    public function showDetailInventory(Request $request, $id) {
        $alats = DB::table('inventaris_detail')
        ->join('alat','alat.id', 'inventaris_detail.id_alat')
        ->select('inventaris_detail.*','alat.gambar', 'alat.nama_alat')
        ->where('inventaris_detail.id_inventaris','=', $id)
        ->get();

        $inventaris = DB::table('inventaris')
        ->select('inventaris.bulan as bulan','inventaris.tahun as tahun')
        ->where('inventaris.id','=', $id)
        ->get();

        $user = Pengguna::find($request->session()->get('id'));

        return view('dashboard.inventaris.show', compact('alats', 'inventaris', 'user'));
    }
}
