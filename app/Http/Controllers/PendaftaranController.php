<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use File;


class PendaftaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Pendaftaran Online";
    
        return view('pages.pendaftaran.index_pendaftaran', compact('title'));
    }

    public function datapendaftaran()
    {
        $title = "Riwayat Pendaftaran Online";

        $id_user = Auth::user()->id;

        if(Auth::user()->hasRole('admin'))
        {
            $pendaftaran = DB::table('td_pendaftaran')
                ->leftjoin('md_layanan AS t1', 'td_pendaftaran.id_layanan', '=', 't1.id')
                ->select('td_pendaftaran.*', 't1.nama_layanan AS jenis_layanan')
                ->orderBy('id', 'desc')
                ->get();
        }
        else
        {
            $pendaftaran = DB::table('td_pendaftaran')
                ->where('td_pendaftaran.id_user', '=', $id_user)
                ->leftjoin('md_layanan AS t1', 'td_pendaftaran.id_layanan', '=', 't1.id')
                ->select('td_pendaftaran.*', 't1.nama_layanan AS jenis_layanan')
                ->orderBy('id', 'desc')
                ->get();
        }
    
        return view('pages.pendaftaran.data_pendaftaran', compact('title', 'pendaftaran'));
    }


    public function pendaftaranpengujian()
    {
        $title = "Pendaftaran Pengujian";
        
        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.pendaftaran.tambah_pengujian', compact('title', 'user'));
    }

    public function pendaftarankalibrasi()
    {
        $title = "Pendaftaran Kalibrasi";

        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.pendaftaran.tambah_kalibrasi', compact('title', 'user'));
    }

    public function pendaftaransertifikasi()
    {
        $title = "Pendaftaran Sertifikasi";

        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.pendaftaran.tambah_sertifikasi', compact('title', 'user'));
    }

    public function pendaftaranbimtek()
    {
        $title = "Pendaftaran Bimbingan Teknis";

        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.pendaftaran.tambah_bimtek', compact('title','user'));
    }

    public function pendaftarankonsultansi()
    {
        $title = "Pendaftaran Konsultansi";

        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.pendaftaran.tambah_konsultansi', compact('title', 'user'));
    }

    public function prosespendaftaran(Request $request)
    {
        DB::beginTransaction();

        try 
        {
            $tgl_permohonan= $request->input('tgl_permohonan');
            $newTglPermohonan= Carbon::createFromFormat('d/m/Y', $tgl_permohonan)->format('Y-m-d');

            $path=public_path().'/file/pendaftaran/formulir/';

            if (!File::exists($path))
            {
                $result = File::makeDirectory($path);
            }

            $filename="";

            if($request->hasFile('upload_dokumen'))
            {
                $upload_dokumen = $request->file('upload_dokumen');
                $extension = $upload_dokumen->getClientOriginalExtension();
                $size = $upload_dokumen->getSize();

                if($size <= 2097152)
                {         
                    $code = Carbon::now()->timestamp;
                    $filename = "Formulir_".$code.".".$extension;
                    $upload_dokumen->move($path, $filename); 
                }
                else
                {
                    return Redirect::back()->with('failed','Ukuran file harus lebih kecil dari 2 MB');
                }
            }   

            $data = array(
                'id_user' => Auth::user()->id,
                'id_layanan' => $request->input('id_layanan'),
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'tgl_permohonan' => $newTglPermohonan,
                'link_formulir' => $filename,
                'created_at' => Carbon::now()->toDateTimeString(),
                'created_by' => Auth::user()->id,
            );

            DB::table('td_pendaftaran')->insert($data);

            DB::commit();

            return Redirect::to('data-pendaftaran')->with('message','Data berhasil disimpan.');

        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            // something went wrong

            return Redirect::to('arsip')->with('failed',$e);
        }
    }

}
