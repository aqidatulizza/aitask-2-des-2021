@extends('layouts.app')

@section('content')

<section class="projects" id="projects">
    <div class="title text-center">
        <h1>PROJECTS</h1>
    </div>
    <ul>
        <a href="/projects/create" class="btn btn-success mb-3 float-right">Create Project</a>
    </ul>
    <div class="box-container">
    @foreach($projects as $project)
      <a href="/projects/{{ $project->id }}" class="box" style="text-decoration:none;">
          <img src="{{ url('images/projects.jpg') }}" alt="">
          <h3>{{ $project->name }}</h3>
          <h6><i class="fa fa-building"></i> {{ $project->company->name }}</h6>
          <hr>
          <p class="description">{{ $project->description }}</p>
      </a>
    @endforeach
    @foreach($projectUsers as $projectUser)
      <a href="/projects/{{ $projectUser->project_id }}" class="box" style="text-decoration:none;">
          <img src="{{ url('images/projects.jpg') }}" alt="">
          <h3>{{ $projectUser->project->name }}</h3>
          <h6><i class="fa fa-building"></i> {{ $projectUser->project->company->name }}</h6>
          <hr>
          <p class="description">{{ $projectUser->project->description }}</p>
      </a>
    @endforeach
    </div>
</section>

@include('layouts.footer')


<!--<div class="col-md-8 col-lg-8 ">
  <div class="col-md-12 float-right">
    <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Projects</h4>
          </div>
          <div class="card-body">
            <div class="list-group">
                @foreach($projects as $project)
                <a href="/projects/{{ $project->id }}" class="list-group-item list-group-item-action">{{ $project->name }}</a>
                @endforeach
            </div>
          </div>
    </div>
  </div>
</div>
<div class="col-md-4 ">
    <div class="col-md-12 col-sm-12 col-lg-12 float-left">
    <a class="pull-right btn btn-primary " href="/projects/create">Buat Project Baru</a>
    </div>
</div>-->

@endsection()
