@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert" >
                        Data voting akan muncul ketika waktu pemilihan umum telah selesai atau semua pemilih sudah melakukan voting.
                    </div>
                    <form action="/dashboard/voting" class="needs-validation">
                        <div class="form-row">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <label for="kandidat">Kandidat</label>
                                <select class="form-control" name="kandidat" id="kandidat">
                                    <option value="" {{ request('kandidat') == "" ? "selected" : "" }}>Semua kandidat</option>
                                    @foreach ($kandidats as $kandidat)
                                        <option value="{{ $kandidat->nama }}" {{ request('kandidat') == $kandidat->nama ? "selected" : "" }}>{{ $kandidat->nomor }} - {{ $kandidat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row d-flex justify-content-between mb-3 mx-0">
                        <div class="tombol">
                            <a href="/dashboard/voting/print?kandidat={{ request('kandidat') }}" target="_blank" class="btn btn-primary mb-2 mb-md-0">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Print Data Voting</span>
                            </a>
                            <a href="/dashboard/voting/printSuratSuara" target="_blank" class="btn btn-success">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Print Semua Surat Suara</span>
                            </a>
                        </div>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/voting">
                                    <input class="form-control" type="text" name="search" id="search" value="{{  request('search') }}">
                                </form>
                            </li>
                        </ul>
                    </div>
                    @if (request('kandidat'))  
                        <div class="table-scrollable table-scrollable-borderless"> 
                            <table class="table table-hover table-light"> 
                                <tbody> 
                                    <tr> 
                                        <td width="20%">Kandidat</td> 
                                        <td width="1%">:</td> 
                                        <td>
                                            @if (request('kandidat'))
                                                {{ request('kandidat') }}
                                            @else
                                                Semua kandidat
                                            @endif
                                        </td> 
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">PEMILIH</th>
                                    <th scope="col">KANDIDAT</th>
                                    <th scope="col">WAKTU VOTING</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($votings))
                                    @foreach ($votings as $index => $voting)
                                        <tr>
                                            <td>{{ $index + $votings->firstItem() }}</td>
                                            <td>{{ $voting->pemilih->nama }}</td>
                                            <td>{{ $voting->kandidat->nomor }} - {{ $voting->kandidat->nama }}</td>
                                            <td>{{ $voting->created_at }}</td>
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
                            Showing {{ $votings->firstItem() }} to {{ $votings->lastItem() }} of {{$votings->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $votings->onEachSide(0)->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection