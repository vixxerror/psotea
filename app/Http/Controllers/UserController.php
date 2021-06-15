<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Query\Builder;
class UserController extends Controller
{
    public function index()
    {
        //$users = DB::table('users')->get();
      

        $users = Auth::id();
        $posts = User::where('_id', '=', $users)->get();
        return view('users.edit', compact('posts'));

       
    }

    public function show(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email'.$user->id,
            'password' => '',
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect('/users');
    }

    public function destroy( $id)
    {
        
              
            $user = User::find($id);
           
            $posts = Post::where('user_id', '=', $id);
             $posts->delete();
            $user->delete();
             return redirect('/posts');      
             

    }
   

 
}
