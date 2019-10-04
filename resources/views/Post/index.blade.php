<div class="content mt-5">
    @if(isset($all_post_by_user))
        @foreach($all_post_by_user as $post)
            <div class="row mt-2 p-2">
                <div class="col-sm-12">
                    <h5>{{ $post->comment }}</h5>
                </div>
            </div>
        @endforeach
    @endif
</div>