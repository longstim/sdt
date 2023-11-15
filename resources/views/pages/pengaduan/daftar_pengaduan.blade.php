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
              <th>Tanggal</th>
              <th>Nama</th>
              <th>Jenis Pelayanan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($pengaduan as $data)  
               <tr>
                  <td>{{++$no}}</td>
                  <td>{{formatTanggalIndonesia($data->created_at)}}</td>
                  <td>{{$data->nama}}</td>
                  <td>{{($data->jenis_pelayanan=="Lainnya") ? $data->jenis_pelayanan." (".$data->lainnya.")" : $data->jenis_pelayanan}}</td>
                  <td>
                    @php
                      if($data->is_cancel=="yes")
                      {
                    @endphp
                        <span class="badge bg-danger">Canceled</span>
                        <p style="font-size:12px"><i>{{formatTanggalIndonesia($data->cancel_at)}}</i></p>
                    @php
                      }
                      else if($data->is_solved=="yes")
                      {
                    @endphp
                        <span class="badge bg-success">Solved</span>
                        <p style="font-size:12px"><i>{{formatTanggalIndonesia($data->solved_at)}}</i></p>
                    @php
                      }
                      else if($data->is_process=="yes")
                      {
                    @endphp
                        <span class="badge bg-warning">In Progress</span>
                        <p style="font-size:12px"><i>{{formatTanggalIndonesia($data->process_at)}}</i></p>
                    @php
                      }
                      else
                      {
                    @endphp
                        <span class="badge bg-primary">Open</span>
                        <p style="font-size:12px"><i>{{formatTanggalIndonesia($data->created_at)}}</i></p>
                    @php
                      }
                    @endphp
                      

                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{url('detail-pengaduan/'.$data->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detail" type="button" ><i class="fas fa-search"></i>
                      </a>&nbsp;
                      @role('admin|pengaduan')
                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-check nav-icon"></i>
                      <span class="caret"></span>
                      </button>
                      <div class="dropdown-menu" id="dropdown-action-id">
                        <!--Button Proses-->
                        @php
                            if($data->is_process=="no" && $data->is_solved=="" && $data->is_cancel=="")
                            {
                        @endphp
                            <a class="dropdown-item" href="update-pengaduan-in-progress/{{$data->id}}">Proses</a>
                        @php
                            }
                            else
                            {
                        @endphp
                            <a class="dropdown-item disabled" href="#">Proses</a>
                        @php
                        }
                        @endphp

                        <!--Button Selesai-->
                        @php
                            if($data->is_process=="yes" && $data->is_solved=="" && $data->is_cancel=="")
                            {
                        @endphp
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-tindak-lanjut-{{$data->id}}">Selesai</a>
                        @php
                            }
                            else
                            {
                        @endphp
                            <a class="dropdown-item disabled" href="#">Selesai</a>
                        @php
                        }
                        @endphp


                        <!--Button Batal-->
                        @php
                            if($data->is_solved=="yes" || $data->is_cancel=="yes")
                            {
                        @endphp
                            <a class="dropdown-item disabled" href="#">Batal</a>
                        @php
                            }
                            else
                            {
                        @endphp
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-cancel-{{$data->id}}">Batal</a>
                        @php
                        }
                        @endphp
                       @endrole
                      </div>
                    </div>
                  </td>
               </tr>
    
    <!-- Modal Tindak lanjut -->
    <div class="modal fade" id="modal-tindak-lanjut-{{$data->id}}">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
             <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                <!-- jquery validation -->
                <form role="form" id="tindaklanjut" method="post" action="{{url('update-pengaduan-solved')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
  
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-check"></i><b> &nbsp;Tindak Lanjut Pengaduan</b></h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <input type="hidden" name="id_solve" id="txtIDSolve" class="form-control" value="{{$data->id}}">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label>Keterangan<a style="color:red;">&#42;</a></label>
                                <textarea name="keterangan_tindaklanjut" class="form-control" id="txtKeterangan" rows="2" placeholder="Keterangan" required></textarea>
                            </div>
                          </div>
                          <div class="form-group col-md-12">
                              <label>Bukti Tindak Lanjut Permohonan</label><br>
                              <input type="file" name="bukti_tindaklanjut" id="buktitindaklanjut">
                          </div>
                      </div>
                    </div>
                          <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                  </div>
                </form>
                </div>
              </div>
          </div>
        </div>
    </div>
      <!-- Modal Tindak Lanjut-->


         <!-- Modal Tindak lanjut -->
    <div class="modal fade" id="modal-cancel-{{$data->id}}">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
             <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                <!-- jquery validation -->
                <form role="form" id="cancel-modal" method="post" action="{{url('update-pengaduan-cancel')}}">
                    {{ csrf_field() }}
  
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-times-circle"></i><b> &nbsp;Keterangan Pembatalan Pengaduan</b></h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <input type="hidden" name="id_cancel" id="txtIDCancel" class="form-control" value="{{$data->id}}">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label>Keterangan<a style="color:red;">&#42;</a></label>
                                <textarea name="keterangan_tindaklanjut" class="form-control" id="txtKeterangan" rows="2" placeholder="Keterangan" required></textarea>
                            </div>
                          </div>
                      </div>
                    </div>
                          <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                      </div>
                  </div>
                </form>
                </div>
              </div>
          </div>
        </div>
    </div>
      <!-- Modal Tindak Lanjut-->
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