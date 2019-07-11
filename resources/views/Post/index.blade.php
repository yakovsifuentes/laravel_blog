@extends('master.layouts.master')
@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Listado de Post</h1>
            <p class="lead">Listado de Post del Usuario.</p>
            <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">Crear Post</a>
        </div>
    </div>

@endsection