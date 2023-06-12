<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index()
    {
        return Tip::all();
    }

    public function store(Request $request)
    {
        $tip = Tip::create($request->all());
        return response()->json($tip, 201);
    }

    public function show(Tip $tip)
    {
        return $tip;
    }

    public function update(Request $request, Tip $tip)
    {
        $tip->update($request->all());
        return response()->json($tip, 200);
    }

    public function destroy(Tip $tip)
    {
        $tip->delete();
        return response()->json(null, 204);
    }
}
