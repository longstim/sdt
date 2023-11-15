@extends('layouts.dashboard')
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
              <div class="col-lg-6 text-center">
                <a href="https://bspjimedan.kemenperin.go.id/portal/tracking-order/" target="_blank">
                <div class="small-box">
                  <img src="{{asset('image/icon/tracking.png')}}" width="200px">
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pengaduan')}}">
                  <div class="small-box">
                   <img src="{{asset('image/icon/pengaduan.png')}}" width="200px">
                  </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="https://wa.me/+6285171699665" target="_blank">
                <div class="small-box">
                  <img src="{{asset('image/icon/tanyajawab.png')}}" width="200px">
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pendaftaran')}}">
                <div class="small-box">
                  <img src="{{asset('image/icon/pendaftaran.png')}}" width="200px">
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
