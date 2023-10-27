<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rank::get();
        return response()->json($data);
    }

    public function ranks()
    {
        return view('admin.rank.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rank.create');
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
            'code' => 'required',
            'name' => 'required',
            'alias' => 'required',
        ]);

        $data = new Rank();
        $data->code = $request['code'];
        $data->name = $request['name'];
        $data->alias = $request['alias'];
        $data->save();

        Session::flash('message', 'Rank was added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rank $rank, $id)
    {
        $data = $rank->find($id);
        return view('admin.rank.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rank $rank, $id)
    {
        $data = Rank::find($id);

        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'alias' => 'required',
        ]);

        $data->code = $request['code'];
        $data->name = $request['name'];
        $data->alias = $request['alias'];
        $data->save();

        Session::flash('message', 'Document was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rank $rank, $id)
    {
        $document = Rank::find($id);
        $document->delete();
    }
}
