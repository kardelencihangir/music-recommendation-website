@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action = "/home" method = "post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Song Name</th>
                            <th scope="col">Artist</th>
                            <th scope="col">Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($songs as $song)
                            <tr>
                            <td name='title'>{{$song->title}}</td>
                            <td name='artist'>{{$song->artist_name}}</td>
                            <!-- below it takes the id of the song but displays the year to the user. -->
                            <td><input type="radio" name="song_id" value="{{$song->song_id}}"> <label>{{$song->year}}</label></td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <input type = 'submit' value = "Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>

function ShowHideDiv() {
    var chk = document.getElementById("chk");
    var dvtext = document.getElementById("dvtext");
    dvtext.style.display = chk.checked ? "block" : "none";
    }
</script> -->

@endsection

