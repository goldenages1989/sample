<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show','create','store','index','confirmEmail']
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
	    $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(30);
        return view('users.show', compact('user','statuses'));
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

//        Auth::login($user);
//        session()->flash('success','A new jour has begin!');
//        return redirect()->route('users.show',[$user]);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success','A mail has been send to your email.');
        return redirect('/');

    }

    public function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = "感谢注册 Sample 应用！请确认你的邮箱。";

        Mail::send($view, $data, function($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token) {
        $user = User::where('activation_token',$token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);

        session()->flash('success','恭喜你,激活成功!');
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
