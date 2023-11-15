@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}} 2023</b>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><span class="text-muted">Last Update: {{$lastupdateDate}} <i class="fa fa-clock"></i> {{$lastupdateTime}} WIB</span></li>
</ol>
@endsection
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div>
      @if(Session::has('message'))
          <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
          <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
      @endif
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
            <div class = "col-md-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b> Persentase SPM</b></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <canvas id="pieChartSPMPengujian" style="min-height: 150px; height: 150px; max-height: 200px; max-width: 100%;"></canvas><br>
                  <div class="text-center">
                    M : <span class="text-muted"><b> {{$persenTotalSesuaiSPMPengujian}}%</b></span> | TM : <span class="text-muted"><b>{{$persenTotalTidakSesuaiSPMPengujian}}%</b></span><br>
                    <b class="text-primary">SPM Pengujian</b>
                  </div>
                </div>
                <div class="col-md-4">
                  <canvas id="pieChartSPMKalibrasi" style="min-height: 150px; height: 150px; max-height: 200px; max-width: 100%;"></canvas><br>
                  <div class="text-center">
                    M : <span class="text-muted"><b> {{$persenTotalSesuaiSPMKalibrasi}}%</b></span> | TM : <span class="text-muted"><b>{{$persenTotalTidakSesuaiSPMKalibrasi}}%</b></span><br>
                    <b class="text-primary">SPM Kalibrasi</b>
                  </div>
                </div>
                <div class="col-md-4">
                  <canvas id="pieChartSPMSertifikasi" style="min-height: 150px; height: 150px; max-height: 200px; max-width: 100%;"></canvas><br>
                  <div class="text-center">
                    M : <span class="text-muted"><b> {{$persenTotalSesuaiSPMSertifikasi}}%</b></span> | TM : <span class="text-muted"><b>{{$persenTotalTidakSesuaiSPMSertifikasi}}%</b></span><br>
                    <b class="text-primary">SPM Sertifikasi</b>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>

              <div class="card card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><b> Persentase SPM per Bulan</b></h3> 
                    <!--<div class="card-tools">
                      <a href="{{url('/')}}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>-->
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartDataSPM" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                 @role('admin|spm')
                  <div class="card-footer text-right">
                    <a href="{{url('update-spm')}}" class="btn btn-primary">Update Data SPM</a>
                  </div>
                  @endrole
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
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

    //-------------
    //- DATA SPM -
    //-------------

    var barChartCanvas = $('#barChartDataSPM').get(0).getContext('2d')

    let chart = new Chart(barChartCanvas, {
        type: 'bar',
        data: {
            datasets: [
            {
                label               : 'Pengujian',
                backgroundColor     : '#1C4E80',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [{{$persenSPMPengujian[1]}},{{$persenSPMPengujian[2]}}, {{$persenSPMPengujian[3]}},{{$persenSPMPengujian[4]}},{{$persenSPMPengujian[5]}},{{$persenSPMPengujian[6]}},{{$persenSPMPengujian[7]}},{{$persenSPMPengujian[8]}}, {{$persenSPMPengujian[9]}},{{$persenSPMPengujian[10]}},{{$persenSPMPengujian[11]}},{{$persenSPMPengujian[12]}}]
            },
            {
                label               : 'Kalibrasi',
                backgroundColor     : '#E61C5D',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [{{$persenSPMKalibrasi[1]}},{{$persenSPMKalibrasi[2]}}, {{$persenSPMKalibrasi[3]}},{{$persenSPMKalibrasi[4]}},{{$persenSPMKalibrasi[5]}},{{$persenSPMKalibrasi[6]}},{{$persenSPMKalibrasi[7]}},{{$persenSPMKalibrasi[8]}}, {{$persenSPMKalibrasi[9]}},{{$persenSPMKalibrasi[10]}},{{$persenSPMKalibrasi[11]}},{{$persenSPMKalibrasi[12]}}]
              },
              {
                label               : 'Sertifikasi',
                backgroundColor     : '#FFBD39',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [{{$persenSPMSertifikasi[1]}},{{$persenSPMSertifikasi[2]}}, {{$persenSPMSertifikasi[3]}},{{$persenSPMSertifikasi[4]}},{{$persenSPMSertifikasi[5]}},{{$persenSPMSertifikasi[6]}},{{$persenSPMSertifikasi[7]}},{{$persenSPMSertifikasi[8]}}, {{$persenSPMSertifikasi[9]}},{{$persenSPMSertifikasi[10]}},{{$persenSPMSertifikasi[11]}},{{$persenSPMSertifikasi[12]}}]
              }
            ],

            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                          return value + "%";
                        },
                        min: 0,
                        max: 100
                    }
                }]
            }
        }
    });

    //-------------
    //- PENGUJIAN -
    //-------------

    var pengujianData        = {
      labels: [
          'Memenuhi SPM',
          'Tidak Memenuhi SPM',
      ],
      datasets: [
        {
          data: [{{$persenTotalSesuaiSPMPengujian}},{{$persenTotalTidakSesuaiSPMPengujian}}],
          backgroundColor : ['#7AA874', '#ffc107'],
        }
      ]
    }

    var pieChartCanvas = $('#pieChartSPMPengujian').get(0).getContext('2d')
    var pieData        = pengujianData;
    var pieOptions     = {
      responsive: true,
      maintainAspectRatio: false,
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
    new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- KALIBRASI -
    //-------------

    var kalibrasiData        = {
      labels: [
          'Memenuhi SPM',
          'Tidak Memenuhi SPM',
      ],
      datasets: [
        {
          data: [{{$persenTotalSesuaiSPMKalibrasi}},{{$persenTotalTidakSesuaiSPMKalibrasi}}],
          backgroundColor : ['#7AA874', '#ffc107'],
        }
      ]
    }

    var pieChartCanvas = $('#pieChartSPMKalibrasi').get(0).getContext('2d')
    var pieData        = kalibrasiData;
    var pieOptions     = {
      responsive: true,
      maintainAspectRatio: false,
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
    new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions
    })


    //-------------
    //- SERTIFIKASI -
    //-------------

    var sertifikasiData        = {
      labels: [
          'Memenuhi SPM',
          'Tidak Memenuhi SPM',
      ],
      datasets: [
        {
          data: [{{$persenTotalSesuaiSPMSertifikasi}},{{$persenTotalTidakSesuaiSPMSertifikasi}}],
          backgroundColor : ['#7AA874', '#ffc107'],
        }
      ]
    }

    var pieChartCanvas = $('#pieChartSPMSertifikasi').get(0).getContext('2d')
    var pieData        = sertifikasiData;
    var pieOptions     = {
      responsive: true,
      maintainAspectRatio: false,
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
    new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions
    })
})
   
</script>
@endsection
