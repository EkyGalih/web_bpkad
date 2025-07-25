<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\Laporan;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Api;

class LaporanPermohonanMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.faq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $token
     * @return \Illuminate\Http\Response
     */
    public function show(Request $token)
    {
        $status = Permohonan::where('kode_pemohon', '=', $token->code)
            ->orWhere('email', '=', $token->code)
            ->select('status')
            ->first();

        if ($status->status == 'proses') {
            return redirect()->back()->with(['warning_ext_req' => 'status permohonan anda sedang dalam proses, hubungi admin jika permohonan anda belum selesai']);
        } else {
            return redirect()->back()->with(['success_req' => 'status permohonan anda sudah selesai']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');

        if ($request->jenis == 'permohonan') {
            $code       = 'req-' . uniqid();

            // validasi data
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email',
                'telepon' => 'required|numeric|min:12',
                'alamat' => 'required',
                'ktp' => 'required',
                'informasi_diminta' => 'required',
                'tujuan_informasi' => 'required',
                'pekerjaan' => 'required',
                'asal_instansi' => 'required'
            ]);

            $ktp = $request->file('ktp');
            $filename = md5($ktp->getClientOriginalName()) . '.' . $ktp->getClientOriginalExtension();

            if (in_array($ktp->getClientOriginalExtension(), $ext)) {
                if ($ktp->getSize() <= 5000000) {
                    $path = $ktp->storeAs('uploads/permohonan', $filename, 's3');
                    $request->ktp = $path;
                } else {
                    return redirect()->back()->with(['warning_size' => 'Ukuran file KTP melebihi 5MB!']);
                }
            } else {
                return redirect()->back()->with(['warning_ext' => 'Ektensi File KTP harus format JPG, JPEG atau PNG!']);
            }

            Permohonan::create([
                'kode_pemohon' => $code,
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'ktp' => $request->ktp,
                'informasi_diminta' => $request->informasi_diminta,
                'tujuan_informasi' => $request->tujuan_informasi,
                'pekerjaan' => $request->pekerjaan,
                'asal_instansi' => $request->asal_instansi
            ]);

            $title = 'Permohonan!'; // ini untuk title email
            $telegram   = new Api(env('TELEGRAM_BOT_TOKEN'));
            $chatID     = env('TELEGRAM_CHAT_ID');
            $text       = 'Peromohonan Masuk dari ' . $request->nama . ' dengan nomor permohonan ' . $code . ', memohonkan informasi ' . $request->informasi_diminta . ' untuk kebutuhan ' . $request->tujuan_informasi;

            $telegram->sendMessage([
                'chat_id' => $chatID,
                'text' => $text
            ]);

            Mail::to('prog.bpkad.ntb@gmail.com')->send(new SendEmail($title, $text));

            return redirect()->back()->with(['success_req' => 'Permohonan dengan kode "' . $code . '" terkirim harap catat kode permohonan untuk pengecekkan status permohonan'], 'Pshow', 'Pactive', 'Lshow', 'Lactive');
        } elseif ($request->jenis == 'pelaporan') {
            $code       = 'lap-' . uniqid();

            $request->validate([
                'nama_pelapor' => 'required',
                'kode_laporan' => 'Lap-' . bin2hex(random_bytes(5)),
                'judul_laporan' => 'required|max:100',
                'no_pelapor' => 'required|numeric|min:12',
                'isi_laporan' => 'required|max:500',
                'lokasi_kejadian' => 'required',
                'kategori_laporan' => 'required',
                'berkas' => 'required'
            ]);

            $file       = $request->file('berkas');
            $filename   = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

            if (in_array($file->getClientOriginalExtension(), $ext)) {
                if ($file->getSize() <= 5000000) {
                    $path = $file->storeAs('uploads/laporan', $filename, 's3');
                    $request->berkas = $path;
                } else {
                    return redirect()->back()->with(['warning_lap_size' => 'Ukuran file melebihi 5MB'], 'Pshow', 'Pactive', 'Lshow', 'Lactive');
                }
            } else {
                return redirect()->back()->with(['warning_lap_ext' => 'Ektensi File harus format JPG, JPEG atau PNG'], 'Pshow', 'Pactive', 'Lshow', 'Lactive');
            }

            Laporan::create([
                'nama_pelapor' => $request->nama_pelapor,
                'kode_laporan' => $code,
                'judul_laporan' => $request->judul_laporan,
                'tgl_laporan' => date('Y-m-d h:i:s'),
                'no_pelapor' => $request->no_pelapor,
                'isi_laporan' => $request->isi_laporan,
                'lokasi_kejadian' => $request->lokasi_kejadian,
                'kategori_laporan' => $request->kategori_laporan,
                'berkas' => $request->berkas
            ]);

            $title = 'Pengaduan!'; // ini untuk title email
            $telegram   = new Api(env('TELEGRAM_BOT_TOKEN'));
            $chatID     = env('TELEGRAM_CHAT_ID');
            $text       = 'Pengaduan Masuk dari ' . $request->nama_pelapor . ' dengan nomor laporan ' . $code . ', melaporkan ' . $request->judul_laporan . ', berlokasi ' . $request->lokasi_kejadian;

            $telegram->sendMessage([
                'chat_id' => $chatID,
                'text' => $text
            ]);

            Mail::to('prog.bpkad.ntb@gmail.com')->send(new SendEmail($title, $text));

            return redirect()->back()->with(['lap_success' => 'Laporan sudah diterima!'], 'Pshow', 'Pactive', 'Lshow', 'Lactive');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $laporan    = Laporan::findOrFail($id);
        $berkas     = $request->file('berkas_jawaban');

        if ($berkas != null) {
            $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG', 'pdf', 'xls', 'xlsx');
            $filename   = md5($berkas->getClientOriginalName()) . '.' . $berkas->getClientOriginalExtension();

            if (in_array($berkas->getClientOriginalExtension(), $ext)) {
                if ($berkas->getSize() <= 5000000) {
                    if ($laporan->berkas_jawaban == null) {
                        $berkas->move('uploads/laporan/jawaban/', $filename);
                        $request->berkas_jawaban = 'uploads/laporan/jawaban/' . $filename;
                    } else {
                        unlink($laporan->berkas_jawaban);
                        $berkas->move('uploads/laporan/jawaban/', $filename);
                        $request->berkas_jawaban = 'uploads/laporan/jawaban/' . $filename;
                    }
                    $laporan->update([
                        'jawaban' => $request->jawaban,
                        'berkas_jawaban' => $request->berkas_jawaban,
                        'jawaban_dari' => 'langsung'
                    ]);

                    return redirect()->back()->with(['success' => 'Jawaban sudah dikirim!']);
                } else {
                    return redirect()->back()->with(['warning_size' => 'Ukuran file melebihi 5MB']);
                }
            } else {
                return redirect()->back()->with(['warning_ext' => 'Ektensi File harus format JPG, JPEG, PNG, PDF, XLS, atau XLSX']);
            }
        } else {

            $laporan->update([
                'jawaban' => $request->jawaban,
                'berkas_jawaban' => $request->berkas_jawaban,
                'jawaban_dari' => 'langsung'
            ]);

            return redirect()->back()->with(['success' => 'Jawaban sudah dikirim!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->berkas != null ? unlink($laporan->berkas) : '';
        $laporan->berkas_jawaban != null ? unlink($laporan->berkas_jawaban) : '';
        $laporan->delete();

        return redirect()->back()->with(['success' => 'Laporan dihapus!']);
    }
}
