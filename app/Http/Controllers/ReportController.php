<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ReportNotFoundException;

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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',//The user_id attribute is required and must exist in the users table.
            'location' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $report = Report::create($request->all());
        return response()->json($report, 201);

    }

    public function show(Report $report)
    {
        if (!$report) {
            throw new ReportNotFoundException;
        }
        return $report;
    }


    public function update(Request $request, Report $report)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id',
            'location' => 'string',
            'description' => 'string',
            'status' => 'string',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $report->update($request->all());
        return response()->json($report, 200);
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json(null, 204);
    }
}
