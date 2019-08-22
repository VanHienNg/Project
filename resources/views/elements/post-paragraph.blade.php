@foreach ($posts as $post)
@if(auth()->check())
<div class="col-xl-4 col-md-6 mb-4 post-item" style="height:170px" id="post_id_{{ $post -> id }}" data-id="{{ auth()->user()->id }}">
@else
<div class="col-xl-4 col-md-6 mb-4 post-item" style="height:170px" id="post_id_{{ $post -> id }}">
@endif
    <div class="card border-left-primary shadow h-100">
        <div class="card-body" style="padding: 0 1.25rem">
            <div class="row no-gutters align-items-center">
            @if(auth()->check())
                @if(auth()->user()->id == $post->user_id || auth()->user()->role == 'admin')
                <div class="col-12 text-right" style="margin-bottom:5px">
                    <button class="btn" style="font-size:12px" id="delete-post"
                        data-id="{{ $post -> id }}"><i class="fas fa-window-close" style="font-size:20px; color:red"></i></button>
                </div>
                @else
                <div class="col-12 text-right" style="margin-bottom:5px; height:36px">
                    
                </div>
                @endif
            @else 
            <div class="col-12 text-right" style="margin-bottom:5px; height:36px">
                    
            </div>
            @endif
            <div class="col-12 mr-2" style="height:50px" id="post-paragraph" data-id="{{ $post -> id }}">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="width:100%; height:32px">{{ $post -> title }}</div>
                <textarea class="h6 mb-0" readonly
                    style="border:none; overflow:hidden; box-shadow:none; width:100%">{{ $post -> body }}</textarea>
            </div>
            @if(auth()->check())
                @php($like = 0)
                @php($dislike = 0)
                @foreach($post->feedback as $feedback)
                    @if($feedback->feedback == 1) 
                        @php($like++)
                    @endif
                    @if($feedback->feedback == 0) 
                        @php($dislike++)
                    @endif
                @endforeach
                <div class="col-12 text-right" style="margin-top:40px">
                    <button class="btn far fa-thumbs-up feedback-btn" id="like-btn-{{ $post -> id }}" name="like-btn" data-id="{{ $post -> id }}" value="1">
                        <label class="fb-value" id="like-{{ $post->id }}" for="like-btn" value="{{ $like }}">{{ $like }}</label>
                    </button>
                    <button class="btn far fa-thumbs-down feedback-btn" id="dislike-btn-{{ $post -> id }}" name="dislike-btn" data-id="{{ $post -> id }}" value="0">
                        <label class="fb-value" id="dislike-{{ $post->id }}" for="dislike-btn" value="{{ $dislike }}">{{ $dislike }}</label>
                    </button>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endforeach
