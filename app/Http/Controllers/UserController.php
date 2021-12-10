<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Validator;
use Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

    public function dataLaporan(Request $request)
    {
        $data =  DB::table('transactions')
        ->select('transactions.status','ext','order_number','name','weight','price','payment_type','transactions.created_at')
        ->leftJoin('costumers','costumers.id','=','transactions.costumer_id')
        ->whereDate('transactions.created_at','>=', $request->x)
        ->whereDate('transactions.created_at','<=', $request->y)
        ->get();
        $i = 1;
        $data = array_map(function($x) use ($i) {
            $json = json_decode($x->ext);
            $layanan = DB::table('service')->where('id', $json->service_id)->first();
            $x->no = $i++;
            $x->no_order = $layanan->code.'-'.$x->order_number;
            $x->layanan = $layanan->name;
            $x->pembayaran = ($x->payment_type == 1)?'Lunas':'Belum Lunas';
            $x->total = number_format($x->price,0,',','.');
            $x->status = $this->status($x->status);
            unset($x->ext);
            unset($x->order_number);
            unset($x->price);
            return $x;
        },$data->toArray());

        return response()->json($data);
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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
    
}
