<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function create(Request $requets)
    {
        return view('dashboard.Area.Create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();

            $area = Area::create($data);
            return redirect()->back()->with('success', 'You register an area Successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $user = Area::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'You Delete Area Successfully');
    }
}