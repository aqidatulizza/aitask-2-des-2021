@extends('layouts.app')

@section('content')
<section class="home" id="home">
    <div class="content">
        <h3>title</h3>
        <p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</strong></p>
        <a href="" class="btn btn-success" style="font-size: 1.3rem;">button</a>
    </div>
</section>

<section class="about" id="about">
    <div class="title text-center">
        <h1>ABOUT US</h1>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 p-0">
                <div class="image">
                    <img src="{{ url('images/about.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-md-6">
            <div class="content">
                <h3>lorem ipsum</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                    laboris nisi ut aliquip ex ea commodo consequat.<br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua.</p>
            </div>
            </div>
        </div>
    </div>
</section>

<section class="companies">
    <div class="title text-center">
        <h1>COMPANIES</h1>
    </div>
    <ul>
        <a href="" class="btn btn-success mb-3 float-right">Create Company</a>
    </ul>
    <div class="box-container">
        <div class="box">
            <img src="{{ url('images/companies.jpg') }}" alt="">
            <h3>title</h3>
            <!--<div class="description"></div>-->
            <a href="" class="btn btn-success">View Company</a>
        </div>
    </div>
</section>

@include('layouts.footer')

@endsection
