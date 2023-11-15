<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'IndexController@index')->name('index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminlte', function () {
    return view('admin/adminlte');
});

//Layanan
Route::get('layanan-klien', 'IndexController@layananklien')->middleware(['auth', 'role:admin|pelanggan']);

//Pengaduan
Route::get('pengaduan', 'PengaduanController@index')->middleware(['auth', 'role:admin|pelanggan']);
Route::post('proses-pengaduan', 'PengaduanController@prosespengaduan')->middleware(['auth', 'role:admin|pelanggan']);
Route::get('daftar-pengaduan', 'PengaduanController@daftarpengaduan')->middleware(['auth', 'role:admin|pelanggan']);
Route::get('daftar-pengaduan/{status}', 'PengaduanController@daftarpengaduanbystatus')->middleware(['auth', 'role:admin|pelanggan']);
Route::get('update-pengaduan-in-progress/{id}', 'PengaduanController@updatepengaduaninprogress')->middleware(['auth', 'role:admin|pelanggan']);
Route::post('update-pengaduan-solved', 'PengaduanController@updatepengaduansolved')->middleware(['auth', 'role:admin|pelanggan']);
Route::post('update-pengaduan-cancel', 'PengaduanController@updatepengaduancancel')->middleware(['auth', 'role:admin|pelanggan']);
Route::get('detail-pengaduan/{id}', 'PengaduanController@detailpengaduan')->middleware(['auth', 'role:admin|pelanggan']);

//Kontak
Route::get('kontak-kami', 'IndexController@kontakkami');

//BMN
Route::get('bmn', 'BMNController@index')->middleware(['auth', 'role:admin|spm|bmn|pnbp|arsip|pegawai']);
Route::get('daftar-bmn/{id_kelompok_bmn}', 'BMNController@daftarbmn')->middleware(['auth', 'role:admin|spm|bmn|pnbp|arsip|pegawai']);

//SPM
Route::get('spm', 'SPMController@index')->middleware(['auth', 'role:admin|spm|bmn|pnbp|arsip|pegawai']);
Route::get('update-spm', 'SPMController@updatespm')->middleware(['auth', 'role:admin|spm']);
Route::post('proses-update-spm', 'SPMController@prosesupdatespm')->middleware(['auth', 'role:admin|spm']);

//Tracking
Route::get('tracking-order', 'TrackingController@index');

//PNBP
Route::get('pnbp', 'PNBPController@index')->middleware(['auth', 'role:admin|spm|bmn|pnbp|arsip|pegawai']);
Route::get('daftar-pnbp', 'PNBPController@daftarpnbp')->middleware(['auth', 'role:admin|pnbp']);
Route::get('tambah-pnbp', 'PNBPController@tambahpnbp')->middleware(['auth', 'role:admin|pnbp']);
Route::post('proses-tambah-pnbp', 'PNBPController@prosestambahpnbp')->middleware(['auth', 'role:admin|pnbp']);
Route::get('ubah-pnbp/{id}', 'PNBPController@ubahpnbp')->middleware(['auth', 'role:admin|pnbp']);
Route::post('proses-ubah-pnbp', 'PNBPController@prosesubahpnbp')->middleware(['auth', 'role:admin|pnbp']);
Route::get('hapus-pnbp/{id}', 'PNBPController@hapuspnbp')->middleware(['auth', 'role:admin|pnbp']);

//Arsip
Route::get('arsip', 'ArsipController@index')->middleware(['auth', 'role:admin|spm|bmn|pnbp|arsip|pegawai']);
Route::get('tambah-arsip', 'ArsipController@tambaharsip')->middleware(['auth', 'role:admin|arsip']);
Route::post('proses-tambah-arsip', 'ArsipController@prosestambaharsip')->middleware(['auth', 'role:admin|arsip']);
Route::get('ubah-arsip/{id}', 'ArsipController@ubaharsip')->middleware(['auth', 'role:admin|arsip']);
Route::post('proses-ubah-arsip', 'ArsipController@prosesubaharsip')->middleware(['auth', 'role:admin|arsip']);
Route::get('hapus-arsip/{id}', 'ArsipController@hapusarsip')->middleware(['auth', 'role:admin|arsip']);

//Pendaftaran
Route::get('pendaftaran', 'PendaftaranController@index');
Route::get('data-pendaftaran', 'PendaftaranController@datapendaftaran');
Route::get('pendaftaran-pengujian', 'PendaftaranController@pendaftaranpengujian');
Route::get('pendaftaran-kalibrasi', 'PendaftaranController@pendaftarankalibrasi');
Route::get('pendaftaran-sertifikasi', 'PendaftaranController@pendaftaransertifikasi');
Route::get('pendaftaran-bimtek', 'PendaftaranController@pendaftaranbimtek');
Route::get('pendaftaran-konsultansi', 'PendaftaranController@pendaftarankonsultansi');
Route::post('proses-pendaftaran', 'PendaftaranController@prosespendaftaran');

//Profil
Route::get('profil', 'ProfilController@index');
Route::post('proses-ubah-profil', 'ProfilController@prosesubahprofil');
Route::post('proses-ubah-password', 'ProfilController@prosesubahpassword');


//Pengaturan
Route::get('role', 'PengaturanController@daftarrole');
Route::get('permission', 'PengaturanController@daftarpermission');
Route::get('tambahpermission', 'PengaturanController@tambahpermission');
Route::post('prosestambahpermission', 'PengaturanController@prosestambahpermission');
Route::get('user', 'PengaturanController@daftaruser');
Route::get('ubahuser/{id_user}','PengaturanController@ubahuser');
Route::post('prosesubahuser','PengaturanController@prosesubahuser');