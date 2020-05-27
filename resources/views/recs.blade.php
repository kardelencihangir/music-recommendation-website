@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Recommendations</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Song Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($songs as $song)
                            <tr>
                            <td name='title'>{{$song}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
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

