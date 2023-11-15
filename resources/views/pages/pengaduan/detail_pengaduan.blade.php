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

  #addDropDownDiagnosa .table td
  {
    padding: 0 rem;
  }
</style>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <div class="row">

    <div class="col-12">
      <div>
        @if(Session::has('message'))
            <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
            <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
        @endif
      </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="table-responsive">
            <table class="table table-hover">
              <tr>
                <td>Status</td>
                <td>:</td>
                <th>  
                    @php
                      if($detail->is_cancel=="yes")
                      {
                    @endphp
                        <span class="badge bg-danger">Canceled </span>&nbsp;
                        <i style="font-size:12px"> {{$detail->cancel_at}} WIB</i>
                    @php
                      }
                      else if($detail->is_solved=="yes")
                      {
                    @endphp
                        <span class="badge bg-success">Solved</span>&nbsp;
                        <i style="font-size:12px"> {{$detail->solved_at}} WIB</i>
                    @php
                      }
                      else if($detail->is_process=="yes")
                      {
                    @endphp
                        <span class="badge bg-warning">In Progress</span>&nbsp;
                        <i style="font-size:12px"> {{$detail->process_at}} WIB</i>
                    @php
                      }
                      else
                      {
                    @endphp
                        <span class="badge bg-primary">Open</span>&nbsp;
                        <i style="font-size:12px"> {{$detail->created_at}} WIB</i>
                    @php
                      }
                    @endphp
                </th>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>:</td>
                <th>{{formatTanggalIndonesia($detail->created_at)}}</th>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <th>{{$detail->nama}}</th>
              </tr>
               <tr>
                <td>No. HP (Whatsapp)</td>
                <td>:</td>
                <th>{{$detail->no_hp}}</th>
              </tr>
              <tr>
                <td>E-Mail</td>
                <td>:</td>
                <th>{{$detail->email}}</th>
              </tr>
              <tr>
                <td>Jenis Pelayanan</td>
                <td>:</td>
                <th>{{($detail->jenis_pelayanan=="Lainnya") ? $detail->jenis_pelayanan." (".$detail->lainnya.")" : $detail->jenis_pelayanan}}</th>
              </tr>
              <tr>
                <td>Uraian Pengaduan</td>
                <td>:</td>
                <th>{{$detail->uraian_pengaduan}}</th>
              </tr>
              <tr>
                <td>Bukti Pendukung</td>
                <td>:</td>
                <th>
                @php
                  if($detail->bukti_pengaduan !="" || $detail->bukti_pengaduan !=null)
                  {
                @endphp
                  <p> <a href="{{asset('file/pengaduan/bukti-pengaduan/'.$detail->bukti_pengaduan)}}" class="text-primary" target="_blank"><i class="fas fa-file-pdf text-primary"></i> {{$detail->bukti_pengaduan}}</a></p>
                @php
                }
                else
                {
                @endphp
                <p>-</p>
                @php
                }
                @endphp
              </th>
              </tr>
            </table>
        </div>
      </div>
       <div class="card card-outline card-primary">
          <div class="card-header">
                @php
                if($detail->is_cancel=="yes")
                {
              @endphp
                    <b class="text-danger">Keterangan Pembatalan</b>
              @php
                }
                else if($detail->is_solved=="yes")
                {
              @endphp
                     <b class="text-success">Keterangan Tindak Lanjut</b>
              @php
                }
                else
                {
              @endphp
                    <b>Keterangan Tindak Lanjut</b>
              @php
                }
              @endphp
          </div>
          <div class="card-body">
              <div class="form-group col-md-12">
                <label>Keterangan</label>
                <p>{{($detail->keterangan_tindaklanjut !="" || $detail->keterangan_tindaklanjut !=null) ? $detail->keterangan_tindaklanjut : "-"}}
              </div>
              <div class="form-group col-md-12">
                <label>Bukti Tindak Lanjut</label>
                @php
                  if($detail->bukti_tindaklanjut !="" || $detail->bukti_tindaklanjut !=null)
                  {
                @endphp
                  <p> <a href="{{asset('file/pengaduan/tindak-lanjut/'.$detail->bukti_tindaklanjut)}}" class="text-primary" target="_blank"><i class="fas fa-file-pdf text-primary"></i> {{$detail->bukti_tindaklanjut}}</a></p>
                @php
                }
                else
                {
                @endphp
                <p>-</p>
                @php
                }
                @endphp

              </div>
          </div>
      </div>
    </div>
    </div>
  </div>
    <!-- /.col -->
  </div>

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
  <script>
    $( document ).ready(function () {

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