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

class DashboardUserController extends Controller
{
    public function listStudioBooking(Request $request){
        $bookings =  DB::table('sewa_studio')
        ->join('pengguna','pengguna.id','sewa_studio.id_pengguna')
        ->select('sewa_studio.*')
        ->where('pengguna.id', '=', $request->session()->get('id'))
        ->orderBy('updated_at')
        ->paginate(10);
        //DIISI VIEW DASHBOARD USER LIST STUDIO BOOKING
        return view('admin/dashboard/sewa_studio/list', [
            'nama' => $request->session()->get('nama'),
            'role'  => $request->session()->get('role'),
            'bookings'  => $bookings
        ]);
    }

    public function listStuffBooking(Request $request){
        $bookings =  DB::table('peminjaman')
        ->join('pengguna','pengguna.id','peminjaman.id_pengguna')
        ->join('alat','alat.id','peminjaman.id_alat')
        ->select('peminjaman.*', 'alat.nama_alat')
        ->where('pengguna.id', '=', $request->session()->get('id'))
        ->orderBy('updated_at')
        ->paginate(10);
        //DIISI VIEW DASHBOARD USER LIST ALAT BOOKING
        return view('admin/dashboard/sewa_alat/list', [
            'nama' => $request->session()->get('nama'),
            'role'  => $request->session()->get('role'),
            'bookings'  => $bookings
        ]);
    }

    public function showListInventory(Request $request) {
        //ISI TABEL KAYAK BLADE DI admin/dashboard/inventaris/list-inventaris, nanti ada href ke halaman detail inventory
        $inventaris = Inventaris::paginate(10);
        return view('admin.dashboard.inventaris.list-inventaris', [
            'nama' => $request->session()->get('nama'),
            'role'  => $request->session()->get('role'),
            'inventaris' => $inventaris
        ]);
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
         //ISI TABEL KAYAK BLADE DI admin/dashboard/inventaris/detail-inventaris
        return view('admin.dashboard.inventaris.detail-inventaris', [
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role'),
            'alats' => $alats,
            'inventaris' => $inventaris
        ]);
    }

}
