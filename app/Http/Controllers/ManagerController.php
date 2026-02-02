<?php

namespace App\Http\Controllers;

use App\Models\Manager;

class ManagerController extends Controller
{
    public function leads(Manager $manager)
    {
        $leads = $manager->leads()->get()->map(function($lead) {
            return [
                'id' => $lead->id,
                'name' => $lead->name,
                'status' => $lead->status,
                'calls_count' => $lead->calls()->count(),
                'total_call_duration' => $lead->calls()->sum('duration'),
            ];
        });

        return response()->json($leads);
    }
}
