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
        $user = Auth::user();
        $service = DB::table('service')->where('status', 1)->get();
        $customer = DB::table('costumers')->where('user_id',$user->id)->where('status', 1 )->get();
        $transaction = DB::table('transactions')
        ->select('transactions.status','ext','order_number','name','weight','price','payment_type')
        ->leftJoin('costumers','costumers.id','transactions.costumer_id')
        ->where('transactions.id_user', $user->id)
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
            'note' => $request->note??0,
            'price' => $request->price,
            'status' => $request->payment_tipe,
            'pay_amount' => $request->pay_amount,
            'ext' => json_encode($data),
            'created_at' => date('Y-m-d', time()),
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

    public function print($id)
    {
        $data =  DB::table('transactions')
        ->select('transactions.status','ext','order_number','name','weight','price','payment_type','pay_amount','transactions.created_at')
        ->leftJoin('costumers','costumers.id','=','transactions.costumer_id')
        ->where('transactions.order_number', $id)
        ->get();

        $data = array_map(function($x) {
            $json = json_decode($x->ext);
            $layanan = DB::table('service')->where('id', $json->service_id)->first();
            $x->no_order = $layanan->code.'-'.$x->order_number;
            $x->layanan = $layanan->name;
            $x->pembayaran = ($x->payment_type == 1)?'Lunas':'Belum Lunas';
            $x->total = $x->price;
            $x->biaya_layanan = $x->price/$x->weight;
            $x->tanggal_ambil = date('Y-m-d',strtotime($x->created_at) + (24*$layanan->duration*60*60));
            $x->status = $this->status($x->status);
            unset($x->ext);
            unset($x->order_number);
            unset($x->price);
            return $x;
        },$data->toArray());

        return view('user.print',compact('data'));
    }

    function status($val)
    {
        switch ($val) {
            case '1':
                $status = 'Cuci';
                break;
            case '2':
                $status = 'Setrika';
                break;
            case '3':
                $status = 'Selesai';
                break;
            case '4':
                $status = 'Diambil';
                break;
            default:
                $status = 'Proses';
                break;
        }
        return $status;
    }
   
}
