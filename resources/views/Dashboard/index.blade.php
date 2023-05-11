@extends('dashboard.layouts.main')

@section('container')
<div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
          <div class="inner">
              <h3>150</h3>
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
            <h3>53</h3>
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
          <h3>44</h3>
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
          <h3>65</h3>
          <p>Pemilih Belum Memilih</p>
        </div>
        <div class="icon">
          <i class="ion ion-document"></i>
        </div>
      </div>
    </div>
</div>
<div class="row">
  <section class="col-lg-7 connectedSortable">
    <div class="card">
      <h5 class="card-header">Grafik Perolehan Suara</h5>
      <div class="card-body">
        <div id="donut-chart" style="height: 300px;"></div>
      </div>
    </div>
  </section>
</div>
@endsection
