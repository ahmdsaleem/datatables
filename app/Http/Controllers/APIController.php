<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getUsers()
    {
        $query = User::select('name', 'email', 'created_at');
        return datatables($query)->make(true);
        //return datatables()->of(User::query())->toJson();
       // return datatables()->of(DB::table('users'))->toJson();
    }
}
