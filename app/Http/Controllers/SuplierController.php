<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('suplier')->get();
        return view('user.suplier',compact('data'));
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
        $rules = [
            'name' => 'required',
            'photos' => 'mimes:png,jpg',
            'phone' => 'required|min:12',
            'address' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()){
            if($request->file){
                $file = $request->file('photos');
                $name = time().'-'.rand(1,1000).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('assets/suplier'),$name);
            }
            $insert = [
                'name' => $request->name,
                'photos' => ($request->file)?'/assets/suplier/'.$name:0,
                'phone' => $request->phone,
                'address' => $request->address,
                'ext'   => null,
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s',time())
            ];
            $data = DB::table('suplier');
            $data = $data->insert($insert);
            return redirect()->back()->with(['message' => 'berhasil']);
        }
       return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('suplier')->where('id', $id)->first();
        if($data->status  == 1)
        {
            DB::table('suplier')->where('id', $id)->update(['status' => 0 ]);
        }else{
            DB::table('suplier')->where('id', $id)->update(['status' => 1 ]);
        }
        return redirect()->back()->with('msg','Berhasil mengubah data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
