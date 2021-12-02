<!--create project lama-->

@extends('layouts.app')

@section('content')

  <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
      <h1>Create New Project</h1>

      <!-- Example row of columns -->
      <div class="row col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;">
        <form method="post" action="{{ route('projects.store' ) }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="project-name">Name <span class="required">*</span></label>
              <input placeholder="Enter Name" style="width:750px" id="project-name" required name="name" 
              spellcheck="false" class="form-control"/>
            </div>

            <!--if(($company_id != null)) juga bisa-->
            @if($companies==null)
            <input type="hidden" name="company_id" value="{{ $company_id }}"/>
            @endif

            <!--if(($company_id == null)) juga bisa-->
            @if($companies!=null)
            <div class="form-group">
              <label for="company-content">Select Company</label>
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
              <label for="project-content">Description</label>
              <textarea placeholder="Enter Description" style="resize: vertical" id="project-content" name="description" 
              rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>

        
        
        </form>
      </div>
  </div>
  <div class="col-md-3 col-sm-3 col-lg-3 pull-right">
      <!--<div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="fst-italic">About</h4>
          <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
        </div>-->

        <div class="p-4">
          <h4 class="fst-italic">Aksi</h4>
          <ol class="list-unstyled">
            <li><a href="/projects">List project</a></li>
          </ol>
        </div>
        <!--<div class="p-4">
          <h4 class="fst-italic">Member</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2021</a></li>
          </ol>
        </div>-->
      </div>


@endsection

<!--edit project lama-->class

@extends('layouts.app')

@section('content')
<div class="container">

  <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
      

      <!-- Example row of columns -->
      <div class="row col-md-12 col-lg-12 col-sm-12" style="margin: 10px;">
        <form method="post" action="{{ route('projects.update', [$project->id] ) }}">
            {{ csrf_field() }}

            <input type="hidden" name="company_id" value="{{ $company_id }}">
            <input type="hidden" name="_method" value="put">

            <div class="form-group">
            <label for="project-name">Name <span class="required">*</span></label>
            <input placeholder="Enter Name" style="width:750px" id="project-name" required name="name" 
            spellcheck="false" class="form-control" value="{{ $project->name }}" />
            </div>

            <div class="form-group">
            <label for="project-content">Description</label>
            <textarea placeholder="Enter Description" style="resize: vertical" id="project-content" name="description" 
            rows="5" spellcheck="false" class="form-control autosize-target text-left">{{ $project->description }}</textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>

        
        
        </form>
      </div>
  </div>
  <div class="col-md-3 col-sm-3 col-lg-3 pull-right">
      <!--<div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="fst-italic">About</h4>
          <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
        </div>-->

        <div class="p-4">
          <h4 class="fst-italic">Aksi</h4>
          <ol class="list-unstyled">
            <li><a href="/projects/{{ $project->id }}">Lihat Project</a></li>
            <li><a href="/projects">Semua Project</a></li>
          </ol>
        </div>
        <!--<div class="p-4">
          <h4 class="fst-italic">Member</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2021</a></li>
          </ol>
        </div>-->
      </div>
  </div>

@endsection