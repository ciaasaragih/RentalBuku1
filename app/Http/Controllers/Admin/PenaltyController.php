<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenaltySetting; // <--- PASTIKAN BARIS INI ADA

class PenaltyController extends Controller
{
    public function edit()
    {
        // Data ID 1 sudah ada di DB, jadi ini tidak akan error lagi
        $setting = PenaltySetting::findOrFail(1);
        return view('admin.penalty.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = PenaltySetting::findOrFail(1);
        $setting->update($request->all());

        return redirect()->back()->with('success', 'Berhasil update denda!');
    }
}