@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}} 2023</b>
@endsection
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

        <div class="row">
        <!-- NILAI BUKU BMN-->
          <div class = "col-md-12">
            <div class="card card-outline">
              <div class="card-header">
                <h3 class="card-title"><b>Nilai Buku BMN</b></h3>
                <div class="card-tools">
                  <!--<a href="{{url('/')}}" class="btn btn-sm btn-outline-primary">Detail</a>-->
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                      <canvas id="nilaiBukuChart" style="min-height: 300px; height: 350px; max-height: 1000px; max-width: 100%;"></canvas>
                  </div>
                  <div class="col-sm-6">
                    <h3>Total Nilai Buku: <br></h3>
                    <h1><b class="text-primary">{{formatRupiah($sumNilaiBukuBMN)}}</b></h1><br>
                    <table cellpadding="5">
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#007ED6;"></i>
                        </td>
                        <td>Tanah</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBukuBMN['tanah'])}}</b></td>
                        <td align="right">({{$persenBukuBMN['tanah']}}%)</td>
                      </tr>
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#7CDDDD;"></i>
                        </td>
                        <td>Peralatan dan Mesin</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBukuBMN['peralatan'])}}</b></td>
                        <td align="right">({{$persenBukuBMN['peralatan']}}%)</td>
                      </tr> 
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#52D726;"></i>
                        </td>
                        <td>Gedung dan Bangunan</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBukuBMN['gedung'])}}</b></td>
                        <td align="right">({{$persenBukuBMN['gedung']}}%)</td>
                      </tr> 
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#FF7300;"></i>
                        </td>
                        <td>Jalan dan Jembatan</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBukuBMN['jalan'])}}</b></td>
                        <td align="right">({{$persenBukuBMN['jalan']}}%)</td>
                      </tr> 
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#FFEC00;"></i>
                        </td>
                        <td>Jaringan</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBukuBMN['jaringan'])}}</b></td>
                        <td align="right">({{$persenBukuBMN['jaringan']}}%)</td>
                      </tr>  
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#FF0000;"></i>
                        </td>
                        <td>Aset Tetap Lainnya</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBukuBMN['aset'])}}</b></td>
                        <td align="right">({{$persenBukuBMN['aset']}}%)</td>
                      </tr>   
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
        <div class="row">
        <!-- NILAI PEROLEHAN BMN-->
          <div class = "col-md-12">
            <div class="card card-outline">
              <div class="card-header">
                <h3 class="card-title"><b>Nilai Perolehan BMN</b></h3>
                <div class="card-tools">
                  <!--<a href="{{url('/')}}" class="btn btn-sm btn-outline-primary">Detail</a>-->
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                      <canvas id="nilaiPerolehanChart" style="min-height: 300px; height: 350px; max-height: 1000px; max-width: 100%;"></canvas>
                  </div>
                  <div class="col-sm-6">
                    <h3>Total Nilai Perolehan: <br></h3>
                    <h1><b class="text-primary">{{formatRupiah($sumNilaiBMN)}}</b></h1><br>
                    <table cellpadding="5">
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#007ED6;"></i>
                        </td>
                        <td>Tanah</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBMN['tanah'])}}</b></td>
                        <td align="right">({{$persenBMN['tanah']}}%)</td>
                      </tr>
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#7CDDDD;"></i>
                        </td>
                        <td>Peralatan dan Mesin</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBMN['peralatan'])}}</b></td>
                        <td align="right">({{$persenBMN['peralatan']}}%)</td>
                      </tr> 
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#52D726;"></i>
                        </td>
                        <td>Gedung dan Bangunan</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBMN['gedung'])}}</b></td>
                        <td align="right">({{$persenBMN['gedung']}}%)</td>
                      </tr> 
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#FF7300;"></i>
                        </td>
                        <td>Jalan dan Jembatan</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBMN['jalan'])}}</b></td>
                        <td align="right">({{$persenBMN['jalan']}}%)</td>
                      </tr> 
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#FFEC00;"></i>
                        </td>
                        <td>Jaringan</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBMN['jaringan'])}}</b></td>
                        <td align="right">({{$persenBMN['jaringan']}}%)</td>
                      </tr>  
                      <tr>
                        <td>                    
                          <i class="fa fa-square" style="color:#FF0000;"></i>
                        </td>
                        <td>Aset Tetap Lainnya</td>
                        <td>:</td>
                        <td align="right"><b>{{formatMataUang($nilaiBMN['aset'])}}</b></td>
                        <td align="right">({{$persenBMN['aset']}}%)</td>
                      </tr>   
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

           <div class="row">
              <div class="col-lg-6 text-center">
                <a href="{{url('daftar-bmn/1')}}">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Tanah</h3>
                    <h4>{{formatMataUang($jumlahBMN['tanah'])}} m<sup>2</sup></h4>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-analytics"></i>
                  </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('daftar-bmn/2')}}">
                  <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Peralatan dan Mesin</h3>
                    <h4>{{formatMataUang($jumlahBMN['peralatan'])}} Unit</h4>
                  </div>
                  <div class="icon">
                    <i class="ion ion-wrench"></i>
                  </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('daftar-bmn/3')}}">
                  <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Gedung dan Bangunan</h3>
                    <h4>{{formatMataUang($jumlahBMN['gedung'])}} Buah</h4>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-home"></i>
                  </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('daftar-bmn/4')}}">
                  <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Jalan dan Jembatan</h3>
                    <h4>{{formatMataUang($jumlahBMN['jalan'])}} m<sup>2</sup></h4>
                  </div>
                  <div class="icon">
                    <i class="ion ion-alert-circled"></i>
                  </div>
                </div>
                </a>
              </div>
                <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('daftar-bmn/5')}}">
                  <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Jaringan</h3>
                    <h4>{{formatMataUang($jumlahBMN['jaringan'])}} Buah</h4>
                  </div>
                  <div class="icon">
                    <i class="ion ion-waterdrop"></i>
                  </div>
                </div>
                </a>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 text-center">
                <a href="{{url('daftar-bmn/6')}}">
                  <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Aset Tetap Lainnya</h3>
                    <h4>{{formatMataUang($jumlahBMN['aset'])}} Buah</h4>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-paper"></i>
                  </div>
                </div>
                </a>
              </div>
          </div>

        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

  

