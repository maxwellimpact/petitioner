<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Gate;
use App\Http\Requests;
use App\Petition;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petitions = Auth::user()->petitions()->paginate(10);
        
        return view('petition.index', ['petitions' => $petitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Petition $petition)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required',
            'body' => 'required',
        ]);
        
        $petition->fill($request->all());
        
        Auth::user()->petitions()->save($petition);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Petition $petitions)
    {
        if(Auth::guest() && !$petitions->published) {
            abort(404);
        } else if(Auth::check() && Gate::denies('view', $petitions)) {
            abort(403);
        }
        
        return view('petition.show', ['petition' => $petitions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Petition $petitions)
    {
        
        if(Gate::denies('view', $petitions)) {
            abort(403);
        }
        
        return view('petition.edit', ['petition' => $petitions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petition $petitions)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required',
            'body' => 'required',
        ]);
        
        $petitions->fill($request->all());
        $petitions->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
