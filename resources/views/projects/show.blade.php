@extends('layouts.app')

@section('content')
<section class="show-project" id="show-project">
  <ul class="nav nav-fill justify-content-center mb-4">
    <li class="nav-item bg-dark">
      <a class="nav-link" aria-current="page" href="#" style="color:#DCDCDC;"><h5><i class="fa fa-building mr-1"></i> {{ $company->name }}</h5></a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" style="color:#DCDCDC;"><h5>Project - {{ $project->name }}</h5></a>
    </li>
    <li class="nav-item">
        <div class="btn-group float-right">
          <button class="btn bg-dark text-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            Action
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="/projects/{{ $project->id }}/edit"><i class="fa fa-edit"></i> Edit</a></li>
            <li><a class="dropdown-item" href="/projects/create"><i class="fas fa-plus"></i> Create Project</a></li>
            <li><a class="dropdown-item" href="/projects"><i class="fa fa-building"></i> My Project</a></li>
            @if($project->user_id == Auth::user()->id)
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" 
            onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Project Ini?');
            if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();}"><i class="fas fa-trash"></i> Delete
            </a></li>
            <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" method="POST"
                style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
            </form>
            @endif
          </ul>
        </div>
    </li>
    <li class="nav-item">
        <div class="btn-group float-right">
          <button class="btn bg-dark text-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            Members
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item"><i class="fas fa-user-check mr-1"></i> {{$member->name}}</a></li>
            <li><hr class="dropdown-divider"></li>
            @foreach($project->users as $user)
            <li><a class="dropdown-item" href="#"><i class="fas fa-user mr-1"></i> {{$user->name}}</a></li>
            @endforeach
          </ul>
        </div>
    </li>
  </ul>

  <hr>

  <!--<div class="jumbotron text-center">
    <h1>Project - {{ $project->name }}</h1>
      <p class="lead">{{ $project->description }}</p>
  </div>

  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/companies/{{ $company->id }}">{{ $company->name }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Projects</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
    </ol>
  </nav>-->

  <!--<div class="col-md-12">
    <div class="row">
      <div class="col-md-9">
        <div class="title-task text-center">
          <h1>Task</h1>
        </div>
      </div>
      <div class="col-md-3">
        <div class="action">
          <div class="list-group">
            <a href="/projects/{{ $project->id }}/edit" class="list-group-item list-group-item-action"><i class="fa fa-edit"></i> Edit</a>
            <a href="/projects/create" class="list-group-item list-group-item-action"><i class="fas fa-plus"></i> Create Project</a>
            <a href="/projects" class="list-group-item list-group-item-action"><i class="fa fa-building"></i> My Project</a>
            
            @if($project->user_id == Auth::user()->id)
            <a href="#" class="list-group-item list-group-item-action" 
            onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Project Ini?');
            if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();}"><i class="fas fa-trash"></i> Delete
            </a>
            <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" method="POST"
                style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
            </form>
            @endif
          </div>
        </div>

          <hr>-->

          <h6 style="color:#DCDCDC; text-align:center;">Add Member</h6>
          <form id="add-user" class="card " action="{{ route('projects.adduser') }}" method="POST">
          {{ csrf_field() }}
            <div class="input-group">
              <input type="hidden" class="form-control" name="project_id" value="{{ $project->id }}">
              <input type="text" class="form-control" name="email" style="background:#DCDCDC;" placeholder="Email">
              <button type="submit" class="btn btn-secondary">Add</button>
            </div>
          </form>

          <!--<div class="members">
            <div class="list-group">
              <a href="/projects" class="list-group-item"><i class="fas fa-user-check"></i> {{$member->name}}</a>
            @foreach($project->users as $user)
              <a href="/projects" class="list-group-item"><i class="fas fa-user"></i> {{$user->name}}</a>
            @endforeach
            </div>
          </div>-->

      </div>
    </div>
  </div>
  <nav>>

  <div class="project-task">
  <div class="title-task text-center">
    <h1>Task</h1>
  </div>

    <a class="create-task" type="submit" href="/tasks/create/{{ $project->id }}" >Add New Task</a>

  <div class="col-md-12 col-sm-12 col-lg-12">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-lg-4">
        <div class="card p-3">
          <div class="task-tobedone">
            <h6><i class="fas fa-clipboard fa-lg"></i> To Be Done </h6>
          </div>
          <div class="task">
            <div class="box-container">
            @foreach($project->tasks as $task)
            @if ($task->status_id==1)
              <div class="box">
                <div class="icons">
                  <a href="/tasks/{{ $task->id }}" class="fas fa-eye"></a>
                  <a href="" class="fa fa-edit"></a>
                  <a href="" class="fas fa-trash"></a>
                </div>
                <div class="content">
                  <h6>{{$task->name}}</h6>
                  @if ($task->deadline!=null)
                  <div class="deadline"><i class="far fa-clock"></i> {{ date('d M', strtotime($task->deadline)) }}</div>
                  @endif
                </div>
              </div>
            @endif
            @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-lg-4">
        <div class="card p-3">
          <div class="task-onprogress">
            <h6><i class="fas fa-clipboard"></i> On Progress</h6>
          </div>
          @foreach($project->tasks as $task)
          @if ($task->status_id==2)
          <div class="task">
            <div class="box-container">
                <div class="box">
                  <div class="icons">
                    <a href="/tasks/{{ $task->id }}" class="fas fa-eye"></a>
                    <a href="" class="fa fa-edit"></a>
                    <a href="" class="fas fa-trash"></a>
                  </div>
                  <div class="content">
                    <h6>{{$task->name}}</h6>
                    @if ($task->deadline!=null)
                    <div class="deadline"><i class="far fa-clock"></i> {{ $task->deadline->format('d M') }}</div>
                    @endif
                  </div>
                </div>
              </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-lg-4">
        <div class="card p-3">
          <div class="task-done">
            <h6><i class="fas fa-clipboard"></i> Done</h6>
          </div>
          @foreach($project->tasks as $task)
          @if ($task->status_id==3)
          <div class="task">
            <div class="box-container">
                <div class="box">
                  <div class="icons">
                    <a href="/tasks/{{ $task->id }}" class="fas fa-eye"></a>
                    <a href="" class="fa fa-edit"></a>
                    <a href="" class="fas fa-trash"></a>
                  </div>
                  <div class="content">
                    <h6>{{$task->name}}</h6>
                    @if ($task->deadline!=null)
                    <div class="deadline"><i class="far fa-clock"></i> {{ $task->deadline->format('d M') }}</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  </div>
