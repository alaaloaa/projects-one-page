@extends('layouts.app')

@section('content') 

 <!-- Create Post -->
    @if(session()->has('msg'))
        <div class="msg msg-fadeOut col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
            {!! session()->get('msg') !!}
        </div>
    @endif 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 post-form">
                <form method="POST" action="{{ route('post/create') }}" enctype="multipart/form-data">               
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
                    <div class="button">
                      <button type="submit" class="btn main-btn pull-right btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
          
            <!-- Show Posts --> 
     <div class="container">
        <div class="row">
            @if($posts->isNotEmpty())
            @foreach($posts as $post)

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 m post">
				  <div class="content">
					  <div class="txt">
                          <span class="pull-right icons">
                              <a href="{{route('post/edit', ['id' => $post->id])}}"><i class="fa fa-edit"></i></a> <a href="{{route('post/delete', ['id' => $post->id])}}"><i class="fa fa-remove"></i></a>
                          </span>
                          <div style="margin-bottom: 5px">
                              <span class="fa fa-plus"  style="float:left;width:15px; color: #999; 
                              position: relative;top: 2px">
                              </span>
                              <div><a href="#"><b>New Post</b></a></div>
                          </div>
                          <div>
                              @if(!empty($post->body))
                              <div style="">{{$post->body}}</div>
                              @endif
                          </div>
					   </div>

					  <div class="q">
                          @if(!empty($post->image))
						  <div class="image">
                            <div style="background: url({{$post->image}});"></div>
                          </div>
                          @endif
					  </div>
                  </div>
            </div>
            @endforeach
            @else
              <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2 posts-empty">There Is No Any Posts Here..</div>
            @endif
        </div>
    </div>
@endsection