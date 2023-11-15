<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class BMNController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title="Data Barang Milik Negara";

        $tanah = DB::table('td_bmn')
                        ->where('kelompok_bmn','=','1')
                        ->sum('nilai_perolehan');

        $peralatan = DB::table('td_bmn')
                        ->where('kelompok_bmn','=','2')
                        ->sum('nilai_perolehan');

        $gedung = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','3')
                    ->sum('nilai_perolehan');

        $jalan = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','4')
                    ->sum('nilai_perolehan');

        $jaringan = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','5')
                    ->sum('nilai_perolehan');

        $aset = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','6')
                    ->sum('nilai_perolehan');

        $sumNilaiBMN = $tanah + $peralatan + $gedung + $jalan + $jaringan + $aset;

        $nilaiBMN = [
          'tanah' => $tanah,
          'peralatan' => $peralatan,
          'gedung' => $gedung,
          'jalan' => $jalan,
          'jaringan' => $jaringan,
          'aset' => $aset,
        ];

        $persenTanah = round(((double)$tanah / (double)$sumNilaiBMN) * 100, 2);
        $persenPeralatan = round(((double)$peralatan / (double)$sumNilaiBMN) * 100, 2);
        $persenGedung= round(((double)$gedung / (double)$sumNilaiBMN) * 100, 2);
        $persenJalan = round(((double)$jalan / (double)$sumNilaiBMN) * 100, 2);
        $persenJaringan = round(((double)$jaringan / (double)$sumNilaiBMN) * 100, 2);
        $persenAset= round(((double)$aset / (double)$sumNilaiBMN) * 100, 2);

        $persenBMN = [
          'tanah' => $persenTanah,
          'peralatan' => $persenPeralatan,
          'gedung' => $persenGedung,
          'jalan' => $persenJalan,
          'jaringan' => $persenJaringan,
          'aset' => $persenAset,
        ];


        $buku_tanah = DB::table('td_bmn')
                        ->where('kelompok_bmn','=','1')
                        ->sum('nilai_buku');

        $buku_peralatan = DB::table('td_bmn')
                        ->where('kelompok_bmn','=','2')
                        ->sum('nilai_buku');

        $buku_gedung = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','3')
                    ->sum('nilai_buku');

        $buku_jalan = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','4')
                    ->sum('nilai_buku');

        $buku_jaringan = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','5')
                    ->sum('nilai_buku');

        $buku_aset = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','6')
                    ->sum('nilai_buku');

        $sumNilaiBukuBMN = $buku_tanah + $buku_peralatan + $buku_gedung + $buku_jalan + $buku_jaringan + $buku_aset;

        $nilaiBukuBMN = [
          'tanah' => $buku_tanah,
          'peralatan' => $buku_peralatan,
          'gedung' => $buku_gedung,
          'jalan' => $buku_jalan,
          'jaringan' => $buku_jaringan,
          'aset' => $buku_aset,
        ];

        $persenBukuTanah = round(((double)$buku_tanah / (double)$sumNilaiBukuBMN) * 100, 2);
        $persenBukuPeralatan = round(((double)$buku_peralatan / (double)$sumNilaiBukuBMN) * 100, 2);
        $persenBukuGedung= round(((double)$buku_gedung / (double)$sumNilaiBukuBMN) * 100, 2);
        $persenBukuJalan = round(((double)$buku_jalan / (double)$sumNilaiBukuBMN) * 100, 2);
        $persenBukuJaringan = round(((double)$buku_jaringan / (double)$sumNilaiBukuBMN) * 100, 2);
        $persenBukuAset= round(((double)$buku_aset / (double)$sumNilaiBukuBMN) * 100, 2);

        $persenBukuBMN = [
          'tanah' => $persenBukuTanah,
          'peralatan' => $persenBukuPeralatan,
          'gedung' => $persenBukuGedung,
          'jalan' => $persenBukuJalan,
          'jaringan' => $persenBukuJaringan,
          'aset' => $persenBukuAset,
        ];

        $jlh_tanah = DB::table('td_bmn')
                        ->where('kelompok_bmn','=','1')
                        ->sum('kuantitas');

        $jlh_peralatan = DB::table('td_bmn')
                        ->where('kelompok_bmn','=','2')
                        ->sum('kuantitas');

        $jlh_gedung = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','3')
                    ->sum('kuantitas');

        $jlh_jalan = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','4')
                    ->sum('kuantitas');

        $jlh_jaringan = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','5')
                    ->sum('kuantitas');

        $jlh_aset = DB::table('td_bmn')
                    ->where('kelompok_bmn','=','6')
                    ->sum('kuantitas');

        $jumlahBMN = [
          'tanah' => $jlh_tanah,
          'peralatan' => $jlh_peralatan,
          'gedung' => $jlh_gedung,
          'jalan' => $jlh_jalan,
          'jaringan' => $jlh_jaringan,
          'aset' => $jlh_aset,
        ];

        return view('pages.bmn.index_bmn', compact('title', 'persenBMN', 'nilaiBMN', 'sumNilaiBMN', 'persenBukuBMN', 'nilaiBukuBMN', 'sumNilaiBukuBMN', 'jumlahBMN'));
    }

    public function daftarbmn($id_kelompok_bmn)
    {
        if($id_kelompok_bmn==1)
        {
            $title="Daftar Tanah";
        }
        else if($id_kelompok_bmn==2)
        {
            $title="Daftar Peralatan dan Mesin";
        }
        else if($id_kelompok_bmn==3)
        {
            $title="Daftar Gedung dan Bangunan";
        }
        else if($id_kelompok_bmn==4)
        {
            $title="Daftar Jalan dan Jembatan";
        }
        else if($id_kelompok_bmn==5)
        {
            $title="Daftar Jaringan";
        }
        else if($id_kelompok_bmn==6)
        {
            $title="Daftar Aset Tetap Lainnnya";
        }

        $bmn=DB::table('td_bmn')
                  ->where('kelompok_bmn','=',$id_kelompok_bmn)
                  ->get();

        return view('pages.bmn.daftar_bmn', compact('title', 'bmn'));
    }
}
