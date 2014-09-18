<?php
// app/routes.php

// route to show the duck form
Route::get('ducks', function(){
	return View::make('duck-form');
});

// route to process the ducks form
Route::post('ducks', function(){

	// process the form here

	// do the validation ----------------------------------
	// validate against the inputs from our form
	$validator = Validator::make(Input::all(), Duck::$rules, Duck::$messages);

	// check if the validator failed -----------------------
	if ($validator->fails()) {

		// get the error messages from the validator
		$messages = $validator->messages();

		// redirect our user back to the form with the errors from the validator
		return Redirect::to('ducks')
			->withErrors($validator)
			->withInput(Input::except('password', 'password_confirm'));

	} else {
		// validation successful ---------------------------

		// our duck has passed all tests!
		// let him enter the database

		// create the data for our duck
		$duck = new Duck;
		$duck->name     = Input::get('name');
		$duck->email    = Input::get('email');
		$duck->password = Hash::make(Input::get('password'));

		// save our duck
		$duck->save();

		// redirect ----------------------------------------
		// redirect our user back to the form so they can do it all over again
		return Redirect::to('ducks');

	}

});
