@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('content')

<style type="text/css">
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link
  {
    background-color: #17a2b8;
  }
</style>
<!-- Main content -->
  <div class="row">
    <div>
          @if(Session::has('message'))
              <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
              <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
          @endif

          @if(Session::has('failed'))
            <input type="hidden" name="txtFailed" id="idfailed" value="{{Session::has('failed')}}"></input>
            <input type="hidden" name="txtFailed_text" id="idfailed_text" value="{{Session::get('failed')}}"></input>
          @endif
    </div>
    <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header p-2">
           <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#informasi" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Informasi Akun</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#password" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Ubah Password</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
          <!-- Biodata -->
          <div class="tab-content">
            <div class="active tab-pane" id="informasi">
            <form role="form" id="ubahprofil" method="post" action="{{url('proses-ubah-profil')}}">
            {{ csrf_field() }}
            <table class="table table-borderless">
              <input type="hidden" name="id_user_profil" id="txtIDUserProfil" value="{{$user->id}}"></input>
              <tr>
                <th style="width:170px">Username</th>
                <td>:</td>
                 <td><input type="text" name="username" value="{{$user->username}}" class="form-control" id="txtUsername" placeholder="Username" readonly></td>
              </tr>
              <tr>
                <th style="width:170px">Nama</th>
                <td>:</td>
                 <td><input type="text" name="name" value="{{$user->name}}" class="form-control" id="txtName" placeholder="Nama" required></td>
              </tr> 
              <tr>
                <th style="width:170px">Email</th>
                <td>:</td>
                 <td><input type="text" name="email" value="{{$user->email}}" class="form-control" id="txtEmail" placeholder="Nama" readonly></td>
              </tr> 
              <tr>
                <th style="width:170px">No. HP</th>
                <td>:</td>
                 <td><input type="text" name="nohp" value="{{$user->nohp}}" class="form-control" id="txtNoHP" placeholder="No. HP" required></td>
              </tr> 
            </table>
            <div class="float-right">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          <div class="tab-pane" id="password">
            <form role="form" id="ubahpassword" method="post" action="{{url('proses-ubah-password')}}">
            {{ csrf_field() }}

              <input type="hidden" name="id_user_password" id="txtIDUserPassword" value="{{$user->id}}"></input>
              <div class="form-group col-md-8">
                    <label for="password">Password Baru<a style="color:red;">&#42;<i style="font-size:10pt;">(Silahkan diisi jika password diubah)</i></a></label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="form-group col-md-8">
                    <label for="password-confirm">Konfirmasi Password Baru<a style="color:red;">&#42;</a></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>  
            <div class="float-right">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
            </div>
          </div>
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- /.content -->

  <!-- Modal Tambah Detail -->
<div class="modal fade" id="modal-upload-foto">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
         <div class="row">
      <!-- left column -->
      <div class="col-md-12">
      <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-image"></i><b> &nbsp;Edit Foto Profil</b></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="uploadfotoprofil" method="post" action="{{url('proses-upload-foto-profil')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
      
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id_user" id="txtIDUser" value="{{$user->id}}"></input>
                    <div class="form-group">
                      <label>Foto Profil</label>
                      <input type="file" name="foto_profil" id="fotoprofilFile" required>
                    </div>
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="simpanfotoprofil" class="btn btn-primary float-right">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      </div>
    </div>
</div>
<!-- Modal Tambah Detail-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $( document ).ready(function () {

      //DataTable
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

      //SweetAlert Success
      var message = $("#idmessage").val();
      var message_text = $("#idmessage_text").val();

      if(message=="1")
      {
        Swal.fire({     
           icon: 'success',
           title: 'Success!',
           text: message_text,
           showConfirmButton: false,
           timer: 1500
        })
      }

      //SweetAlert Failed
      var failed = $("#idfailed").val();
      var messagefailed_text = $("#idfailed_text").val();

      if(failed=="1")
      {
          Swal.fire({     
             icon: 'error',
             title: 'Failed!',
             text: messagefailed_text,
             showConfirmButton: true,
          })
      }

      //SweetAlert Delete
     $(document).on("click", ".swalDelete",function(event) {  
        event.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
          title: 'Apakah anda yakin menghapus data ini?',
          text: 'Anda tidak akan dapat mengembalikan data ini!',
          icon: 'error',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.value) 
        {
            window.location.href = url;
        }
      });
    });
  });
</script>
@endsection