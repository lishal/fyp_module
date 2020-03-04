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
    
    public function edit($type_id=0)
    {
        $type = new Type();
        if($type_id > 0) {
            $type = $type->where('id', $type_id)->first();
        }

        return view('type.add_type', ['type' => $type]);
    }

    public function save(Request $request)
	{
        switch ($request->input('action')) {
            case 'save':
                $this->validate($request, [
                    'name' => 'required|min:3|max:255',
                    'description' =>'required',
                    'account_type'=> 'required'
                ]);
                $type_id = $this->request->input('type_id');
                $name = $this->request->input('name');
                $description = $this->request->input('description');
                $account_type = $this->request->input('account_type');
                
                $data = [
                    'name' => $name, 
                    'description' => $description,
                    'account_type' =>$account_type,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            
                if($type_id == 0) {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    \DB::table('types')->insert($data);
                    $message = "Record added successfully.";
                }
                else {
                    \DB::table('types')
                    ->where('id', $type_id)
                    ->update($data);
                    $message = "Record updated successfully.";
                    //  return($type_id);
                }
                    return redirect('/type')->with('success','Record Added');
            break;

            case 'cancel':
                return redirect('/type');
            break;
        }

        
    }

    public function delete($id){
        $type = Type::find($id);
        if($type->delete()){
            return redirect('type')->with('success','Type deleted successfully.');
        }
        else{
            return redirect('type')->with('error','Something went wrong. Please try again.');
        }
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
