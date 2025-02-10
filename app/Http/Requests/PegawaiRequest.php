<?php

namespace App\Http\Requests;

use App\Models\Pegawai;
use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nip' => 'required|string|max:20|unique:'.Pegawai::class.',nip,'.$this->id,
            'name' => 'required|string|max:100',
            'pendidikan' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:50',
            'no_sk' => 'nullable|string|max:50',
            'nama_rekening' => 'nullable|string|max:100',
            'no_rekening' => 'nullable|string|max:20',
            'golongan_id' => 'required',
            'pangkat_id' => 'required',
            'nama_jabatan' => 'required|string|max:100',
            'initial_jabatan' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'masa_kerja_golongan' => 'nullable',
            'diklat' => 'nullable|string|max:100',
            'umur' => 'required|integer',
            'pensiun' => 'required',
            'kenaikan_pangkat' => 'nullable',
            'tanggal_sk' => 'nullable',
            'bidang_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nip.required' => 'NIP pegawai wajib diisi.',
            'nip.unique' => 'NIP pegawai sudah terdaftar.',
            'name.required' => 'Nama pegawai wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'golongan_id.required' => 'Golongan pegawai wajib diisi.',
            'golongan_id.exists' => 'Golongan yang dipilih tidak valid.',
            'pangkat_id.required' => 'Pangkat pegawai wajib diisi.',
            'pangkat_id.exists' => 'Pangkat yang dipilih tidak valid.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'bidang_id.required' => 'Bidang pegawai wajib diisi.',
            'bidang_id.exists' => 'Bidang yang dipilih tidak valid.',
            // Tambahkan pesan kesalahan lainnya sesuai dengan kebutuhan
        ];
    }
}
