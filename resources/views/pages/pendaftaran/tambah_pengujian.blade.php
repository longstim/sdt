@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('content')
  <!-- Main content -->
      <!-- /.col -->
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
    <div class="col-md-12">
        <form role="form" id="arsip" method="post" action="{{url('proses-pendaftaran')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
                <div class="card">
                  <div class="card-body">
                  <p>
                  Download formulir pendaftaran disini! <a href="{{asset('file/pendaftaran/Formulir Pengujian.docx')}}">Formulir Pengujian.docx</a>
                  </p>
                  <input type="hidden" name="id_layanan" value="1">
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>Nama Pelanggan</label>
                    </div>
                    <div class="col-md-7">
                          <input type="text" name="nama_pelanggan" class="form-control" id="txtNamaPelanggan" placeholder="Nama Perusahaan / Instansi / Perorangan" required>
                    </div>
                  </div> 
                  <div class="form-group col-md-12 row">
                      <div class="col-md-3">
                          <label>Tanggal Permohonan</label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group date">
                            <input type="text" name="tgl_permohonan" id="" class="form-control" placeholder="dd/mm/yyyy" value="{{date('d/m/Y')}}" required readonly>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                        </div>
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
                        <label>Upload Formulir</label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" name="upload_dokumen" id="uploadFileDokumen" required>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="margin-left:10px;">Simpan</button>
                </div>
                <!-- /.card-body -->
              </div>
            </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

  

<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
 $( document ).ready(function () {

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
})
   
</script>
@endsection
