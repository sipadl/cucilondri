<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

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
        $user = Auth::user();
        if($user->role == 0){
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
            $stok = DB::table('stok')->where('user_id', $user->id)->get();
        }else{
            $service = DB::table('service')->where('status', 1)->get();
            $customer = DB::table('costumers')->where('user_id',$user->id)->where('status', 1 )->get();
            $transaction = DB::table('transactions')
            ->leftJoin('costumers','costumers.id','transactions.costumer_id')
            ->where('transactions.id_user',$user->id)
            ->paginate(10);
            
            
            $profit = DB::table('transactions')
            ->leftJoin('costumers','costumers.id','transactions.costumer_id')
            ->whereMonth('transactions.created_at', date('m'))
            ->where('transactions.id_user',$user->id)
            ->where('payment_type', 1)->sum('price');
            
            $piutang = DB::table('transactions')
            ->leftJoin('costumers','costumers.id','transactions.costumer_id')
            ->whereMonth('transactions.created_at', date('m'))
            ->where('transactions.id_user',$user->id)
            ->where('payment_type', 0)->sum('price');        
            
            $proses = $this->count_transaction([0,1,2,3], $user);
            $berhasil = $this->count_transaction([4], $user);
            $gagal = $this->count_transaction([5], $user);
            $stok = DB::table('stok')->where('user_id', $user->id)->get();
        }

        return view('user.index',compact('service','customer','transaction',
        'profit','piutang','proses','berhasil','gagal','stok'));
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
        $user = DB::table('users')->where('id', $id)->first();
        return response()->json($user);
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
        $delete = DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('msg','Berhasil Menghapus Cabang');
    }
    
    public function deaktif($id)
    {
        $delete = DB::table('users')->where('id', $id)->update([
            'status' => 0
        ]);
        return redirect()->back()->with('msg','Berhasil Menonaktifkan Cabang');

    }

    function count_transaction($status, $user = null)
    {
        $trans = DB::table('transactions')
        ->whereMonth('created_at',date('m'))
        ->whereIn('status', $status);
        if($user)
        {
            $trans->where('id_user', $user->id);
        }
        $trans = $trans->count();

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
        $user = Auth::user();
        $data =  DB::table('transactions')
        ->select('users.name as cabang','transactions.status','ext','order_number','costumers.name','weight','price','payment_type','transactions.created_at')
        ->leftJoin('costumers','costumers.id','=','transactions.costumer_id')
        ->leftJoin('users','users.id', 'transactions.id_user')
        ->whereDate('transactions.created_at','>=', $request->x)
        ->whereDate('transactions.created_at','<=', $request->y);
        if($user->role == 0 ){
            $data->where('id_user', $user->id);
        }
        $data = $data->get();
        $data = array_map(function($x) use ($user) {
            $json = json_decode($x->ext);
            $layanan = DB::table('service')->where('id', $json->service_id)->first();
            if($user->role == 1){
                $x->cabang = $x->cabang;
            }
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

    public function password()
    {
        return view('user.password');
    }

    public function ubahPassword(Request $request)
    {  
        $user = Auth::user();
        $rules = [
            'password_old' => 'required',
            'password_new' => 'required',
            'password_confirmation' => 'same:password_new'
        ];
        $validator = Validator::make($request->except('_token'), $rules);
        if($validator->passes())
        {
            $cek = Hash::check($request->password_old, $user->password);
            if($cek)
            {
                DB::table('users')->where('id', $user->id)->update(
                    ['password' => Hash::make($request->password_new)]
                );
            }
        }
        return redirect()->back()->with('msg', $validator->errors()->first()??(!$cek)?'Cek kembali password lama anda':'Berhasl');
    }
    
}
