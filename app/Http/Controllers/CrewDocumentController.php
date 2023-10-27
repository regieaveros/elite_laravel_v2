<?php

namespace App\Http\Controllers;

use App\Models\CrewDocument;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CrewDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = $request['crew_id'];

        $request->validate([
            'code' => 'required',
            'doctype' => 'required',
            'docname' => 'required',
            'docnum' => 'required',
            'docfile' => 'mimes:pdf',
            'dateissued' => 'required',
            'dateexpire' => 'required',
        ]);

        $data = new CrewDocument();

        if ($request->hasFile('docfile')) {
            $document = $request->file('docfile');
            $publicPath = public_path('files/' . $id);
            $documentPath = $publicPath . '/' . uniqid() . '.' . $document->getClientOriginalExtension();
            $document->move($publicPath, $documentPath);
            $file = basename($documentPath);

            $folderPath = 'files/' . $id . '/' . $file;
            $data->docpath = $folderPath;
        }

        $user = Auth::user()->firstname . ' ' . Auth::user()->middlename . ' ' . Auth::user()->lastname;

        $data->crew_id  = $id;
        $data->code = $request['code'];
        $data->doctype = $request['doctype'];
        $data->docname = $request['docname'];
        $data->docnum = $request['docnum'];
        $data->dateissued = $request['dateissued'];
        $data->dateexpire = $request['dateexpire'];
        $data->uploadedby = $user;
        $data->save();

        Session::flash('message', 'Crew Document was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CrewDocument  $crewDocument
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('crew_documents')
            ->leftJoin('documents', 'crew_documents.doctype', '=', 'documents.id')
            ->select('crew_documents.*', 'documents.name as doctypename')
            ->where('crew_documents.crew_id', $id)
            ->get();

        foreach ($data as $crewdocument) {
            $newdate = new DateTime();
            $dateexpire = new DateTime($crewdocument->dateexpire);
            $difference = $newdate->diff($dateexpire);
            if ($difference->days <= 7) {
                $crewdocument->color = "red";
            } elseif ($difference->days <= 30) {
                $crewdocument->color = "yellow";
            } elseif ($difference->days <= 90) {
                $crewdocument->color = "orange";
            } else {
                $crewdocument->color = "transparent";
            }
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CrewDocument  $crewDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(CrewDocument $crewDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CrewDocument  $crewDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrewDocument $crewDocument, $id)
    {

        $crew_id = $request['crew_id'];

        $request->validate([
            'code' => 'required',
            'doctype' => 'required',
            'docname' => 'required',
            'docnum' => 'required',
            'dateissued' => 'required',
            'dateexpire' => 'required',
        ]);

        $data = CrewDocument::find($id);

        if ($request->hasFile('docfile')) {

            $request->validate([
                'docfile' => 'mimes:pdf',
            ]);

            $document = $request->file('docfile');
            $publicPath = public_path('files/' . $crew_id);
            $documentPath = $publicPath . '/' . uniqid() . '.' . $document->getClientOriginalExtension();
            $document->move($publicPath, $documentPath);
            $file = basename($documentPath);

            $folderPath = 'files/' . $id . '/' . $file;
            $data->docpath = $folderPath;
        }

        $data->code = $request['code'];
        $data->doctype = $request['doctype'];
        $data->docname = $request['docname'];
        $data->docnum = $request['docnum'];
        $data->dateissued = $request['dateissued'];
        $data->dateexpire = $request['dateexpire'];
        $data->save();

        Session::flash('message', 'Crew Document was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CrewDocument  $crewDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crew = CrewDocument::find($id);
        $crew->delete();
    }
}
