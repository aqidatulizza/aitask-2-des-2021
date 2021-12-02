@extends('layouts.app')

@section('content')

<section class="show-task">
  <div class="card">
    <div class="card-task-show">
      <div class="company-name">
          <h4>Create New Company</h4>
      </div>

    <hr>

    <form method="post" action="{{ route('companies.store' ) }}">
            {{ csrf_field() }}

            <div class="form-group">
            <label for="company-name" style="margin-top:.5rem;"><h6>Name<span class="required">*</span></h6></label>
            <input placeholder="Enter Name" id="company-name" required name="name" 
            spellcheck="false" class="form-control"/>
            </div>

            <div class="form-group">
            <label for="company-content"><h6>Description</h6></label>
            <textarea placeholder="Enter Description" style="resize: vertical" id="company-content" name="description" 
            rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <div class="form-group">
                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
      </form>
    
    </div>
  </div>
</section>


@endsection

