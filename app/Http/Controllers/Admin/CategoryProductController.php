<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product  $product, Category $category)
    {
        //armazena na variavel repository um objeto de product
        $this->product = $product;
        $this->category = $category;

        $this->middleware(['can:products']);
    }

    public function categories($idProduct){
        
        if(!$product = $this->product->find($idProduct)){
           return redirect()->back();
        }
        
        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact( 'product', 'categories'));
        

    }

    public function products($idCategory){
        
        if(!$category = $this->category->find($idCategory)){
            redirect()->back();
        }
        
        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact(  'category','products'));
        

    }
    public function categoriesAvailable(Request $request, $idProduct){
        
        if(!$product = $this->product->find($idProduct)){
            redirect()->back();
        }

        $filters = $request->except('_token');
        

        //
        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact( 'product', 'categories', 'filters'));
    
    }
    //Lista os perfils que estão vinculado a uma permissão
   
    
    //metodo que vincula a permissão 
    public function attachCategoriesProduct(Request $request, $idProduct){

        
        if(!$product = $this->product->find($idProduct)){
            redirect()->back();
        }

        if(!$request->categories || count($request->categories) == 0){
            redirect()
                ->back()
                ->with('info', 'É necessário escolher pelo menos uma permissão');
        };

        $product ->categories()->attach($request->categories);
      
        return redirect()->route('products.categories', $product->id);

    }

    //metodo que desvincular a permissão

    public function detachCategoriesProduct($idProduct, $idCategory){
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);
        
        if(!$product || $category){
            redirect()->back();
        }
        //pega a permissão atraves do relacionamento categories e desvincula através do detach()
        $product->categories()->detach($category);
        return redirect()->route('products.categories', $product->id);
    }

    

}
