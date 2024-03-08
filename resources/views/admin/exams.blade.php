@extends('layouts.master_template', ['title'=> 'Exams'])
@section('header')
<div class="pagetitle">
    <h1>Exams</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Exams</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="col-lg-4">

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Exam Data Entry</h5>

          <!-- Multi Columns Form -->


            <form method="POST" action="{{ route('add-exam') }}" class="row g-3">
                @csrf

            <div class="col-12">
                <label for="inputTest" class="form-label">Test Code</label>
                <input type="text" class="form-control" name="test_code" id="inputAddres5s" placeholder="">
              </div>
            <div class="col-md-12">
              <label for="inputTest" class="form-label">Test Name</label>
              <select id="inputTest" class="form-select" name="test_series_name">
                <option selected>Choose a Test...</option>
                <option value="Rank Booster Test">Rank Booster Test</option>
                <option value="Target Board Test">Target Board Test</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="inputSubject" class="form-label">Sujects</label>
              <select id="inputSubject" class="form-select" name="subjects">
                <option selected>Choose a Subject...</option>
                <option value="Maths">Maths</option>
                <option value="Science">Science</option>
              </select>
            </div>


            <div class="col-12">
              <label for="inputChapterName" class="form-label">Chapter name</label>
              <input type="text" class="form-control" id="inputChapterName" placeholder="" name="chapter_name">
            </div>
            <div class="col-md-12">
              <label for="inputPrice" class="form-label">Chapter Price</label>
              <input type="text" class="form-control" id="inputPrice" name="test_price">
            </div>

            {{-- <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Check me out
                </label>
              </div>
            </div> --}}
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>
</div>
<div class="col-lg-8">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">View Exams</h5>

      <!-- Default Table -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Test Code</th>
            <th scope="col">Test Name</th>
            <th scope="col">Subject</th>
            <th scope="col">Chapter</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           @if (!$exams)
               'No data found'
           @else

           @foreach ($exams as $key => $exam)
           <tr>
               <th scope="row"></th>
               <td>{{$exam->test_code}}</td>
               <td>{{$exam->test_series_name}}</td>
               <td>{{$exam->subjects}}</td>
               <td>{{$exam->chapter_name}}</td>
               <td>₹{{$exam->test_price}}</td>
               <td><a href="{{url('/admin/exam/delete/'.$exam->id)}}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
           </tr>
           @endforeach


           @endif





        </tbody>
      </table>
      <!-- End Default Table Example -->
    </div>
  </div>
</div>
@endsection

