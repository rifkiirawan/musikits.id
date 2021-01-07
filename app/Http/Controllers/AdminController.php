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


class AdminController extends Controller
{
    // menampilkan form login admin
    public function showLogin() {

        return view('admin.login');

    }

    public function showHome(Request $request) {
        $allAdmin = Admin::all();
        return view('admin.dashboard.home', [
            'nama' => $request->session()->get('nama'),
            'admin_total' => $allAdmin->count()
        ]);

    }

    // login admin
    public function Login(Request $request) {

        $admin = Admin::where('email', '=', $request->input('email'))->first();
        if($admin) {
            if(Hash::check($request->input('password'), $admin->password)) {

                $request->session()->put([
                    'login'     => true,
                    'nama'      => $admin->nama,
                    'id'        => $admin->id,
                    'email'     => $admin->email,
                    'role'      => 'admin',
                    'mobile_no' => $admin->mobile_no,
                ]);

                Session::flash('success', 'Anda berhasil Login');
                return redirect('/admin/dashboard');
            }else{
                // password salah
                Session::flash('error', 'Salah Password');
                return redirect('/admin-login');
            }
        }else{
            // admin tidak ditemukan
            Session::flash('error', 'User tidak dapat ditemukan');
            return redirect('/admin-login');
        }

    }

    // menampilkan form register admin
    public function showRegister(Request $request) {

        return view('admin.dashboard.admin.register-admin', [
            'nama' => $request->session()->get('nama')
        ]);


    }

    // mendaftarkan admin
    public function Register(Request $request) {
        // dd($request->all());
        try {
            Admin::create([
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'no_hp' => $request->input('no_hp'),
                'password' => Hash::make($request->input('password')),
            ]);

            Session::flash('sukses', 'Admin berhasil didaftarkan');
            return redirect('admin/dashboard/list-admin');

        }catch(\Illuminate\Database\QueryException $e){

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('admin/dashboard/register-admin');
            }
        }
    }

    public function listAdmin(Request $request) {
        $admins = Admin::paginate(10);
        return view('admin.dashboard.admin.list-admin', [
            'nama' => $request->session()->get('nama'),
            'admins'  => $admins
        ]);
    }

    public function showCreateInfo(Request $request) {
        return view('admin.dashboard.informasi.create-info', [
            'nama' => $request->session()->get('nama'),
        ]);
    }

    public function createInfo(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama'         => 'required',
            'deskripsi'    => 'required',
            'tipe'         => 'required',
            'gambar'       => 'required|mimes:png|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('gagal', $validator->errors());
            return redirect()->back()->withInput();
        }

        try {
            $berkas = $request->file('gambar');
            $nama = $request->input('nama');
            $ext = $berkas->getClientOriginalExtension();
            $current = Carbon::now()->format('YmdHs');
            $filename = $nama.'_'.$current.'_'.'Gambar'.'.'.$ext;
            $tujuan = 'Data/Informasi';
            DB::transaction(function() use ($request,$filename){
                Informasi::create([
                    'nama' => $request->input('nama'),
                    'deskripsi' => $request->input('deskripsi'),
                    'tipe' => $request->input('tipe'),
                    'gambar' => $filename,
                    'created_at' => Carbon::now()->toRfc2822String(),
                    'updated_at' => Carbon::now()->toRfc2822String()
                ]);
            }, 5);
            $berkas->move($tujuan, $filename);
            Session::flash('sukses', 'Informasi berhasil ditambahkan');
            return redirect('/admin/dashboard/list-info');
        } catch (Exception $e) {
            Session::flash('gagal', 'Informasi tidak berhasil ditambahkan, '.$e->getMessage());
            return redirect('/admin/dashboard/list-info');
        }
    }

    public function listInfo(Request $request) {
        $infos = Informasi::paginate(10);
        return view('admin.dashboard.informasi.list-info', [
            'nama' => $request->session()->get('nama'),
            'infos'  => $infos
        ]);
    }

    public function showCreateStuff(Request $request)
    {
        return view('admin.dashboard.alatbarang.create-alat-barang', [
            'nama' => $request->session()->get('nama'),
        ]);
    }

    public function createStuff(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama'         => 'required',
            'harga'        => 'required',
            'status'       => 'required',
            'gambar'       => 'required|mimes:png|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('gagal', $validator->errors());
            return redirect()->back()->withInput();
        }

        try {
            $berkas = $request->file('gambar');
            $nama = $request->input('nama');
            $ext = $berkas->getClientOriginalExtension();
            $current = Carbon::now()->format('YmdHs');
            $filename = $nama.'_'.$current.'_'.'Gambar'.'.'.$ext;
            $tujuan = 'Data/AlatBarang';
            DB::transaction(function() use ($request,$filename){
                AlatBarang::create([
                    'nama_alat' => $request->input('nama'),
                    'harga_sewa' => $request->input('harga'),
                    'status_barang' => $request->input('status'),
                    'gambar' => $filename,
                    'created_at' => Carbon::now()->toRfc2822String(),
                    'updated_at' => Carbon::now()->toRfc2822String()
                ]);
            }, 5);
            $berkas->move($tujuan, $filename);
            Session::flash('sukses', 'Alat dan Barang berhasil ditambahkan');
            return redirect('/admin/dashboard/list-stuff');
        } catch (Exception $e) {
            Session::flash('gagal', 'Alat dan Barang tidak berhasil ditambahkan, '.$e->getMessage());
            return redirect('/admin/dashboard/list-stuff');
        }
    }

    public function listStuff(Request $request)
    {
        $infos = AlatBarang::paginate(10);
        return view('admin.dashboard.alatbarang.list-alat-barang', [
            'nama' => $request->session()->get('nama'),
            'infos'  => $infos
        ]);
    }
}
