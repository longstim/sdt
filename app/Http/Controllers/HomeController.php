<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        if($user->hasRole('admin|spm|bmn|pnbp|arsip|pegawai'))
        {
            return view('home');
        }
        else
        {
            $title="Layanan Klien";

            return view('layanan', compact('title'));
        }
    }
}
