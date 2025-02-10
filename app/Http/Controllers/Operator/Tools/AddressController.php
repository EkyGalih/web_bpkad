<?php

namespace App\Http\Controllers\Operator\Tools;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Cornford\Googlmapper\Mapper;
use GoogleMaps\GoogleMaps;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::first();
        // $config['center'] = $address->address;
        // $config['zoom'] = '14';
        // $config['map_height'] = '500px';
        // $config['scrollwheel'] = false;

        \Mapper::map($address->lat, $address->lng);

        return view('operator.Tools.Address.index', compact('address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Address::create([
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email
        ]);

        return redirect()->back()->with(['success' => 'Pengaturan alamat berhasil disimpan!']);
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
        $address = Address::findOrFail($id);
        $address->update([
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email
        ]);

        return redirect()->back()->with(['success' => 'Pengaturan alamat berhasil disimpan!']);
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
