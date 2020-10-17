<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class HomeController extends FrontendBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->frontendView('home.index');
    }
}
