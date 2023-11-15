<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class PNBPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title="Data PNBP";
        $tahun = 2023;

        $maxTglPNBP = DB::select("SELECT  MAX(tgl_pnbp) AS tgl_pnbp FROM td_pnbp");

        $tgl_pnbp = $maxTglPNBP[0]->tgl_pnbp;

        $lastupdateDate = customTanggal($tgl_pnbp, 'd-m-Y');

        $pnbp_pengujian = DB::select("SELECT  MONTH(tgl_pnbp) AS bulan, SUM(pengujian) AS jumlah
                        FROM     td_pnbp
                        GROUP BY  MONTH(tgl_pnbp)");

        
        $pengujian_Arr=array();
        $totalPNBPPengujian=0;

        for($i=1;$i<=12;$i++)
        {
            $temp=0;
            foreach($pnbp_pengujian as $val)
            {
                if($val->bulan==$i)
                {
                    $temp=$val->jumlah;
                }
            }
            $pengujian_Arr[$i] = $temp;
            $totalPNBPPengujian = $totalPNBPPengujian + $temp;
        }


        $pnbp_kalibrasi = DB::select("SELECT  MONTH(tgl_pnbp) AS bulan, SUM(kalibrasi) AS jumlah
                        FROM     td_pnbp
                        GROUP BY  MONTH(tgl_pnbp)");
        
        $kalibrasi_Arr=array();
        $totalPNBPKalibrasi=0;

        for($i=1;$i<=12;$i++)
        {
            $temp=0;
            foreach($pnbp_kalibrasi as $val)
            {
                if($val->bulan==$i)
                {
                    $temp=$val->jumlah;
                }
            }
            $kalibrasi_Arr[$i] = $temp;
            $totalPNBPKalibrasi = $totalPNBPKalibrasi + $temp;
        }


        $pnbp_sertifikasi = DB::select("SELECT  MONTH(tgl_pnbp) AS bulan, SUM(sertifikasi) AS jumlah
                        FROM     td_pnbp
                        GROUP BY  MONTH(tgl_pnbp)");

        $sertifikasi_Arr=array();
        $totalPNBPSertifikasi=0;

        for($i=1;$i<=12;$i++)
        {
            $temp=0;
            foreach($pnbp_sertifikasi as $val)
            {
                if($val->bulan==$i)
                {
                    $temp=$val->jumlah;
                }
            }
            $sertifikasi_Arr[$i] = $temp;
            $totalPNBPSertifikasi = $totalPNBPSertifikasi + $temp;
        }


        $pnbp_bimtek = DB::select("SELECT  MONTH(tgl_pnbp) AS bulan, SUM(bimtek) AS jumlah
                        FROM     td_pnbp
                        GROUP BY  MONTH(tgl_pnbp)");

        $bimtek_Arr=array();
        $totalPNBPBimtek=0;

        for($i=1;$i<=12;$i++)
        {
            $temp=0;
            foreach($pnbp_bimtek as $val)
            {
                if($val->bulan==$i)
                {
                    $temp=$val->jumlah;
                }
            }
            $bimtek_Arr[$i] = $temp;
            $totalPNBPBimtek = $totalPNBPBimtek + $temp;
        }


        $pnbp_konsultansi= DB::select("SELECT  MONTH(tgl_pnbp) AS bulan, SUM(konsultansi) AS jumlah
                        FROM     td_pnbp
                        GROUP BY  MONTH(tgl_pnbp)");

        $konsultansi_Arr=array();
        $totalPNBPKonsultansi=0;

        for($i=1;$i<=12;$i++)
        {
            $temp=0;
            foreach($pnbp_konsultansi as $val)
            {
                if($val->bulan==$i)
                {
                    $temp=$val->jumlah;
                }
            }
            $konsultansi_Arr[$i] = $temp;
            $totalPNBPKonsultansi = $totalPNBPKonsultansi + $temp;
        }

        $totalPNBP = $totalPNBPPengujian + $totalPNBPKalibrasi + $totalPNBPSertifikasi + $totalPNBPBimtek + $totalPNBPKonsultansi;

        $JumlahPNBP = [
            'pengujian' => $totalPNBPPengujian,
            'kalibrasi' => $totalPNBPKalibrasi,
            'sertifikasi' => $totalPNBPSertifikasi,
            'bimtek' => $totalPNBPBimtek,
            'konsultansi' => $totalPNBPKonsultansi,
        ];

        $persenPengujian = round(((double)$totalPNBPPengujian / (double)$totalPNBP) * 100, 2);
        $persenKalibrasi = round(((double)$totalPNBPKalibrasi / (double)$totalPNBP) * 100, 2);
        $persenSertifikasi= round(((double)$totalPNBPSertifikasi / (double)$totalPNBP) * 100, 2);
        $persenBimtek = round(((double)$totalPNBPBimtek / (double)$totalPNBP) * 100, 2);
        $persenKonsultansi = round(((double)$totalPNBPKonsultansi/ (double)$totalPNBP) * 100, 2);

        $PersenPNBP = [
            'pengujian' => $persenPengujian,
            'kalibrasi' => $persenKalibrasi,
            'sertifikasi' => $persenSertifikasi,
            'bimtek' => $persenBimtek,
            'konsultansi' => $persenKonsultansi,
        ];

        return view('pages.pnbp.index_pnbp', compact('title', 'pengujian_Arr', 'kalibrasi_Arr', 'sertifikasi_Arr', 'bimtek_Arr', 'konsultansi_Arr', 'totalPNBP', 'JumlahPNBP', 'PersenPNBP', 'lastupdateDate'));
    }

    public function daftarpnbp()
    {
        $title="Data PNBP";
        $tahun = 2023;

        $pnbp=DB::table('td_pnbp')
            ->orderBy('tgl_pnbp', 'desc')
            ->get();

        return view('pages.pnbp.daftar_pnbp', compact('title', 'pnbp'));
    }

    public function tambahpnbp()
    {
        $title="Tambah Data PNBP";
        $tahun = 2023;

        return view('pages.pnbp.tambah_pnbp', compact('title'));
    }

    public function prosestambahpnbp(Request $request)
    {
        $title="Data PNBP";
        $tahun = 2023;

        $tgl_pnbp= $request->input('tgl_pnbp');
        $newTglPNBP= Carbon::createFromFormat('d/m/Y', $tgl_pnbp)->format('Y-m-d');

        $dataPNBP = DB::table('td_pnbp')->where('tgl_pnbp', '=', $newTglPNBP)->get();

        if(count($dataPNBP) > 0)
        {
            return redirect::back()->with('message','Data PNBP tanggal '.$newTglPNBP.' sudah ada.');
        }

        $str_pengujian= $request->input('pengujian');
        $pengujian = (int)str_replace('.', '', $str_pengujian);

        $str_kalibrasi= $request->input('kalibrasi');
        $kalibrasi = (int)str_replace('.', '', $str_kalibrasi);

        $str_sertifikasi= $request->input('sertifikasi');
        $sertifikasi = (int)str_replace('.', '', $str_sertifikasi);

        $str_bimtek= $request->input('bimtek');
        $bimtek = (int)str_replace('.', '', $str_bimtek);

        $str_konstultansi= $request->input('konsultansi');
        $konsultansi = (int)str_replace('.', '', $str_konstultansi);

        $data = array(
            'tgl_pnbp' => $newTglPNBP,
            'pengujian' => $pengujian,
            'kalibrasi' => $kalibrasi,
            'sertifikasi' => $sertifikasi,
            'bimtek' => $bimtek,
            'konsultansi' => $konsultansi,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => Auth::user()->id,
        );

        DB::table('td_pnbp')->insert($data);

        return Redirect::to('daftar-pnbp')->with('message','Data berhasil disimpan.');
    }

    public function ubahpnbp($id)
    {
        $title="Ubah Data PNBP";
        $tahun = 2023;

        $pnbp = DB::table('td_pnbp')->where('id','=',$id)->first();

        return view('pages.pnbp.ubah_pnbp', compact('title', 'pnbp'));
    }

    public function prosesubahpnbp(Request $request)
    {
        $title="Data PNBP";
        $tahun = 2023;
        $id = $request->input('id');

        $str_pengujian= $request->input('pengujian');
        $pengujian = (int)str_replace('.', '', $str_pengujian);

        $str_kalibrasi= $request->input('kalibrasi');
        $kalibrasi = (int)str_replace('.', '', $str_kalibrasi);

        $str_sertifikasi= $request->input('sertifikasi');
        $sertifikasi = (int)str_replace('.', '', $str_sertifikasi);

        $str_bimtek= $request->input('bimtek');
        $bimtek = (int)str_replace('.', '', $str_bimtek);

        $str_konstultansi= $request->input('konsultansi');
        $konsultansi = (int)str_replace('.', '', $str_konstultansi);

        $data = array(
            'pengujian' => $pengujian,
            'kalibrasi' => $kalibrasi,
            'sertifikasi' => $sertifikasi,
            'bimtek' => $bimtek,
            'konsultansi' => $konsultansi,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => Auth::user()->id,
        );

        DB::table('td_pnbp')->where('id','=',$id)->update($data);

        return Redirect::to('daftar-pnbp')->with('message','Data berhasil disimpan.');
    }

    public function hapuspnbp($id)
    {
        $title="Data PNBP";
        $tahun = 2023;

        DB::table('td_pnbp')->where('id','=',$id)->delete();

         return Redirect::to('daftar-pnbp')->with('message','Data berhasil disimpan.');
    }
}
