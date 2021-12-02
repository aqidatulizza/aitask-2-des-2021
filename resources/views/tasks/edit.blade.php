@extends('layouts.app')

@section('content')

<section class="show-task">
  <div class="card">
    <div class="card-task-show">
      <div class="task-name">
          <h4>Edit Task</h4>
      </div>

    <hr>

    <form method="post" action="{{ route('tasks.update', [$task->id] ) }}" >
            {{ csrf_field() }}

            <input type="hidden" name="company_id" value="{{ $company_id }}">
            <input type="hidden" name="project_id" value="{{ $project_id }}"/>
            <input type="hidden" name="_method" value="put">

            <div class="form-group">
              <label for="namatugas" style="margin-top:.5rem;"><h6>Name <span class="required">*</span></h6></label>
              <input type="text" placeholder="Enter Name" class="form-control" id="task-name" required name="name" 
                    spellcheck="false" value="{{ $task->name }}">
            </div>
            
            <div class="form-group">
              <label for="desctugas"><h6>Description</h6></label>
              <textarea class="form-control" placeholder="Enter Description" id="description" name="description" 
                    spellcheck="false" rows="3">{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="deadline"><h6>Deadline</h6></label>
              <input type="date" class="form-control" id="deadline" name="deadline" 
              value="{{ $task->deadline }}">
            </div>
            <div class="form-group">
              <label for="filetugas"><h6>Task File</h6></label>
              <input type="file" class="form-control-file" id="file" name="file" 
                    spellcheck="false" value="{{ $task->file }}">
            </div>

            <div class="form-group">
              <label for="status"><h6>Status</h6></label>
              <select class="form-control" id="exampleFormControlSelect1" >
                <option>Select Status</option>
                <option>To Be Done</option>
                <option>On Progress</option>
                <option>Done</option>
              </select>
            </div>

            <div class="form-group">
                <a href="{{url()->previous()}}" class="btn btn-secondary mt-3">Cancel</a>
                <input type="submit" class="btn btn-primary mt-3" value="Submit">
            </div>
        
        </form>
    
    </div>
  </div>
</section>


@endsection

