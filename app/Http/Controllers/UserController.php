<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('super_admin');
        $users = User::whereNot('admin_level', 1)->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('super_admin');
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('super_admin');
        $cookie = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 16);
        $validator = $request->validate([
            'email' => 'unique:users',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hash' => $cookie,
            'admin_level' => $request->admin_level,
        ]);
        if ($user) {
            return to_route('user.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('super_admin');
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('super_admin');
        $cookie = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 16);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->hash = $cookie;
        $user->save();
        return back()->with('message', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('super_admin');
        $user->delete();
        return back()->with('warning', 'User Trashed!');
    }

    public function trash_list()
    {
        $this->authorize('super_admin');
        $users = User::onlyTrashed()->whereNotIn('admin_level', [0, 1])->get();
        return view('admin.users.trash', compact('users'));
    }

    public function user_permanent_destroy($id)
    {
        $this->authorize('super_admin');
        User::onlyTrashed()->find($id)->forceDelete();
        return back()->with('error', 'User Delete Permanently!');
    }
    public function user_restore($id)
    {
        $this->authorize('super_admin');
        User::withTrashed()->find($id)->restore();
        return back()->with('message', 'User Restored!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $cookie = $request->cookie('admin_hash');
        $user = User::where('email', $request->email)->where('hash', $cookie)->first();
        // dd($user);
        if ($user) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return to_route('admin.dashboard');
            }
            return redirect("admin/login")->with('info', 'Login details are not valid');
        }
        return redirect("admin/login")->with('info', 'Login details are not valid');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return to_route('home');
    }
}
