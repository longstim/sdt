<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use DB;
Use Redirect;
use Auth;
use File;
use Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Profil User";

        $id_user = Auth::user()->id;

        $user=DB::table('users')
            ->where('users.id', '=', $id_user)
            ->first();
    
        return view('pages.profil.profil_user', compact('title', 'user'));
    }


    public function prosesubahprofil(Request $request)
    {
        $id_user = $request->input('id_user_profil');

        try 
        {
            $data = array(
                'name' => $request->input('name'),
                'nohp' => $request->input('nohp'),
                'updated_at' => Carbon::now()->toDateTimeString(),
            );

            DB::table('users')->where('id', '=', $id_user)->update($data);

            DB::commit();

        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            // something went wrong
        }

        return Redirect::to('profil')->with('message','Data berhasil disimpan.');
    }  

    public function prosesubahpassword(Request $request)
    {
        $id_user = $request->input('id_user_password');

        try
        {
           if($request->input('password') != $request->input('password_confirmation'))
            {
                return Redirect::to('profil')->with('failed','The password confirmation does not match!');
            }

            $data = array(
              'password' => Hash::make($request->input('password')),
              'updated_at' => Carbon::now()->toDateTimeString(),
            );

            DB::table('users')->where('id', '=', $id_user)->update($data);  
          
            DB::commit();

        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            // something went wrong
        }

        return Redirect::to('profil')->with('message','Password berhasil diubah.');
    }
}
