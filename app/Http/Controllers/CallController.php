<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Lead;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function store(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'duration' => 'required|integer|min:1',
            'result' => 'required|in:no_answer,callback_later,success',
            'manager_id' => 'required|exists:managers,id',
        ]);

        $call = Call::create(array_merge($validated, [
            'lead_id' => $lead->id
        ]));

        return response()->json($call, 201);
    }
}
