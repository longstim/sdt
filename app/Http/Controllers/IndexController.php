<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class IndexController extends Controller
{

    public function index()
    {
        $title="Homepage";
    
        return view('homepage', compact('title'));
    }

    public function layananklien()
    {    
        $title="Layanan Klien";

        return view('layanan', compact('title'));
    }

    public function prosespermohonaninformasipublik(Request $request)
    {
        $totalNumber    = DB::table('td_permohonan_informasi')
                            ->get()
                            ->count();

        if($totalNumber > 0)
        {
            $lastNumber     = DB::table('td_permohonan_informasi')
                            ->orderBy('id', 'desc')
                            ->first();
            $lastNumber     = $lastNumber->no_daftar_temp + 1;
        }
        else 
        {
            $lastNumber     = $totalNumber + 1;
        }

        $no_pendaftaran = number($lastNumber)."/BSKJI/BSPJI-Medan/PPID/".getRomawi(date('m'))."/".date('Y');

        $namafile="";

        if($request->hasFile('upload_dokumen'))
        {
            $upload_dokumen = $request->file('upload_dokumen');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $namafile = "ID_".$lastNumber.".".$extension;
            $tujuan_upload = public_path(). '/file/permohonan-informasi/identitas/';
            $upload_dokumen->move($tujuan_upload, $namafile);
        }      

        $data = array(
          'no_daftar_temp' => $lastNumber,
          'no_pendaftaran' => $no_pendaftaran,
          'nama_pemohon' => $request->input('nama_pemohon'),
          'no_identitas' => $request->input('no_identitas'),
          'alamat' => $request->input('alamat'),
          'pekerjaan' => $request->input('pekerjaan'),
          'no_hp' => $request->input('no_hp'),
          'email' => $request->input('email'),
          'rincian' => $request->input('rincian'),
          'tujuan' => $request->input('tujuan'),
          'cara_memperoleh' => $request->input('cara_memperoleh'),
          'cara_mendapatkan' => $request->input('cara_mendapatkan'),
          'is_process' => 'no',
          'upload_dokumen' => $namafile,
        );

        $insertID = DB::table('td_permohonan_informasi')->insertGetId($data);

        return Redirect::to('permohonan-informasi-publik')->with('message','Berhasil menyimpan data');
    }

    public function pengaduan()
    {
        $title="Pengaduan Masyarakat";
    
        return view('pages.pengaduan.form_pengaduan', compact('title'));
    }

    public function prosespengaduan(Request $request)
    {
        $lainnya = "";

        if($request->input('jenis_pelayanan')=="Lainnya")
        {
            $lainnya = $request->input('lainnya_text');
        }

        $data = array(
          'nama' => $request->input('nama'),
          'alamat' => $request->input('alamat'),
          'pekerjaan' => $request->input('pekerjaan'),
          'no_hp' => $request->input('no_hp'),
          'email' => $request->input('email'),
          'jenis_pelayanan' => $request->input('jenis_pelayanan'),
          'lainnya' => $lainnya,
          'uraian_pengaduan' => $request->input('uraian_pengaduan'),
          'is_process' => 'no',
        );

        $insertID = DB::table('td_pengaduan')->insertGetId($data);

        return Redirect::to('pengaduan')->with('message','Berhasil menyimpan data');
    }

    public function kontakkami()
    {
        $title="Kontak Kami";
    
        return view('kontak-kami', compact('title'));
    }

    public function tariflayanan()
    {
        $title="Simulasi Tarif Layanan Jasa Teknis";
        $komoditi = DB::table('md_komoditi')->get();

        return view('pages.informasi-layanan.tarif-layanan', compact('title', 'komoditi'));
    }

    public function alurlayananpengujian()
    {
        $title = "Alur Pelayanan Jasa Pengujian";

        return view('pages.informasi-layanan.alur-layanan-pengujian', compact('title'));
    }

    public function alurlayanankalibrasi()
    {
        $title = "Alur Pelayanan Jasa Kalibrasi";

        return view('pages.informasi-layanan.alur-layanan-kalibrasi', compact('title'));
    }

    public function alurlayanansertifikasi()
    {
        $title = "Alur Pelayanan Jasa Sertifikasi Produk";

        return view('pages.informasi-layanan.alur-layanan-sertifikasi', compact('title'));
    }

    public function standarpelayanan()
    {
        $title = "Standar Pelayanan";

        return view('pages.informasi-layanan.standar-pelayanan', compact('title'));
    }


    public function jsondataparameter($id_komoditi)
    {
        $parameter=DB::table('md_parameter')
            ->where('md_parameter.id_komoditi','=',$id_komoditi)  
            ->pluck('nama_parameter','id');

        //dd($parameter);

        return json_encode($parameter);
    }

    public function jsongethargaparameter($id_parameter)
    {
        $parameter=DB::table('md_parameter')
            ->where('md_parameter.id','=',$id_parameter)  
            ->first();

        //dd($parameter);

        return json_encode($parameter);
    }
}