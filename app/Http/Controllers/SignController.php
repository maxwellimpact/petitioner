<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Petition;
use App\Sign;
use App\Http\Requests;

class SignController extends Controller
{
    public function store(Request $request, Petition $petition, Sign $sign)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
        ]);
        
        $sign->fill($request->all());
        $petition->signs()->save($sign);
        
        $request->session()->flash('success', true);
        
        return redirect(action('PetitionController@show', [
            $petition->id
        ]));
    }
}
