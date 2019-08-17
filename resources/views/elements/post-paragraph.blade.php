@foreach ($posts as $post)
<div class="col-xl-4 col-md-6 mb-4" id="post_id_{{ $post -> id }}">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col-12 mr-2" id="post-paragraph" data-id="{{ $post -> id }}">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $post -> title }}</div>
                    <textarea class="h6 mb-0" readonly
                        style="border: none;overflow: hidden;box-shadow: none">{{ $post -> body }}</textarea>
                </div>
                @if(auth()->check())
                <div class="col-12">
                    <button class="btn btn-danger" style="font-size:12px" id="delete-post"
                        data-id="{{ $post -> id }}">Delete</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
