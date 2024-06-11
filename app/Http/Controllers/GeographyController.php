<?php

namespace App\Http\Controllers;

use App\Geography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      

        $geographies = DB::table('geography')
                ->orderBy('country', 'asc')
                ->paginate(20);
        
        return view('geography.index', compact('geographies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $continents = ['Africa', 'Antarctica', 'Asia', 'Australia and Oceania', 'Europe', 'North America', 'South America'];

        return view('geography.create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['country'=>'required',
        'continent'=>'required',
        'flag'=>'required|image|mimes:jpeg, png, jpg, gif|max:3500',
        ]);

        $imageName = '';
        if($request->flag) {
            $imageName = time().'.'.$request->flag->extension();
            $request->flag->move(public_path('uploads'), $imageName);
        }

        $data = new Geography;
        $data->country = $request->country;
        $data->continent = $request->continent;
        $data->capital = $request->capital;
        $data->flag = $imageName;
        $data->save();
        return redirect()->route('geography.index')->with('success', 'Data has successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function show(Geography $geography)
    {
        return view('geography.show', compact('geography'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function edit(Geography $geography)
    {
        $continents = ['Africa', 'Antarctica', 'Asia', 'Australia and Oceania', 'Europe', 'North America', 'South America'];
        return view('geography.edit', compact('geography', 'continents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geography $geography)
    {
        $request->validate([
            'country' => 'required',
            'capital' => 'required',
        ]);

        $imageName = '';
        if($request->flag) {
            $imageName = time().'.'.$request->flag->extension();
            $request->flag->move(public_path('uploads'), $imageName);
            $geography->flag = $imageName;
        }
        $geography->country = $request->country;
        $geography->continent = $request->continent;
        $geography->capital = $request->capital;
        $geography->update();
        return redirect()->route('geography.index')->with('success', 'Data has successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $geography = Geography::findOrFail($id);
        $geography -> delete();
        return redirect()->route('geography.index')->with('success', 'Data has successfully deleted!');
    }
}
