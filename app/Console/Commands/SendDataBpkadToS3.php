<?php

namespace App\Console\Commands;

use App\Models\KIP;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SendDataBpkadToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:data-bpkad-to-s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending all data bpkad to s3';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Koneksi ke database simpeg
        // $pegawaiList = DB::connection('simpeg')->table('pegawai')->whereNotNull('foto')->get();
        // $bar = $this->output->createProgressBar(count($pegawaiList));
        // $bar->start();

        // foreach ($pegawaiList as $pegawai) {
        //     $localPath = public_path('uploads/' . $pegawai->foto);

        //     if (!file_exists($localPath)) {
        //         $this->warn("File not found: $localPath");
        //         continue;
        //     }

        //     $fileName = basename($pegawai->foto);
        //     $folder = 'uploads/pegawai';
        //     $s3Path = $folder . '/' . $fileName;

        //     // Upload ke S3
        //     $uploaded = Storage::disk('s3')->put($s3Path, file_get_contents($localPath), 'public');

        //     if ($uploaded) {
        //         $s3Url = rtrim(config('filesystems.disks.s3.url') ?? config('app.url'), '/') . '/' . $s3Path;

        //         // Update database
        //         DB::connection('simpeg')->table('pegawai')
        //             ->where('id', $pegawai->id)
        //             ->update(['foto' => $s3Url]);

        //         $this->info("Updated: {$pegawai->id} -> $s3Url");
        //     } else {
        //         $this->error("Failed to upload: $localPath");
        //     }
        //     $bar->advance();
        // }

        // $bar->finish();
        // echo " ";
        // $this->info("<fg=green>Data copied successfully</>");

        // $galeries = DB::table('galery_foto')->whereNotNull('path')->get();
        // $bar = $this->output->createProgressBar(count($galeries));
        // $bar->start();

        // foreach ($galeries as $galery) {
        //     $relativePath = ltrim($galery->path, '/'); // hapus tanda slash pertama
        //     $localPath = public_path($relativePath);

        //     if (!file_exists($localPath)) {
        //         $this->warn("File not found: $localPath");
        //         continue;
        //     }

        //     $s3Path = 'uploads/galery/foto/' . basename($relativePath);

        //     // Upload ke S3
        //     $uploaded = Storage::disk('s3')->put($s3Path, file_get_contents($localPath), 'public');

        //     if ($uploaded) {
        //         $s3Url = rtrim(config('filesystems.disks.s3.url') ?? config('app.url'), '/') . '/' . $s3Path;

        //         // Update database
        //         DB::table('galery_foto')
        //             ->where('id', $galery->id)
        //             ->update(['path' => $s3Url]);

        //         $this->info("Updated: {$galery->id} -> $s3Url");
        //     } else {
        //         $this->error("Failed to upload: $localPath");
        //     }

        //     $bar->advance();
        // }
        // $bar->finish();
        // echo " ";
        // $this->info("<fg=green>Data copied successfully</>");

        // $defaultUrl = 'https://storage.ntbprov.go.id/bpkad/uploads/defaults/no-image-post.png';

        // $posts = DB::table('posts')
        // ->where('foto_berita', 'like', '/storage/uploads/berita/%')
        // ->get();
        // $posts = DB::table('posts')->whereNotNull('foto_berita')->get();
        // $posts = DB::table('posts')
        //     ->whereNotNull('content')
        //     ->where('content', 'like', '%<img%src=%')
        //     ->get();
        // $bar = $this->output->createProgressBar(count($posts));

        // foreach ($posts as $post) {
        //     if (empty($post->foto_berita)) {
        //         $this->warn("Post ID {$post->id} tidak punya foto_berita");
        //         continue;
        //     }

        //     $content = $post->content;

        //     // Regex untuk ganti semua src dalam <img>
        //     $newContent = preg_replace(
        //         '/<img[^>]*src=["\'](.*?)["\']/i',
        //         '<img src="' . $post->foto_berita . '"',
        //         $content
        //     );

        //     if ($newContent !== $content) {
        //         DB::table('posts')->where('id', $post->id)->update(['content' => $newContent]);
        //         $this->info("Updated post ID {$post->id}");
        //     } else {
        //         $this->line("No change for post ID {$post->id}");
        //     }

        //     $bar->advance();
        // }
        // foreach ($posts as $post) {
        //     $foto = ltrim($post->foto_berita, '/'); // buang slash di depan jika ada

        //     // Asumsi path asli file
        //     $localPath = storage_path('app/public/' . str_replace('storage/', '', $foto));

        //     if (!file_exists($localPath)) {
        //         $this->warn("File not found for post ID {$post->id}: $localPath");
        //         continue;
        //     }

        //     $s3Path = 'uploads/berita/' . basename($foto);

        //     // Upload ke S3
        //     $uploaded = Storage::disk('s3')->put($s3Path, file_get_contents($localPath), 'public');

        //     if ($uploaded) {
        //         $s3Url = rtrim(config('filesystems.disks.s3.url') ?? config('app.url'), '/') . '/' . $s3Path;

        //         DB::table('posts')->where('id', $post->id)->update(['foto_berita' => $s3Url]);

        //         $this->info("Updated post ID {$post->id} to $s3Url");
        //     } else {
        //         $this->error("Failed to upload for post ID {$post->id}");
        //     }
        // }

        // foreach ($posts as $post) {
        //     $foto = $post->foto_berita;

        //     // Jika sudah berupa URL S3, lewati
        //     if (str_starts_with($foto, 'http://') || str_starts_with($foto, 'https://')) {
        //         $this->info("Skipped (sudah URL): {$post->id}");
        //         continue;
        //     }

        //     $foto = ltrim($foto, '/'); // Hilangkan '/' di awal jika ada

        //     // Coba dua kemungkinan path
        //     $pathsToTry = [
        //         public_path($foto),
        //         public_path('storage/' . $foto),
        //     ];

        //     $localPath = null;
        //     foreach ($pathsToTry as $path) {
        //         if (file_exists($path)) {
        //             $localPath = $path;
        //             break;
        //         }
        //     }

        //     if (!$localPath) {
        //         $this->warn("File not found for post ID {$post->id}: $foto");
        //         continue;
        //     }

        //     $s3Path = 'uploads/berita/' . basename($foto);

        //     // Upload ke S3
        //     $uploaded = Storage::disk('s3')->put($s3Path, file_get_contents($localPath), 'public');

        //     if ($uploaded) {
        //         $s3Url = rtrim(config('filesystems.disks.s3.url') ?? config('app.url'), '/') . '/' . $s3Path;

        //         DB::table('posts')->where('id', $post->id)->update(['foto_berita' => $s3Url]);

        //         $this->info("Updated: {$post->id} -> $s3Url");
        //     } else {
        //         $this->error("Failed to upload for post ID {$post->id}");
        //     }

        //     $bar->advance();
        // }

        // foreach ($posts as $post) {
        //     DB::table('posts')
        //         ->where('id', $post->id)
        //         ->update(['foto_berita' => $defaultUrl]);

        //     $this->info("Updated post ID {$post->id} to default image");
        //     $bar->advance();
        // }

        // $bar->finish();
        // echo " ";
        // $this->info("<fg=green>Data copied successfully</>");

        $kips = KIP::all();
        $bar = $this->output->createProgressBar(count($kips));
        $bar->start();

        foreach ($kips as $kip) {
            $fileUrl = $kip->files;
            $jenisFile = $kip->jenis_file;

            // Cek apakah ini URL Google Drive / Firebase
            if ($this->isExternalUrl($fileUrl)) {
                $this->info("⏳ Memproses: {$fileUrl}");

                try {
                    $response = Http::timeout(20)->get($this->convertToDirectDownload($fileUrl));

                    if ($response->successful()) {
                        $extension = $this->getExtensionFromResponse($response, $fileUrl);
                        $filename = $kip->nama_informasi . '-' . Str::random(10) . '.' . $extension;
                        $path = "uploads/kip/{$kip->jenis_informasi}/{$filename}";

                        Storage::disk('s3')->put($path, $response->body());
                        $kip->files = Storage::disk('s3')->url($path);
                        $kip->jenis_file = 'upload';
                        $kip->save();

                        $this->info("✅ File berhasil disimpan ke: {$path}");
                    } else {
                        $this->warn("⚠️ Gagal mengunduh file: {$fileUrl}");
                    }
                } catch (\Exception $e) {
                    $this->error("❌ Error saat memproses {$fileUrl}: " . $e->getMessage());
                }
            } else {
                // Bukan URL: ubah jenis_file ke upload
                if ($jenisFile !== 'upload') {
                    $kip->jenis_file = 'upload';
                    $kip->save();
                    $this->info("📄 File lokal, jenis_file diubah jadi 'upload' untuk ID {$kip->id}");
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("🎉 Selesai memproses semua data.");
    }

    private function isExternalUrl($url)
    {
        return Str::startsWith($url, [
            'http://',
            'https://drive.google.com',
            'https://firebasestorage.googleapis.com'
        ]);
    }

    private function convertToDirectDownload($url)
    {
        if (Str::contains($url, 'drive.google.com')) {
            preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $url, $matches);
            if (isset($matches[1])) {
                return "https://drive.google.com/uc?export=download&id={$matches[1]}";
            }
        }

        // Firebase URL sudah langsung bisa diunduh
        return $url;
    }

    private function getExtensionFromResponse($response, $url)
    {
        // 1. Coba ambil dari nama file di URL
        $filename = basename(parse_url($url, PHP_URL_PATH));
        $extFromName = pathinfo($filename, PATHINFO_EXTENSION);
        if (!empty($extFromName)) {
            return strtolower($extFromName);
        }

        // 2. Coba dari MIME Type
        $contentType = $response->header('Content-Type');
        $mimeToExt = [
            'application/pdf' => 'pdf',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            // tambahkan sesuai kebutuhan
        ];

        return $mimeToExt[$contentType] ?? 'pdf';
    }
}
