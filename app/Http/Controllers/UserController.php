<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }
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
        ->leftJoin('costumers','costumers.id','transactions.costumer_id')
        ->paginate(10);


        $profit = DB::table('transactions')
        ->leftJoin('costumers','costumers.id','transactions.costumer_id')
        ->whereMonth('transactions.created_at', date('m'))
        ->where('payment_type', 1)->sum('price');

        $piutang = DB::table('transactions')
        ->leftJoin('costumers','costumers.id','transactions.costumer_id')
        ->whereMonth('transactions.created_at', date('m'))
        ->where('payment_type', 0)->sum('price');        
        
        $proses = $this->count_transaction([0,1,2,3]);
        $berhasil = $this->count_transaction([4]);
        $gagal = $this->count_transaction([5]);

        return view('user.index',compact('service','customer','transaction',
        'profit','piutang','proses','berhasil','gagal'));
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

    function count_transaction($status)
    {
        $trans = DB::table('transactions')
        ->whereMonth('created_at',date('m'))
        ->whereIn('status', $status)
        ->count();

        return $trans;
    }

    public function laporan()
    {
        $trans = DB::table('transactions')
        ->select('transactions.status','ext','order_number','name','weight','price','payment_type','transactions.created_at')
        ->leftJoin('costumers','costumers.id','=','transactions.costumer_id')
        ->whereMonth('transactions.created_at',date('m'))->get();
        return view('user.laporan', compact('trans'));
    }

    public function dataLaporan($x, $y)
    {
        $data =  DB::table('transactions')
        ->select('transactions.status','ext','order_number','name','weight','price','payment_type','transactions.created_at')
        ->leftJoin('costumers','costumers.id','=','transactions.costumer_id')
        ->whereMonth('transactions.created_at','>=', $x)
        ->whereMonth('transactions.created_at','<=', $y)
        ->get();
        
        dd($data);
        return $data;
    }
}
