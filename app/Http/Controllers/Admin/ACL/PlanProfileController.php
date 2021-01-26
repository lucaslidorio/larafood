<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    
    protected $plan, $profile;

    public function __construct(Plan  $plan, Profile $profile)
    {
        //armazena na variavel repository um objeto de plan
        $this->plan = $plan;
        $this->profile = $profile;

        $this->middleware(['can:plans']);
    }

    public function profiles($idPlan){
       
        if(!$plan = $this->plan->find($idPlan)){
            redirect()->back();
        }
        
        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact( 'plan', 'profiles'));
        

    }

    public function plans($idProfile){
        
        if(!$profile = $this->profile->find($idProfile)){
            redirect()->back();
        }
        
        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact(  'profile','plans'));
        

    }
    public function profilesAvailable(Request $request, $idPlan){
        
        if(!$plan = $this->plan->find($idPlan)){
            redirect()->back();
        }

        $filters = $request->except('_token');
        

        //
        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact( 'plan', 'profiles', 'filters'));
    
    }
    //Lista os perfils que estão vinculado a uma permissão
   
    
    //metodo que vincula a permissão 
    public function attachProfilesPlan(Request $request, $idPlan){

        
        if(!$plan = $this->plan->find($idPlan)){
            redirect()->back();
        }

        if(!$request->profiles || count($request->profiles) == 0){
            redirect()
                ->back()
                ->with('info', 'É necessário escolher pelo menos um plano');
        };

        $plan ->profiles()->attach($request->profiles);
      
        return redirect()->route('plans.profiles', $plan->id);

    }

    //metodo que desvincular a permissão

    public function detachProfilesPlan($idPlan, $idProfile){
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);
        
        if(!$plan || $profile){
            redirect()->back();
        }
        //pega a permissão atraves do relacionamento profiles e desvincula através do detach()
        $plan->profiles()->detach($profile);
        return redirect()->route('plans.profiles', $plan->id);
    }

    


}
