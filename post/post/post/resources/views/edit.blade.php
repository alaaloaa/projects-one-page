@extends('layouts.app')

@section('content') 

  <form method="POST" enctype="multipart/form-data">               
        {{ csrf_field() }}                         
        <div class="form-group">
            <textarea class="form-control textarea" name="body" placeholder="Write Your Post..."></textarea>
        </div>
        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}" style="margin-bottom: 0">
            <input class="form-control image" name="image" type="file">
            @if ($errors->has('image'))
                <span class="help-block msg-fadeOut">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <div style="margin-top: 10px">
          <button type="submit" class="btn main-btn pull-right btn-primary">Post</button>
        </div>
  </form>

@endsection