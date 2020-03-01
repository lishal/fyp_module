<?php

namespace App\Http\Controllers;

use App\type;
use Illuminate\Http\Request;
use App\Repositories\TypeRepository;
use Illuminate\Http\RedirectResponse;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $types;
    protected $request;

    public function __construct(type $types, Request $request)
    {
        $this->middleware('auth');

        $this->types = $types;
        $this->request = $request;
    }
    public function index()
    {
        $types = $this->types->getAll();

	    return view('type.type', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\type  $type
     * @return \Illuminate\Http\Response
     */
    
    public function edit($typeId=0)
    {
        $type = new Type();
        if($typeId > 0) {
            $type = $type->where('id', $typeId)->first();
        }

        return view('type.add_type', ['type' => $type]);
    }

    public function save(Request $request)
	{
	    $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'long_desc' =>'required',
            'account_type'=> 'required'
        ]);
        return redirect('/type')->with('success','Record Added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(type $type)
    {
        //
    }
}
