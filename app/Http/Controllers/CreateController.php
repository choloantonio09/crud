<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Create;
use Illuminate\Support\Facades\Input;

class CreateController extends Controller
{
	

	public function displayAll() // DONE
    {
    	$create = Create::all();
    	return view('main')->with('create', $create);
    }

    public function store(Request $request) // DONE
    {
    	// $this->validate($request,[

    	// 	'name' => 'bail|required|max:255',
    	// 	'email' => 'bail|required|email|max:255',
    	// 	'password' => 'bail|required|max:255'

    	// 	]);

    	$create = new Create;
    	$create->name = $request->name;
    	$create->email = $request->email;
    	$create->password = md5($request->password);
    	$create->save();

    	$latest = Create::orderBy('created_at','desc')->first();
    	
    	return response()->json([

    		'newId' => $latest->id,
    		'newName' => $latest->name,
    		'newEmail' => $latest->email

    		]);
    }

    

    public function displayUpdate(Request $request)
    {

    	if($request->isMethod('get'))
    	{
    		$create2 = Create::find($request);
	    	$create = Create::all();
	    	return view('main',[
	    		'name' => $create2->name,
	    		'email' => $create2->email,
	    		'id' => $create2->id,
	    		'create' => $create,
	    		]);
    	}
    	
    }

    public function update(Request $request)
    {
    	$create = Create::find($request->id);
    	$create->name = $request->name;
    	$create->email = $request->email;
    	
    	$create->save();

    	return response()->json([
    		'name' => $create->name,
    		'email' => $create->email
    		]);

    }

    public function delete($id) //DONE
    {
    	
    	$create = Create::find($id);
    	$create->delete();
    	
    	return 'success';
    	
    }
}
