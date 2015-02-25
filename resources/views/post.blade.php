@extends('app')

@section('content')
    <div class="container">

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <h3>Current Posts:</h3>
        <div class="well">
            @forelse ($posts as $post)
                <h5>{{ $post['title'] }}</h5>
                <p>{{ $post['body'] }}</p>
                <hr>
            @empty
                <p>None</p>
            @endforelse
        </div>

        <div class="alerts">
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6">
                <form rel="form" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" value="" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <textarea name="body" rows="5" class="form-control" placeholder="Body"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
