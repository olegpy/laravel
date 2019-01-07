<?php

namespace App\Http\Controllers;

use App\Http\Services\Contracts\UserServiceContract;
use Illuminate\Http\Request;

class HomeController extends Controller
{
//    /** @var UserServiceContract */
//    protected $userContract;

    public function __construct()
    {
        $this->middleware('auth');

//        $this->userContract = $userServiceContract;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $users = $this->userContract->list();
//        return view('index')->with(['proposals' => $proposals]);
    }
}
