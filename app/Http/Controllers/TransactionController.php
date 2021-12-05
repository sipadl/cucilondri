<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = DB::table('service')->where('status', 1)->get();
        $customer = DB::table('costumers')->where('status', 1 )->get();
        $transaction = DB::table('transactions')
        ->select('transactions.status','ext','order_number','name','weight','price','payment_type')
        ->leftJoin('costumers','costumers.id','transactions.costumer_id')
        ->paginate(10);
        return view('user.transaksi', compact('service','customer','transaction'));
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
        $user = Auth::user();
        if(!$request->is_member){
            $id = DB::table('costumers')->insertGetId([
                'name' => Str::ucfirst(strtolower($request->name)),
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 1
            ]);
        }
        $data = [
            'payment_tipe' => $request->payment_tipe,
            'service_id' => $request->service_id,
        ];
        $trade = DB::table('transactions')->insert([
            'order_number' => rand(100000,999999),
            'id_user' => $user->id??0,
            'costumer_id' => $id??$request->member_id,
            'weight' => $request->weight,
            'note' => $request->note??null,
            'price' => $request->price,
            'status' => 0,
            'ext' => json_encode($data),
            'created_at' => time()
        ]);
        return redirect()->back()->with('msg','Berhasil Memproses Pesanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

   
}
