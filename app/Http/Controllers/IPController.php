<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IPController extends Controller
{
    public function create()
    {
        $areas = DB::table('areas')->get();
        return view('IP.create', ['areas' => $areas]);
    }
    public function index()
    {
        return view('IP.index');
    }
    public function ip_signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'area_id' => 'required',
            'lot_id' => 'required',
            'district_id' => 'required',
            'tehsil_id' => 'required',
            'uc_id' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = '_image' . time() . '.' . $extension;
            $image->move(public_path('admin/assets/img'), $filename);
        }
    }

}
