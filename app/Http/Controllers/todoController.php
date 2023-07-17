<?php

namespace App\Http\Controllers;
use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todo = todo::all();
        if (!empty($todo)){
            return response()->json([
                'status' => 200 ,
                'todo' =>  $todo
            ],200);
        }else{
            return response()->json([
                'status' => 200 ,
                'todo' => 'No Records Found'
            ],200);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request -> all() , [
            'nameTask' => 'required|String|max:200',
            'completed' => 'required|boolean',
        ]); 
        if($validator ->fails()){
           return response()->json([
            'status' => 422,
            'error' => $validator -> messages()
           ]) ;
        }else{
            $todo = todo::create([
            'nameTask' => $request -> nameTask,
            'completed' => $request -> completed,
            ]);
            if ($todo){
                return response()->json([
                    'status' => 200 ,
                    'message' => 'created successfully' 
                ],200);
            }else{
                return response()->json([
                    'status' => 500 ,
                    'message' =>  'something wrong'
                ],200);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = todo::find($id);
        if($todo){
            return response()->json([
                'status' => 200 ,
                'todo' => $todo 
            ],200);
        }else{
            return response()->json([
                'status' => 404 ,
                'message' =>  'No such Found!'
            ],200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = todo::find($id);
        if($todo){
            return response()->json([
                'status' => 200 ,
                'todo' => $todo 
            ],200);
        }else{
            return response()->json([
                'status' => 404 ,
                'message' =>  'No such Found!'
            ],200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request -> all() , [
            'nameTask' => 'required|String|max:200',
            'completed' => 'required|boolean',
        ]); 
        if($validator ->fails()){
           return response()->json([
            'status' => 422,
            'error' => $validator -> messages()
           ]) ;
        }else{
            $todo = todo::find($id);
            $todo -> update([
            'nameTask' => $request -> nameTask,
            'completed' => $request -> completed,
            ]);
            if ($todo){
                return response()->json([
                    'status' => 200 ,
                    'message' => 'update successfully' 
                ],200);
            }else{
                return response()->json([
                    'status' => 500 ,
                    'message' =>  'something wrong'
                ],200);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = todo::find($id);
      
        if($todo){
            $todo -> delete();
            return response()->json([
                'status' => 200 ,
                'todo' => $todo ,
                'message' => 'delete successfully' 
            ],200);
        }else{
            return response()->json([
                'status' => 404 ,
                'message' =>  'No such Found!'
            ],200);
        }
    }
}
