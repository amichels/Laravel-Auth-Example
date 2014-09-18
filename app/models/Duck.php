<?php
// app/models/Duck.php

class Duck extends Eloquent {

	protected $fillable = array('name', 'email', 'password');

	public static $rules = array(
		'name'             => 'required', 						// just a normal required validation
		'email'            => 'required|email|unique:ducks', 	// required and must be unique in the ducks table
		'password'         => 'required',
		'password_confirm' => 'required|same:password' 			// required and has to match the password field
	);

	// create custom validation messages ------------------
	public static $messages = array(
		'required' => 'The :attribute is really really really important.',
		'same' 	=> 'The :others must match.'
	);

}