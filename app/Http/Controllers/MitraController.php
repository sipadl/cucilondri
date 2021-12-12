<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class MitraController extends Controller
{
    public function index()
    {
        $user = DB::table('users')
        ->leftJoin('transactions', 'transactions.id_user', 'users.id')->paginate(20);
        return view('user.mitra', compact('user'));
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
