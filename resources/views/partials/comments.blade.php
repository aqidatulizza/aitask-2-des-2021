<div class="mt-4" style="background-color:grey;">
<h2 >Comments</h2>
        <hr>
          <!-- Comment -->
          <article class="row">
            <div class="col-md-1 col-sm-1 hidden-xs">
            <i class="fa fa-user fa-3x"></i>
            </div>
            @foreach($comments as $comment)
            <div class="col-md-11 col-sm-11">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><strong><a href="users/{{ $comment->user->id }}" class="comment-name" >{{ $comment->user->first_name }}{{ $comment->user->last_name }}{{ $comment->user->name }}</a></strong></div>
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{ $comment->user->created_at }}</time>
                  </header>
                  <div class="comment-post">
                    <p><i class="fa fa-comment"></i>
                    {{ $comment->body }}
                    </p>
                    <p><!--<i class="fa fa-link"></i>-->Proof : 
                    {{ $comment->url }}
                    </p>
                  </div>
                  <!--<p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>-->
                </div>
              </div>
            </div>
            @endforeach
          </article>
          <hr/>
</div>