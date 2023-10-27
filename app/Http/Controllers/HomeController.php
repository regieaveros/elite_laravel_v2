<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

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

        return view('single', compact('id', 'crew'));
    }
}
