@extends('layouts.main')

@push('head')
    {{-- Highchart --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush

@section('container')
    <div class="row bg-primary mb-4 px-3 text-light bg-votos">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3 garis-bawah-gradient">Perolehan Suara</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Hasil perolehan suara akan muncul ketika waktu voting telah selesai atau semua pemilih telah memilih</p>
        </div>
    </div>
    <div class="px-5 mx-md-5">
        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-4 d-flex justify-content-center px-md-5 mx-md-3 mb-3 mb-md-5">
            @foreach ($kandidats as $kandidat) 
                <div class="col">
                    <div class="kotak-profil bg-white overflow-hidden" >
                        <div class="candidate_thumb">
                            @if ($kandidat->foto)
                                <img src="{{ asset('storage/'. $kandidat->foto) }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                            @else
                                <img src="{{ asset('storage/foto-kandidat/defaultKandidat.jpg') }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                            @endif
                            <div class="thumbnail-foto-kandidat px-3">
                                <h5 class="text-primary">
                                    {{ $kandidat->nomor }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 pt-1 pb-3">
                            <h6 class="card-title text-end mb-4">{{ $kandidat->nama }}</h6>
                            <div class="lihat-detail px-3 mb-2"> 
                                <div class="pb-1">
                                    <b class="text-primary">
                                        @if ($cekPerolehan)
                                            {{ $kandidat->jumlah_suara }}
                                        @else
                                            0
                                        @endif
                                    </b>
                                    Suara
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-center px-md-5 mx-md-5 mb-3 mb-md-5">
            <h4 class="text-center mb-3">Grafik Perolehan Suara</h4>
            <div class="col-md-8 rounded-3 bg-white p-4">
                <div id="perolehan_suara"></div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        Highcharts.chart('perolehan_suara', {
            chart: {
                type: 'column'
            },
            accessibility: {
                enabled: false
            },
            title: {
                text: ''
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