<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use DB;

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

            $area = DB::table('areas')->get();
            return redirect()->route('area.list')->with(['area' => $area, 'success' => 'You create an area successfully!']);

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

    public function index()
    {
        $area = DB::table('areas')->get();
        return view('dashboard.Area.list', ['area' => $area]);
    }
    public function edit(Request $request, $id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        return view('dashboard.Area.edit', ['area' => $area]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();
            $area = Area::find($id);
            $area->fill($data)->save();
            $area = DB::table('areas')->get();
            return redirect()->route('area.list')->with(['area' => $area, 'success' => 'You update an area successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
}