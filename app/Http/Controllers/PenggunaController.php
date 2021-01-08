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
                    return redirect()->route('pengguna/show-login');
                }
            }
            else if($pengguna->status == 0)
            {
                Session::flash('error', 'Akun anda belum divalidasi');
                return redirect()->route('pengguna/show-login');
            }
            else
            {
                Session::flash('error', 'Akun tidak ditemukan');
                return redirect()->route('pengguna/show-login');
            }
        }
        Session::flash('error', 'Anda belum mempunyai akun, silahkan register terlebih dahulu');
        return redirect()->route('pengguna/show-register');
    }

    public function Register(Request $request)
    {
        // dd($request->input('email'));
        // dd($formatDate);

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:pengguna',
            'password'      => 'required|min:8',
            'nama_pengguna' => 'required',
            'role'          => 'required',
            'jenis_kelamin' => 'required',
            'no_telp'       => 'required|max:15',
            'id_line'       => 'required|max:255',
            'alamat'        => 'required|max:256',
        ],
        [
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email harus menggunakan email yang belum pernah dipakai!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal terdiri dari 8 karakter!',
            'role.required' => 'Role harus diisi!',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi!',
            'alamat.required' => 'Alamat Mahasiswa harus diisi!',
            'no_telp.required' => 'Nomor Handphone harus diisi!',
            'no_telp.max' => 'Nomor Handphone maksimal panjangnya 15 karakter!',
            'id_line.required' => 'ID Line harus diisi!',
            'id_line.max' => 'ID Line maksimal panjangnya 255 karakter!',
            'nama_pengguna.required' => 'Nama Pengguna harus diisi!',
        ]);


        if ($validator->fails()) {
            // Session::flash('error', $validator->errors());
            return redirect()->back()->withErrors($validator->messages())->withInput();;
        }
        if($request->input('role') == "anggota")
        {
            $role = "Anggota";
        }
        else
        {
            $role = "Non-Anggota";
        }
        try {

            DB::transaction(function() use ($request,$role) {
            Pengguna::create([
                'nama_pengguna' => $request->input('nama_pengguna'),
                'alamat'        => $request->input('alamat'),
                'no_telp'       => $request->input('no_telp'),
                'id_line'        => $request->input('id_line'),
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('password')),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'role'          => $role,
                'created_at'    => Carbon::now()->toRfc2822String(),
                'updated_at'    => Carbon::now()->toRfc2822String(),
            ]);
            }, 5);
            Session::flash('success', 'Akun berhasil didaftarkan, silahkan tunggu akun anda divalidasi oleh admin');
            return redirect()->route('student/show-login');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return redirect()->route('student/show-register');
        }
    }
    /*<=============== Auth ===============>*/

}
