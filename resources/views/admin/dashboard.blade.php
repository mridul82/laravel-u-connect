@extends('layouts.master_template', ['title'=> 'Dashboard'])

@section('header')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection


 <!-- Left side columns -->
 <div class="col-lg-12">
    <div class="row">

        @section('content')
<div class="col-xxl-3 col-md-6">
    <div class="card info-card sales-card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Students <span>| Today</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-cart"></i>
          </div>
          <div class="ps-3">
            <h6>145</h6>
            <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

          </div>
        </div>
      </div>

    </div>
  </div><!-- End Sales Card -->

  <!-- Revenue Card -->
  <div class="col-xxl-3 col-md-6">
    <div class="card info-card revenue-card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Revenue Earn <span>| This Month</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="ps-3">
            <h6>$3,264</h6>
            <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

          </div>
        </div>
      </div>

    </div>
  </div><!-- End Revenue Card -->

  <!-- Customers Card -->
  <div class="col-xxl-3 col-xl-12">

    <div class="card info-card customers-card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Tutors <span>| This Year</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-people"></i>
          </div>
          <div class="ps-3">
            <h6>1244</h6>
            <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

          </div>
        </div>

      </div>

    </div>

  </div>
  <div class="col-xxl-3 col-xl-12">

    <div class="card info-card customers-card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Exam Conducted <span>| This Year</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-people"></i>
          </div>
          <div class="ps-3">
            <h6>100</h6>
            <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

          </div>
        </div>

      </div>

    </div>

  </div>


  <div class="col-12">
    <div class="card recent-sales overflow-auto">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Recent Students <span>| Today</span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">Register Id</th>
              <th scope="col">Student Name</th>
              <th scope="col">Phone</th>
              <th scope="col">Guardian Phone</th>
              <th scope="col">Profile Status</th>
              <th scope="col">View Details</th>
            </tr>
          </thead>
          <tbody>

              @foreach ($students as $key => $student)
              <tr>
              <th scope="row"><a href="#">#{{(!$student->profile) ? 'Profile Incomplete' : $student->profile->register_id}}</a></th>
              <td>{{ $student->name }}</td>
              <td><a href="#" class="text-primary">{{ $student->phone_number }}</a></td>
              <td>{{ (!$student->profile) ? 'Profile Incomplete' :  $student->profile->guardian_contact }}</td>
              <td><span class="badge bg-success">{{ (!$student->profile) ? 'Profile Incomplete' : 'Profile Complete' }}</span></td>
              <td> <a href="{{url('/admin/student-view/'.$student->id)}}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
              @endforeach



          </tbody>
        </table>

      </div>

    </div>
  </div><!-- End Recent Sales -->

  <div class="col-12">
    <div class="card recent-sales overflow-auto">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Recent Teachers <span>| Today</span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">Register Id</th>
              <th scope="col">Teacher Name</th>
              <th scope="col">Phone</th>
              <th scope="col">No of Students</th>
              <th scope="col">Profile Status</th>
              <th scope="col">View Details</th>

            </tr>
          </thead>
          <tbody>

              @foreach ($teachers as $key => $teacher)
              <tr>
              <th scope="row"><a href="#">#{{ (!$teacher->profile) ? 'Profile Incomplete' : $teacher->profile->register_id}}</a></th>
              <td>{{ $teacher->name }}</td>
              <td><a href="#" class="text-primary">{{ $teacher->phone_number }}</a></td>
              <td> {{ ($teacher->reference_count> 0 ) ?  $teacher->reference_count  : 0 }}</td>
              <td><span class="badge bg-success">{{ (!$teacher->profile) ? 'Profile InComplete' : 'Profile Complete'}}</span></td>
              <td>
                <a href="{{url('/admin/tutor-view/'.$teacher->id)}}" class="btn btn-primary btn-sm">View</a>
                {{-- <a href="{{url('/admin/tutor-activate/'.$teacher->id)}}" class="btn btn-success btn-sm">Activate</a> --}}



            </td>
            <td>
                @if($teacher->active && $teacher->active->is_active == 1)
                <form action="{{ route('tutor-deactivate', $teacher->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            @else
                <form action="{{ route('tutor-activate', $teacher->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            @endif
            </td>
            </tr>
              @endforeach



          </tbody>
        </table>

      </div>

    </div>
  </div>

@endsection
</div>
</div>
