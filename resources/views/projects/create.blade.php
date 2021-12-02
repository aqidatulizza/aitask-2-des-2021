@extends('layouts.app')

@section('content')

<section class="show-task">
  <div class="card">
    <div class="card-task-show">
      <div class="task-name">
          <h4>Create New Project</h4>
      </div>

    <hr>

    <form method="post" action="{{ route('projects.store' ) }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="project-name" style="margin-top:.5rem;"><h6>Name <span class="required">*</span></h6></label>
              <input placeholder="Enter Name" id="project-name" required name="name" 
              spellcheck="false" class="form-control"/>
            </div>

            <div class="form-group">
              <label for="project-content"><h6>Description</h6></label>
              <textarea placeholder="Enter Description" style="resize: vertical" id="project-content" name="description" 
              rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <!--if(($company_id != null)) juga bisa-->
            @if($companies==null)
            <input type="hidden" name="company_id" value="{{ $company_id }}"/>
            @endif

            <!--if(($company_id == null)) juga bisa-->
            @if($companies!=null)
            <div class="form-group">
              <label for="company-content"><h6>Select Company</h6></label>
              <select name="company_id" class="form-control">
                @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                @foreach($companyUsers as $companyUser)
                <option value="{{ $companyUser->company_id }}">{{ $companyUser->company->name }}</option>
                @endforeach
              </select>
            </div>
            @endif

            <div class="form-group">
                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>

    </form>
    
    </div>
  </div>
</section>

@endsection