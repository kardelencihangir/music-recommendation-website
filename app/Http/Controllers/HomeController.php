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
        $songs = DB::table('songs_metadata_file')->inRandomOrder('1234')->paginate(15);
        return view('home', ['songs' => $songs]);
    }
    public function store(Request $request){
        //$song = $request->all();
        //$song_id = $song['song_id'];
        // $this->validate($request, [
        //     'song_id' => 'required',
        // ]);
        //$data = array('user_id'=>1, 'song_id'=>$song_id, 'listen_count'=>1);
        //DB::table('triplets_file')->insert($data);

        $song_id = $request->ajax('song_id');
        $data=array('user_id'=>1, 'song_id'=>$song_id, 'listen_count'=>1);
        DB::table('triplets_file')->insert($data);
                
        // $song_id = $request->input('song_id');
        // $data = array('user_id'=>1, 'song_id'=>$song_id, 'listen_count'=>1);
        // DB::table('triplets_file')->insert($data);
        // }
            
    }
}