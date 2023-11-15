@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{url('data-pendaftaran')}}" class="btn btn-primary">Riwayat Pendaftaran</a></li>
</ol>
@endsection
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
              <div class="col-lg-6 text-center">
                <a href="{{url('pendaftaran-pengujian')}}">
                <div class="small-box bg-primary">
                  <div class="inner">
                  <h3>Pengujian</h3>
                  <p>Permohonan Pengujian</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-erlenmeyer-flask"></i>
                  </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pendaftaran-kalibrasi')}}">
                  <div class="small-box bg-danger">
                    <div class="inner">
                    <h3>Kalibrasi</h3>
                    <p>Permohonan Kalibrasi</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-speedometer"></i>
                    </div>
                  </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pendaftaran-sertifikasi')}}">
                <div class="small-box bg-success">
                    <div class="inner">
                    <h3>Sertifikasi</h3>
                    <p>Permohonan Sertifikasi</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-document-text"></i>
                    </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pendaftaran-bimtek')}}">
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>Bimbingan Teknis</h3>
                    <p>Permohonan Bimbingan Teknis</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-easel"></i>
                    </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pendaftaran-konsultansi')}}">
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>Konsultansi</h3>
                    <p>Permohonan Konsultansi</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
          </div>

        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

  

<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
@endsection
