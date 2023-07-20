<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Pemilu;
use App\Models\Voting;
use App\Models\Pemilih;
use App\Models\Kandidat;
use Illuminate\Http\Request;

class DashboardVotingController extends Controller
{
    public function index()
    {
        return view('dashboard.voting.index', [
            'title' => 'Data Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'votings' => $this->cekAkhirPemilu() ? Voting::latest()->filter(request(['search', 'kandidat']))->paginate(10)->withQueryString() : [],
            'cekAkhirPemilu' => $this->cekAkhirPemilu()
        ]);
    }

    public function ulangVoting()
    {
        Kandidat::where('jumlah_suara', '>', 0)->update(['jumlah_suara' => 0]);
        Voting::query()->delete();

        return redirect('/dashboard/voting')->with('success', 'Data voting berhasil dihapus!');
    }

    public function rekapitulasi()
    {
        return view('dashboard.rekapitulasi.index', [
            'title' => 'Rekapitulasi',
            'kandidats' => $this->tambahKeterangan(),
            'cekAkhirPemilu' => $this->cekAkhirPemilu()
        ]);
    }

    public function cekAkhirPemilu()
    {
        $pemilihs = Pemilih::get();
        $votings = Voting::get();
        $pemilu = Pemilu::first();
        $now = Carbon::now();
        $cekpemilu = $now->isAfter($pemilu->selesai) || count($pemilihs) - count($votings) == 0;

        return $cekpemilu;
    }

    public function tambahKeterangan()
    {
        $kandidats = $this->cekAkhirPemilu() ? Kandidat::orderBy('jumlah_suara', 'DESC')->filter(request(['rekapitulasi']))->paginate(10)->withQueryString() : [];
        $keterangan = ['Ketua', 'Wakil Ketua', 'Sekretaris'];
        if ($kandidats) {
            $i = 0;
            foreach ($kandidats as $data) {

                if ($i >= 3) {
                    $data->setAttribute('keterangan', '-');
                } else {
                    $data->setAttribute('keterangan', $keterangan[$i]);
                }
                $i++;
            }
        }
        return $kandidats;
    }

    public function cetakPdf()
    {
        return view('dashboard.voting.print', [
            'title' => 'Cetak Data Voting',
            'votings' => $this->cekAkhirPemilu() ? Voting::latest()->filter(request(['kandidat']))->get() : []
        ]);
    }

    public function cetakPdfSuratSuara()
    {
        return view('dashboard.voting.printSuratSuara', [
            'title' => 'Cetak Data Voting',
            'votings' => $this->cekAkhirPemilu() ? Voting::latest()->get() : []
        ]);
    }

    public function cetakPdfRekapitulasi()
    {
        return view('dashboard.rekapitulasi.print', [
            'title' => 'Cetak Rekapitulasi Voting',
            'kandidats' => $this->tambahKeterangan()
        ]);
    }
}
