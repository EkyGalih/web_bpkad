<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $posts = DB::table('posts')
            ->whereNotNull('content')
            ->where('content', 'like', '%<img%src=%')
            ->get();
        $bar = $this->output->createProgressBar(count($posts));

        foreach ($posts as $post) {
            if (empty($post->foto_berita)) {
                $this->warn("Post ID {$post->id} tidak punya foto_berita");
                continue;
            }

            $content = $post->content;

            // Regex untuk ganti semua src dalam <img>
            $newContent = preg_replace(
                '/<img[^>]*src=["\'](.*?)["\']/i',
                '<img src="' . $post->foto_berita . '"',
                $content
            );

            if ($newContent !== $content) {
                DB::table('posts')->where('id', $post->id)->update(['content' => $newContent]);
                $this->info("Updated post ID {$post->id}");
            } else {
                $this->line("No change for post ID {$post->id}");
            }

            $bar->advance();
        }
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

        $bar->finish();
        echo " ";
        $this->info("<fg=green>Data copied successfully</>");
    }
}
