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
            'cekAkhirPemilu' => $this->cekAkhirPemilu()
        ]);
    }

    public function ulangVoting()
    {
        Kandidat::where('jumlah_suara', '>', 0)->update(['jumlah_suara' => 0]);
        Voting::query()->delete();
        Laporan::query()->delete();

        return redirect('/dashboard/voting')->with('success', 'Data voting berhasil dihapus!');
    }

    public function rekapitulasi()
    {
        return view('dashboard.rekapitulasi.index', [
            'title' => 'Rekapitulasi',
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
        $waktu = Voting::oldest()->first();
        $pemilih = Pemilih::get();
        $voting = Voting::get();

        $pdf = Pdf::loadView('dashboard.voting.print', [
            'title' => 'Cetak Data Voting',
            'votings' => $this->cekAkhirPemilu() ? Voting::latest()->filter(request(['kandidat']))->get() : [],
            'tahunSekarang' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->year : 'XXXX',
            'tahunDepan' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->addYear()->year : 'XXXX',
            'jumlahPemilih' => count($pemilih),
            'jumlahKandidat' => count(Kandidat::get()),
            'jumlahSudahMemilih' => count($voting),
            'jumlahTidakMemilih' => count($pemilih) - count($voting)
        ])->setPaper('A4', 'potrait');
        return $pdf->stream('Cetak-Data-Voting.pdf');

        // return view('dashboard.voting.print', [
        //     'title' => 'Cetak Data Voting',
        //     'votings' => $this->cekAkhirPemilu() ? Voting::orderBy('kandidat_id', 'ASC')->filter(request(['kandidat']))->get() : [],
        //     'tahunSekarang' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->year : 'XXXX',
        //     'tahunDepan' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->addYear()->year : 'XXXX',
        //     'jumlahPemilih' => count($pemilih),
        //     'jumlahKandidat' => count(Kandidat::get()),
        //     'jumlahSudahMemilih' => count($voting),
        //     'jumlahTidakMemilih' => count($pemilih) - count($voting)
        // ]);
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

    public function cetakPdfRekapitulasi()
    {
        $waktu = Voting::oldest()->first();
        $pemilih = Pemilih::get();
        $voting = Voting::get();
        $laporan = Laporan::first();

        $pdf = Pdf::loadView('dashboard.rekapitulasi.print', [
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
        return $pdf->stream('Cetak-Data-Voting.pdf');

        // return view('dashboard.rekapitulasi.print', [
        //     'title' => 'Cetak Hasil Pemilu',
        //     'kandidats' => $this->tambahKeterangan(),
        //     'tahunSekarang' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->year : 'XXXX',
        //     'tahunDepan' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->created_at)->addYear()->year : 'XXXX',
        //     'jumlahPemilih' => count($pemilih),
        //     'jumlahKandidat' => count(Kandidat::get()),
        //     'jumlahSudahMemilih' => count($voting),
        //     'jumlahTidakMemilih' => count($pemilih) - count($voting),
        //     'waktuSekarang' =>  $waktu ? Carbon::parse($waktu->created_at)->isoFormat('D MMMM Y') : 'XXXX',
        //     'pihak' => $laporan,
        //     'qrCode' => $laporan ? base64_encode($laporan->qr_code) : ''
        // ]);
    }

    public function laporan()
    {
        $laporan = Laporan::get();
        if (count($laporan) > 0) {
            abort(403);
        }
        return view('dashboard.rekapitulasi.laporan', [
            'title' => 'Data Laporan'
        ]);
    }

    public function validasiLaporan(Request $request)
    {
        $validateData = $request->validate([
            'ketua' => 'required',
            'sekretaris' => 'required',
            'kesiswaan' => 'required',
            'pembina' => 'required',
            'kepala_sekolah' => 'required',
        ]);
        $validateData['id'] = 1;
        $validateData['kode'] = Str::random(100);
        $validateData['qr_code'] = QrCode::size(300)->errorCorrection('M')->generate($validateData['kode']);


        Laporan::create($validateData);
        return redirect('/dashboard/rekapitulasi')->with('success', 'Data Laporan berhasil ditambahkan!');
    }
}
