<?php

namespace App\Observers;

use App\Models\Call;

class CallObserver
{
    /**
     * Обробка події створення дзвінка
     */
    public function created(Call $call)
    {
        $lead = $call->lead;

        if ($lead->calls()->count() === 1 && $lead->status === 'new') {
            $lead->status = 'in_progress';
        }

        if (!$lead->manager_id) {
            $lead->manager_id = $call->manager_id;
        }

        if ($call->result === 'success') {
            $lead->status = 'won';
        }
        
        $lastResults = $lead->calls()
            ->latest()
            ->limit(3)
            ->pluck('result');

        if ($lastResults->count() === 3 && $lastResults->every(fn($r) => $r === 'no_answer')) {
            $lead->status = 'lost';
        }

        $lead->save();
    }
}
