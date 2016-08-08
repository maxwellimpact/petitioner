<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Gate;
use App\Http\Requests;
use App\Petition;

class PetitionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petitions = Auth::user()->petitions()
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(10);
        
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
        
        return redirect()->action('PetitionController@index')
                         ->with('create', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Petition $petition)
    {
        if(Auth::guest() && !$petition->published) {
            abort(404);
        } else if(Auth::check() && !$petition->published && Gate::denies('view', $petition)) {
            abort(403);
        }
        
        return view('petition.show', ['petition' => $petition]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Petition $petition)
    {
        
        if(Gate::denies('view', $petition)) {
            abort(403);
        }
        
        return view('petition.edit', ['petition' => $petition]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petition $petition)
    {
        if(Gate::denies('view', $petition)) {
            abort(403);
        }
        
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required',
            'body' => 'required',
        ]);
        
        $petition->fill($request->all());
        $petition->save();
        
        $request->session()->flash('update', true);
        
        return redirect()->action('PetitionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        if(Gate::denies('view', $petition)) {
            abort(403);
        }
        
        $petition->delete();
        
        return back()->with('delete', true);
    }
}
