<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show','create','store','index']
        ]);
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }


    //
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        try {
            $this->authorize('update', $user);

            $data = [
                'name' => $request->name
            ];

            if($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);

            session()->flash('success','更新成功');

            return redirect()->route('users.show', $user->id);
        } catch(AuthenticationException $e) {
            return abort(403, '您无权访问');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);
        session()->flash('success','A new jour has begin!');
        return redirect()->route('users.show',[$user]);
    }

    public function destroy(User $user)
    {
//        $this->authorize('destroy', $user);

        $user->delete();

        session()->flash('success','删除用户成功');
        return redirect()->back();
    }

}
