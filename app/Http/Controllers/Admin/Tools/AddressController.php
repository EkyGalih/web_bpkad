<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Models\Address;
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

        return view('admin.Tools.Address.index', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $addrr = new Address();
        $addrr->address = $request->address;
        $addrr->lat = $request->lat;
        $addrr->lng = $request->lng;
        $addrr->phone = $request->phone;
        $addrr->email = $request->email;
        $addrr->save();

        _recentAdd($address->id, ' Mengubah alamat: ', 'Alamat');

        return redirect()->back()->with('success', 'Pengaturan alamat berhasil disimpan!');
    }
}
