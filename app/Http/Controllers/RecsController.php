<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $auth = auth()->user();
        $auth_id = $auth->id;
        json_encode($auth_id); // burada recs rotasında ilk olarak bu çalışıp auth'un id'sini yayınlıyor.
        // $songs = json_decode(file_get_contents('http://localhost:5000/predict'), true);
        // return view('recs', ['songs' => $songs]);
    }
}
