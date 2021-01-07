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
        if(request()->ajax())
        {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Sewa_Studio::whereDate('waktu_mulai', '>=', $start)->whereDate('waktu_selesai',   '<=', $end)->get(['id','waktu_mulai', 'waktu_selesai']);

            return Response::json($data);
        }
        return view('page.calendar');
    }

}
