@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="row d-flex justify-content-between mb-3">
                        <a href="/dashboard/voting/print" class="btn btn-primary">
                            <i class="fa-solid fa-print"></i>
                            <span class="ml-1">Print</span>
                        </a>
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
                                            <td>{{ $voting->pemilih->nisn }} - {{ $voting->pemilih->nama }}</td>
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
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Showing {{ $votings->firstItem() }} to {{ $votings->lastItem() }} of {{$votings->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $votings->onEachSide(0)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection