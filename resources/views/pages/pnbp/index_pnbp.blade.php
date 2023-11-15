@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}} 2023</b>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><span class="text-muted">Last Update: {{$lastupdateDate}}</span></li>
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
              <div class="card card-outline">
                <div class="card-header">
                  <h3 class="card-title"><b> PNBP per Layanan</b></h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                        <canvas id="PNBPChart" style="min-height: 300px; height: 350px; max-height: 1000px; max-width: 100%;"></canvas>
                    </div>
                    <div class="col-sm-6">
                      <h3>Total PNBP: <br></h3>
                      <h1><b class="text-primary">{{formatRupiah($totalPNBP)}}</b></h1><br>
                      <table cellpadding="5">
                        <tr>
                          <td>                    
                            <i class="fa fa-square" style="color:#1C4E80;"></i>
                          </td>
                          <td>Pengujian</td>
                          <td>:</td>
                          <td align="right"><b>{{formatMataUang($JumlahPNBP['pengujian'])}}</b></td>
                          <td align="right">({{$PersenPNBP['pengujian']}}%)</td>
                        </tr>
                        <tr>
                          <td>                    
                            <i class="fa fa-square" style="color:#20c997;"></i>
                          </td>
                          <td>Kalibrasi</td>
                          <td>:</td>
                          <td align="right"><b>{{formatMataUang($JumlahPNBP['kalibrasi'])}}</b></td>
                          <td align="right">({{$PersenPNBP['kalibrasi']}}%)</td>
                        </tr> 
                        <tr>
                          <td>                    
                            <i class="fa fa-square" style="color:#F6635C;"></i>
                          </td>
                          <td>Sertifikasi</td>
                          <td>:</td>
                          <td align="right"><b>{{formatMataUang($JumlahPNBP['sertifikasi'])}}</b></td>
                          <td align="right">({{$PersenPNBP['sertifikasi']}}%)</td>
                        </tr> 
                        <tr>
                          <td>                    
                            <i class="fa fa-square" style="color:#EBE76C;"></i>
                          </td>
                          <td>Bimbingan Teknis</td>
                          <td>:</td>
                          <td align="right"><b>{{formatMataUang($JumlahPNBP['bimtek'])}}</b></td>
                          <td align="right">({{$PersenPNBP['bimtek']}}%)</td>
                        </tr> 
                        <tr>
                          <td>                    
                            <i class="fa fa-square" style="color:#7C73C0;"></i>
                          </td>
                          <td>Konsultansi</td>
                          <td>:</td>
                          <td align="right"><b>{{formatMataUang($JumlahPNBP['konsultansi'])}}</b></td>
                          <td align="right">({{$PersenPNBP['konsultansi']}}%)</td>
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
            <div class = "col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><b> Data PNBP per Bulan</b></h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartDataPNBP" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
                @role('admin|pnbp')
                <div class="card-footer text-right">
                    <a href="{{url('daftar-pnbp')}}" class="btn btn-primary">Update Data PNBP</a>
                </div>
                @endrole
                  <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
          </div><!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>

  

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
    //- PNBP Per Layanan -
    //-------------

    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#PNBPChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Pengujian', 'Kalibrasi', 'Sertifikasi', 'Bimbingan Teknis', 'Konsultansi'
      ],
      datasets: [
        {
          data: [{{$PersenPNBP['pengujian']}}, {{$PersenPNBP['kalibrasi']}}, {{$PersenPNBP['sertifikasi']}}, {{$PersenPNBP['bimtek']}}, {{$PersenPNBP['konsultansi']}}],
          backgroundColor : ['#1C4E80', '#20c997', '#F6635C', '#EBE76C', '#7C73C0'],
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
    //- DATA PNBP Per Bulan -
    //-------------

    var areaChartDataPNBP = {
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
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
          data                : [{{$pengujian_Arr[1]}},{{$pengujian_Arr[2]}}, {{$pengujian_Arr[3]}},{{$pengujian_Arr[4]}},{{$pengujian_Arr[5]}},{{$pengujian_Arr[6]}},{{$pengujian_Arr[7]}},{{$pengujian_Arr[8]}}, {{$pengujian_Arr[9]}},{{$pengujian_Arr[10]}},{{$pengujian_Arr[11]}},{{$pengujian_Arr[12]}}]
        },
        {
          label               : 'Kalibrasi',
          backgroundColor     : '#20c997',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$kalibrasi_Arr[1]}},{{$kalibrasi_Arr[2]}}, {{$kalibrasi_Arr[3]}},{{$kalibrasi_Arr[4]}},{{$kalibrasi_Arr[5]}},{{$kalibrasi_Arr[6]}},{{$kalibrasi_Arr[7]}},{{$kalibrasi_Arr[8]}}, {{$kalibrasi_Arr[9]}},{{$kalibrasi_Arr[10]}},{{$kalibrasi_Arr[11]}},{{$kalibrasi_Arr[12]}}]
        },
        {
          label               : 'Sertifikasi',
          backgroundColor     : '#F6635C',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$sertifikasi_Arr[1]}},{{$sertifikasi_Arr[2]}}, {{$sertifikasi_Arr[3]}},{{$sertifikasi_Arr[4]}},{{$sertifikasi_Arr[5]}},{{$sertifikasi_Arr[6]}},{{$sertifikasi_Arr[7]}},{{$sertifikasi_Arr[8]}}, {{$sertifikasi_Arr[9]}},{{$sertifikasi_Arr[10]}},{{$sertifikasi_Arr[11]}},{{$sertifikasi_Arr[12]}}]
        },
        {
          label               : 'Bimbingan Teknis',
          backgroundColor     : '#EBE76C',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$bimtek_Arr[1]}},{{$bimtek_Arr[2]}}, {{$bimtek_Arr[3]}},{{$bimtek_Arr[4]}},{{$bimtek_Arr[5]}},{{$bimtek_Arr[6]}},{{$bimtek_Arr[7]}},{{$bimtek_Arr[8]}}, {{$bimtek_Arr[9]}},{{$bimtek_Arr[10]}},{{$bimtek_Arr[11]}},{{$bimtek_Arr[12]}}]
        },
        {
          label               : 'Konsultansi',
          backgroundColor     : '#7C73C0',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$konsultansi_Arr[1]}},{{$konsultansi_Arr[2]}}, {{$konsultansi_Arr[3]}},{{$konsultansi_Arr[4]}},{{$konsultansi_Arr[5]}},{{$konsultansi_Arr[6]}},{{$konsultansi_Arr[7]}},{{$konsultansi_Arr[8]}}, {{$konsultansi_Arr[9]}},{{$konsultansi_Arr[10]}},{{$konsultansi_Arr[11]}},{{$konsultansi_Arr[12]}}]
        },
      ]
    }

    var barChartCanvasPNBP = $('#barChartDataPNBP').get(0).getContext('2d')
    var barChartDataPNBP = $.extend(true, {}, areaChartDataPNBP)
    var temp = areaChartDataPNBP.datasets[0]
    barChartDataPNBP.datasets[0] = temp
        

    new Chart(barChartCanvasPNBP, {
      type                    : 'bar',
      data                    : barChartDataPNBP,
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      options: {
          maintainAspectRatio : false,
          locale: 'id-ID',
          scales: {
               yAxes: [{
                  ticks: {
                      beginAtZero:true,
                      callback: (value, index, values) => {
                        return new Intl.NumberFormat('id-ID', {
                          style: 'currency',
                          currency: 'IDR',
                          maximumSignificantDigits: 3
                        }).format(value);
                      }
                  }
            }]
          },
          tooltips: {
              callbacks: {
                  label: function(tooltipItem, data)  {
                      var label = data.datasets[tooltipItem.datasetIndex].label || '';

                      if (label) {
                        label += ': ';
                      }

                      label += Intl.NumberFormat('id-ID', {
                          style: 'currency',
                          currency: 'IDR',
                          maximumSignificantDigits: 3
                        }).format(tooltipItem.yLabel);

                      return label;
                  },
              }
          }        
        },
    })

   })
   
</script>
@endsection
