<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\WebsiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class WebsiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WebsiteSettings $settings)
    {
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebsiteSettings $settings)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'contact_number' => 'required|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'youtube' => 'nullable|string|max:255',
                'tiktok' => 'nullable|string|max:255',
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'simaskot_link' => 'nullable|url',
                'simaskot_opd' => 'nullable|string|max:255',
                'maintenance_mode' => 'nullable|boolean',

                // File upload
                'logo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'header_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'simaskot_qrcode_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }

        $deleteS3ByUrl = function ($url) {
            if (!$url) return;

            // Ambil bagian path setelah domain
            $fullPath = ltrim(parse_url($url, PHP_URL_PATH), '/'); // hasil: bpkad/uploads/...

            // Hapus prefix `bpkad/` jika memang struktur S3 tidak menyertakan itu
            $storagePath = preg_replace('/^bpkad\//', '', $fullPath);

            if (Storage::disk('s3')->exists($storagePath)) {
                Storage::disk('s3')->delete($storagePath);
            }
        };

        // ================== LOGO ==================
        if ($request->hasFile('logo_image')) {
            $deleteS3ByUrl($settings->logo_image); // hapus lama
            $path = $request->file('logo_image')->store('uploads/website-settings', 's3');
            $settings->logo_image = Storage::disk('s3')->url($path); // simpan baru
        }

        // ================== HEADER ==================
        if ($request->hasFile('header_image')) {
            $deleteS3ByUrl($settings->header_image);
            $path = $request->file('header_image')->store('uploads/website-settings', 's3');
            $settings->header_image = Storage::disk('s3')->url($path);
        }

        // ================== SIMASKOT QR ==================
        if ($request->hasFile('simaskot_qrcode_image')) {
            $deleteS3ByUrl($settings->simaskot_qrcode_image);
            $path = $request->file('simaskot_qrcode_image')->store('uploads/website-settings', 's3');
            $settings->simaskot_qrcode_image = Storage::disk('s3')->url($path);
        }

        // ================== FIELD TEXT BIASA ==================
        $settings->email = $validated['email'];
        $settings->contact_number = $validated['contact_number'];
        $settings->facebook = $validated['facebook'] ?? '';
        $settings->twitter = $validated['twitter'] ?? '';
        $settings->instagram = $validated['instagram'] ?? '';
        $settings->youtube = $validated['youtube'] ?? '';
        $settings->tiktok = $validated['tiktok'] ?? '';
        $settings->title = $validated['title'];
        $settings->subtitle = $validated['subtitle'] ?? '';
        $settings->simaskot_link = $validated['simaskot_link'] ?? '';
        $settings->simaskot_opd = $validated['simaskot_opd'] ?? '';
        $settings->maintenance_mode = $validated['maintenance_mode'];

        $settings->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Settings berhasil disimpan.'
        ]);
    }
}