</section>


<!----------------------------------------------------------------------------------->

  <!--<div class="col-md-9 col-lg-9 col-sm-9 float-left">
      <div class="bg-light p-5 rounded mt-3">
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
      </div>

      <div class="row col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;">
  
      <br/>

      <div class="row container-fluid">-->

      <!--<form method="post" action="{{ route('comments.store' ) }}">
            {{ csrf_field() }}

            <input type="hidden" name="commentable_type" value="App\Project">
            <input type="hidden" name="commentable_id" value="{{$project->id}}">

            <div class="form-group">
            <label for="comment-content">Comment</label>
            <textarea placeholder="" style="resize: vertical" id="comment-content" name="body" 
            rows="3" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <div class="form-group">
            <label for="comment-content">Proof a work done </label>
            <textarea placeholder="Enter URL" style="resize: vertical" id="comment-content" name="url" 
            rows="2" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
        </div>
        
      </div>
  </div>-->
  <!--<div class="col-md-3 col-sm-3 col-lg-3 ">
      <h4>Aksi</h4>
            <ul class="icon-list">
              <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
              <li><a href="/projects/create">Create New Project</a></li>
              <li><a href="/projects">My project</a></li>
              <br>

              @if($project->user_id == Auth::user()->id)
              <li>
            
                <a href="#" onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Project Ini?');
                  if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();}">Delete
                </a>
                <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" method="POST"
                style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
                </form>
              </li>
              @endif
            </ul>
            
          <hr>

          <h4>Add Members</h4>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <form id="add-user" class="card p-2" action="{{ route('projects.adduser') }}" method="POST">
                {{ csrf_field() }}
                  <div class="input-group">
                    <input type="hidden" class="form-control" name="project_id" value="{{ $project->id }}">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                    <button type="submit" class="btn btn-secondary">Add</button>
                  </div>
                </form>
              </div>
            </div>

            <br>

            <h4>Members</h4>
            <ul class="icon-list">
            @foreach($project->users as $user)
              <li><a href="#">{{ $user->email }}</a></li>
            @endforeach
            </ul>
              <br>

    </div>
      
  </div>-->
  


@endsection

