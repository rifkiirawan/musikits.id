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
use App\Models\Pengguna;


class PenggunaController extends Controller
{
    public function showLoginForm(){
        return view('customAuth.login');
    }

    public function showRegisterFormUmum(){
        return view('customAuth.register.umum');
    }

    public function showRegisterFormAnggota(){
        return view('customAuth.register.anggota');
    }

    public function Login(Request $request)
    {
        $pengguna = Pengguna::where('email' ,'=', $request->input('email'))->first();

        if ($pengguna)
        {
            if($pengguna->status == 1)
            {
                if (Hash::check($request->input('password'), $pengguna->password))
                {
                    $request->session()->put([
                        'login' => true,
                        'id' => $pengguna->id,
                        'nama' => $pengguna->nama,
                        'email' => $pengguna->email,
                        'role' => $pengguna->role,
                    ]);
		    //dd($request->session());
                    Session::flash('success', 'Anda berhasil Login');
                    return redirect('/');
                }else
                {
                    Session::flash('error', 'Password tidak cocok');
                    return redirect()->route('registerUmum');
                }
            }
            else if($pengguna->status == 0)
            {
                Session::flash('error', 'Akun anda belum divalidasi');
                return redirect()->route('registerUmum');
            }
            else
            {
                Session::flash('error', 'Akun tidak ditemukan');
                return redirect()->route('registerUmum');
            }
        }
        Session::flash('error', 'Anda belum mempunyai akun, silahkan register terlebih dahulu');
        return redirect()->route('registerUmum');
    }

    public function RegisterUmum(Request $request)
    {
        // dd($request->input('email'));
        // dd($formatDate);

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:pengguna',
            'pass'          => 'required|min:8',
            're_pass'       => 'required|min:8|same:pass',
            'nama'          => 'required',
            // 'role'          => 'required',
            // 'jenis_kelamin' => 'required',
            'notelp'        => 'required|max:15',
            'idLine'        => 'required|max:255',
            'alamat'        => 'required|max:256',
        ],
        [
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email harus menggunakan email yang belum pernah dipakai!',
            'pass.required' => 'Password harus diisi!',
            'pass.min' => 'Password minimal terdiri dari 8 karakter!',
            're_pass.required' => 'Konfirmasi Password harus diisi!',
            're_pass.same' => 'Konfirmasi password harus sama dengan password yang diisikan!',
            // 'role.required' => 'Role harus diisi!',
            // 'jenis_kelamin.required' => 'Jenis Kelamin harus diisi!',
            'alamat.required' => 'Alamat Mahasiswa harus diisi!',
            'notelp.required' => 'Nomor Handphone harus diisi!',
            'notelp.max' => 'Nomor Handphone maksimal panjangnya 15 karakter!',
            'idLine.required' => 'ID Line harus diisi!',
            'idLine.max' => 'ID Line maksimal panjangnya 255 karakter!',
            'nama.required' => 'Nama Pengguna harus diisi!',
        ]);


        if ($validator->fails()) {
            // Session::flash('error', $validator->errors());
            return redirect()->back()->withErrors($validator->messages())->withInput();;
        }
        try {

            DB::transaction(function() use ($request) {
            Pengguna::create([
                'nama_pengguna' => $request->input('nama'),
                'alamat'        => $request->input('alamat'),
                'no_telp'       => $request->input('notelp'),
                'id_line'       => $request->input('idLine'),
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('pass')),
                // 'jenis_kelamin' => $request->input('jenis_kelamin'),
                'role'          => "Non-Anggota",
                'created_at'    => Carbon::now()->toRfc2822String(),
                'updated_at'    => Carbon::now()->toRfc2822String(),
            ]);
            }, 5);
            Session::flash('success', 'Akun berhasil didaftarkan, silahkan tunggu akun anda divalidasi oleh admin');
            return redirect()->route('login');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return redirect()->route('registerUmum');
        }
    }

    public function RegisterAnggota(Request $request)
    {
        // dd($request->input('email'));
        // dd($formatDate);

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:pengguna',
            'pass'          => 'required|min:8',
            're_pass'       =>'required|min:8|same:pass',
            'nama'          => 'required',
            'nrp'          => 'required',
            // 'jenis_kelamin' => 'required',
            'notelp'        => 'required|max:15',
            'idLine'        => 'required|max:255',
            'alamat'        => 'required|max:256',
        ],
        [
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email harus menggunakan email yang belum pernah dipakai!',
            'pass.required' => 'Password harus diisi!',
            'pass.min' => 'Password minimal terdiri dari 8 karakter!',
            're_pass.required' => 'Konfirmasi Password harus diisi!',
            're_pass.same' => 'Konfirmasi password harus sama dengan password yang diisikan!',
            'nrp.required' => 'NRP harus diisi!',
            // 'jenis_kelamin.required' => 'Jenis Kelamin harus diisi!',
            'alamat.required' => 'Alamat Mahasiswa harus diisi!',
            'notelp.required' => 'Nomor Handphone harus diisi!',
            'notelp.max' => 'Nomor Handphone maksimal panjangnya 15 karakter!',
            'idLine.required' => 'ID Line harus diisi!',
            'idLine.max' => 'ID Line maksimal panjangnya 255 karakter!',
            'nama.required' => 'Nama Pengguna harus diisi!',
        ]);


        if ($validator->fails()) {
            // Session::flash('error', $validator->errors());
            return redirect()->back()->withErrors($validator->messages())->withInput();;
        }
        try {

            DB::transaction(function() use ($request) {
            Pengguna::create([
                'nama_pengguna' => $request->input('nama'),
                'alamat'        => $request->input('alamat'),
                'no_telp'       => $request->input('notelp'),
                'id_line'       => $request->input('idLine'),
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('pass')),
                'nrp'           => $request->input('nrp'),
                'role'          => "Anggota",
                'created_at'    => Carbon::now()->toRfc2822String(),
                'updated_at'    => Carbon::now()->toRfc2822String(),
            ]);
            }, 5);
            Session::flash('success', 'Akun berhasil didaftarkan, silahkan tunggu akun anda divalidasi oleh admin');
            return redirect()->route('login');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return redirect()->route('registerAnggota');
        }
    }
    /*<=============== Auth ===============>*/

}
