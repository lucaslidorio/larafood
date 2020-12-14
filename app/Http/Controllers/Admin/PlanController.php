<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $Plan)
    {
        //repository recebe o objeto de Plan
        $this->repository = $Plan;
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();
        return view('admin.pages.plans.index', [
            'plans' => $plans
        ]);
    }
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request)
    {
       
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }
    public function show($url )
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show',[
            'plan' =>$plan
        ]);
    }

    public function destroy($url )
    {
        $plan = $this->repository
                        ->with('details')
                        ->where('url', $url)
                        ->first();

        if(!$plan)
            return redirect()->back();
            //valida para ver se o plano possui detalhes vinculado, caso tenha, impede a exclusão
            if($plan->details->count() > 0){
                return redirect()
                            ->back()
                            ->with('error', 'Existem detalhes vinculado a esse plano, portando não pode ser excluido');
            }
        $plan->delete();
        return redirect()->route('plans.index');
        
    }

    public function search(Request $request){
        //pega todos os campos do request, com exeção do token
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        return view('admin/pages.plans.index', [
            'plans' =>$plans,
            'filters' => $filters,
        ]);
    }

    public function edit($url )
    {
        //recupera o plano pela url e add a variavel $plan
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', [
            'plan' => $plan
        ]);
        
    }

    public function update(StoreUpdatePlan $request, $url )
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();
       
        $plan->update($request->all());
        return redirect()->route('plans.index');
    }


    

}
