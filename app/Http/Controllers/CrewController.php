<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('crews')
            ->leftJoin('ranks', 'crews.rank', '=', 'ranks.id')
            ->select('crews.*', 'ranks.name as rankname', 'ranks.code as rankcode')
            ->get();

        foreach ($data as $crew) {
            $weight = $crew->weight;
            $height = $crew->height;
            $bmi = $weight / ($height * $height);

            if ($bmi < 18.5) {
                $category = "Underweight";
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $category = "Normal Weight";
            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                $category = "Overweight";
            } else {
                $category = "Obesity";
            }

            $crew->bmi = $category;
        }

        return response()->json($data);
    }

    public function crews()
    {
        return view('admin.crew.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Rank::get();
        return view('admin.crew.create', compact('data'));
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
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email', 'unique:crews'],
            'birthdate' => 'required',
            'age' => 'required',
            'address' => 'required',
            'rank' => 'required',
            'height' => 'required',
            'weight' => 'required',
        ]);

        $data = new Crew();
        $data->firstname = $request['firstname'];
        $data->middlename = $request['middlename'];
        $data->lastname = $request['lastname'];
        $data->email = $request['email'];
        $data->birthdate = $request['birthdate'];
        $data->age = $request['age'];
        $data->address = $request['address'];
        $data->rank = $request['rank'];
        $data->height = $request['height'];
        $data->weight = $request['weight'];
        $data->save();

        Session::flash('message', 'Crew was added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('crews')
            ->leftJoin('ranks', 'crews.rank', '=', 'ranks.id')
            ->select('crews.*', 'ranks.name as rankname', 'ranks.code as rankcode')
            ->where('crews.id', $id)
            ->first();

        $weight = $data->weight;
        $height = $data->height;
        $bmi = $weight / ($height * $height);

        if ($bmi < 18.5) {
            $category = "Underweight";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $category = "Normal Weight";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $category = "Overweight";
        } else {
            $category = "Obesity";
        }
        $data->bmi = $category;

        $crew = json_encode($data);

        return view('admin.crew.show', compact('id', 'crew'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function edit(Crew $crew, $id)
    {
        $ranks = Rank::get();
        $crew = $crew->find($id);
        return view('admin.crew.edit', compact('ranks', 'crew'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crew $crew, $id)
    {
        $data = Crew::find($id);

        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email'],
            'birthdate' => 'required',
            'age' => 'required',
            'address' => 'required',
            'rank' => 'required',
            'height' => 'required',
            'weight' => 'required',
        ]);

        $data->firstname = $request['firstname'];
        $data->middlename = $request['middlename'];
        $data->lastname = $request['lastname'];
        $data->email = $request['email'];
        $data->birthdate = $request['birthdate'];
        $data->age = $request['age'];
        $data->address = $request['address'];
        $data->rank = $request['rank'];
        $data->height = $request['height'];
        $data->weight = $request['weight'];
        $data->save();

        Session::flash('message', 'Crew was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crew $crew, $id)
    {
        $crew = Crew::find($id);
        $crew->delete();
    }
}
