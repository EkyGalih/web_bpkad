<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Schedule::select('id as schedule_id', 'schedule.*')->orderBy('created_at', 'DESC')->where('status', '=', '0')->get();
        $users = User::select('id as user_id', 'nama')->get();
        return view('admin.Schedule.schedule', compact('jadwals', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Schedule::create([
            'jenis_acara' => $request->jenis_acara,
            'tgl_acara' => $request->tgl_acara,
            'jam_acara' => $request->jam_acara,
            'redaksi_acara' => $request->redaksi_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'acara_dari' => $request->acara_dari,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('admin.jadwal');
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
        $jadwal = Schedule::findOrFail($id);
        $jadwal->update([
            'jenis_acara' => $request->jenis_acara,
            'tgl_acara' => $request->tgl_acara,
            'jam_acara' => $request->jam_acara,
            'redaksi_acara' => $request->redaksi_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'acara_dari' => $request->acara_dari,
            'user_id' => $request->user_id
        ]);

        return redirect()->back()->with(['success' => 'Jadwal Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
