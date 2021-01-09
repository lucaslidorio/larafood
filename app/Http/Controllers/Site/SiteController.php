<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
    public function index(){

        //Pega todos os  já com os detalhes, atraves do relacionamento "details" 
        $plans = Plan::with('details')->orderBy('price', 'ASC')->get();

        return view('site.pages.home.index', compact('plans'));
    }
    public function plan ($url){
        if(!$plan = Plan::where('url', $url)->first()){
            return redirect()->back();
        }

        session()->put('plan', $plan);

        return redirect()->route('register'); 


    }
}
