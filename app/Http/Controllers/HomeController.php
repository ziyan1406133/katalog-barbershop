<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barbershop;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'homepage']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homepage()
    {
        $barbershops = Barbershop::where('status', 'Terverifikasi')->inRandomOrder()->limit(8)->get();
        return view('homepage', compact('barbershops'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}
