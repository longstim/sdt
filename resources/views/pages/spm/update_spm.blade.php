@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><span class="text-muted">Last Update: {{$lastupdateDate}} <i class="fa fa-clock"></i> {{$lastupdateTime}} WIB</span></li>
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
        <form role="form" id="update-spm" method="post" action="{{url('proses-update-spm')}}">
        {{ csrf_field() }}

        <div class="card-body">
          <table id="table-view" class="table table-bordered table-hover">
            <thead>
            <tr align="center">
              <th rowspan="2">Bulan</th>
              <th colspan="2">Pengujian</th>
              <th colspan="2">Kalibrasi</th>
              <th colspan="2">Sertifikasi</th>
            </tr>
            <tr align="center">
              <th>M</th>
              <th>TM</th>
              <th>M</th>
              <th>TM</th>
              <th>M</th>
              <th>TM</th>
            </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Januari</td>
                  <td>
                    <input type="text" name="pengujianM[1]" class="form-control" value={{$pengujianM_Arr[1]}} >
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[1]" class="form-control" value={{$pengujianTM_Arr[1]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[1]" class="form-control" value={{$kalibrasiM_Arr[1]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[1]" class="form-control" value={{$kalibrasiTM_Arr[1]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[1]" class="form-control" value={{$sertifikasiM_Arr[1]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[1]" class="form-control" value={{$sertifikasiTM_Arr[1]}}>
                  </td>
               </tr>
               <tr>
                  <td>Februari</td>
                  <td>
                    <input type="text" name="pengujianM[2]" class="form-control" value={{$pengujianM_Arr[2]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[2]" class="form-control" value={{$pengujianTM_Arr[2]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[2]" class="form-control" value={{$kalibrasiM_Arr[2]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[2]" class="form-control" value={{$kalibrasiTM_Arr[2]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[2]" class="form-control" value={{$sertifikasiM_Arr[2]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[2]" class="form-control" value={{$sertifikasiTM_Arr[2]}}>
                  </td>
               </tr>
               <tr>
                  <td>Maret</td>
                  <td>
                    <input type="text" name="pengujianM[3]" class="form-control" value={{$pengujianM_Arr[3]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[3]" class="form-control" value={{$pengujianTM_Arr[3]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[3]" class="form-control" value={{$kalibrasiM_Arr[3]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[3]" class="form-control" value={{$kalibrasiTM_Arr[3]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[3]" class="form-control" value={{$sertifikasiM_Arr[3]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[3]" class="form-control" value={{$sertifikasiTM_Arr[3]}}>
                  </td>
               </tr>
               <tr>
                  <td>April</td>
                  <td>
                    <input type="text" name="pengujianM[4]" class="form-control" value={{$pengujianM_Arr[4]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[4]" class="form-control" value={{$pengujianTM_Arr[4]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[4]" class="form-control" value={{$kalibrasiM_Arr[4]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[4]" class="form-control" value={{$kalibrasiTM_Arr[4]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[4]" class="form-control" value={{$sertifikasiTM_Arr[4]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[4]" class="form-control" value={{$sertifikasiTM_Arr[4]}}>
                  </td>
               </tr>
               <tr>
                  <td>Mei</td>
                  <td>
                    <input type="text" name="pengujianM[5]" class="form-control" value={{$pengujianM_Arr[5]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[5]" class="form-control" value={{$pengujianTM_Arr[5]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[5]" class="form-control" value={{$kalibrasiM_Arr[5]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[5]" class="form-control" value={{$kalibrasiTM_Arr[5]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[5]" class="form-control" value={{$sertifikasiM_Arr[5]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[5]" class="form-control" value={{$sertifikasiTM_Arr[5]}}>
                  </td>
               </tr>
               <tr>
                  <td>Juni</td>
                  <td>
                    <input type="text" name="pengujianM[6]" class="form-control" value={{$pengujianM_Arr[6]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[6]" class="form-control" value={{$pengujianTM_Arr[6]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[6]" class="form-control" value={{$kalibrasiM_Arr[6]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[6]" class="form-control" value={{$kalibrasiTM_Arr[6]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[6]" class="form-control" value={{$sertifikasiM_Arr[6]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[6]" class="form-control" value={{$sertifikasiTM_Arr[6]}}>
                  </td>
               </tr>
               <tr>
                  <td>Juli</td>
                  <td>
                    <input type="text" name="pengujianM[7]" class="form-control" value={{$pengujianM_Arr[7]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[7]" class="form-control" value={{$pengujianTM_Arr[7]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[7]" class="form-control" value={{$kalibrasiM_Arr[7]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[7]" class="form-control" value={{$kalibrasiTM_Arr[7]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[7]" class="form-control" value={{$sertifikasiM_Arr[7]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[7]" class="form-control" value={{$sertifikasiTM_Arr[7]}}>
                  </td>
               </tr>
               <tr>
                  <td>Agustus</td>
                  <td>
                    <input type="text" name="pengujianM[8]" class="form-control" value={{$pengujianM_Arr[8]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[8]" class="form-control" value={{$pengujianTM_Arr[8]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[8]" class="form-control"  value={{$kalibrasiM_Arr[8]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[8]" class="form-control" value={{$kalibrasiTM_Arr[8]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[8]" class="form-control" value={{$sertifikasiM_Arr[8]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[8]" class="form-control" value={{$sertifikasiTM_Arr[8]}}>
                  </td>
               </tr>
               <tr>
                  <td>September</td>
                  <td>
                    <input type="text" name="pengujianM[9]" class="form-control" value={{$pengujianM_Arr[9]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[9]" class="form-control" value={{$pengujianTM_Arr[9]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[9]" class="form-control" value={{$kalibrasiM_Arr[9]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[9]" class="form-control" value={{$kalibrasiTM_Arr[9]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[9]" class="form-control" value={{$sertifikasiM_Arr[9]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[9]" class="form-control" value={{$sertifikasiTM_Arr[9]}}>
                  </td>
               </tr>
               <tr>
                  <td>Oktober</td>
                  <td>
                    <input type="text" name="pengujianM[10]" class="form-control" value={{$pengujianM_Arr[10]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[10]" class="form-control" value={{$pengujianTM_Arr[10]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[10]" class="form-control" value={{$kalibrasiM_Arr[10]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[10]" class="form-control" value={{$kalibrasiTM_Arr[10]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[10]" class="form-control" value={{$sertifikasiM_Arr[10]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[10]" class="form-control" value={{$sertifikasiTM_Arr[10]}}>
                  </td>
               </tr>
               <tr>
                  <td>November</td>
                  <td>
                    <input type="text" name="pengujianM[11]" class="form-control" value={{$pengujianM_Arr[11]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[11]" class="form-control" value={{$pengujianTM_Arr[11]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[11]" class="form-control" value={{$kalibrasiM_Arr[11]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[11]" class="form-control" value={{$kalibrasiTM_Arr[11]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[11]" class="form-control" value={{$sertifikasiM_Arr[11]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[11]" class="form-control" value={{$sertifikasiTM_Arr[11]}}>
                  </td>
               </tr>
               <tr>
                  <td>Desember</td>
                  <td>
                    <input type="text" name="pengujianM[12]" class="form-control" value={{$pengujianM_Arr[12]}}>
                  </td>
                  <td>
                    <input type="text" name="pengujianTM[12]" class="form-control" value={{$pengujianTM_Arr[12]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiM[12]" class="form-control" value={{$kalibrasiM_Arr[12]}}>
                  </td>
                  <td>
                    <input type="text" name="kalibrasiTM[12]" class="form-control" value={{$kalibrasiTM_Arr[12]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiM[12]" class="form-control" value={{$sertifikasiM_Arr[12]}}>
                  </td>
                  <td>
                    <input type="text" name="sertifikasiTM[12]" class="form-control" value={{$sertifikasiTM_Arr[12]}}>
                  </td>
               </tr>
            </tbody>
          </table>
          <br>
          <u>Keterangan : </u><br>
          <b>M</b> = Memenuhi SPM<br>
          <b>TM</b> = Tidak Memenuhi SPM
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