<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
   $( document ).ready(function () {
    //-------------
    //- NILAI PEROLEHAN BMN CHART -
    //-------------

    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#nilaiPerolehanChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Tanah', 'Peralatan dan Mesin', 'Gedung dan Bangunan', 'Jalan dan Jembatan', 'Jaringan', 'Aset Tetap Lainnya'
      ],
      datasets: [
        {
          data: [{{$persenBMN['tanah']}}, {{$persenBMN['peralatan']}}, {{$persenBMN['gedung']}}, {{$persenBMN['jalan']}}, {{$persenBMN['jaringan']}}, {{$persenBMN['aset']}}],
          backgroundColor : ['#007ED6', '#7CDDDD', '#52D726', '#FF7300', '#FFEC00', '#FF0000'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
          }
        }
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- NILAI BUKU BMN CHART -
    //-------------

    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#nilaiBukuChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Tanah', 'Peralatan dan Mesin', 'Gedung dan Bangunan', 'Jalan dan Jembatan', 'Jaringan', 'Aset Tetap Lainnya'
      ],
      datasets: [
        {
          data: [{{$persenBukuBMN['tanah']}}, {{$persenBukuBMN['peralatan']}}, {{$persenBukuBMN['gedung']}}, {{$persenBukuBMN['jalan']}}, {{$persenBukuBMN['jaringan']}}, {{$persenBukuBMN['aset']}}],
          backgroundColor : ['#007ED6', '#7CDDDD', '#52D726', '#FF7300', '#FFEC00', '#FF0000'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
          }
        }
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    })
</script>
@endsection
