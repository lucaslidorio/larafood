<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Product;


class ProductObserver
{
     /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        //antes de criar um producto, pega o nome e junta para criar uma url
        
        $product->flag = Str::kebab($product->title);  
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Model\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->flag = Str::kebab($product->title);
    }
}