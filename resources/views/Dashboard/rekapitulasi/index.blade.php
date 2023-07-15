@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert" >
                        Data rekapitulasi akan muncul ketika waktu pemilihan umum telah selesai atau semua pemilih sudah melakukan voting.
                    </div>
                    <div class="row d-flex justify-content-between mb-3 mx-0">
                        <a href="/dashboard/rekapitulasi/print?kandidat={{ request('kandidat') }}" target="_blank" class="btn btn-primary">
                            <i class="fa-solid fa-print"></i>
                            <span class="ml-1">Print</span>
                        </a>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/rekapitulasi" class="input-search">
                                    <input class="form-control" type="text" name="search" id="search" value="{{  request('search') }}">
                                    <a class="delete-input-search btn btn-transparent" id="hapus_value">
                                        <i class="fa-solid fa-xmark" style="color: #a0a0a0;"></i>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">KANDIDAT</th>
                                    <th scope="col">JUMLAH SUARA</th>
                                    <th scope="col">KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($kandidats) > 0)
                                    @foreach ($kandidats as $index => $kandidat)
                                        <tr>
                                            <td>{{ $index + $kandidats->firstItem() }}</td>
                                            <td>{{ $kandidat->nomor}} - {{ $kandidat->nama }}</td>
                                            <td>{{ $kandidat->jumlah_suara }}</td>
                                            <td>{{ $kandidat->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($cekAkhirPemilu)
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Showing {{ $kandidats->firstItem() }} to {{ $kandidats->lastItem() }} of {{$kandidats->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $kandidats->onEachSide(0)->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script>
        $("#hapus_value").on('click', function(event) {
            event.preventDefault();
            $('#search').attr('value', '');
            $("#search").focus();
        });
    </script>
@endpush