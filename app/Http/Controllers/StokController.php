<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Stok;
use Auth;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $stok = Stok::with('suplier')->where('user_id',$user->id)->where('status',1)->get();
        $suplier = DB::table('suplier')->where('status',1)->get();
        return view('user.stok', compact('stok','suplier'));
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
            'product' => 'required',
            'stock' => 'required|min:1',
            'id_suplier' => 'required|exists:suplier,id',
            'price' => 'required|integer|min:1',
            'status' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()){
            $stok = Stok::create($request->except('_token'));
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('stok')->where('id', $id)->first();
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
        $data = DB::table('stok')->where('id', $id)->first();
        if($data->status  == 1)
        {
            DB::table('stok')->update(['status' => 0 ]);
        }else{
            DB::table('stok')->update(['status' => 1 ]);
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
        $data = DB::table('stok')->where('id', $request->id)->update($request->except(['id','_token']));
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
}
