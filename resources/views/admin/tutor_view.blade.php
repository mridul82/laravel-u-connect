@extends('layouts.master_template', ['title'=> 'Dashboard'])

@section('header')
<div class="pagetitle">
    <h1>Tutor Detail View</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Tutor Detail View</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection
@section('content')
<div class="col-xl-4">

    <div class="card">
      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

        <img src="{{asset($tutor->profile_pic)}}" height="150" width="150" alt="Profile" class="rounded-circle">
        <h2>Teacher Id:{{ $tutor->register_id }}</h2>
        <h3>Phone: {{ $tutor->whatapp_no }}</h3>

      </div>
    </div>

  </div>
  <div class="col-xl-8">

    <div class="card">
      <div class="card-body pt-3">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Teacher Details</button>
          </li>


        </ul>
        <div class="tab-content pt-2">

          <div class="tab-pane fade show active profile-overview" id="profile-overview">

            <h5 class="card-title">Profile Details</h5>

            <div class="row">
              <div class="col-lg-3 col-md-4 label ">Full Name</div>
              <div class="col-lg-9 col-md-8">{{$tutor->credential->name}}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Address</div>
              <div class="col-lg-9 col-md-8">{{$tutor->present_address}}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">specialisation</div>
              <div class="col-lg-9 col-md-8">{{$tutor->specialisation}}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Subjects</div>
              <div class="col-lg-9 col-md-8">{{$tutor->preferred_subject}}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Preferred Location & time</div>
              <div class="col-lg-9 col-md-8">{{$tutor->preferred_location}} & {{$tutor->preferred_time}}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Aadhar Card </div>
              <div class="col-lg-9 col-md-8"><img src="{{asset($tutor->education_document1)}}" height="200" width="550" alt="Profile" ></div>
            </div>



          </div>



      </div>
    </div>

  </div>
@endsection
