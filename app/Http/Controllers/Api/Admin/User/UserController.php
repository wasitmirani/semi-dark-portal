<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $q=request('query');
        $user=User::where('name', 'like', '%' . $q . '%')
        ->Orwhere('name', 'like', '%' . $q . '%')
        ->latest()->paginate(env('PER_PAGE'));
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'min:3','max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $request->validate([
            'name' => ['required', 'string', 'min:3','max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$request->id],
        ]);

        if($request->password!=""){
              $request->validate([
                    'password' => ['required', 'string', 'min:8'],
              ]);
            User::where('id',$request->id)->update(['password'=>Hash::make($request->password)]);
        }
// 'password' => Hash::make($request->password),
          $user=User::where('id',$request->id)->first();
          $user->update([
            'name'=>$request->name,
            'email'=>$request->email,

        ]);

        return response()->json($user,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $del=User::destroy($request->id);
        if($del){
            return response()->json($del);
        }
        //
    }

    public function filter_dateby(Request $request){

        $users =User::where('created_at', '>=',$request->startdate)
                           ->where('created_at', '<=', $request->enddate)
                           ->paginate(env('PER_PAGE'));

        return response()->json($users);

    }
    public function search(){
        $query=request('query');
        $users=User::where('name', 'like', '%' . $query. '%')
        ->Orwhere('email', 'like', '%' . $query. '%')
        ->orderBy('name','ASC')->paginate(env('PER_PAGE'));
        return response()->json($users);
    }
}
