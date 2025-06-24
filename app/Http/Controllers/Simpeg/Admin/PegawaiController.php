<?php

namespace App\Http\Controllers\Simpeg\Admin;

use App\Enum\JabatanEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
use App\Models\Bidang;
use App\Models\Golongan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pegawai = Pegawai::whereNull('deleted_at')->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        })->orderBy('updated_at', 'DESC')->paginate(12);

        return view('SimPeg.pegawai.pegawai', compact('pegawai'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $pegawai = Pegawai::whereNull('deleted_at')->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        })->orderBy('updated_at', 'DESC')->get();

        return response()->json($pegawai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang = Bidang::get();
        $pangkat = Pangkat::get();
        $golongan = Golongan::get();
        $NamaJabatan = _jsonDecode(asset('server/data/umum/NamaJabatan.json'));
        $InitialJabatan = JabatanEnum::cases();

        return view('SimPeg.pegawai.components.add', compact('bidang', 'pangkat', 'golongan', 'NamaJabatan', 'InitialJabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $validatedData = $request->validated();
        $pegawai = Pegawai::create([
            'nip' => $validatedData['nip'],
            'name' => $validatedData['name'],
            'jenis_pegawai' => $validatedData['nip'] == '0' ? 'non asn' : 'asn',
            'pendidikan' => $validatedData['pendidikan'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'agama' => $validatedData['agama'],
            'no_sk' => $validatedData['no_sk'],
            'nama_rekening' => $validatedData['nama_rekening'],
            'no_rekening' => $validatedData['no_rekening'],
            'golongan_id' => $validatedData['golongan_id'],
            'pangkat_id' => $validatedData['pangkat_id'],
            'nama_jabatan' => $validatedData['nama_jabatan'],
            'initial_jabatan' => $validatedData['initial_jabatan'],
            'jabatan' => $validatedData['jabatan'],
            'masa_kerja_golongan' => $validatedData['masa_kerja_golongan'],
            'diklat' => $validatedData['diklat'],
            'umur' => $validatedData['umur'],
            'batas_pensiun' => $validatedData['pensiun'],
            'kenaikan_pangkat' => $validatedData['kenaikan_pangkat'],
            'tanggal_sk' => $validatedData['tanggal_sk'],
            'bidang_id' => $validatedData['bidang_id']
        ]);

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $path = $request->file('foto')->store('uploads/pegawai', 's3');
            $pegawai->foto = Storage::disk('s3')->url($path);
        } else {
            if ($validatedData['jenis_kelamin'] == 'pria') {
                $pegawai->foto = 'https://storage.ntbprov.go.id/bpkad/uploads/defaults/male.jpg';
            } elseif ($validatedData['jenis_kelamin'] == 'wanita') {
                $pegawai->foto = 'https://storage.ntbprov.go.id/bpkad/uploads/defaults/female.jpg';
            } else {
                $pegawai->foto = null;
            }
        }

        // Menyimpan data ke dalam database
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $umur = USIA($pegawai->tanggal_lahir)->umur;
        $mkg = hitungMasaKerja($pegawai->tanggal_sk);

        if ($pegawai->umur != $umur) {
            $pegawai->update(['umur' => $umur]);
        }
        if ($pegawai->masa_kerja_golongan != $mkg) {
            $pegawai->update(['masa_kerja_golongan' => $mkg]);
        }

        return view('SimPeg.pegawai.components.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $bidang = Bidang::get();
        $pangkat = Pangkat::get();
        $golongan = Golongan::get();
        $NamaJabatan = _jsonDecode(asset('server/data/umum/NamaJabatan.json'));
        $InitialJabatan = JabatanEnum::cases();

        return view('SimPeg.pegawai.components.edit', compact('pegawai', 'golongan', 'pangkat', 'bidang', 'NamaJabatan', 'InitialJabatan'));
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
        // Cari pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);

        // Memperbarui data pegawai
        $pegawai->nip = $request->nip;
        $pegawai->name = $request->name;
        $pegawai->jenis_pegawai = $request->nip == '0' ? 'non asn' : 'asn';
        $pegawai->pendidikan = $request->pendidikan;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->agama = $request->agama;
        $pegawai->no_sk = $request->no_sk;
        $pegawai->nama_rekening = $request->nama_rekening;
        $pegawai->no_rekening = $request->no_rekening;
        $pegawai->golongan_id = $request->golongan_id;
        $pegawai->pangkat_id = $request->pangkat_id;
        $pegawai->nama_jabatan = $request->nama_jabatan;
        $pegawai->initial_jabatan = $request->initial_jabatan;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->masa_kerja_golongan = $request->masa_kerja_golongan;
        $pegawai->diklat = $request->diklat;
        $pegawai->umur = $request->umur;
        $pegawai->batas_pensiun = $request->pensiun;
        $pegawai->kenaikan_pangkat = $request->kenaikan_pangkat;
        $pegawai->tanggal_sk = $request->tanggal_sk;
        $pegawai->status_pegawai = $request->status_pegawai;
        $pegawai->bidang_id = $request->bidang_id;

        // Jika ada file foto baru yang diunggah
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Hapus file foto lama dari storage jika ada
            if ($pegawai->foto) {
                $oldPath = str_replace(Storage::disk('s3')->url(''), '', $pegawai->foto);
                Storage::disk('s3')->delete($oldPath);
            }

            // Simpan file foto baru ke dalam folder 'storage/app/public/pegawai'
            $path = $request->file('foto')->store('uploads/pegawai', 's3');

            // Update path foto di database
            $pegawai->foto = Storage::disk('s3')->url($path);
        }

        // Menyimpan perubahan ke dalam database
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        // Storage::delete(str_replace('storage/', 'public/', $pegawai->foto));
        $pegawai->update([
            'deleted_at' => new DateTime()
        ]);

        _recentAdd($id, 'menghapus pegawai', 'pegawai');

        return redirect()->route('pegawai.index')->with(['success' => 'Pegawai Berhasil dihapus!']);
    }
}
