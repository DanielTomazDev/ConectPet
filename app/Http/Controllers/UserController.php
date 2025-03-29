<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function Show($id)
    {
        if(!$user = $this->model->find($id))
            return redirect()->back();

        return view('users.show', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(storeUpdateUserRequest $request)
    {
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->image){
            $file = $request['image'];
            $path = $file->store('profile', 'public');
            $data['image'] = $path;
        }

        $this->model->create($data);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        $data = $request->except("password", "password_confirmation");
        if ($request->has("password")) {
            $data['password'] = bcrypt($request->password);
            $data['password_confirmation'] = bcrypt($request->password_confirmation);
        }

        if($request->image){
            $file = $request['image'];
            $path = $file->store('profile', 'public');
            $data['image']= $path;
        }

        $data['is_admin'] = $request->admin? 1 : 0;

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }

}
