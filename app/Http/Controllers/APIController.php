<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getUsers()
    {
//        $query = User::select('id','name', 'email');
//        return datatables($query)->make(true);
//        //return datatables()->of(User::query())->toJson();
       // return datatables()->of(DB::table('users'))->toJson();

        $user = User::all();
        return datatables($user)
            ->addColumn('action',function($user)
            {
                return '<a onclick="deleteData('.$user->id.')"> Delete </a>';
            })->make(true);

//        return Datatables::of($user)
//            ->addColumn('action', function($user){
//                return '<a onclick="deleteData('. $user->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
//            })
//            ->rawColumns(['action'])->make(true);


    }
}
