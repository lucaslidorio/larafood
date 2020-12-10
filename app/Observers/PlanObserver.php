<?php

namespace App\Observers;

use App\Models\Plan;
use Illuminate\Support\Str;

class PlanObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\\Plan  $plan
     * @return void
     */
    public function creating(Plan $plan)
    {
        //antes de criar um plano, pega o nome e junta para criar uma url
        
        $plan->url = Str::kebab($plan->name);  
    }

    /**
     * Handle the plan "updating" event.
     *
     * @param  \App\Models\\Plan  $plan
     * @return void
     */
    public function updating(Plan $plan)
    {
        //antes de atualizar um plano, pega o nome e junta para para atualizar uma url
        $plan->url = Str::kebab($plan->name);
    }

}
