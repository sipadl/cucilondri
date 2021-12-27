<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class MitraController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->paginate(25);
        $users = array_map(function($x){
            $y['id'] = $x->id;
            $y['name'] = $x->name??'Pelanggan Setia';
            $y['phone'] = $x->phone??'kosong';
            $y['role'] = ($x->role == 1 )?'Administrator':'Cabang';
            $y['status'] = ($x->status == 1)?'Aktif':'Non Aktif';
            $y['piutang'] = DB::table('transactions')->where('id_user', $x->id)->where('payment_type', 0)->sum('price');
            $y['keuntungan'] = DB::table('transactions')->where('id_user', $x->id)->where('payment_type', 1)->sum('price');
            return $y;
        },$user->toArray()['data']);
        return view('user.mitra', compact('users','user'));
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make('123456789a'),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 0
        ];

        $data = DB::table('users')->insert($input);
        return redirect()->back()->with('msg','Berhasil mengubah data');
    }

    public function update(Request $request)
    {
        $data = DB::table('users')->where('id', $request->id)->update($request->except(['_token','id']));
        return redirect()->back()->with('msg','Berhasil mengubah data');
    }
}
