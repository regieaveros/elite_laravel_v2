<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = DB::table('users')
            ->leftJoin('usertypes', 'users.usertype_id', '=', 'usertypes.id')
            ->select('users.*', 'usertypes.usertype as type')
            ->get();

        return response()->json($data);
    }

    public function users()
    {
        return view('admin.user.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Usertype::get();
        return view('admin.user.create', compact('data'));
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
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'username' => ['required', 'max:10', 'unique:users'],
            'password' => ['required', 'max:20', 'confirmed', 'regex:/^[A-Za-z0-9]+$/'],
            'usertype' => 'required',
        ]);

        $data = new User();
        $data->firstname = $request['firstname'];
        $data->lastname = $request['lastname'];
        $data->middlename = $request['middlename'];
        $data->username  = $request['username'];
        $data->password  = Hash::make($request['password']);
        $data->usertype_id   = $request['usertype'];
        $data->save();

        Session::flash('message', 'User was added successfully!');
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
    public function edit(User $user, $id)
    {
        $user = $user->find($id);
        $usertypes = Usertype::get();

        return view('admin.user.edit', compact('user', 'usertypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = User::find($id);

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'username' => ['required', 'max:10'],
            'usertype' => 'required',
        ]);

        if (!empty($request['password'])) {
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'middlename' => 'required',
                'username' => ['required', 'max:10'],
                'password' => ['required', 'max:20', 'confirmed', 'regex:/^[A-Za-z0-9]+$/'],
                'usertype' => 'required',
            ]);

            $data->password = Hash::make($request['password']);
        }

        $data->firstname = $request['firstname'];
        $data->lastname = $request['lastname'];
        $data->middlename = $request['middlename'];
        $data->username  = $request['username'];
        $data->usertype_id   = $request['usertype'];
        $data->save();

        Session::flash('message', 'User was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
