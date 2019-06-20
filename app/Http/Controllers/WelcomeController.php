<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 *  This is a class responsible for the landing page
 */
class WelcomeController extends Controller
{
	
	public function index(){

		return view('welcome');
	}
}