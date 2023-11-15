@extends('layouts.dashboard')
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
              <div class="col-lg-6 text-center">
                <a href="{{url('spm')}}">
                <div class="small-box">
                  <img src="{{asset('image/icon/spm.png')}}" width="200px">
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('pnbp')}}">
                <div class="small-box">
                  <img src="{{asset('image/icon/pnbp.png')}}" width="200px">
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('bmn')}}">
                <div class="small-box">
                  <img src="{{asset('image/icon/bmn.png')}}" width="200px">
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('arsip')}}">
                  <div class="small-box">
                  <img src="{{asset('image/icon/arsip.png')}}" width="200px">
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
