<link href="{{ asset('css/comments_2.css') }}" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
<!------ Include the above in your HEAD tag ---------->
<div class="comments">
    <div class="row">
        <div class="panel panel-default widget pl-0 pr-0">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <strong>Recent Comments</strong></h3>
            </div>
            @foreach($comments as $comment)
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="https://i.pinimg.com/564x/e7/c3/f4/e7c3f4a076b8472e0b1bd9c00a847f7f.jpg" class="img-circle img-responsive" alt="" style="border-radius:100%;" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="users/{{ $comment->user->id }}" class="comment-name">
                                    {{ $comment->user->first_name }}{{ $comment->user->last_name }}{{ $comment->user->name }}</a>
                                    <div class="mic-info">
                                      <i class="fa fa-clock-o"></i>  On {{ $comment->created_at }}
                                    </div>
                                </div>
                                <div class="comment-text mb-2">
                                  <i class="fa fa-comment"></i>  {{ $comment->body }}
                                </div>
                                <div class="comment-text">
                                  Proof :  {{ $comment->url }}
                                </div>
                                <div class="action">
                                    <button type="button" class="btn float-right" title="Delete">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>