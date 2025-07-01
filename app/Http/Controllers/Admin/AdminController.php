<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\KIP;
use App\Models\Laporan;
use App\Models\Olympic;
use App\Models\Pages;
use App\Models\Permohonan;
use App\Models\Posts;
use App\Models\SubPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class AdminController extends Controller
{
    public function index()
    {
        $post = Posts::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $laporan = Laporan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $permohonan = Permohonan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $posts = Posts::where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')->limit(5)->get();
        $lap = Laporan::where('jawaban', '!=', NULL)->where('created_at', 'LIKE' . date('Y-m') . '%')->limit(5)->get();
        $kips = KIP::orderByDesc('click')->limit(5)->get();
        $recents = DB::table('recent_activity')
            ->where('recent_activity.created_at', 'LIKE', date('Y-m-d') . '%')
            ->where('recent_activity.user_id', '=', Auth::user()->id)
            ->orderBy('recent_activity.created_at', 'DESC')
            ->limit(7)
            ->get();
        $analyticsData = Analytics::get(
            Period::days(7),
            ['totalUsers'],
            ['date']
        );

        $actions = [
            'Memberi pelayanan terbaik untuk masyarakat dengan hati yang tulus ❤️',
            'Menjaga integritas meskipun tidak ada yang melihat 🛡️',
            'Satu senyum hari ini bisa meredakan amarah warga 😊',
            'Menyelesaikan pekerjaan hari ini dengan tuntas dan tanggung jawab ✔️',
            'Datang ke kantor bukan hanya menggugurkan kewajiban, tapi menjalankan amanah 📜',
            'Membantu rekan kerja agar pekerjaan lebih ringan 🤝',
            'Hari ini bisa menjadi momen perubahan — mulai dari dirimu sendiri 🔁',
            'Menjadi teladan etika dan disiplin, bukan hanya karena peraturan, tapi karena prinsip ✊',
            'Menghadapi birokrasi dengan kesabaran dan solusi, bukan keluhan ⚙️',
            'Bekerja bukan hanya untuk gaji, tapi untuk memberi arti 💼',
            'Berdoa sebelum bekerja agar semua dimudahkan 🙏',
            'Setiap dokumen yang ditandatangani adalah bentuk tanggung jawab dunia dan akhirat 📄',
            'Menjaga kesehatan agar bisa terus melayani masyarakat dengan maksimal 🏃‍♂️',
            'Meluangkan waktu untuk mengecek kembali — detail kecil bisa berdampak besar 🔍',
            'Menjaga tutur kata, karena setiap kata ASN mencerminkan negara 🗣️',
            'Satu keputusanmu hari ini, bisa memengaruhi hidup banyak orang 🎯',
            'ASN sejati melayani bukan karena disuruh, tapi karena peduli 🤲',
            'Jadilah ASN yang dikenang karena kebaikan dan ketegasannya, bukan karena jabatannya 🏛️',
            'Menyempatkan waktu untuk keluarga meskipun sedang sibuk 👨‍👩‍👧‍👦',
            'Ingatlah, kerja kerasmu hari ini adalah investasi untuk masa depanmu dan orang lain ⏳',
            'Pekerjaan boleh padat, tapi jangan lupa makan dan minum 💧🍽️',
            'Hidup ini bukan hanya tentang bekerja, tapi juga mencintai dan dicintai ❤️',
            'Tersenyum kepada orang lain bisa menjadi ladang pahala dan energi positif 😄',
            'Jangan biarkan masalah kantor merusak ketenangan rumah tangga 🏠',
            'Satu waktu tenang dengan anak lebih berharga dari 100 rapat 🧒👨‍👩‍👦',
            'Tidak semua harus sempurna — tapi niat baik dan proses yang jujur akan selalu dihargai 🙌',
            'Luangkan waktu 10 menit untuk refleksi: sudahkah aku melayani dengan benar hari ini? 🕊️',
            'Rezeki bukan hanya uang, tapi juga waktu luang, kesehatan, dan keikhlasan 🍃',
            'Jangan hanya bangga dengan jabatan — banggalah ketika masyarakat merasa terbantu ✨',
            'Hari ini adalah kesempatan untuk memperbaiki kesalahan kemarin 🔄',
            'Fokus pada solusi, bukan menyalahkan 🌟',
            'Ambil keputusan dengan hati-hati — karena ASN adalah bagian dari wajah negara 🪪',
            'Tidak semua hal bisa diubah hari ini, tapi niat yang benar bisa dimulai sekarang 🛤️',
            'Jangan korbankan nilai-nilai hanya untuk kenyamanan sementara 🧭',
            'Berbuat baik hari ini, meski kecil, tetap lebih baik daripada tidak sama sekali 🌱',
            'ASN bukan hanya status — tapi dedikasi untuk melayani bangsa 🇮🇩',
            'Luangkan waktu untuk berolahraga ringan agar tetap fokus 💪',
            'Tugas negara jangan membuat lupa waktu untuk beribadah 🕌',
            'Kesuksesan ASN bukan hanya naik pangkat, tapi juga naik kualitas hidup 📈',
            'Jangan menunda pekerjaan yang bisa diselesaikan hari ini 🗂️',
            'Hidup akan lebih ringan jika bekerja dengan ikhlas dan berprasangka baik 🤍',
            'Kadang yang dibutuhkan masyarakat bukan birokrasi, tapi empati 🙋‍♂️',
        ];

        $randomAction = $actions[array_rand($actions)];

        return view('admin.beranda.beranda', compact('post', 'laporan', 'permohonan', 'posts', 'lap', 'recents', 'kips', 'randomAction', 'analyticsData'));
    }

    public function olympic(Request $request)
    {
        // Ambil semua bidang dari koneksi SIMPEG
        $bidangs = Bidang::on('simpeg')->get();

        // Tahun yang aktif (terbaru atau dari query string)
        $year = $request->query('tahun') ?? Olympic::orderByDesc('tahun')->first()?->tahun;

        // Keterangan season (misalnya "Olimpiade")
        $season = Olympic::where('tahun', $year)->first()?->keterangan ?? 'Olimpiade';

        // Ambil nama database dari koneksi SIMPEG
        $dbSimpeg = DB::connection('simpeg')->getDatabaseName();

        // Ambil data olympic untuk tahun tertentu, join dengan tabel `bidang` di koneksi simpeg
        $olympics = Olympic::join("$dbSimpeg.bidang", 'olympic.bidang_id', '=', "$dbSimpeg.bidang.id")
            ->where('olympic.tahun', $year)
            ->orderByDesc('emas')       // Urutan 1: Emas terbanyak
            ->orderByDesc('perak')      // Urutan 2: Perak
            ->orderByDesc('perunggu')   // Urutan 3: Perunggu
            ->orderByDesc('total')      // Opsional: jika ingin bandingkan jumlah total juga
            ->select("$dbSimpeg.bidang.nama_bidang", 'olympic.*')
            ->get();

        // Ambil tahun sebelumnya untuk perbandingan
        $previousYear = $year ? $year - 1 : now()->year - 1;

        // Ambil 3 besar pemenang tahun sebelumnya
        $before_winners = Olympic::where('tahun', $previousYear)
            ->orderByDesc('emas')
            ->orderByDesc('perak')
            ->orderByDesc('perunggu')
            ->orderByDesc('total')
            ->take(3)
            ->get()
            ->map(function ($item, $index) {
                $item->ranking = $index + 1;
                return $item;
            });

        // Daftar tahun yang tersedia
        $years = Olympic::select('tahun')
            ->groupBy('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.Tools.olympic.index', compact(
            'bidangs',
            'olympics',
            'years',
            'year',
            'before_winners',
            'season'
        ));
    }

    public function create_periode(Request $request)
    {
        $tahun = now()->year;

        // Cek apakah sudah ada data Olympic untuk tahun ini
        $exists = Olympic::where('tahun', $tahun)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Periode untuk tahun ini sudah ada!');
        }

        $bidangs = Bidang::selectRaw('MIN(id) as id, nama_bidang')
            ->whereNotIn('nama_bidang', ['Pimpinan', 'Lainnya'])
            ->groupBy('nama_bidang')
            ->get();

        foreach ($bidangs as $bidang) {
            $olympic = new Olympic();
            $olympic->bidang_id = $bidang->id;
            $olympic->emas = 0;
            $olympic->perak = 0;
            $olympic->perunggu = 0;
            $olympic->total = 0;
            $olympic->tahun = $tahun;
            $olympic->keterangan = $request->name;
            $olympic->save();
        }

        _recentAdd($olympic->id, ' Membuat periode baru untuk Olimpiade', 'olympic');

        return redirect()->back()->with('success', 'Periode berhasil dibuat!');
    }

    public function store(Request $request)
    {
        $olympic = Olympic::findOrFail($request->id);
        $field = $request->field;
        $value = (int) $request->value;

        // Validasi field yang diizinkan
        if (!in_array($field, ['emas', 'perak', 'perunggu'])) {
            return response()->json(['error' => 'Invalid field'], 400);
        }

        $olympic->$field = $value;
        $olympic->total = $olympic->emas + $olympic->perak + $olympic->perunggu;
        $olympic->save();

        return response()->json(['success' => true, 'total' => $olympic->total]);
    }

    public function update(Request $request, $id)
    {
        $olympic = Olympic::findOrFail($id);

        $emas = $request->emas;
        $perak = $request->perak;
        $perunggu = $request->perunggu;
        $total = $emas + $perak + $perunggu;

        $olympic->update([
            'emas' => $emas,
            'perak' => $perak,
            'perunggu' => $perunggu,
            'total' => $total
        ]);

        return redirect()->route('olympic-admin.index')->with(['success' => 'Data berhasil diupdate!']);
    }

    public function checkSlugPage(Request $request)
    {
        $slug = Str::slug($request->input('slug'));
        $originalSlug = $slug;
        $counter = 1;

        while (Pages::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return response()->json(['slug' => $slug]);
    }

    public function checkSlugSubPage(Request $request)
    {
        $slug = Str::slug($request->input('slug'));
        $originalSlug = $slug;
        $counter = 1;

        while (SubPages::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return response()->json(['slug' => $slug]);
    }
}
