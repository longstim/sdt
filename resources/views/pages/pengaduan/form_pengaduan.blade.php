@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{url('daftar-pengaduan')}}" class="btn btn-primary">Riwayat Pengaduan</a></li>
</ol>
@endsection
@section('content')
<style>
  #dropdown-action-id
  {
    min-width: 5rem;
  }

  #dropdown-action-id .dropdown-item:hover
  {
    color:#007bff;
  }

  #dropdown-action-id .dropdown-item:active
  {
    color:#fff;
  }

  a.disabled 
  {
    pointer-events: none;
    cursor: default;
  }
</style>
  <div class="row">
    <div class="col-12">
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
  
      <div class="card">
        <!-- /.card-header -->
        <form role="form" id="pengaduan" method="post" action="{{url('proses-pengaduan')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
          <p>
          Silahkan isi data pengaduan anda dengan benar!
          </p>
          <input type="hidden" name="id_user" value="{{$id_user}}">
          <div class="form-group col-md-12 row">
            <div class="col-md-3">
                <label>Nama</label>
            </div>
            <div class="col-md-7">
                  <input type="text" name="nama" class="form-control" id="txtNama" value="{{$user->name}}" placeholder="Nama" readonly>
            </div>
          </div> 
          <div class="form-group col-md-12 row">
            <div class="col-md-3">
                <label>No. HP</label>
            </div>
            <div class="col-md-7">
                  <input type="text" name="no_hp" class="form-control" id="txtNoHP" value="{{$user->nohp}}" placeholder="No. HP" readonly>
            </div>
          </div>
          <div class="form-group col-md-12 row">
            <div class="col-md-3">
                <label>E-Mail</label>
            </div>
            <div class="col-md-7">
                  <input type="text" name="email" class="form-control" id="txtEmail" value="{{$user->email}}" placeholder="E-Mail" readonly>
            </div>
          </div>
          <div class="form-group col-md-12 row">
            <div class="col-md-3">
                <label>Jenis Pelayanan</label>
            </div>
            <div class="col-md-7">
              <div class="col-md-12 row">
                <label class="font-weight-normal">
                  <input type="radio" name="jenis_pelayanan" id="optJenisPelayanan" value="Pengujian" required> 
                  Pengujian
                </label>
              </div>
              <div class="col-md-12 row">
                <label class="font-weight-normal">
                  <input type="radio" name="jenis_pelayanan" id="optJenisPelayanan" value="Kalibrasi" required> 
                  Kalibrasi
                </label>
              </div>
              <div class="col-md-12 row">
                <label class="font-weight-normal">
                  <input type="radio" name="jenis_pelayanan" id="optJenisPelayanan" value="Sertifikasi" required> 
                  Sertifikasi
                </label>
              </div>
              <div class="col-md-12 row">
                <label class="font-weight-normal">
                  <input type="radio" name="jenis_pelayanan" id="optJenisPelayanan" value="Bimbingan Teknis" required> 
                  Bimbingan Teknis
                </label>
              </div>
              <div class="col-md-12 row">
                <label class="font-weight-normal">
                  <input type="radio" name="jenis_pelayanan" id="optJenisPelayanan" value="Konsultansi" required> 
                  Konsultansi
                </label>
              </div>
              <div class="col-md-12 row">
                <label class="font-weight-normal">
                  <input type="radio" name="jenis_pelayanan" id="optJenisPelayanan" value="Lainnya" required> 
                  Lainnya
                </label>
                <input type="text" name="lainnya_text" class="form-control" placeholder="Lainnya">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12 row">
            <div class="col-md-3">
                <label>Uraian Pengaduan</label>
            </div>
            <div class="col-md-7">
                <textarea name="uraian_pengaduan" class="form-control" placeholder="Uraian Pengaduan" rows="4" required></textarea>
            </div>
          </div>
          <div class="form-group col-md-12 row">
            <div class="col-md-3">
                <label>Bukti Pendukung</label> <i>(jika ada)</i>
            </div>
            <div class="col-md-7">
                <input type="file" name="bukti_pengaduan" id="uploadBuktiPengaduan">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" style="margin-left:10px;">Simpan</button>
        </div>
        <!-- /.card-body -->
        </form>

      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>

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