@extends('master.layouts.master')



@section('content')
    <div class="container">
        <form action="{{ route('post.store') }}" method="post">
          @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Titulo</label>
                <input type="text" name="title" class="form-control" placeholder="Ingresa el titulo del post">
                <small class="form-text text-muted">Ingresa un titulo breve del post.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Comentario</label>
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
        </form>
    </div>
@endsection
@section