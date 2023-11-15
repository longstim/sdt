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
        <form role="form" id="arsip" method="post" action="{{url('proses-ubah-arsip')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
                <div class="card">
                  <div class="card-body">
                  <input type="hidden" name="id" value="{{$arsip->id}}">
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>No. Dokumen</label>
                    </div>
                    <div class="col-md-7">
                          <input type="text" name="no_dokumen" class="form-control" id="txtNoDokumen" placeholder="No. Dokumen" value="{{$arsip->no_dokumen}}" required>
                    </div>
                  </div> 
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>Judul</label>
                    </div>
                    <div class="col-md-7">
                          <textarea name="judul" class="form-control" rows="2" placeholder="Judul Dokumen" required>{{$arsip->judul}}</textarea>
                    </div>
                  </div> 
                  <div class="form-group col-md-12 row">
                      <div class="col-md-3">
                          <label>Tanggal</label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group date">
                            <input type="text" name="tgl_dokumen" id="datepicker" class="form-control" placeholder="dd/mm/yyyy" value="@if($arsip->tgl_dokumen==null || $arsip->tgl_dokumen=='')@else {{date('d/m/Y', strtotime($arsip->tgl_dokumen))}}@endif" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>Jenis Dokumen</label>
                    </div>
                    <div class="col-md-7">
                      <select name="jenisdokumen" class="form-control select2bs4" style="width: 100%;" required>
                          <option value="" selected="selected">-- Pilih Satu --</option>
                          @foreach($jenisdokumen as $data)
                              <option value="{{$data->id}}" @if($data->id == $arsip->id_jenis) selected @endif>{{$data->nama}}</option>
                          @endforeach
                      </select>
                    </div>
                </div>
                    <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>Klasifikasi Dokumen</label>
                    </div>
                    <div class="col-md-7">
                      <select name="klasifikasidokumen" class="form-control select2bs4" style="width: 100%;" required>
                          <option value="" selected="selected">-- Pilih Satu --</option>
                          @foreach($klasifikasidokumen as $data)
                              <option value="{{$data->id}}" @if($data->id == $arsip->id_klasifikasi) selected @endif>{{$data->nama}} ({{$data->keterangan}})</option>
                          @endforeach
                      </select>
                    </div>
                  </div> 
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>File Dokumen</label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" name="upload_dokumen" id="uploadFileDokumen">
                        <br>
                        <a href="{{asset('file/arsip/'.$arsip->link_dokumen)}}" target="_blank"><i>{{$arsip->link_dokumen}}</i></a>
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
