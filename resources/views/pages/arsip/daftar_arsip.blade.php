@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}} 2023</b>
@endsection
@section('breadcrumb')
@role('admin|arsip')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{url('tambah-arsip')}}" class="btn btn-primary">Tambah Data Arsip</a></li>
</ol>
@endrole
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
        <div class="card-body">
          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>No. Dokumen</th>
              <th width="300px">Judul</th>
              <th width="70px">Tanggal</th>
              <th>Jenis</th>
              <th>Klasifikasi</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($arsip as $data)  
               <tr>
                  <td>{{++$no}}</td>
                  <td>{{$data->no_dokumen}}</td>
                  <td>{{$data->judul}}</td>
                  <td>{{$data->tgl_dokumen}}</td>
                  <td>{{$data->jenis_dokumen}}</td>
                  <td>{{$data->klasifikasi_dokumen}}</td>
                  <td width="10%">
                    <div class="btn-group">
                      <a href="{{asset('file/arsip/'.$data->link_dokumen)}}" target="_blank" class="btn btn-primary" data-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>&nbsp;
                      @role('admin|arsip')
                      <button class="btn btn-success btn-md dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-check nav-icon"></i>
                      <span class="caret"></span>
                      </button>
                      <div class="dropdown-menu" id="dropdown-action-id">
                        <a class="dropdown-item" href="ubah-arsip/{{$data->id}}">Ubah Data</a>
                        <a class="dropdown-item swalDelete" href="hapus-arsip/{{$data->id}}">Hapus Data</a>
                      </div>
                      @endrole
                    </div>
                  </td>
               </tr>
      
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
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
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i><span style="font-family: Source Sans Pro"> PDF &nbsp;</span>',
                className: 'btn-danger',
                orientation: 'landscape',
                pageSize: 'A4',
                title: '{{$title}}'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i><span style="font-family: Source Sans Pro"> Excel &nbsp;</span>',
                className: 'btn-success',
                orientation: 'landscape',
                pageSize: 'A4',
                title: '{{$title}}'
            }, 
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i><span style="font-family: Source Sans Pro"> Print &nbsp;</span>',
                className: 'btn-secondary',
                title: '{{$title}}',
                autoPrint: false,
            },
        ]
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