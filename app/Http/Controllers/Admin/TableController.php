<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpadataTable;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;


class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table)
    {
       $this->repository = $table;
    }

    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpadataTable $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tables.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       
        if( !$table = $this->repository->find($id)){
            return redirect()->back();
            
        }
        return view('admin.pages.tables.show', compact('table'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        if( !$table = $this->repository->find($id)){
            return redirect()->back();
            
        }
        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpadataTable $request, $id)
    {
        if( !$table = $this->repository->find($id)){
            return redirect()->back();
            
        }
        $table->update($request->all());

        return redirect()->route('tables.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        if( !$table = $this->repository->find($id)){
            return redirect()->back();
            
        }

        $table->delete();
        return redirect()->route('tables.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
        $tables = $this->repository
                        ->where(function($query) use ($request){
                            if($request->filter){
                                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                                $query->where('identify', $request->filter);
                                
                            }                            
                        })
                        ->latest()
                        ->paginate();


        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }
}
