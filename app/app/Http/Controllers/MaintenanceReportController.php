<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceReport;
use Illuminate\Http\Request;

class MaintenanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if ($request->wantsJson()) {
            $maintenances = MaintenanceReport::with('location')
                ->latest()
                ->get();

            return response()->json($maintenances);
        }

        return view('secure.maintenance.index');
    }

    public function getDrainageReport($id)
    {
        $maintenance = MaintenanceReport::where('location_id', $id)
            ->latest()
            ->get();

        return response()->json($maintenance);
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

        \DB::beginTransaction();

        try {
            $request->validate([
                'type' => 'required',
                'remarks' => 'required',
                'status' => 'required'
            ]);

            MaintenanceReport::create($request->all());

            \DB::commit();

            return response()->json([
                'message' => 'Report created successfully'
            ]);
        }
        catch (\Exception $exception) {
            \DB::rollBack();

            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceReport $maintenanceReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceReport $maintenanceReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        \DB::beginTransaction();

        try {

            MaintenanceReport::find($id)->update($request->all());

            \DB::commit();

            return response()->json([
                'message' => 'Report updated successfully'
            ]);
        }
        catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        \DB::beginTransaction();

        try {

            MaintenanceReport::find($id)->delete();

            \DB::commit();

            return response()->json([
                'message' => 'Report deleted successfully'
            ]);
        }
        catch (\Exception $exception) {
            \DB::rollBack();

            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
