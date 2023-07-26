<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Voting;
use App\Models\Laporan;
use App\Models\Pemilih;
use App\Models\Kandidat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardVotingController extends Controller
{
    public function index()
    {
        return view('dashboard.voting.index', [
            'title' => 'Data Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'votings' => $this->cekAkhirPemilu() ? Voting::latest()->filter(request(['search', 'kandidat']))->paginate(10)->withQueryString() : [],
            'cekAkhirPemilu' => $this->cekAkhirPemilu(),
            'laporan' => Laporan::first()
        ]);
    }

    public function ulangVoting()
    {
        Kandidat::where('jumlah_suara', '>', 0)->update(['jumlah_suara' => 0]);
        Voting::query()->delete();
        Laporan::query()->delete();

        return redirect('/dashboard/voting')->with('success', 'Data voting berhasil dihapus!');
    }

    public function hasilPemilu()
    {
        return view('dashboard.hasil_pemilu.index', [
            'title' => 'Hasil Pemilu',
            'kandidats' => $this->tambahKeterangan(),
            'cekAkhirPemilu' => $this->cekAkhirPemilu(),
            'laporan' => Laporan::first()
        ]);
    }

    public function cekAkhirPemilu()
    {
        $pemilihs = Pemilih::get();
        $votings = Voting::get();
        $pemilu = Pemilu::first();
        $now = Carbon::now();
        $cekpemilu = false;
        if ($pemilu) {
            $cekpemilu = $now->isAfter($pemilu->selesai) || count($pemilihs) - count($votings) == 0;
        }

        return $cekpemilu;
    }

    public function tambahKeterangan()
    {
        $kandidats = $this->cekAkhirPemilu() ? Kandidat::orderBy('jumlah_suara', 'DESC')->paginate(10)->withQueryString() : [];
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

    public function cetakDataVoting(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);
        $passwordFile = $request->password;
        $kandidat = $request->kandidat;

        $waktu = Voting::oldest()->first();
        $pemilih = Pemilih::get();
        $voting = Voting::get();
        $laporan = Laporan::first();

        $pdf = Pdf::loadView('dashboard.voting.print', [
            'title' => 'Cetak Data Voting',
            'votings' => $this->cekAkhirPemilu() ? ($kandidat ? Voting::latest()->filter(['kandidat' => $kandidat])->get() : Voting::latest()->get()) : [],
            'tahunSekarang' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->year : 'XXXX',
            'tahunDepan' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->addYear()->year : 'XXXX',
            'jumlahPemilih' => count($pemilih),
            'jumlahKandidat' => count(Kandidat::get()),
            'jumlahSudahMemilih' => count($voting),
            'jumlahTidakMemilih' => count($pemilih) - count($voting),
            'filterKandidat' => $kandidat,
            'qrCode' => $laporan ? base64_encode($laporan->qr_code) : ''
        ])->setPaper('A4', 'potrait');
        $pdf->setEncryption($passwordFile, '', ['print']);
        return $pdf->stream('Cetak-Data-Voting.pdf');
    }

    public function cetakPdfSuratSuara()
    {
        $pdf = Pdf::loadView('dashboard.voting.printSuratSuara', [
            'title' => 'Cetak Surat Suara',
            'votings' => $this->cekAkhirPemilu() ? Voting::latest()->get() : [],
            'tahunSekarang' => Carbon::now()->format('Y'),
            'tahunDepan' => Carbon::now()->addYear()->format('Y')
        ])->setPaper('A4', 'potrait');
        return $pdf->stream('Cetak-Surat-Suara.pdf');
    }

    public function cetakPdfHasilPemilu(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);
        $passwordFile = $request->password;

        $waktu = Voting::oldest()->first();
        $pemilih = Pemilih::get();
        $voting = Voting::get();
        $laporan = Laporan::first();

        $pdf = Pdf::loadView('dashboard.hasil_pemilu.print', [
            'title' => 'Cetak Hasil Pemilu',
            'kandidats' => $this->tambahKeterangan(),
            'tahunSekarang' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->year : 'XXXX',
            'tahunDepan' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->addYear()->year : 'XXXX',
            'jumlahPemilih' => count($pemilih),
            'jumlahKandidat' => count(Kandidat::get()),
            'jumlahSudahMemilih' => count($voting),
            'jumlahTidakMemilih' => count($pemilih) - count($voting),
            'waktuSekarang' => $waktu ? Carbon::parse($waktu->created_at)->isoFormat('D MMMM Y') : 'XXXX',
            'pihak' => $laporan,
            'qrCode' => $laporan ? base64_encode($laporan->qr_code) : ''
        ])->setPaper('A4', 'potrait');
        $pdf->setEncryption($passwordFile, '', ['print']);
        return $pdf->stream('Cetak-Data-Voting.pdf');
    }
}
