@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
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
      </div>
      <div class="card">
        <!-- /.card-header -->
        <form role="form" id="tambah-pnbp" method="post" action="{{url('proses-tambah-pnbp')}}">
        {{ csrf_field() }}

        <div class="card-body">
          <div class="col-md-12">
            <div class="form-group col-md-12 row">
                <div class="col-md-3">
                    <label>Tanggal</label>
                </div>
                <div class="col-md-3">
                  <div class="input-group date">
                      <input type="text" name="tgl_pnbp" id="datepicker" class="form-control" placeholder="dd/mm/yyyy" value="{{date('d/m/Y')}}" required>
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                  </div>
                </div>
            </div>
            <div class="form-group col-md-12 row">
                <div class="col-md-3">
                    <label>PNBP Pengujian</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="pengujian" class="form-control" id="txtPengujian" required>
                </div>
            </div> 
            <div class="form-group col-md-12 row">
                <div class="col-md-3">
                    <label>PNBP Kalibrasi</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="kalibrasi" class="form-control" id="txtKalibrasi" required>
                </div>
            </div>
            <div class="form-group col-md-12 row">
                <div class="col-md-3">
                    <label>PNBP Sertifikasi</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="sertifikasi" class="form-control" id="txtSertifikasi" required>
                </div>
            </div>
            <div class="form-group col-md-12 row">
                <div class="col-md-3">
                    <label>PNBP Bimbingan Teknis</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="bimtek" class="form-control" id="txtBimtek" required>
                </div>
            </div>
            <div class="form-group col-md-12 row">
                <div class="col-md-3">
                    <label>PNBP Konsultansi</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="konsultansi" class="form-control" id="txtKonsultansi" required>
                </div>
            </div>
          </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script>
    $( document ).ready(function () {

      //SweetAlert Success
      var message = $("#idmessage").val();
      var message_text = $("#idmessage_text").val();

      if(message=="1")
      {
        Swal.fire({     
           icon: 'error',
           title: 'Gagal!',
           text: message_text,
           showConfirmButton: false,
           timer: 1500
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

  $(document).ready(function () {
    $("#txtPengujian").keyup(function(){
         $("#txtPengujian").val(formatRupiah($(this).val()));
      });
  });

  $(document).ready(function () {
    $("#txtKalibrasi").keyup(function(){
         $("#txtKalibrasi").val(formatRupiah($(this).val()));
      });
  });

  $(document).ready(function () {
    $("#txtSertifikasi").keyup(function(){
         $("#txtSertifikasi").val(formatRupiah($(this).val()));
      });
  });

  $(document).ready(function () {
    $("#txtBimtek").keyup(function(){
         $("#txtBimtek").val(formatRupiah($(this).val()));
      });
  });

  $(document).ready(function () {
    $("#txtKonsultansi").keyup(function(){
         $("#txtKonsultansi").val(formatRupiah($(this).val()));
      });
  });

  function formatRupiah(angka)
  {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split       = number_string.split(','),
    sisa        = split[0].length % 3,
    rupiah        = split[0].substr(0, sisa),
    ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
   
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
   
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
  }
  </script>
@endsection