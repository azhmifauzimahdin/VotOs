@extends('dashboard.layouts.main')

@push('head')
    <!-- Highchart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush

@section('container')
  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
          <div class="inner">
              <h3>{{ $laporan ? $laporan->jumlah_pemilih : 0 }}</h3>
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
            <h3>{{ $laporan ? $laporan->jumlah_kandidat : 0 }}</h3>
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
          <h3>{{ $laporan ? $laporan->jumlah_sudah_memilih : 0}}</h3>
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
          <h3>{{ $laporan ? $laporan->jumlah_belum_memilih : 0 }}</h3>
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
    @if ($pemilu)
    <section class="col-lg-4">
      <div class="card">
        <h5 class="card-header">Waktu Voting Dimulai</h5>
        <div class="card-body">
          <div class="row">
              <div id="hari" class="col-3 d-flex flex-column align-items-center"><h1 class="my-1">0</h1><span>Hari</span></div>
              <div id="jam" class="col-3 d-flex flex-column align-items-center"><h1 class="my-1">0</h1><span>Jam</span></div>
              <div id="menit" class="col-3 d-flex flex-column align-items-center"><h1 class="my-1">0</h1><span>Menit</span></div>
              <div id="detik" class="col-3 d-flex flex-column align-items-center"><h1 class="my-1">0</h1><span>Detik</span></div>
          </div>
        </div>
      </div>
    </section>
    @endif
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function() {
    var end = new Date('{{$waktupemilu}}');
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    
    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {
            clearInterval(timer);
            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        $("#hari").html("<h1 class='my-1'>" + days + "</h1><span>Hari</span>");
        $("#jam").html("<h1 class='my-1'>" + hours + "</h1><span>Jam</span>");
        $("#menit").html("<h1 class='my-1'>" + minutes + "</h1><span>Menit</span>");
        $("#detik").html("<h1 class='my-1'>" + seconds + "</h1><span>Detik</span>");
    }
    
    timer = setInterval(showRemaining, 1000);
  });

  Highcharts.chart('perolehan_suara', {
    chart: {
      type: 'column'
    },
    accessibility: {
      enabled: false
    },
    title: {
      text: ' '
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
      pointFormat: '<tr><td>{point.y:.0f} Suara</td></tr>',
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
@endpush