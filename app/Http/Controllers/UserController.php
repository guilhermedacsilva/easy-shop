<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use EasyShop\Model\User;
use EasyShop\Http\Traits\CrudActions;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    use CrudActions;

    public function __construct() {
        $this->initCrud('User');
    }

    protected function getStoreValidationArray($request)
    {
        return [
            'name' => 'required|between:1,255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    protected function getUpdateValidationArray($request, $record)
    {
        return [
            'name' => 'required|between:1,255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($record->id),
            ],
            'note' => '',
        ];
    }

    protected function createStoreData($request, $fields)
    {
        return array_merge($request->only('name','email','note'),[
            'password' => bcrypt($request->input('password')),
        ]);
    }

    public function editPassword($id)
    {
        return view('layouts.simple_page', $this->createViewData([
            'includeView' => $this->getCrudRoute('form_password'),
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

}
