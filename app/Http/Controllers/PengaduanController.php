<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use File;

class PengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Formulir Pengaduan";

        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.pengaduan.form_pengaduan', compact('title', 'id_user', 'user'));
    }

    public function prosespengaduan(Request $request)
    {
        $lainnya = "";

        if($request->input('jenis_pelayanan')=="Lainnya")
        {
            $lainnya = $request->input('lainnya_text');
        }

        $path=public_path().'/file/pengaduan/bukti-pengaduan/';

        if (!File::exists($path))
        {
            $result = File::makeDirectory($path);
        }

        $filename="";

        if($request->hasFile('bukti_pengaduan'))
        {
            $upload_dokumen = $request->file('bukti_pengaduan');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $size = $upload_dokumen->getSize();

            if($size <= 2097152)
            {         
                $code = Carbon::now()->timestamp;
                $filename = "BuktiPengaduan_".$code.".".$extension;
                $upload_dokumen->move($path, $filename); 
            }
            else
            {
                return Redirect::back()->with('failed','Ukuran file harus lebih kecil dari 2 MB');
            }
        }   

        $data = array(
          'id_user' => $request->input('id_user'),
          'nama' => $request->input('nama'),
          'no_hp' => $request->input('no_hp'),
          'email' => $request->input('email'),
          'jenis_pelayanan' => $request->input('jenis_pelayanan'),
          'lainnya' => $lainnya,
          'uraian_pengaduan' => $request->input('uraian_pengaduan'),
          'bukti_pengaduan' => $filename,
          'is_process' => 'no',
        );

        $insertID = DB::table('td_pengaduan')->insertGetId($data);

        return Redirect::to('daftar-pengaduan')->with('message','Berhasil menyimpan data');
    }

    public function daftarpengaduan()
    {
        $title="Riwayat Pengaduan";

        $id_user = Auth::user()->id;
        if(Auth::user()->hasRole('admin'))
        {
            $pengaduan=DB::table('td_pengaduan')
                    ->orderBy('id', 'desc')
                    ->get();
        }
        else
        {
            $pengaduan=DB::table('td_pengaduan')
                    ->where('id_user', '=', $id_user)
                    ->orderBy('id', 'desc')
                    ->get();
        }

        return view('pages.pengaduan.daftar_pengaduan', compact('title', 'pengaduan'));
    }

    public function daftarpengaduanbystatus($status)
    {
        $title="Pengaduan Masyarakat (".$status.")";

        if($status=="Open")
        {
            $pengaduan=DB::table('td_pengaduan')
                ->where('is_process','=','no')
                ->where('is_solved','=',null)
                ->where('is_cancel','=',null)
                ->orderBy('id', 'desc')
                ->get();
        }
        else if($status=="Process")
        {
            $pengaduan= DB::table('td_pengaduan')
                ->where('is_process','=','yes')
                ->where('is_solved','=',null)
                ->where('is_cancel','=',null)
                ->orderBy('id', 'desc')
                ->get();
        }
        else if($status=="Solved")
        {   
            $pengaduan= DB::table('td_pengaduan')
                ->where('is_process','=','yes')
                ->where('is_solved','=','yes')
                ->where('is_cancel','=',null)
                ->orderBy('id', 'desc')
                ->get();
        }
        else if($status=="Cancel")
        {
            $pengaduan= DB::table('td_pengaduan')
                ->where('is_solved','=',null)
                ->where('is_cancel','=','yes')
                ->orderBy('id', 'desc')
                ->get();
        }
        else
        {
            $pengaduan= DB::table('td_pengaduan')
                ->orderBy('id', 'desc')
                ->get();
        }


        return view('pages.pengaduan.daftar_pengaduan', compact('title', 'pengaduan'));
    }

     public function detailpengaduan($id)
    {
        $title="Detail Pengaduan";

        $detail=DB::table('td_pengaduan')
                  ->where('id', '=', $id)
                  ->first();

        return view('pages.pengaduan.detail_pengaduan', compact('title', 'detail'));
    }

    public function updatepengaduaninprogress(Request $request, $id)
    {
        $data = array(
          'is_process' => 'yes',
          'process_at' => Carbon::now()->toDateTimeString(),
        );

        DB::table('td_pengaduan')->where('id','=',$id)->update($data);

        return Redirect::to('daftar-pengaduan')->with('message','Berhasil menyimpan data');
    }

    public function updatepengaduansolved(Request $request)
    {   
        $id = $request->input('id_solve');

        $namafile="";

        if($request->hasFile('bukti_tindaklanjut'))
        {
            $upload_dokumen = $request->file('bukti_tindaklanjut');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $namafile = "TindakLanjut_".$id.time().".".$extension;
            $tujuan_upload = public_path(). '/file/pengaduan/tindak-lanjut/';
            $upload_dokumen->move($tujuan_upload, $namafile);
        }      

        $data = array(
          'keterangan_tindaklanjut' => $request->input('keterangan_tindaklanjut'),
          'bukti_tindaklanjut' => $namafile,
          'is_solved' => 'yes',
          'solved_at' => Carbon::now()->toDateTimeString(),
        );

        DB::table('td_pengaduan')->where('id','=',$id)->update($data);

        return Redirect::to('daftar-pengaduan')->with('message','Berhasil menyimpan data');
    }

    public function updatepengaduancancel(Request $request)
    {
        $id = $request->input('id_cancel');

        $data = array(
          'keterangan_tindaklanjut' => $request->input('keterangan_tindaklanjut'),
          'is_cancel' => 'yes',
          'cancel_at' => Carbon::now()->toDateTimeString(),
        );

        DB::table('td_pengaduan')->where('id','=',$id)->update($data);

        return Redirect::to('daftar-pengaduan')->with('message','Berhasil menyimpan data');
    }
}
