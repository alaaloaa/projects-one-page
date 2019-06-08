@extends('layouts.app')

@section('content') 

 <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 post-form">
                <form method="POST" action="{{ route('post/update', ['id' => $post->id]) }}" enctype="multipart/form-data">               
                    {{ csrf_field() }}                         
                    <div class="form-group">
                        <textarea class="form-control textarea" name="body" placeholder="Write Your Post...">{{$post->body}}</textarea>
                    </div>
                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}" style="margin-bottom: 0">
                        <input class="form-control image" name="image" type="file">
                        @if ($errors->has('image'))
                            <span class="help-block msg-fadeOut">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="button">
                      <button type="submit" class="btn main-btn pull-right btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection