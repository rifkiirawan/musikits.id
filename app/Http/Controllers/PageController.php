<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Admin;
use App\Models\Informasi;
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

class PageController extends Controller
{
    public function showSewaStudio()
    {
        return view('page.calendar');
    }

    // public function getSewaStudio()
    // {
    //     $sewa = DB::table('sewa_studio')
    //         ->select('id as title','waktu_mulai as start', 'waktu_selesai as end')
    //         ->get();
    //     echo json_encode($sewa);
    // }

    function getEvents(Request $request) {
        $bookings = Sewa_Studio::join('pengguna','pengguna.id','sewa_studio.id_pengguna')
        ->where('sewa_studio.status','=','1')
        ->get(['pengguna.nama_pengguna as title','waktu_mulai as start','waktu_selesai as end']);
        foreach ($bookings as $booking)
        {
            // Force timezone to Asia/Jakarta
            $booking['color'] = "#ff0000";
            $booking['textColor'] = "#000000";
        }
        echo json_encode($bookings);

    }

    function randomcolor($id)
    {
        $y = intval($id);
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        while($y > 0)
        {
            $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
            $y = $y-1;
        }
        return $color;
    }

    function getEventsAlat(Request $request) {
        $bookings = Sewa_Alat::join('pengguna','pengguna.id','peminjaman.id_pengguna')
        ->join('alat','alat.id','peminjaman.id_alat')
        ->where('peminjaman.status','=','1')
        ->get(['waktu_mulai as start','waktu_selesai as end', 'alat.nama_alat as title', 'alat.id as id']);
        foreach ($bookings as $booking)
        {
            // Force timezone to Asia/Jakarta
            $booking['color'] = "#ff0000";
            $booking['textColor'] = "#000000";
        }
        echo json_encode($bookings);

    }
}
