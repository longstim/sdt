<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class SPMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title="Data Standar Pelayanan Minimal";
        $tahun = 2023;

        $spm = DB::table('td_spm')
                ->where('tahun','=',$tahun)
                ->get();

        $lastupdateDate = customTanggalWaktu($spm[0]->updated_at, 'd-m-Y');

        $lastupdateTime = customTanggalWaktu($spm[0]->updated_at, 'H:i:s');

        $persenSPMPengujian=array();
        $persenSPMKalibrasi=array();
        $persenSPMSertifikasi=array();

        for($i=1;$i<=12;$i++)
        {
            $persenSPMPengujian[$i] = 0;
            $persenSPMKalibrasi[$i] = 0;
            $persenSPMSertifikasi[$i]= 0;

            foreach($spm as $val)
            {
                if($val->bulan==$i && $val->jenis_layanan==1)
                {
                    if((int)$val->sesuai_spm + (int)$val->tidak_sesuai_spm > 0)
                    {
                        $jlhPengujian = (double)$val->sesuai_spm + (double)$val->tidak_sesuai_spm;

                        $persenSPMPengujian[$i] = round(((double)$val->sesuai_spm / (double)$jlhPengujian) * 100, 2);
                    }
                
                }

                if($val->bulan==$i && $val->jenis_layanan==2)
                {
                    if((int)$val->sesuai_spm + (int)$val->tidak_sesuai_spm > 0)
                    {
                        $jlhKalibrasi = (double)$val->sesuai_spm + (double)$val->tidak_sesuai_spm;

                        $persenSPMKalibrasi[$i] = round(((double)$val->sesuai_spm / (double)$jlhKalibrasi) * 100, 2);
                    }
                }

                if($val->bulan==$i && $val->jenis_layanan==3)
                {
                    if((int)$val->sesuai_spm + (int)$val->tidak_sesuai_spm > 0)
                    {
                        $jlhSertifikasi = (double)$val->sesuai_spm + (double)$val->tidak_sesuai_spm;

                        $persenSPMSertifikasi[$i] = round(((double)$val->sesuai_spm / (double)$jlhSertifikasi) * 100, 2);
                    }
                }
            }
        }

        $totalSesuaiSPMPengujian = DB::table('td_spm')
                ->where('jenis_layanan','=',1)
                ->where('tahun','=',$tahun)
                ->sum('sesuai_spm');

        $totalTidakSesuaiSPMPengujian = DB::table('td_spm')
                ->where('jenis_layanan','=',1)
                ->where('tahun','=',$tahun)
                ->sum('tidak_sesuai_spm');

        $totalSPMPengujian = (double)$totalSesuaiSPMPengujian + (double)$totalTidakSesuaiSPMPengujian;

        $persenTotalSesuaiSPMPengujian = round(((double)$totalSesuaiSPMPengujian / (double)$totalSPMPengujian) * 100, 2);

        $persenTotalTidakSesuaiSPMPengujian = round(((double)$totalTidakSesuaiSPMPengujian / (double)$totalSPMPengujian) * 100, 2);



        $totalSesuaiSPMKalibrasi = DB::table('td_spm')
                ->where('jenis_layanan','=',2)
                ->where('tahun','=',$tahun)
                ->sum('sesuai_spm');

        $totalTidakSesuaiSPMKalibrasi = DB::table('td_spm')
                ->where('jenis_layanan','=',2)
                ->where('tahun','=',$tahun)
                ->sum('tidak_sesuai_spm');

        $totalSPMKalibrasi = (double)$totalSesuaiSPMKalibrasi + (double)$totalTidakSesuaiSPMKalibrasi;

        $persenTotalSesuaiSPMKalibrasi= round(((double)$totalSesuaiSPMKalibrasi / (double)$totalSPMKalibrasi) * 100, 2);

        $persenTotalTidakSesuaiSPMKalibrasi= round(((double)$totalTidakSesuaiSPMKalibrasi / (double)$totalSPMKalibrasi) * 100, 2);

        

        $totalSesuaiSPMSertifikasi = DB::table('td_spm')
                ->where('jenis_layanan','=',3)
                ->where('tahun','=',$tahun)
                ->sum('sesuai_spm');

        $totalTidakSesuaiSPMSertifikasi = DB::table('td_spm')
                ->where('jenis_layanan','=',3)
                ->where('tahun','=',$tahun)
                ->sum('tidak_sesuai_spm');

        $totalSPMSertifikasi = (double)$totalSesuaiSPMSertifikasi + (double)$totalTidakSesuaiSPMSertifikasi;

        $persenTotalSesuaiSPMSertifikasi= round(((double)$totalSesuaiSPMSertifikasi / (double)$totalSPMSertifikasi) * 100, 2);

        $persenTotalTidakSesuaiSPMSertifikasi= round(((double)$totalTidakSesuaiSPMSertifikasi / (double)$totalSPMSertifikasi) * 100, 2);

        return view('pages.spm.index_spm', compact('title', 'lastupdateDate', 'lastupdateTime', 'persenSPMPengujian', 'persenSPMKalibrasi', 'persenSPMSertifikasi', 'persenTotalSesuaiSPMPengujian', 'persenTotalSesuaiSPMKalibrasi', 'persenTotalSesuaiSPMSertifikasi', 'persenTotalTidakSesuaiSPMPengujian', 'persenTotalTidakSesuaiSPMKalibrasi', 'persenTotalTidakSesuaiSPMSertifikasi'));
    }

    public function updatespm()
    {
        $title="Update Data SPM";
        $tahun = 2023;

        $spm = DB::table('td_spm')
                ->where('tahun','=',$tahun)
                ->get();

        $lastupdateDate = customTanggalWaktu($spm[0]->updated_at, 'd-m-Y');

        $lastupdateTime = customTanggalWaktu($spm[0]->updated_at, 'H:i:s');

        $pengujianM_Arr=array();
        $pengujianTM_Arr=array();
        $kalibrasiM_Arr=array();
        $kalibrasiTM_Arr=array();
        $sertifikasiM_Arr=array();
        $sertifikasiTM_Arr=array();

        for($i=1;$i<=12;$i++)
        {
            $pengujianM_Arr[$i] = 0;
            $pengujianTM_Arr[$i] = 0;
            $kalibrasiM_Arr[$i]= 0;
            $kalibrasiTM_Arr[$i]= 0;
            $sertifikasiM_Arr[$i]= 0;
            $sertifikasiTM_Arr[$i]= 0;

            foreach($spm as $val)
            {
                if($val->bulan==$i && $val->jenis_layanan==1)
                {
                    $pengujianM_Arr[$i]=$val->sesuai_spm;
                    $pengujianTM_Arr[$i]=$val->tidak_sesuai_spm;
                }

                if($val->bulan==$i && $val->jenis_layanan==2)
                {
                    $kalibrasiM_Arr[$i]=$val->sesuai_spm;
                    $kalibrasiTM_Arr[$i]=$val->tidak_sesuai_spm;
                }

                if($val->bulan==$i && $val->jenis_layanan==3)
                {
                    $sertifikasiM_Arr[$i]=$val->sesuai_spm;
                    $sertifikasiTM_Arr[$i]=$val->tidak_sesuai_spm;
                }
            }
        }

        return view('pages.spm.update_spm', compact('title', 'pengujianM_Arr', 'pengujianTM_Arr', 'kalibrasiM_Arr', 'kalibrasiTM_Arr', 'sertifikasiM_Arr', 'sertifikasiTM_Arr', 'lastupdateDate', 'lastupdateTime'));
    }

    public function prosesupdatespm(Request $request)
    {
        $title = "Update Data SPM";
        $tahun = 2023;
        $user_id = Auth::user()->id;

        $pengujianM=$request->input('pengujianM');
        $pengujianTM=$request->input('pengujianTM');

        $kalibrasiM=$request->input('kalibrasiM');
        $kalibrasiTM=$request->input('kalibrasiTM');

        $sertifikasiM=$request->input('sertifikasiM');
        $sertifikasiTM=$request->input('sertifikasiTM');

        for($i=1;$i<=12;$i++)
        {
            DB::table('td_spm')
                ->updateOrInsert(
                    ['jenis_layanan'=> 1, 'bulan' => $i, 'tahun' => $tahun],
                    ['sesuai_spm' => $pengujianM[$i], 'tidak_sesuai_spm' => $pengujianTM[$i], 'updated_by' => $user_id, 'updated_at' => Carbon::now()->toDateTimeString()]
                );

            DB::table('td_spm')
                ->updateOrInsert(
                    ['jenis_layanan'=> 2, 'bulan' => $i, 'tahun' => $tahun],
                    ['sesuai_spm' => $kalibrasiM[$i], 'tidak_sesuai_spm' => $kalibrasiTM[$i], 'updated_by' => $user_id, 'updated_at' => Carbon::now()->toDateTimeString()]
                );

            DB::table('td_spm')
                ->updateOrInsert(
                    ['jenis_layanan'=> 3, 'bulan' => $i, 'tahun' => $tahun],
                    ['sesuai_spm' => $sertifikasiM[$i], 'tidak_sesuai_spm' => $sertifikasiTM[$i], 'updated_by' => $user_id, 'updated_at' => Carbon::now()->toDateTimeString()]
                );
        }
        
        
        return Redirect::to('spm')->with('message','Berhasil menyimpan data');;
    }
}
