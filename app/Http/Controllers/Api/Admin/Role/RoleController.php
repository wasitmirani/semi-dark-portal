<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //

    public function store(Request $request){
         $request->validate([
            'name' => ['required', 'string', 'max:255','unique:roles'],
        ]);

        $user_collection=User::WhereIn('id',$request->users)->get();
        $role = Role::create(['name' => $this->name]);

        $role->users()->attach($user_collection);

        return response()->json();

    }
    public function users(){
        $users=User::OrderBy('name','ASC')->get();
         return response()->json($users,200);
    }
}
