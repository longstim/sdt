@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}} 2023</b>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{url('tambah-pnbp')}}" class="btn btn-primary">Tambah Data PNBP</a></li>
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
      </div>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Pengujian</th>
              <th>Kalibrasi</th>
              <th>Sertifikasi</th>
              <th>Bimtek</th>
              <th>Konsultansi</th>
              <th>Updated at</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($pnbp as $data)  
               <tr>
                  <td>{{++$no}}</td>
                  <td>{{customTanggal($data->tgl_pnbp, 'Y-m-d')}}</td>
                  <td>{{formatMataUang($data->pengujian)}}</td>
                  <td>{{formatMataUang($data->kalibrasi)}}</td>
                  <td>{{formatMataUang($data->sertifikasi)}}</td>
                  <td>{{formatMataUang($data->bimtek)}}</td>
                  <td>{{formatMataUang($data->konsultansi)}}</td>
                  <td>{{customTanggalWaktu($data->updated_at, 'Y-m-d H:i:s')}}</td>
                  <td width="10%">
                    <div class="btn-group">
                      <button class="btn btn-success btn-md dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-check nav-icon"></i>
                      <span class="caret"></span>
                      </button>
                      <div class="dropdown-menu" id="dropdown-action-id">
                        <a class="dropdown-item" href="ubah-pnbp/{{$data->id}}">Ubah Data</a>
                        <a class="dropdown-item swalDelete" href="hapus-pnbp/{{$data->id}}">Hapus Data</a>
                      </div>
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