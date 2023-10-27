<?php

namespace App\Http\Controllers;

use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Usertype::get();
        return response()->json($data);
    }

    public function usertypes()
    {
        return view('admin.usertype.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usertype.create');
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
            'usertype' => 'required',
            'restriction' => 'required',
        ]);

        $data = new Usertype();
        $data->usertype = $request['usertype'];
        $data->restriction = json_encode($request['restriction']);
        $data->save();

        Session::flash('message', 'User Type was added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function show(Usertype $usertype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function edit(Usertype $usertype, $id)
    {
        $data = $usertype->find($id);

        return view('admin.usertype.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'usertype' => 'required',
            'restriction' => 'required',
        ]);

        $usertype = Usertype::find($id);
        $usertype->usertype = $request->input('usertype');
        $usertype->restriction = json_encode($request['restriction']);
        $usertype->save();

        Session::flash('message', 'User Type was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usertype $usertype, $id)
    {
        $usertype = Usertype::find($id);
        $usertype->delete();
    }
}
