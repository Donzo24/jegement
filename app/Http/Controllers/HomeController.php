<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'documents' => Document::paginate(10)
        ]);
    }
}
