<?php

namespace App\Http\Controllers\Admin\PPID;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\KIP;
use App\Models\Recent;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;
use Intervention\Image\Colors\Rgb\Channels\Red;

class KIPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kip = KIP::orderBy('created_at', 'DESC')
            ->where('deleted_at', '=', NULL)
            ->get();
        $DeletedKIP = KIP::orderBy('created_at', 'DESC')
            ->where('deleted_at', '!=', NULL)
            ->get();

        return view('admin.ppid.kip.index', compact('kip', 'DeletedKIP'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ppid.kip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_informasi' => 'required',
            'jenis_informasi' => 'required',
            'jenis_file' => 'required',
            'tahun' => 'required',
            'files' => 'required_if:jenis_file,upload|file|mimes:pdf|max:20480',
            'links_file' => 'required_if:jenis_file,link',
        ], [
            'nama_informasi.required' => 'Nama informasi wajib diisi.',
            'jenis_informasi.required' => 'Jenis informasi wajib diisi.',
            'jenis_file.required' => 'Jenis file wajib dipilih.',
            'tahun.required' => 'Tahun wajib diisi.',
            'files.required_if' => 'File PDF wajib diunggah jika jenis file adalah upload.',
            'files.file' => 'File yang diunggah harus berupa file.',
            'files.mimes' => 'File yang diunggah harus berformat PDF.',
            'files.max' => 'Ukuran file maksimal 20MB.',
            'links_file.required_if' => 'Link file wajib diisi jika jenis file adalah link.',
        ]);

        if ($request->jenis_file === 'upload') {
            // Upload file ke storage S3
            $file = $request->file('files');
            $path = $file->store('uploads/files', 's3');
            $url = config('filesystems.disks.s3.url') . '/' . $path;
        } else {
            // Jika jenis_file adalah "link", simpan link yang diinputkan
            $url = $request->links_file;
        }

        $id = (string)Uuid::generate(4);
        $kip = new KIP();

        $kip->id = $id;
        $kip->nama_informasi = $request->nama_informasi;
        $kip->jenis_informasi = $request->jenis_informasi;
        $kip->jenis_file = $request->jenis_file;
        $kip->upload_by = Auth::user()->id;
        $kip->files = $url;
        $kip->save();

        _recentAdd($id, 'mengupload file pada PPID informasi ' . $request->jenis_informasi, 'kip');

        return redirect()->route('ppid-kip.index')->with(['success' => 'Data informasi berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agenda()
    {
        return view('admin.ppid.agenda.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(KIP $kip)
    {

        return view('admin.ppid.kip.edit', compact('kip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KIP $kip)
    {
        if ($request->jenis_file === 'upload') {
            // Jika ada file baru yang diunggah
            if ($request->hasFile('files') && $request->file('files')->isValid()) {
                // Hapus file lama dari S3 jika masih ada dan berbentuk URL S3
                if (!empty($kip->files) && Str::contains($kip->files, config('filesystems.disks.s3.url'))) {
                    $oldPath = str_replace(config('filesystems.disks.s3.url') . '/', '', $kip->files);
                    Storage::disk('s3')->delete($oldPath);
                }

                // Upload file baru ke S3
                $path = $request->file('files')->store('uploads/files', 's3');
                $url = Storage::disk('s3')->url($path); // Generate URL otomatis
            } else {
                // Jika tidak ada file baru dikirim, gunakan file lama
                $url = $kip->files;
            }
        } else {
            // Jika jenis_file adalah "link", simpan link yang diinputkan
            $url = $request->links_file;

            // Hapus file lama dari S3 jika sebelumnya adalah upload
            if (!empty($kip->files) && Str::contains($kip->files, config('filesystems.disks.s3.url'))) {
                $oldPath = str_replace(config('filesystems.disks.s3.url') . '/', '', $kip->files);
                Storage::disk('s3')->delete($oldPath);
            }
        }

        $kip->files = $url;
        $kip->save();

        _recentAdd($kip->id, 'mengubah file pada PPID informasi ' . $request->jenis_informasi . ' menjadi', 'kip');

        return redirect()->route('ppid-kip.index')->with('success', 'Data informasi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KIP $kip)
    {
        $kip->update([
            'deleted_at' => new DateTime()
        ]);

        _recentAdd($kip->id, 'menghapus file pada PPID informasi ' . $kip->jenis_informasi, 'kip');

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function restore(KIP $kip)
    {
        $kip->update([
            'deleted_at' => NULL
        ]);

        _recentAdd($kip->id, 'memulihkan informasi ' . $kip->nama_informasi, 'kip');

        return redirect()->back()->with('success', 'Data berhasil dipulihkan');
    }

    public function delete(KIP $kip)
    {
        if ($kip->files && Str::contains($kip->files, env('AWS_URL'))) {
            $oldPath = str_replace(env('AWS_URL') . '/', '', $kip->files);
            Storage::disk('s3')->delete($oldPath);
        } else {
            Storage::disk('public')->delete($kip->files);
        }

        $kip->delete();

        _recentAdd($kip->id, 'menghapus permanent file pada PPID informasi ' . $kip->jenis_informasi, 'kip');

        return redirect()->back()->with('success', 'Data berhasil dihapus permanent!');
    }

    public function clear()
    {
        $kip = KIP::whereNotNull('deleted_at')->get();
        foreach ($kip as $item) {
            $recent = Recent::where('uuid_activity', '=', $item->id)->first();
            if ($recent != NULL) {
                $recent->delete();
            }
            if ($item->files && Str::contains($item->files, env('AWS_URL'))) {
                $oldPath = str_replace(env('AWS_URL') . '/', '', $item->files);
                Storage::disk('s3')->delete($oldPath);
            } else {
                Storage::disk('public')->delete($item->files);
            }
            $item->delete();
        }

        return redirect()->route('ppid-kip.index')->with(['success' => 'File Sampah berhasil dibersihkan!']);
    }

    public function viewPDF(KIP $kip)
    {
        $files = KIP::select('files')->findOrFail($kip->id);
        if ($files->files && Str::contains($files->files, env('AWS_URL'))) {
            return redirect($files->files);
        } else {
            return response()->file(public_path('storage/' . $files->files));
        }
    }

    public function downloadPDF(KIP $kip)
    {
        $files = KIP::select('files')->findOrFail($kip->id);
        if ($files->files && Str::contains($files->files, env('AWS_URL'))) {
            // Mengunduh file dari URL eksternal
            return redirect($files->files);
        } else {
            // Mengunduh file dari penyimpanan lokal
            return response()->download(public_path('storage/' . $files->files));
        }
    }
}
