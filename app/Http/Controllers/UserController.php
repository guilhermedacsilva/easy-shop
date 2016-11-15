<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use EasyShop\Model\User;
use EasyShop\Http\Traits\CrudTrait;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    use CrudTrait;

    public function __construct() {
        $this->crudModelName = 'User';
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required',
        ]);

        $this->createUser($request->all());

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    protected function createUser($data) {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
            'note' => $data['note'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'type' => 'required',
        ]);

        $user->update($request->only('name','email','type','note'));
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function editPassword($id)
    {
        return view('layouts.simple_page', $this->createViewData([
            'includeView' => $this->getCrudRoute('_form_password'),
            'action' => 'edit',
            'record' => User::find($id),
        ]));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
        ]);

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('users.index')
                            ->with('danger','You cannot delete yourself');
        }
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function disable($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('users.index')
                            ->with('danger','You cannot disable yourself.');
        }
        $user = User::find($id);
        $user->disabled_at = $user->disabled_at ? null : Carbon::now();
        $user->save();
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
}
