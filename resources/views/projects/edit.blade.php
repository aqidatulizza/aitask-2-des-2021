@extends('layouts.app')

@section('content')

<section class="show-task">
  <div class="card">
    <div class="card-task-show">
      <div class="task-name">
          <h4>Edit Project</h4>
      </div>

    <hr>

    <form method="post" action="{{ route('projects.update', [$project->id] ) }}" >
            {{ csrf_field() }}

            <input type="hidden" name="company_id" value="{{ $company_id }}">
            <input type="hidden" name="_method" value="put">

            <div class="form-group" >
            <label for="project-name" style="margin-top:.5rem;"><h6>Name <span class="required">*</span></h6></label>
            <input placeholder="Enter Name" id="project-name" required name="name" 
            spellcheck="false" class="form-control" value="{{ $project->name }}" />
            </div>

            <div class="form-group">
            <label for="project-content"><h6>Description</h6></label>
            <textarea placeholder="Enter Description" style="resize: vertical" id="project-content" name="description" 
            rows="5" spellcheck="false" class="form-control autosize-target text-left">{{ $project->description }}</textarea>
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

