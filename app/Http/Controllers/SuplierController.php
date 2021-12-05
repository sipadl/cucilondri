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
        $data = DB::table('suplier')->where('status', 1 )->get();
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

        $validaor = Validator::make($request->all(), $rules);
        if($validator->passes()){

            $file = $request->file('photos');
            $name = time().'-'.rand(1,1000).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/suplier'),$name);
            $insert = [
                'name' => $request->name,
                'photos' => '/assets/suplier/'.$name,
                'phone' => $request->phone,
                'address' => $request->address,
                'ext'   => null,
                'status' => 1,
                'created_at' => time()
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
        //
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
