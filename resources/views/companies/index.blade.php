@extends('layouts.app')

@section('content')

<section class="companies">
    <div class="title text-center">
        <h1>COMPANIES</h1>
    </div>
    <ul>
        <a href="/companies/create" class="btn btn-success mb-3 float-right">Create Company</a>
    </ul>
    <div class="box-container">
    @foreach($companies as $company)
        <div class="box">
            <img src="{{ url('images/companies.jpg') }}" alt="">
            <h3>{{ $company->name }}</h3>
            <!--<div class="description"></div>-->
            <a href="/companies/{{ $company->id }}" class="btn btn-success">View Company</a>
        </div>
    @endforeach
    @foreach($companyUsers as $companyUser)
        <div class="box">
            <img src="{{ url('images/companies.jpg') }}" alt="">
            <h3>{{ $companyUser->company->name }}</h3>
            <!--<div class="description"></div>-->
            <a href="/companies/{{ $companyUser->company_id }}" class="btn btn-success">View Company</a>
        </div>
    @endforeach
    </div>
</section>

@include('layouts.footer')


<!--<section class="company-index">
<div class="col-md-8 col-lg-8 ">
  <div class="col-md-12 float-right">
    <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Companies</h4>
          </div>
          <div class="card-body">
            <div class="list-group">
                @foreach($companies as $company)
                <a href="/companies/{{ $company->id }}" class="list-group-item list-group-item-action">{{ $company->name }}</a>
                @endforeach
                @foreach($companyUsers as $companyUser)
                <a href="/companies/{{ $companyUser->company_id }}" class="list-group-item list-group-item-action">{{ $companyUser->company->name }}</a>
                @endforeach
            </div>
          </div>
    </div>
  </div>
</div>

<div class="col-md-3 ">
    <div class="col-md-12 col-sm-12 col-lg-12 float-right">
    <a class="pull-right btn btn-primary " href="/companies/create">Buat Company Baru</a>
    </div>
</div>
</section>-->

@endsection()
