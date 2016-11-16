<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Create extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password','image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*public function rules()
	{
	    return [
	        'title' => 'required|unique:posts|max:255',
	        'body' => 'required',
	    ];
	}*/
}
