<?php

namespace App\Http\Controllers;

use App\Models\Game\Daily;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /** Application dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

}
