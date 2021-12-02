@extends('layouts.app')

@section('content')

<section class="show-company" id="show-company">
  <div class="jumbotron text-center">
    <h1>Company - {{ $company->name }}</h1>
      <p class="lead">{{ $company->description }}</p>
  </div>

  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $company->name }}</li>
    </ol>
  </nav>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-9">
          <div class="project-companies" id="project-companies">
            <div class="heading">Projects <span>{{ $company->name }}</span> Company</div>
            <ul>
              <a href="/projects/create/{{ $company->id }}" class="btn btn-success mb-3 float-right">Add Project</a>
            </ul>
            <div class="box-container">
            @foreach($company->projects as $project)
                <a href="/projects/{{ $project->id }}" class="box">
                        <img src="{{ url('images/projects.jpg') }}" alt="">
                        <h3>{{ $project->name }}</h3>
                        <p class="description">{{ $project->description }}</p>
                </a>
            @endforeach
            </div>
          </div>
      </div>
      <div class="col-md-3">
        <div class="action">
          <div class="list-group">
            <a href="/companies/{{ $company->id }}/edit" class="list-group-item list-group-item-action"><i class="fa fa-edit"></i> Edit</a>
            <a href="/projects/create/{{ $company->id }}" class="list-group-item list-group-item-action"><i class="fa fa-plus"></i> Add Project</a>
            <a href="/companies" class="list-group-item list-group-item-action"><i class="fa fa-building"></i> My Company</a>
            <a href="/companies/create" class="list-group-item list-group-item-action"><i class="fas fa-plus"></i> Create Company</a>
            <a href="#" class="list-group-item list-group-item-action" 
            onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Company Ini?');
            if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();}"><i class="fas fa-trash"></i> Delete
            </a>
            <form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}" method="POST"
                style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
            </form>
          </div>
        </div>

          <hr>

          <h5 style="color:#DCDCDC; text-align:center;">Members</h5>
          <form id="add-user" class="card m-4" action="{{ route('companies.adduser') }}" method="POST">
          {{ csrf_field() }}
            <div class="input-group">
              <input type="hidden" class="form-control" name="company_id" value="{{ $company->id }}">
              <input type="text" class="form-control" name="email" style="background:#DCDCDC;" placeholder="Email">
              <button type="submit" class="btn btn-secondary">Add</button>
            </div>
          </form>

          <div class="members">
            <div class="list-group">
              <a href="/companies" class="list-group-item"><i class="fas fa-user-check"></i> {{$member->name}}</a>
            @foreach($company->users as $user)
              <div class="list-group-item">
              <a href="/companies" class="name"><i class="fas fa-user"></i> {{$user->name}}</a>
            @endforeach
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</section>

@include('layouts.footer')

  <!--<div class="col-md-9 col-lg-9 col-sm-9 float-left">
      <div class="jumbotron">
        <h1>{{ $company->name }}</h1>
        <p class="lead">{{ $company->description }}</p>
      </div>
      <div class="row col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;">
      <ol class="list-unstyled">
        <li><a href="/projects/create/{{ $company->id }}"class="float-right btn btn-primary mb-2">Add Project</a></li>
      </ol>
      @foreach($company->projects as $project)
        <div class="col-lg-4 col-sm-4 col-lg-4">
          <h2>{{ $project->name }}</h2>
          <p>{{ $project->description }} </p>
          <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button"> View project »</a></p>
        </div>
      @endforeach
      </div>
  </div>
  <div class="col-md-3 col-sm-3 col-lg-3 ">
      <h4>Aksi</h4>
          <p></p>
            <ul class="icon-list">
              <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
              <li><a href="/projects/create/{{ $company->id }}">Add Project</a></li>
              <li><a href="/companies">My Company</a></li>
              <li><a href="/companies/create">Create New Company</a></li>
              <br>
              <li>
            
                <a href="#" onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Project Ini?');
                  if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();}">Delete
                </a>
                <form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}" method="POST"
                style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
                </form>
              </li>
            </ul>
          <hr/>

          <h4>Add Members</h4>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <form id="add-user" class="card p-2" action="{{ route('companies.adduser') }}" method="POST">
                {{ csrf_field() }}
                  <div class="input-group">
                    <input type="hidden" class="form-control" name="company_id" value="{{ $company->id }}">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                    <button type="submit" class="btn btn-secondary">Add</button>
                  </div>
                </form>
              </div>
            </div>

            <br>

            <h4>Members</h4>
            <ul class="icon-list">
            
            @foreach($company->users as $user)
              <li><a href="#">{{ $user->email }}</a></li>
            @endforeach
            </ul>
            <br>
        </div>
    </div>-->

    <!----------------------------------------------------------------------->
  
      <!--<div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="fst-italic">About</h4>
          <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
        </div>-->

        <!--<div class="p-4">
          <h4 class="fst-italic">Aksi</h4>
          <ol class="list-unstyled">
            <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
            <li><a href="/projects/create">Tambah Project</a></li>
            <li><a href="/companies">List Company</a></li>
            <li><a href="/companies/create">Buat Company Baru</a></li>

            <br/>-->

            <!--<li>
            
              <a href="#" onclick="var result= confirm('Apakah Kamu Yakin Ingin Hapus Project Ini?');
                if(result){
                  event.preventDefault();
                  document.getElementById('delete-form').submit();}">Delete
              </a>
              <form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}" method="POST"
              style="display: none;">
                  <input type="hidden" name="_method" value="delete">
                  {{ csrf_field() }}
              </form>
            
            </li>-->

            <!--<li><a href="#">Tambah Member Baru</a></li>-->
          <!--</ol>
        </div>-->
        <!--<div class="p-4">
          <h4 class="fst-italic">Member</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2021</a></li>
          </ol>
        </div>-->
  </div>


@endsection

