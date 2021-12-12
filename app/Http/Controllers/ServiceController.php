<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $service = DB::table('service')->where('status',1)->get();
        return view('user.service', compact('service'));
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
            'code' => 'required',
            'price'=> 'integer|required|min:1',
            'member_discount' => 'nullable',
            'ext' => 'nullable',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()){
            DB::table('service')->insert($request->except('_token'));
            return redirect()->back()->withErrors($validator)->withInput();
        }
        dd($validator->errors()->first());
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
        $data = DB::table('service')->where('id',$id)->first();
        if(!isset($data) ){
            $data = 0;
        }
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('service')->where('id', $id)->first();
        if($data->status  == 1)
        {
            DB::table('service')->update(['status' => 0 ]);
        }else{
            DB::table('service')->update(['status' => 1 ]);
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
    public function update(Request $request)
    {
        $data = DB::table('service')->where('id', $request->id)->update($request->except(['id','_token']));
        return redirect()->back()->with('msg','Berhasil mengubah data');
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

    public function proses($id)
    {
        $trade = DB::table('transactions')->where('order_number',$id);
        $data = $trade->first();
        $update = $trade->update([
            'status' => $data->status+1 ,
        ]);
        return redirect()->back()->with('msg','Berhasil Memproses Orderan');
    }
}
