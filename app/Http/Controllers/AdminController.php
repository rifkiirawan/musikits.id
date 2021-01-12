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


class AdminController extends Controller
{
    // menampilkan form login admin
    public function showLogin() {

        return view('admin.login');

    }

    public function showHome(Request $request) {
        $allAdmin = Admin::all();
        $allPendingStudio = Sewa_Studio::where('status','=','0');
        $allPendingAlat = Sewa_Alat::where('status','=','0');
        $allPendingUsers = Pengguna::where('status','=','0');
        return view('admin.dashboard.home', [
            'nama' => $request->session()->get('nama'),
            'admin_total' => $allAdmin->count(),
            'studio_total' => $allPendingStudio->count(),
            'alat_total' => $allPendingAlat->count(),
            'pengguna_total' => $allPendingUsers->count()
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

    public function listUmum(Request $request){
        $users =  DB::table('pengguna')
        ->select('pengguna.*')
        ->where('pengguna.role','=', 'Non-Anggota')
        ->where('pengguna.status', '=', '1')
        ->orderBy('created_at')
        ->paginate(10);
        return view('admin/dashboard/pengguna/list-umum', [
            'nama' => $request->session()->get('nama'),
            'users'  => $users
        ]);
    }

    public function listAnggota(Request $request){
        $users =  DB::table('pengguna')
        ->select('pengguna.*')
        ->where('pengguna.role','=', 'Anggota')
        ->where('pengguna.status', '=', '1')
        ->orderBy('created_at')
        ->paginate(10);
        return view('admin/dashboard/pengguna/list-anggota', [
            'nama' => $request->session()->get('nama'),
            'users'  => $users
        ]);
    }

    public function listNewUmum(Request $request){
        $users =  DB::table('pengguna')
        ->select('pengguna.*')
        ->where('pengguna.role','=', 'Non-Anggota')
        ->where('pengguna.status', '=', '0')
        ->orderBy('created_at')
        ->paginate(10);
        return view('admin/dashboard/pengguna/verifikasi-umum', [
            'nama' => $request->session()->get('nama'),
            'users'  => $users
        ]);
    }

    public function approveUmum(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $student = Pengguna::find($id);
                $student->status = 1;
                $student->save();
            }, 5);
            Session::flash('sukses', 'Akun pengguna berhasil di-approve');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Akun pengguna tidak berhasil di-approve,'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function rejectUmum(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $student = Student::find($id);
                $student->status = 2;
                $student->save();
            }, 5);
            Session::flash('sukses', 'Akun pengguna berhasil di-reject');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Akun pengguna tidak berhasil di-reject,'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function listNewAnggota(Request $request){
        $users =  DB::table('pengguna')
        ->select('pengguna.*')
        ->where('pengguna.role','=', 'Anggota')
        ->where('pengguna.status', '=', '0')
        ->orderBy('created_at')
        ->paginate(10);
        return view('admin/dashboard/pengguna/verifikasi-anggota', [
            'nama' => $request->session()->get('nama'),
            'users'  => $users
        ]);
    }

    public function approveAnggota(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $student = Pengguna::find($id);
                $student->status = 1;
                $student->save();
            }, 5);
            Session::flash('sukses', 'Akun pengguna berhasil di-approve');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Akun pengguna tidak berhasil di-approve,'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function rejectAnggota(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $student = Student::find($id);
                $student->status = 2;
                $student->save();
            }, 5);
            Session::flash('sukses', 'Akun pengguna berhasil di-reject');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Akun pengguna tidak berhasil di-reject,'.$e->getMessage());
            return redirect()->back();
        }
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
            'subjudul'     => 'required',
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
                    'subjudul' => $request->input('subjudul'),
                    'gambar' => $filename,
                    'id_admin'  => $request->session()->get('id'),
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
        $infos = Informasi::join('admin','admin.id', 'informasi.id_admin')
        ->select('informasi.*','admin.nama as nama_admin')->paginate(10);
        return view('admin.dashboard.informasi.list-info', [
            'nama' => $request->session()->get('nama'),
            'infos'  => $infos
        ]);
    }

    public function updateInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'id_info'       => 'required',
            'nama'         => 'required',
            'deskripsi'    => 'nullable',
            'tipe'         => 'required',
            'subjudul'     => 'required',
            'gambar'       => 'nullable|mimes:png|max:1024',
        ]);

        if ($validator->fails()) {
            Session::flash('gagal', $validator->errors());
            return redirect()->back()->withInput();
        }

        try {

            $info = Informasi::find($request->input('id_info'));
            $filename = null;
            if( $request->file('gambar') != null)
            {
                $berkas = $request->file('gambar');
                $nama = $request->input('nama');
                $ext = $berkas->getClientOriginalExtension();
                $current = Carbon::now()->format('YmdHs');
                $filename = $nama.'_'.$current.'_'.'Gambar'.'.'.$ext;
            }else{
                $filename = '';
            }
            $gambarlama = 'Data/Informasi/'.$info->gambar;
            $tujuan = 'Data/Informasi';

            if( $request->input('deskripsi') != null )
            {
                $deskripsi = $request->input('deskripsi');
            }
            else
            {
                $deskripsi = $info->deskripsi;
            }

            if($request->file('gambar') === null)
            {
                DB::transaction(function() use ($request,$deskripsi) {
                    Informasi::where([
                        'id' => $request->input('id_info')
                    ])->update([
                        'nama' => $request->input('nama'),
                        'deskripsi' => $deskripsi,
                        'tipe' => $request->input('tipe'),
                        'subjudul' => $request->input('subjudul'),
                        'updated_at' => Carbon::now()
                    ]);
                }, 5);
                Session::flash('sukses', 'Info berhasil diupdate');
                return redirect()->back();
            }
            else
            {
                DB::transaction(function() use ($request, $filename, $deskripsi) {
                    Informasi::where([
                        'id' => $request->input('id_info')
                    ])->update([
                        'nama' => $request->input('nama'),
                        'deskripsi' => $deskripsi,
                        'tipe' => $request->input('tipe'),
                        'subjudul' => $request->input('subjudul'),
                        'gambar'    => $filename,
                        'updated_at' => Carbon::now()
                    ]);
                }, 5);
                if(\File::exists(public_path($gambarlama)))
                {
                    \File::delete(public_path($gambarlama));  // or unlink($filename);
                }
                $berkas->move($tujuan, $filename);
                Session::flash('sukses', 'Informasi berhasil diupdate');
                return redirect()->back();
            }

        } catch(Exception $e) {
            Session::flash('gagal', 'Informasi gagal diupdate, '.$e->getMessage());
            return redirect()->back();
        }
    }


    public function deleteInfo($id)
    {
        $info = Informasi::find($id);
        $info->delete();
        Session::flash('sukses', 'Informasi berhasil dihapus');
        return redirect()->back();
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
                    'id_admin'  => $request->session()->get('id'),
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
        $alats = AlatBarang::leftjoin('admin','admin.id', 'alat.id_admin')
        ->select('alat.*','admin.nama as nama_admin')->paginate(10);
        return view('admin.dashboard.alatbarang.list-alat-barang', [
            'nama' => $request->session()->get('nama'),
            'alats'  => $alats
        ]);
    }

    public function updateStuff(Request $request){
        $validator = Validator::make($request->all(), [
            'id_alat'       => 'required',
            'nama'         => 'required',
            'harga'        => 'required',
            'status'       => 'required',
            'gambar'       => 'nullable|mimes:png|max:1024',
        ]);

        if ($validator->fails()) {
            Session::flash('gagal', $validator->errors());
            return redirect()->back()->withInput();
        }
        try {

            $alat = AlatBarang::find($request->input('id_alat'));
            $filename = null;
            if( $request->file('gambar') != null)
            {
                $berkas = $request->file('gambar');
                $nama = $request->input('nama');
                $ext = $berkas->getClientOriginalExtension();
                $current = Carbon::now()->format('YmdHs');
                $filename = $nama.'_'.$current.'_'.'Gambar'.'.'.$ext;
            }else{
                $filename = '';
            }
            // dd($filename);
            $gambarlama = 'Data/AlatBarang/'.$alat->gambar;
            $tujuan = 'Data/AlatBarang';


            if($request->file('gambar') === null)
            {
                DB::transaction(function() use ($request) {
                    AlatBarang::where([
                        'id' => $request->input('id_alat')
                    ])->update([
                        'nama_alat' => $request->input('nama'),
                        'harga_sewa' => $request->input('harga'),
                        'status_barang' => $request->input('status'),
                        'updated_at' => Carbon::now()
                    ]);
                }, 5);
                Session::flash('sukses', 'Alat Barang berhasil diupdate');
                return redirect()->back();
            }
            else
            {
                DB::transaction(function() use ($request, $filename) {
                    AlatBarang::where([
                        'id' => $request->input('id_alat')
                    ])->update([
                        'nama_alat' => $request->input('nama'),
                        'harga_sewa' => $request->input('harga'),
                        'status_barang' => $request->input('status'),
                        'gambar'    => $filename,
                        'updated_at' => Carbon::now()
                    ]);
                }, 5);
                if(\File::exists(public_path($gambarlama)))
                {
                    \File::delete(public_path($gambarlama));  // or unlink($filename);
                }
                $berkas->move($tujuan, $filename);
                Session::flash('sukses', 'Alat Barang berhasil diupdate');
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            Session::flash('gagal', 'Alat Barang gagal diupdate, '.$e->getMessage());
            return redirect()->back();
        }
    }

    public function deleteStuff($id)
    {
        $alat = AlatBarang::find($id);
        $alat->delete();
        Session::flash('sukses', 'Alat berhasil dihapus');
        return redirect()->back();
    }

    public function showCreateInventory(Request $request) {
        $alats = AlatBarang::all();
        return view('admin.dashboard.inventaris.create-inventaris', [
            'nama' => $request->session()->get('nama'),
            'alats' => $alats
        ]);
    }

    public function createInventory(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'tahun'         => 'required',
            'bulan'         => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('gagal', $validator->errors());
            return redirect()->back()->withInput();
        }

        try {
            $id = DB::table('inventaris')->insertGetId([
                'tahun' => $request->input('tahun'),
                'bulan' => $request->input('bulan'),
                'id_admin'  => $request->session()->get('id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $alats = AlatBarang::all();
            foreach($alats as $alat)
            {
                DB::transaction(function() use ($request, $alat, $id){
                    InventarisDetail::create([
                        'status_barang' => $alat->status_barang,
                        'id_alat' => $alat->id,
                        'id_inventaris' => $id,
                        'created_at' => Carbon::now()->toRfc2822String(),
                        'updated_at' => Carbon::now()->toRfc2822String()
                    ]);
                }, 5);
            }
            Session::flash('sukses', 'Inventaris berhasil ditambahkan');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('gagal', 'Inventaris tidak berhasil ditambahkan, '.$e->getMessage());
            return redirect()->back();
        }
    }

    public function showListInventory(Request $request) {
        $inventaris = Inventaris::paginate(10);
        return view('admin.dashboard.inventaris.list-inventaris', [
            'nama' => $request->session()->get('nama'),
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
        // dd($inventaris);
        return view('admin.dashboard.inventaris.detail-inventaris', [
            'nama' => $request->session()->get('nama'),
            'alats' => $alats,
            'inventaris' => $inventaris
        ]);
    }

    public function deleteInventory($id)
    {
        $alat = Inventaris::find($id);
        $alat->delete();
        Session::flash('sukses', 'Inventaris berhasil dihapus');
        return redirect()->back();
    }

    public function listStudioBooking(Request $request){
        $bookings =  DB::table('sewa_studio')
        ->join('pengguna','pengguna.id','sewa_studio.id_pengguna')
        ->select('sewa_studio.*', 'pengguna.nama_pengguna', 'pengguna.no_telp')
        ->where('sewa_studio.status', '=', '1')
        ->orderBy('created_at')
        ->paginate(10);
        return view('admin/dashboard/sewa_studio/list', [
            'nama' => $request->session()->get('nama'),
            'bookings'  => $bookings
        ]);
    }

    public function listNewStudioBooking(Request $request){
        $bookings =  DB::table('sewa_studio')
        ->join('pengguna','pengguna.id','sewa_studio.id_pengguna')
        ->select('sewa_studio.*', 'pengguna.nama_pengguna', 'pengguna.no_telp')
        ->where('sewa_studio.status', '=', '0')
        ->orderBy('updated_at')
        ->paginate(10);
        return view('admin/dashboard/sewa_studio/verifikasi', [
            'nama' => $request->session()->get('nama'),
            'bookings'  => $bookings
        ]);
    }

    public function approveStudioBooking(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $booking = Sewa_Studio::find($id);
                $booking->status = 1;
                $booking->save();
            }, 5);
            Session::flash('sukses', 'Penyewaan berhasil di-approve');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Penyewaan tidak berhasil di-approve'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function rejectStudioBooking(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $booking = Sewa_Studio::find($id);
                $booking->status = 2;
                $booking->save();
            }, 5);
            Session::flash('sukses', 'Penyewaan berhasil di-reject');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Penyewaan tidak berhasil di-reject'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function calendarStudioBooking(Request $request){
        return view('admin/dashboard/sewa_studio/calendar', [
            'nama' => $request->session()->get('nama'),
        ]);
    }

    public function listStuffBooking(Request $request){
        $bookings =  DB::table('peminjaman')
        ->join('pengguna','pengguna.id','peminjaman.id_pengguna')
        ->join('alat','alat.id','peminjaman.id_alat')
        ->select('peminjaman.*', 'pengguna.nama_pengguna', 'pengguna.no_telp', 'alat.nama_alat')
        ->where('peminjaman.status', '=', '1')
        ->orderBy('created_at')
        ->paginate(10);
        return view('admin/dashboard/sewa_alat/list', [
            'nama' => $request->session()->get('nama'),
            'bookings'  => $bookings
        ]);
    }

    public function listNewStuffBooking(Request $request){
        $bookings =  DB::table('peminjaman')
        ->join('pengguna','pengguna.id','peminjaman.id_pengguna')
        ->join('alat','alat.id','peminjaman.id_alat')
        ->select('peminjaman.*', 'pengguna.nama_pengguna', 'pengguna.no_telp', 'alat.nama_alat')
        ->where('peminjaman.status', '=', '0')
        ->orderBy('updated_at')
        ->paginate(10);
        return view('admin/dashboard/sewa_alat/verifikasi', [
            'nama' => $request->session()->get('nama'),
            'bookings'  => $bookings
        ]);
    }

    public function approveStuffBooking(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $booking = Sewa_Alat::find($id);
                $booking->status = 1;
                $booking->save();
            }, 5);
            Session::flash('sukses', 'Penyewaan berhasil di-approve');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Penyewaan tidak berhasil di-approve'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function rejectStuffBooking(Request $request, $id){
        try {
            DB::transaction(function() use ($request, $id) {
                $booking = Sewa_Alat::find($id);
                $booking->status = 2;
                $booking->save();
            }, 5);
            Session::flash('sukses', 'Penyewaan berhasil di-reject');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('gagal', 'Penyewaan tidak berhasil di-reject'.$e->getMessage());
            return redirect()->back();
        }
    }
    public function calendarStuffBooking(Request $request){
        return view('admin/dashboard/sewa_alat/calendar', [
            'nama' => $request->session()->get('nama'),
        ]);
    }
}
