<?php

namespace App\Http\Controllers;

use App\Models\BarangayList;
use Illuminate\Http\Request;

class BarangayListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if ($request->wantsJson()) {
            $barangay = BarangayList::with('detection')->latest()->get();

            return response()->json($barangay);
        }

        return view('secure.drainage.index');


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        //

        if ($request->wantsJson()) {
            $barangay = BarangayList::with('detection')->findOrFail($id);
            return response()->json($barangay);
        }

        return view('secure.drainage.drainage-report');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangayList $barangayList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangayList $barangayList)
    {
        //
    }
}
