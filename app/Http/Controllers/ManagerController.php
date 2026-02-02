<?php

namespace App\Http\Controllers;

use App\Models\Manager;

class ManagerController extends Controller
{
    public function leads(Manager $manager)
    {
        $leads = $manager->leads()
            ->withCount('calls')
            ->withSum('calls', 'duration')
            ->get()
            ->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'status' => $lead->status,
                    'calls_count' => $lead->calls_count,
                    'total_call_duration' => (int) ($lead->calls_sum_duration ?? 0),
                ];
            });

        return response()->json($leads);
    }
}
