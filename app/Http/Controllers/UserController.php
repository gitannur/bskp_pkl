<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $title = 'Karyawan';
        return view('user.index', compact('users','title'));
    }

}
