<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use File;

class ArsipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Daftar Arsip Dokumen";

        $arsip = DB::table('td_arsip')
            ->leftjoin('md_jenis_dokumen AS t1', 'td_arsip.id_jenis', '=', 't1.id')
             ->leftjoin('md_klasifikasi_dokumen AS t2', 'td_arsip.id_klasifikasi', '=', 't2.id')
            ->select('td_arsip.*', 't1.nama AS jenis_dokumen', 't2.nama AS klasifikasi_dokumen')
            ->orderBy('td_arsip.tgl_dokumen', 'desc')
            ->get();

        return view('pages.arsip.daftar_arsip', compact('title', 'arsip'));
    }

    public function tambaharsip()
    {
        $title = "Tambah Arsip Dokumen";

        $jenisdokumen = DB::table('md_jenis_dokumen')->get();

        $klasifikasidokumen = DB::table('md_klasifikasi_dokumen')->get();

        return view('pages.arsip.tambah_arsip', compact('title', 'jenisdokumen', 'klasifikasidokumen'));
    }

    public function prosestambaharsip(Request $request)
    {
        DB::beginTransaction();

        try 
        {
            $tgl_dokumen= $request->input('tgl_dokumen');
            $newTglDokumen= Carbon::createFromFormat('d/m/Y', $tgl_dokumen)->format('Y-m-d');

            $path=public_path().'/file/arsip/';

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

                    $filename = $code."_".$request->input('judul').".".$extension;
                    $upload_dokumen->move($path, $filename); 
                }
                else
                {
                    return Redirect::back()->with('failed','Ukuran file harus lebih kecil dari 2 MB');
                }
            }   

            $data = array(
                'id_jenis' => $request->input('jenisdokumen'),
                'id_klasifikasi' => $request->input('klasifikasidokumen'),
                'no_dokumen' => $request->input('no_dokumen'),
                'judul' => $request->input('judul'),
                'tgl_dokumen' => $newTglDokumen,
                'link_dokumen' => $filename,
                'created_at' => Carbon::now()->toDateTimeString(),
                'created_by' => Auth::user()->id,
            );

            DB::table('td_arsip')->insert($data);

            DB::commit();

            return Redirect::to('arsip')->with('message','Data berhasil disimpan.');

        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            // something went wrong

            return Redirect::to('arsip')->with('failed',$e);
        }
    }

    public function ubaharsip($id)
    {
        $title = "Ubah Arsip Dokumen";

        $arsip = DB::table('td_arsip')
            ->where('id', '=', $id)
            ->first();

        $jenisdokumen = DB::table('md_jenis_dokumen')->get();

        $klasifikasidokumen = DB::table('md_klasifikasi_dokumen')->get();

        return view('pages.arsip.ubah_arsip', compact('title', 'arsip', 'jenisdokumen', 'klasifikasidokumen'));
    }


    public function prosesubaharsip(Request $request)
    {
        $id = $request->input('id');

        $arsip=DB::table('td_arsip')
                ->where('id','=',$id)
                ->first();

        DB::beginTransaction();

        try 
        {
            $tgl_dokumen= $request->input('tgl_dokumen');
            $newTglDokumen= Carbon::createFromFormat('d/m/Y', $tgl_dokumen)->format('Y-m-d');

            $path=public_path().'/file/arsip/';

            if (!File::exists($path))
            {
                $result = File::makeDirectory($path);
            }

            $filename=$arsip->link_dokumen;

            if($request->hasFile('upload_dokumen'))
            {
                if($filename!="" || $filename != NULL)
                {
                   unlink($path.$filename); 
                }
                
                $upload_dokumen = $request->file('upload_dokumen');
                $extension = $upload_dokumen->getClientOriginalExtension();
                $size = $upload_dokumen->getSize();

                if($size <= 2097152 )
                {         
                    $code = Carbon::now()->timestamp;

                    $filename = $code."_".$request->input('judul').".".$extension;
                    $upload_dokumen->move($path, $filename); 
                }
                else
                {
                    return Redirect::back()->with('failed','Ukuran file harus lebih kecil dari 2 MB');
                }
            }   

            $data = array(
                'id_jenis' => $request->input('jenisdokumen'),
                'id_klasifikasi' => $request->input('klasifikasidokumen'),
                'no_dokumen' => $request->input('no_dokumen'),
                'judul' => $request->input('judul'),
                'tgl_dokumen' => $newTglDokumen,
                'link_dokumen' => $filename,
                'updated_at' => Carbon::now()->toDateTimeString(),
                'updated_by' => Auth::user()->id,
            );

            DB::table('td_arsip')
                ->where('id', '=', $id)
                ->update($data);

            DB::commit();

            return Redirect::to('arsip')->with('message','Data berhasil disimpan.');

        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            // something went wrong

            return Redirect::to('arsip')->with('failed','Data gagal disimpan.');
        }
    }

    public function hapusarsip($id)
    {
        $title="Daftar Arsip Dokumen";
        $tahun = 2023;

        $arsip=DB::table('td_arsip')
                ->where('id','=',$id)
                ->first();
        
        $path=public_path().'/file/arsip/';
        $filename=$arsip->link_dokumen;

        if($filename!="" || $filename != NULL)
        {
            unlink($path.$filename); 
        }

        DB::table('td_arsip')->where('id','=',$id)->delete();

         return Redirect::to('arsip')->with('message','Data berhasil disimpan.');
    }
}
