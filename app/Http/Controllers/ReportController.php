<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Report::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $report = Report::create($request->all());
        return response()->json($report, 201);

    }

    public function show(Report $report)
    {
        return $report;
    }


    public function update(Request $request, Report $report)
    {
        $report->update($request->all());
        return response()->json($report, 200);
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json(null, 204);
    }
}
