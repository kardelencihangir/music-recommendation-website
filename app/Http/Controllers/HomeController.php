<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $songs = DB::table('songs_metadata_file')->paginate(15);
        return view('home', ['songs' => $songs]);
    }
    public function insert(Request $request){
        foreach($requests as $song) {
            if(isset($_POST['cb'])) {
                $song_id = $request->ajax('song_id');
                // $city_name = $request->input('city_name');
                $data=array('user_id'=>1, 'song_id'=>$song_id, 'listen_count'=>1);
                DB::table('triplets_file')->insert($data);
                }
        }
    }
}