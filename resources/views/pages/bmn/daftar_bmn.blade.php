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
        <div class="card-body">
          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama Barang</th>
              <th>NUP</th>
              <th>Merk</th>
              <th>Kuantitas</th>
              <th>Tanggal Perolehan</th>
              <th>Nilai Perolehan</th>
              <th>Nilai Buku</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($bmn as $data)  
               <tr>
                  <td>{{++$no}}</td>
                  <td>{{$data->kode_barang}}</td>
                  <td>{{$data->nama}}</td>
                  <td>{{$data->nup}}</td>
                  <td>{{$data->merk}}</td>
                  <td>{{$data->kuantitas}}</td>
                  <td>{{$data->tgl_perolehan}}</td>
                  <td>{{formatMataUang($data->nilai_perolehan)}}</td>
                  <td>{{formatMataUang($data->nilai_buku)}}</td>
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