@extends('dashboard.layouts.main')

@section('container')
  <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($pemilihs) }}</h3>
                <p>Jumlah Pemilih</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ count($kandidats) }}</h3>
              <p>Jumlah Kandidat</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ count($votings) }}</h3>
            <p>Pemilih Sudah Memilih</p>
          </div>
          <div class="icon">
            <i class="ion ion-document-text"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ count($pemilihs) - count($votings) }}</h3>
            <p>Pemilih Belum Memilih</p>
          </div>
          <div class="icon">
            <i class="ion ion-document"></i>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
    <section class="col-lg-7">
      <div class="card">
        <h5 class="card-header">Grafik Perolehan Suara</h5>
        <div class="card-body">
          <div id="perolehan_suara"></div>
        </div>
      </div>
    </section>
  </div>
  <script>
    Highcharts.chart('perolehan_suara', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Grafik Perolehan Suara'
      },
      xAxis: {
        categories: {!! json_encode($label) !!},
        crosshair: true
      },
      yAxis: {
        min: 0, 
        title: {
          text: 'Suara'
        }
      },
      tooltip: {
        headerFormat: '<table>',
        pointFormat: '<tr><td style="padding:0">{point.y:.0f} Suara</td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [{
        name: 'Jumlah Suara',
        data: {!! json_encode($hasil) !!}
      }]
    });
  </script>
@endsection
