<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Models\\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        //antes de criar um categoryo, pega o nome e junta para criar uma url
        
        $category->url = Str::kebab($category->name);  
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Models\\Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        //antes de atualizar um categoryo, pega o nome e junta para para atualizar uma url
        $category->url = Str::kebab($category->name);
    }

}
