<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Laporan;
use App\Models\Kandidat;
use App\Models\SuratSuara;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DashboardVotingController extends Controller
{
    public function index()
    {
        return view('dashboard.voting.index', [
            'title' => 'Data Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'votings' => $this->cekAkhirPemilu() ? SuratSuara::whereNotNull('kode')->orderBy('waktu', 'DESC')->filter(request(['search', 'kandidat']))->paginate(10)->withQueryString() : [],
            'cekAkhirPemilu' => $this->cekAkhirPemilu(),
            'laporan' => Laporan::whereNotNull('kode')->first()
        ]);
    }

    public function ulangVoting()
    {
        $kandidats = Kandidat::get();
        if ($kandidats) {
            foreach ($kandidats as $kandidat) {
                if ($kandidat->foto) {
                    Storage::delete($kandidat->foto);
                }
            }
        }
        Kandidat::query()->delete();
        SuratSuara::query()->delete();
        $laporan = Laporan::where('id', 1)->first();
        $laporan->update([
            'user_id' => 0,
            'surat_suara_id' => 0,
            'ketua' => null,
            'sekretaris' => null,
            'kesiswaan' => null,
            'pembina' => null,
            'kepala_sekolah' => null,
            'jumlah_kandidat' => 0,
            'jumlah_sudah_memilih' => 0,
            'jumlah_belum_memilih' => $laporan->jumlah_pemilih,
            'kode' => null,
            'qr_code' => null
        ]);
        Pemilu::query()->delete();

        return redirect('/dashboard/voting')->with('success', 'Data voting berhasil dihapus!');
    }

    public function hasilPemilu()
    {
        $kandidat = $this->cekAkhirPemilu() ? Kandidat::get()->sortByDesc(function ($query) {
            return $query->suratSuara;
        })->all() : [];

        return view('dashboard.hasil_pemilu.index', [
            'title' => 'Hasil Pemilu',
            'kandidats' => $kandidat,
            'cekAkhirPemilu' => $this->cekAkhirPemilu(),
            'cekLaporan' => Laporan::whereNotNull('kode')->first(),
            'laporan' => Laporan::first(),
            'keterangan' => ['Ketua', 'Wakil Ketua', 'Sekretaris']
        ]);
    }

    public function cekAkhirPemilu()
    {
        $pemilu = Pemilu::first();
        $laporan = Laporan::first();
        $now = Carbon::now();
        $cekpemilu = false;
        if ($pemilu) {
            $cekpemilu = $now->isAfter($pemilu->selesai) || $laporan->jumlah_belum_memilih == 0;
        }
        return $cekpemilu;
    }

    public function cetakDataVoting(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);
        $passwordFile = $request->password;
        $kandidat = $request->filter_kandidat;

        $periode = SuratSuara::whereNotNull('kode')->orderBy('waktu', 'ASC')->first();
        $laporan = Laporan::first();

        $pdf = Pdf::loadView('dashboard.voting.print', [
            'title' => 'Cetak Data Voting',
            'votings' => $this->cekAkhirPemilu() ? ($kandidat ? SuratSuara::whereNotNull('kode')->orderBy('waktu', 'DESC')->filter(['kandidat' => $kandidat])->get() : SuratSuara::whereNotNull('kode')->orderBy('waktu', 'DESC')->get()) : [],
            'tahunSekarang' => $periode ? Carbon::createFromFormat('Y-m-d H:i:s', $periode->waktu)->year : 'XXXX',
            'tahunDepan' => $periode ? Carbon::createFromFormat('Y-m-d H:i:s', $periode->waktu)->addYear()->year : 'XXXX',
            'laporan' => $laporan,
            'filterKandidat' => $kandidat,
            'qrCode' => $laporan ? base64_encode($laporan->qr_code) : ''
        ])->setPaper('A4', 'potrait');
        $pdf->setEncryption($passwordFile, '', ['print']);
        return $pdf->stream('Cetak-Data-Voting.pdf');
    }

    public function cetakPdfSuratSuara()
    {
        $periode = SuratSuara::whereNotNull('kode')->orderBy('waktu', 'ASC')->first();
        $pdf = Pdf::loadView('dashboard.voting.printSuratSuara', [
            'title' => 'Cetak Surat Suara',
            'votings' => $this->cekAkhirPemilu() ? SuratSuara::whereNotNull('kode')->orderBy('waktu', 'DESC')->get() : [],
            'tahunSekarang' => $periode ? Carbon::createFromFormat('Y-m-d H:i:s', $periode->waktu)->year : 'XXXX',
            'tahunDepan' => $periode ? Carbon::createFromFormat('Y-m-d H:i:s', $periode->waktu)->addYear()->year : 'XXXX',
        ])->setPaper('A4', 'potrait');
        return $pdf->stream('Cetak-Surat-Suara.pdf');
    }

    public function cetakPdfHasilPemilu(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);
        $passwordFile = $request->password;


        $waktu = SuratSuara::whereNotNull('kode')->orderBy('waktu', 'ASC')->first();
        $laporan = Laporan::first();
        $pemilu = Pemilu::first();

        $hariMulaiPemilu = $pemilu ? Carbon::parse($pemilu->mulai)->isoFormat('dddd') : 'XXXX';
        $hariSelesaiPemilu = $pemilu ? Carbon::parse($pemilu->selesai)->isoFormat('dddd') : 'XXXX';

        $tanggalMulaiPemilu = $pemilu ? Carbon::parse($pemilu->mulai)->isoFormat('D MMMM Y') : 'XXXX';
        $tanggalSelesaiPemilu = $pemilu ? Carbon::parse($pemilu->selesai)->isoFormat('D MMMM Y') : 'XXXX';
        $kandidat = $this->cekAkhirPemilu() ? Kandidat::get()->sortByDesc(function ($query) {
            return $query->suratSuara;
        })->all() : [];

        $waktuMulaiPemilu = '00.00';
        if ($waktu && $pemilu) {
            if ($waktu->waktu->isBefore($pemilu->mulai)) {
                $waktuMulaiPemilu = Carbon::parse($waktu->waktu)->format('H.i');
            } else {
                $waktuMulaiPemilu = Carbon::parse($pemilu->mulai)->format('H.i');
            }
        }


        $pdf = Pdf::loadView('dashboard.hasil_pemilu.print', [
            'title' => 'Cetak Hasil Pemilu',
            'tahunSekarang' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->waktu)->year : 'XXXX',
            'tahunDepan' => $waktu ? Carbon::createFromFormat('Y-m-d H:i:s', $waktu->waktu)->addYear()->year : 'XXXX',
            'hariMulaiPemilu' => $hariMulaiPemilu,
            'hariSelesaiPemilu' => $hariMulaiPemilu != $hariSelesaiPemilu ? $hariSelesaiPemilu : '',
            'tanggalMulaiPemilu' => $tanggalMulaiPemilu,
            'tanggalSelesaiPemilu' => $tanggalMulaiPemilu != $tanggalSelesaiPemilu ? $tanggalSelesaiPemilu : '',
            'waktuMulaiPemilu' => $waktuMulaiPemilu,
            'waktuSelesaiPemilu' => $pemilu ? Carbon::parse($pemilu->selesai)->format('H.i') : '00.00',
            'waktuSekarang' => $waktu ? Carbon::now()->isoFormat('D MMMM Y') : 'XXXX',
            'kandidats' => $kandidat,
            'keterangan' => ['Ketua', 'Wakil Ketua', 'Sekretaris'],
            'laporan' => $laporan,
            'qrCode' => $laporan ? base64_encode($laporan->qr_code) : ''
        ])->setPaper('A4', 'potrait');
        $pdf->setEncryption($passwordFile, '', ['print']);
        return $pdf->stream('Cetak-Data-Voting.pdf');
    }
}
