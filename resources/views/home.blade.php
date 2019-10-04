@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/dropzone.css') }}" rel="stylsheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mis Publicaciones</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_post">
                                +
                            </button>
                        </div>
                        <div class="col-md-8">
                            <h5 class="float-right">Informacion personal del usuario</h5>
                        </div>
                    </div>
                    @include('Post.index')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="create_post" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" >Crear Publicacion</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.post.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <!--<input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">-->
                            <!-- DropZone -->
                            <div class="container col-12 col-sm-8">
                                <div class="jumbotron text-center dropzone margin-t-40" id="uploadPhotoPanel">
                                    <div class="text-center dz-message">
                                        <div class="row justify-content-center">
                                            <div class="col-8">
                                                @if(isset($user->photo))
                                                    <img class="panel-icon" src="{{ $user->photo->file_url }}" height="80" width="80" />
                                                @else
                                                    <img class="panel-icon" src="{{ asset('img/icons/image.png') }}" height="80" width="80"/>
                                                @endif
                                                <h2 class="text-center red">Comparte una Imagen</h2>
                                                <p class="text-center gray ">Presiona aquí o arrastra la imagen para subir la imagen de la publicacion.</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if(old('photo_id'))
                                        <?php $media = \App\Models\Media::find(old('photo_id')); ?>
                                        <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">  <div class="dz-image" style="width: 120px; height: 120px; background-size: cover; background-position: center; background-image:  url({{ $media->file_url }})"></div>  </div>
                                    @endif
                                </div>
                                @if(isset($user->photo_id))
                                    <input type="hidden" id="photo_id" name="photo_id" value="{{ $administrator->photo_id }}"/>
                                @else
                                    <input type="hidden" id="photo_id" name="photo_id" value="{{ old('photo_id') }}"/>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" placeholder="Tu comentario"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-sm btn-primary">Crear</button> </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {!! Html::script('js/dropzone.js'); !!}
    <script>
        Dropzone.autoDiscover = false;
        var map, initialPosition, marker, markerIcon;
        var currentFile = null;

        var imageDropzone = new Dropzone("div#uploadPhotoPanel",{
            url: '{{ route('api.v1.media.store') }}',
            maxFiles: 1,
            acceptedFiles: 'image/*',
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    $('.btn').prop( "disabled", true );
                    if (currentFile) {
                        this.removeFile(currentFile);
                    }
                    currentFile = file;
                });
            }

        });

        imageDropzone.on("success", function(file, response) {
            /* Maybe display some more file information on your page */
            if(response.status.code == 200){
                $('#photo_id').val(response.data.media.id);
            }
            $('.btn').prop( "disabled", false );
        });

        imageDropzone.on("maxfilesreached", function(file, response) {
            this.removeFile(file);
        });
    </script>
@endsection