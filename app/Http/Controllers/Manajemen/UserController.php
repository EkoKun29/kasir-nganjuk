<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $roles = collect([
            ['role' => 'admin'],
            ['role' => 'qc'],
            ['role' => 'operator'],
        ]);
        $data = User::all();
        return view('manajemen.user.index', compact('data', 'roles'));
    }


    public function store(Request $request)
    {
        $role = Role::where('name', $request->role_name)->first();
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        $user->assignRole($role);
        return redirect()->back();
    }
}
