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
        $bookings = Sewa_Studio::get(['id as title','waktu_mulai as start','waktu_selesai as end']);
        foreach ($bookings as $booking)
        {
            // Force timezone to Asia/Jakarta
            $booking['start'] = Carbon::parse($booking['start'])->addHours(7);
            $booking['end'] = Carbon::parse($booking['end'])->addHours(7);
            $booking['color'] = "#ff0000";
            $booking['textColor'] = "#000000";
        }
        echo json_encode($bookings);

    }
}
