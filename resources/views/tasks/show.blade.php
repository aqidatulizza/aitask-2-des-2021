@extends('layouts.app')

@section('content')

<section class="show-task">
  <div class="card">
    <div class="card-task-show">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-8 col-sm-8 col-lg-8">
            <div class="task-name">
              <h4>{{ $task->name }}</h4>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 col-lg-2">
            @if ($task->deadline!=null)
            <div class="deadline-show"><i class="far fa-clock"></i> {{ date('d M Y', strtotime($task->deadline)) }}</div>
            @endif
          </div>
          <div class="col-md-2 col-sm-2 col-lg-2">
            @if ($task->status_id==1)
            <div class="status-tobedone float-right">{{ $status->name}}</div>
            @endif
            @if ($task->status_id==2)
            <div class="status-onprogress float-right">{{ $status->name}}</div>
            @endif
            @if ($task->status_id==3)
            <div class="status-done float-right">{{ $status->name}}</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <hr>

    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <div class="company-project"><i class="fa fa-building"></i> {{ $company->name }} 
            <span><i class="fas fa-caret-right"></i></span> Project - {{ $project->name }}</div>
            <div class="description-task">
              <h6>Description : </h6>
              @if ($task->description==null)
              <textarea disabled class="span-description-null"></textarea>
              @endif
              @if ($task->description!=null)
              <textarea disabled class="span-description">{{ $task->description }}</textarea>
              @endif

              <script>
                const textarea = document.querySelector("textarea");
                textarea.addEventListener("keyup", e => {
                  textarea.style.height= "120px";
                  let scHeight = e.target.scrollHeight;
                  textarea.style.height= '${scHeight}px';
                });
              </script>
            </div>

          @foreach($task->itemChecklist as $itemchecklist)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
              {{ $itemchecklist->item }}
            </label>
          </div>
          @endforeach

          <form method="post" action="{{ route('itemchecklists.store' ) }}">
            {{ csrf_field() }}

            <input type="hidden" name="task_id" value="{{$task->id}}">

          <div class="checklist-task col-md-12 mt-3">
            <div class="row">
              <div class="col-md-10 p-0">
                <div class="checklist form-group">
                  <input type="text" class="form-control" name="item" id="item" spellcheck="false" placeholder="Add Checklist">
                </div>
              </div>
              <div class="col-md-2 col-sm-2 col-lg-2 p-0">
                <button class="add-checklist" type="submit">Add</button>
              </div>
            </div>
          </div>
          </form>

        </div>
        <div class="add col-md-3">
          <h6>Add Member</h6>
          <form id="add-user" class="input-group" action="{{ route('tasks.adduser') }}" method="POST">
          {{ csrf_field() }}
              <input type="hidden" class="form-control" name="task_id" value="{{ $task->id }}">
              <input type="text" class="form-control" name="email" style="background:#DCDCDC;" placeholder="Email">
              <button type="submit" class="btn btn-secondary">Add</button>
          </form>
          <div class="members-task">
            <div class="list-group">
              <a href="/tasks" class="list-group-item"><i class="fas fa-user-check"></i> {{$member->name}}</a>
            @foreach($task->users as $user)
              <div class="list-group-item">
              <a href="/companies" class="name"><i class="fas fa-user"></i> {{$user->name}}</a>
              </div>
            @endforeach
            </div>
          </div>

          <hr>

          <div class="action">
          <div class="list-group">
            <a href="/tasks/{{ $task->id }}/edit" class="list-group-item list-group-item-action"><i class="fa fa-edit"></i> Edit</a>
            <a href="/tasks/create/{{ $project->id }}" class="list-group-item list-group-item-action"><i class="fa fa-plus"></i> Add Task</a>
            <a href="/tasks" class="list-group-item list-group-item-action"><i class="fa fa-building"></i> My Task</a>
            <a href="#" class="list-group-item list-group-item-action" 
            onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Company Ini?');
            if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();}"><i class="fas fa-trash"></i> Delete
            </a>
            <form id="delete-form" action="{{ route('tasks.destroy', [$task->id]) }}" method="POST"
                style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
            </form>
          </div>
        </div>
        
        </div>
      </div>
    </div>
    

  </div>
</section>

@endsection